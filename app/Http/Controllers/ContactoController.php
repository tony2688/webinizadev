<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function enviar(Request $request)
    {
        $datos = $request->validate([
            'nombre'   => 'required|string|max:255',
            'empresa'  => 'nullable|string|max:255',
            'correo'   => 'required|email',
            'telefono' => 'nullable|string|max:20',
            'asunto'   => 'required|string|max:255',
            'mensaje'  => 'required|string',
        ]);

        Mail::send([], [], function ($message) use ($datos) {
            $message->to('info@webinizadev.com')
                // ✅ Copia oculta SIEMPRE a tu Gmail (string fijo, no puede ser null)
                ->bcc('antonioorlandoromero2688@gmail.com')
                ->subject('Nuevo mensaje de contacto: ' . $datos['asunto'])
                ->text(
                    "Nombre: {$datos['nombre']}\n" .
                    "Empresa: " . ($datos['empresa'] ?? '-') . "\n" .
                    "Correo: {$datos['correo']}\n" .
                    "Teléfono: " . ($datos['telefono'] ?? '-') . "\n\n" .
                    "Mensaje:\n" .
                    "{$datos['mensaje']}"
                );
        });

        return back()->with('success', '¡Mensaje enviado correctamente!');
    }
}
