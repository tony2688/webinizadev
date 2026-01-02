<?php

namespace App\Services;

class AiRouter
{
    /**
     * Este router ahora está "mudo". 
     * Devuelve siempre NULL para que Gemini maneje el 100% de la conversación.
     */
    public static function answer(string $input): ?string
    {
        // No hay reglas fijas. Todo pasa a la IA.
        return null;
    }
}