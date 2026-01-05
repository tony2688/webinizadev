<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class AiChatController extends Controller
{
    public function chat(Request $request)
    {
        try {
            $input = $request->input('prompt');
            $apiKey = env('GEMINI_API_KEY');

            // 1. Validaciones
            if (!$input) return response()->json(['reply' => '👋 ¡Hola! ¿Cómo puedo ayudarte a escalar tu negocio hoy?']);
            if (!$apiKey) return response()->json(['reply' => 'Error técnico: Falta API Key.']);

            // 2. Historial
            $history = Session::get('chat_history', []);

            // 3. CARGAR DATOS
            $facts = config('ai_facts');
            
            // Datos de respaldo (Por seguridad)
            if (!$facts) {
                $facts = [
                    'empresa' => ['nombre' => 'WebinizaDev'],
                    'contacto' => ['whatsapp' => '+54 9 381 555-5648'],
                    'planes' => [],
                    'equipo' => []
                ];
            }

            // Link limpio para la IA
            $linkWa = "https://wa.me/" . str_replace(['+',' ','-'], '', $facts['contacto']['whatsapp']);

            // Contexto de Negocio
            $infoNegocio = "
                EMPRESA: {$facts['empresa']['nombre']}
                SERVICIOS Y PRECIOS REFERENCIALES:
                " . json_encode($facts['planes'], JSON_UNESCAPED_UNICODE) . "
                
                EQUIPO:
                " . json_encode($facts['equipo'], JSON_UNESCAPED_UNICODE) . "
            ";

            // 4. INSTRUCCIONES DEL SISTEMA (LÓGICA CORREGIDA)
            $contextoSistema = "
                ERES: 'Agente W', Consultor de Negocios Digitales en {$facts['empresa']['nombre']}.
                
                CONOCIMIENTO:
                $infoNegocio

                REGLAS DE COTIZACIÓN (LEER CON ATENCIÓN):
                1.  **SI PIDEN 'VENDER ONLINE', 'TIENDA' O 'E-COMMERCE':**
                    - OFRECE: **Plan E-commerce Pro** (USD 1.299).
                    - EXPLICACIÓN: Este es el único plan que permite vender productos, cobrar y manejar stock.
                    - ¡NO OFREZCAS el plan de $390 aquí! (Ese es solo un chatbot, no una tienda).

                2.  **SI PIDEN 'CHATBOT', 'RESPONDER MENSAJES' O 'ATENCIÓN AUTOMÁTICA':**
                    - OFRECE: **Plan Automatización IA** (USD 390).
                    - Ideal para negocios que ya tienen web o venden por redes.

                REGLAS DE FORMATO VISUAL (OBLIGATORIAS):
                1.  **NO** envíes bloques de texto gigantes.
                2.  Usa **Negritas** para resaltar el Plan recomendado y el Precio.
                3.  Usa **Listas** (con guiones -) para enumerar qué incluye.
                4.  Usa **Emojis** 🚀✨ para dar calidez.
                5.  Separa ideas con **doble salto de línea**.

                REGLAS DE VENTA:
                1.  **CERO SPAM:** Link de WhatsApp ($linkWa) SOLO al final si hay interés de compra.
                2.  **RESPONDE PRIMERO:** Aclara la duda técnica.
                3.  **GENERA INTERÉS:** Termina con una pregunta abierta.
            ";

            // 5. MODELO
            $model = "gemini-2.5-flash";

            // 6. PAYLOAD
            $payload = [
                'system_instruction' => [
                    'parts' => [
                        ['text' => $contextoSistema]
                    ]
                ],
                'contents' => array_merge($history, [
                    [
                        'role' => 'user',
                        'parts' => [['text' => $input]]
                    ]
                ])
            ];

            // 7. CONEXIÓN API
            $response = Http::withHeaders(['Content-Type' => 'application/json'])
                ->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}", $payload);

            $json = $response->json();

            // 8. PROCESAR RESPUESTA
            if (isset($json['candidates'][0]['content']['parts'][0]['text'])) {
                $botReply = $json['candidates'][0]['content']['parts'][0]['text'];
                
                // Guardar historial
                $history[] = ['role' => 'user', 'parts' => [['text' => $input]]];
                $history[] = ['role' => 'model', 'parts' => [['text' => $botReply]]];
                
                if (count($history) > 12) $history = array_slice($history, -12);
                Session::put('chat_history', $history);

                return response()->json(['reply' => $botReply]);
            }

            if (isset($json['error'])) {
                $msg = $json['error']['message'] ?? 'Error desconocido';
                return response()->json(['reply' => "⚠️ Ajustando sistema... ¿Me repites la pregunta? ($msg)"]);
            }

            return response()->json(['reply' => 'No capté bien la idea. ¿Me das más detalles?']);

        } catch (\Throwable $e) {
            return response()->json(['reply' => 'Error de conexión. Intenta de nuevo.']);
        }
    }
}