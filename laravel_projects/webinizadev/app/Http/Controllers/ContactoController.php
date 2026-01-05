<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ContactoController extends Controller
{
    public function enviar(Request $request)
    {
        // 1. Validación: Nombres exactos de tu contacto.blade.php
        $datos = $request->validate([
            'nombre'   => 'required|string|max:255',
            'correo'   => 'required|email',
            'servicio' => 'required|string', // Antes decía 'asunto'
            'mensaje'  => 'required|string',
            'empresa'  => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        // ---------------------------------------------------------
        // PASO 1: Asegurar el Lead en n8n (Prioridad #1)
        // ---------------------------------------------------------
        try {
            // URL de tu Ngrok actual (Verificá que siga siendo esta en tu consola negra)
            $url_n8n = 'https://telekinetic-leola-isopachous.ngrok-free.dev/webhook-test/8c881d78-cdf9-4710-82be-ded60be1b7fa';

            // Enviamos todo a n8n
            $response = Http::timeout(10)->post($url_n8n, array_merge($datos, [
                'origen' => 'Web WebinizaDev',
                'fecha'  => now()->toDateTimeString(),
                'ubicacion' => 'San Miguel de Tucumán'
            ]));

            if ($response->successful()) {
                Log::info('✅ Lead enviado a n8n');
            }
            
        } catch (\Exception $e) {
            Log::error('⚠️ Error de conexión n8n: ' . $e->getMessage());
        }

        // ---------------------------------------------------------
        // PASO 2: Enviar Correo Tradicional
        // ---------------------------------------------------------
        try {
            Mail::send([], [], function ($message) use ($datos) {
                $message->to('info@webinizadev.com')
                    ->bcc('antonioorlandoromero2688@gmail.com')
                    ->subject('Nuevo Lead - Servicio: ' . $datos['servicio'])
                    ->text("Nombre: {$datos['nombre']}\nEmail: {$datos['correo']}\nEmpresa: " . ($datos['empresa'] ?? 'N/A') . "\nServicio: {$datos['servicio']}\n\nMensaje: {$datos['mensaje']}");
            });
        } catch (\Exception $e) {
            Log::error('⚠️ Error Mail: ' . $e->getMessage());
        }

        // 3. Respuesta al usuario
        return back()->with('success', '¡Gracias Antonio! Recibimos tu consulta correctamente.');
    }
}