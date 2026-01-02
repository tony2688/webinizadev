<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
// use App\Http\Controllers\ContactoController; // (Opcional si usabas BD local)

// ==========================================
// 1. RUTA PRINCIPAL (HOME)
// ==========================================
Route::get('/', function () {
    return view('layouts.app');
});

// ==========================================
// 2. RUTA DE CONTACTO (MODIFICADA PARA N8N + VIP)
// ==========================================
Route::post('/contacto/enviar', function (Request $request) {
    
    // 1. Capturamos TODOS los datos del formulario
    // (Asegúrate que en tu HTML los inputs tengan name="nombre", "email", "telefono", "presupuesto")
    $datos = $request->validate([
        'nombre' => 'required',
        'email'  => 'required|email',
        'mensaje' => 'nullable',
        'telefono' => 'nullable',
        'presupuesto' => 'nullable' 
    ]);

    // 2. URL de N8N (La misma de Producción)
    $n8nUrl = "https://n8n-production-e796.up.railway.app/webhook/8c881d78-cdf9-4710-82be-ded60be1b7fa";

    try {
        // 3. ENVIAR A N8N (Aquí ocurre la magia VIP)
        // Agregamos 'tipo' => 'formulario' para que tu Switch en n8n sepa diferenciarlo del Chat
        Http::post($n8nUrl, array_merge($datos, [
            'tipo' => 'formulario',
            'origen' => 'web_contacto',
            'fecha' => now()->toDateTimeString()
        ]));

        // 4. Responder al Frontend (Tu web mostrará "Mensaje Enviado")
        return response()->json(['status' => 'ok', 'message' => 'Recibido correctamente.']);

    } catch (\Exception $e) {
        // Si falla n8n, al menos le decimos al usuario que hubo un error técnico, pero no rompemos la web.
        return response()->json(['status' => 'error', 'message' => 'Error de conexión.']);
    }

})->name('contacto.enviar');


// ==========================================
// 3. CHATBOT CONECTADO A N8N (Nube Railway)
// ==========================================
Route::post('/ai/chat', function (Request $request) {
    
    // 1. Validar que el usuario escribió algo
    $input = $request->input('prompt');
    if (!$input) return response()->json(['reply' => '🤔 Te escucho...']);

    // 2. CONFIGURACIÓN DE N8N PRO (RAILWAY)
    // ⚠️ CORREGIDO: URL FINAL (Sin "-test") para que funcione 24/7
    $n8nUrl = "https://n8n-production-e796.up.railway.app/webhook/8c881d78-cdf9-4710-82be-ded60be1b7fa"; 

    try {
        // 3. Enviar mensaje a la Nube
        $response = Http::timeout(30)->post($n8nUrl, [
            'prompt' => $input,
            'fecha' => now()->toDateTimeString()
        ]);

        // 4. Procesar la respuesta
        if ($response->successful()) {
            $data = $response->json();
            
            $reply = $data['output'] ?? $data['reply'] ?? $data['text'] ?? null;

            if (!$reply && is_string($data)) {
                $reply = $data; 
            }

            if (is_array($reply)) $reply = json_encode($reply);

            return response()->json(['reply' => $reply ?? 'El agente recibió el mensaje pero no supo qué decir.']);
        } else {
            return response()->json(['reply' => 'Error técnico: El servidor respondió ' . $response->status()]);
        }

    } catch (\Exception $e) {
        // MENSAJE FINAL
        return response()->json(['reply' => '⚠️ Disculpa, estamos actualizando nuestros sistemas de IA. Por favor intenta en unos minutos.']);
    }

})->name('ai.chat');