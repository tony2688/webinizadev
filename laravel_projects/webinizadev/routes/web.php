<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\AiChatController;

// ==========================================
// 1. RUTA PRINCIPAL (HOME)
// ==========================================
Route::get('/', function () {
    return view('layouts.app');
});

// ==========================================
// 2. RUTA DE CONTACTO (PRODUCCIÓN)
// ==========================================
Route::post('/contacto/enviar', function (Request $request) {
    
    // Validación
    $datos = $request->validate([
        'nombre'   => 'required|string|max:255',
        'correo'   => 'required|email|max:255',
        'empresa'  => 'nullable|string|max:255',
        'telefono' => 'nullable|string|max:50',
        'servicio' => 'nullable|string|max:100',
        'mensaje'  => 'required|string|max:2000',
    ]);

    try {
        // Preparar Email
        $destinatario = 'info@webinizadev.com'; 
        $asunto = "🚀 Nuevo Lead Web: " . $datos['nombre'];

        $cuerpo = "Tienes un nuevo contacto desde la web:\n\n" .
                  "👤 Nombre: " . $datos['nombre'] . "\n" .
                  "🏢 Empresa: " . ($datos['empresa'] ?? '-') . "\n" .
                  "📧 Email: " . $datos['correo'] . "\n" .
                  "📱 Teléfono: " . ($datos['telefono'] ?? '-') . "\n" .
                  "🛠️ Servicio: " . ($datos['servicio'] ?? 'General') . "\n\n" .
                  "📝 Mensaje:\n" . $datos['mensaje'];

        // Enviar
        Mail::raw($cuerpo, function ($msg) use ($destinatario, $asunto, $datos) {
            $msg->to($destinatario)
                ->subject($asunto)
                ->replyTo($datos['correo']);
        });

        return response()->json(['status' => 'ok', 'message' => '¡Mensaje enviado con éxito! Te contactaremos pronto.']);

    } catch (\Exception $e) {
        // Guardamos el error real en privado (Log) y mostramos uno genérico al usuario
        Log::error('Error Contacto: ' . $e->getMessage());
        return response()->json(['status' => 'error', 'message' => 'Hubo un error técnico. Por favor escríbenos al WhatsApp.']);
    }

})->name('contacto.enviar');

// ==========================================
// 3. CHATBOT INTELIGENTE (DIRECTO GEMINI - CERO COSTO)
// ==========================================
Route::post('/ai/chat', [AiChatController::class, 'chat'])->name('ai.chat');