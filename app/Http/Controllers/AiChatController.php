<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Services\AiRouter; // Asegúrate de que este archivo exista en app/Services/AiRouter.php

class AiChatController extends Controller
{
    public function chat(Request $request)
    {
        try {
            $input = $request->input('prompt');
            $apiKey = env('GEMINI_API_KEY');

            // 1. Validaciones Básicas
            if (!$input) return response()->json(['reply' => '¿En qué puedo ayudarte?']);
            if (!$apiKey) return response()->json(['reply' => 'Error: Falta configurar la API Key en .env']);

            // 2. Router (Envuelto en try/catch por si la clase no carga)
            try {
                if (class_exists(AiRouter::class)) {
                    $routerResponse = AiRouter::answer($input);
                    if ($routerResponse) {
                        return response()->json(['reply' => $routerResponse]);
                    }
                }
            } catch (\Exception $e) {
                // Si falla el router, seguimos con la IA normal sin detenernos
                Log::error('Error en AiRouter: ' . $e->getMessage());
            }

            // 3. Historial y Configuración
            $history = Session::get('chat_history', []);
            
            $businessInfo = "
                EMPRESA: WebinizaDev
                EXPERTO: Antonio Romero.
                UBICACIÓN: Tucumán, Argentina.
                WHATSAPP: +54 9 381 555-5648.
                SERVICIOS: Automatización IA (USD 390+), Web (USD 349+), E-commerce (USD 1299+).
            ";

            $systemInstruction = [
                'role' => 'user',
                'parts' => [['text' => "
                    Actúa como 'Agente W' de WebinizaDev.
                    Contexto: $businessInfo
                    Reglas: Sé breve (max 50 palabras), útil y lleva al usuario al WhatsApp.
                    Usuario dice: $input
                "]]
            ];

            // 4. Preparar Mensaje
            // Usamos gemini-1.5-flash que es más estable y rápido
            $model = "gemini-1.5-flash"; 
            
            // Unimos instrucciones + historial
            // Nota: Simplificamos para evitar duplicados. Enviamos contexto + historial.
            $contents = array_merge([$systemInstruction], $history);

            // 5. Conexión a Google
            $response = Http::withHeaders(['Content-Type' => 'application/json'])
                ->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}", [
                    'contents' => $contents
                ]);

            $json = $response->json();

            // 6. Procesar Respuesta Exitos
            if (isset($json['candidates'][0]['content']['parts'][0]['text'])) {
                $botReply = $json['candidates'][0]['content']['parts'][0]['text'];
                
                // Limpiar formato Markdown (**negrita**)
                $botReply = str_replace(['**', '*'], '', $botReply);

                // Guardar en historial
                $history[] = ['role' => 'user', 'parts' => [['text' => $input]]];
                $history[] = ['role' => 'model', 'parts' => [['text' => $botReply]]];
                // Limitamos historial a los últimos 6 mensajes para no saturar
                if (count($history) > 6) $history = array_slice($history, -6);
                Session::put('chat_history', $history);

                return response()->json(['reply' => $botReply]);
            }

            // 7. Manejo de Errores Específicos de Google
            if (isset($json['error'])) {
                $msg = $json['error']['message'] ?? 'Error desconocido de Google';
                return response()->json(['reply' => "Error de IA: $msg"]);
            }

            return response()->json(['reply' => 'No entendí, ¿puedes repetir?']);

        } catch (\Throwable $e) {
            // AQUÍ ESTÁ EL CAMBIO IMPORTANTE:
            // Devolvemos el mensaje real del error en lugar de "Error de conexión"
            // para saber exactamente qué está fallando.
            return response()->json(['reply' => 'Error Interno: ' . $e->getMessage()]);
        }
    }
}