<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Services\AiRouter;
use Illuminate\Support\Facades\Mail;

class AiChatController extends Controller
{
    public function chat(Request $request)
    {
        // 1) Input y Estado del Flujo
        $promptRaw = (string) $request->input('prompt', '');
        $prompt = trim($promptRaw);
        $flowState = $request->session()->get('ai_flow');
        $flowActive = is_array($flowState) && isset($flowState['flow'], $flowState['step']);

        // Normalización de Menú (1, 2, 3...)
        $menuNormalized = $this->normalizeMenu($promptRaw);
        if ($menuNormalized !== null && (!$flowActive || $this->isTerminalStep((array) $flowState))) {
            $intentReply = $this->replyForMenuIntent($request, $menuNormalized);
            if (is_string($intentReply) && $intentReply !== '') {
                return response()->json(['reply' => $intentReply]);
            }
            $prompt = $menuNormalized;
        }

        if ($prompt === '') {
            return response()->json(['error' => 'prompt vacío'], 422);
        }

        // 2) Atajos Rápidos (AiRouter) - PRIORIDAD ALTA
        // Se ejecuta antes del filtro estricto para permitir preguntas como "Servicios" o "Precios"
        if (!$flowActive) {
            $routerReply = \App\Services\AiRouter::answer($promptRaw);
            // Si AiRouter devuelve algo válido (y no un rechazo interno), lo usamos.
            if (is_string($routerReply) && $routerReply !== '' && !str_contains($routerReply, 'solo con temas de WebinizaDev')) {
                return response()->json(['reply' => $routerReply]);
            }
        }

        // 3) Configuración de Entorno (Gemini API)
        $base = rtrim(env('AI_BASE_URL', 'https://generativelanguage.googleapis.com/v1beta/openai/'), '/');
        $path = '/' . ltrim(env('AI_PATH', 'chat/completions'), '/');
        $model = env('AI_MODEL', 'gemini-1.5-flash');
        $system = env('AI_SYSTEM', 'Sos el Consultor de Eficiencia Digital de WebinizaDev.');
        $apiKey = env('AI_API_KEY', '');

        $temperature = (float) env('AI_TEMP', 0.7);
        $maxTokens = (int) env('AI_MAX_TOKENS', 500);
        $timeout = (int) env('AI_TIMEOUT', 60);
        $sslVerify = filter_var(env('AI_SSL_VERIFY', false), FILTER_VALIDATE_BOOL);

        $refusalMsg = env('AI_REFUSAL_MESSAGE', 'Solo puedo ayudarte con lo que hacemos en WebinizaDev.');
        $strict = filter_var(env('AI_STRICT_DOMAIN', true), FILTER_VALIDATE_BOOL);
        $allowTerms = $this->parseAllowTerms(env('AI_ALLOWED_TERMS', ''));

        if ($apiKey === '') {
            return response()->json(['error' => 'Falta AI_API_KEY de Gemini en el .env'], 500);
        }

        // 4) Filtro de Seguridad y Dominio
        $identityTerms = ['sos un bot', 'eres un bot', 'sos bot', 'sos una ia', 'sos humano', 'sos real', 'quién sos', 'quien sos'];
        $isIdentity = false;
        foreach ($identityTerms as $t) {
            if ($t !== '' && mb_stripos(mb_strtolower($prompt), $t) !== false) {
                $isIdentity = true;
                break;
            }
        }

        // Si es estricto, no hay flujo activo, no es permitido y no pregunta identidad -> Rechazar
        if ($strict && !$flowActive && !$this->isOnDomain($prompt, $allowTerms) && !$isIdentity) {
            return response()->json(['reply' => $this->humanize($refusalMsg, $request)]);
        }

        // 5) Progreso de Flujos (Captura de Leads)
        if (!$flowActive) {
            $prompt = $this->normalizePrompt($prompt);
        }

        $flowReplyEarly = $this->progressFlow($request, $promptRaw);
        if (is_string($flowReplyEarly) && $flowReplyEarly !== '') {
            return response()->json(['reply' => $flowReplyEarly]);
        }

        // 6) Headers para Gemini API (OpenAI Compatible)
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $apiKey,
        ];

        // 7) Construcción de Mensajes
        $messages = [
            ['role' => 'system', 'content' => $system],
            ['role' => 'user', 'content' => $prompt],
        ];

        // 8) Payload y Llamada
        $payload = [
            'model' => $model,
            'messages' => $messages,
            'temperature' => $temperature,
            'max_tokens' => $maxTokens,
            'stream' => false,
        ];

        try {
            $http = Http::withHeaders($headers)->timeout($timeout);
            if (!$sslVerify)
                $http = $http->withoutVerifying();

            $resp = $http->post($base . $path, $payload);

            if (!$resp->successful()) {
                Log::error('Error API Gemini', ['status' => $resp->status(), 'body' => $resp->body()]);
                return response()->json(['reply' => $this->humanize($refusalMsg, $request)]);
            }

            $json = $resp->json() ?? [];
            $reply = $json['choices'][0]['message']['content'] ?? null;

            if (!is_string($reply) || trim($reply) === '') {
                $reply = $refusalMsg;
            }

            $reply = $this->sanitizeReply($reply, $promptRaw);
            $reply = $this->humanize($reply, $request);

            return response()->json([
                'reply' => $reply,
                'model' => $json['model'] ?? $model,
            ]);

        } catch (\Throwable $e) {
            Log::error('Excepción en chat', ['msg' => $e->getMessage()]);
            return response()->json(['reply' => $refusalMsg]);
        }
    }

    // --- MÉTODOS PRIVADOS ---

    private function replyForMenuIntent(Request $request, string $intent): string
    {
        $i = mb_strtolower(trim($intent));

        // Mensajes PROFESIONALES para iniciar la captura de datos
        $askContact = [
            'Excelente iniciativa. Para preparar una propuesta técnica a medida, ¿podrías indicarme tu **nombre completo** y **correo electrónico**?',
            'Perfecto. Para avanzar con seriedad, necesito generar una ficha de cliente. ¿Me indicás tu **nombre y apellido** y un **email** de contacto?',
        ];

        // Opción 1: Web / Landing
        if (str_contains($i, 'primera página') || str_contains($i, 'crear mi primera')) {
            $request->session()->put('ai_flow', ['flow' => 'first_web', 'step' => 0, 'data' => []]);
            return "Una web profesional es el activo más importante de tu marca.\n\n" . $this->pick($askContact);
        }

        // Opción 2: Mejorar Web (Auditoría)
        if (str_contains($i, 'mejorar una web') || str_contains($i, 'rediseño')) {
            $request->session()->put('ai_flow', ['flow' => 'improve_web', 'step' => 0, 'data' => []]);
            return "Entendido. Vamos a analizar qué está fallando en tu sitio actual.\n\n" . $this->pick($askContact);
        }

        // Opción 3: E-commerce (Ventas)
        if (str_contains($i, 'tienda online') || str_contains($i, 'e-commerce')) {
            $request->session()->put('ai_flow', ['flow' => 'ecommerce', 'step' => 0, 'data' => []]);
            return "El E-commerce requiere estrategia para ser rentable.\n\n" . $this->pick($askContact);
        }

        // Opción 4: Asesoría / IA
        if (str_contains($i, 'asesoría') || str_contains($i, 'otro')) {
            $request->session()->put('ai_flow', ['flow' => 'advisory', 'step' => 0, 'data' => []]);
            return "Bien. La tecnología debe resolver problemas reales.\n\n" . $this->pick($askContact);
        }

        return '';
    }

    private function progressFlow(Request $request, string $input): ?string
    {
        $flow = $request->session()->get('ai_flow');
        if (!is_array($flow) || !isset($flow['flow'], $flow['step']))
            return null;

        $cur = (string) $flow['flow'];
        $step = (int) $flow['step'];
        $data = is_array($flow['data'] ?? null) ? $flow['data'] : [];
        $in = trim($input);

        // Lógica unificada de captura de contacto para todos los flujos
        if (in_array($cur, ['first_web', 'ecommerce', 'improve_web', 'advisory'])) {

            // Paso 0: Captura de Nombre y Email
            if ($step === 0) {
                $c = $this->extractContact($in);
                $nombre = $c['nombre'] !== 'Cliente' ? $c['nombre'] : ($data['contact_name'] ?? '');
                $email = $c['correo'] !== '' ? $c['correo'] : ($data['contact_email'] ?? '');
                $tel = $c['telefono'] !== '' ? $c['telefono'] : ($data['contact_tel'] ?? '');

                // Guardamos lo que tenemos
                if ($nombre !== 'Cliente')
                    $data['contact_name'] = $nombre;
                if ($email !== '')
                    $data['contact_email'] = $email;
                if ($tel !== '')
                    $data['contact_tel'] = $tel;

                // Validación: Necesitamos al menos Nombre y Email para avanzar
                if (isset($data['contact_name']) && isset($data['contact_email'])) {
                    $flow['step'] = 1;
                    $flow['data'] = $data;
                    $request->session()->put('ai_flow', $flow);
                    return "Gracias, {$data['contact_name']}. Ahora contame brevemente: ¿cuál es el objetivo principal de este proyecto? (Ej: Vender más, Automatizar consultas, Tener presencia).";
                }

                return "Necesito tus datos para poder enviarte la propuesta. ¿Me indicás tu **Nombre** y **Email**?";
            }

            // Paso 1: Captura de Objetivo y Cierre
            if ($step === 1) {
                $data['objetivo'] = $in;
                // Intentamos capturar teléfono si lo pasó ahora
                $c = $this->extractContact($in);
                if ($c['telefono'] !== '')
                    $data['contact_tel'] = $c['telefono'];

                $this->finalizeLead($request, $cur, $data, $data['contact_name'], ($data['contact_tel'] ?? ''), $data['contact_email']);

                return "¡Perfecto! Ya tengo tu ficha técnica. 🚀\n\nAnalizaré tu caso ({$in}) y te enviaré una propuesta formal a **{$data['contact_email']}** en las próximas 24hs.\n\nSi querés acelerar el proceso, escribime ahora a nuestro WhatsApp con la referencia: #PROPUESTA-{$data['contact_name']}.";
            }
        }

        return null;
    }

    private function normalizeMenu(string $raw): ?string
    {
        $t = trim(mb_strtolower($raw));
        $map = [
            '1' => 'Crear mi primera página web (Landing o Institucional) para mi negocio',
            '2' => 'Mejorar una web existente (rediseño/optimización/SEO)',
            '3' => 'Hacer una tienda online para vender productos (e-commerce)',
            '4' => 'Otro / No estoy seguro, necesito asesoría para elegir la mejor solución',
        ];
        return $map[$t] ?? null;
    }

    private function isOnDomain(string $text, array $allowList): bool
    {
        $q = mb_strtolower($text);
        foreach ($allowList as $kw) {
            if ($kw !== '' && mb_strpos($q, $kw) !== false)
                return true;
        }
        return false;
    }

    private function parseAllowTerms(?string $csv): array
    {
        $base = ['hola', 'ia', 'automatización', 'web', 'página', 'n8n', 'chatbot', 'contacto', 'whatsapp', 'presupuesto', 'planes', 'servicios', 'precios'];
        return array_values(array_unique(array_merge($base, array_filter(explode(',', (string) $csv)))));
    }

    private function sanitizeReply(string $text, string $prompt): string
    {
        $t = $text;
        $brands = ['OpenAI', 'ChatGPT', 'Google', 'Gemini', 'Anthropic', 'Claude'];
        foreach ($brands as $b) {
            $t = str_ireplace($b, 'WebinizaDev', $t);
        }
        return $t;
    }

    private function humanize(string $text, Request $r): string
    {
        if (mb_stripos($text, '¿') === false && mb_stripos($text, '?') === false) {
            return rtrim($text) . ' ¿Te puedo ayudar con algo más?';
        }
        return $text;
    }

    private function pick(array $options): string
    {
        return $options[mt_rand(0, count($options) - 1)];
    }

    private function isTerminalStep(array $flow): bool
    {
        return false;
    }
    private function normalizePrompt(string $p): string
    {
        return $p;
    }

    // --- HELPERS DE EXTRACCIÓN REALES ---

    private function extractContact(string $text): array
    {
        $raw = trim($text);
        $email = '';
        // Regex para Email
        if (preg_match('/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}/i', $raw, $m)) {
            $email = (string) ($m[0] ?? '');
        }

        // Regex para Teléfono
        $digits = preg_replace('/[^0-9]/', '', $raw);
        $tel = '';
        if (is_string($digits) && strlen($digits) >= 7) {
            $tel = $digits;
        } else {
            if (preg_match('/\+?\d[\d\s\-]{6,}\d/', $raw, $mm)) {
                $tel = preg_replace('/\D+/', '', (string) $mm[0]);
            }
        }

        // Limpieza para Nombre
        $tmp = $raw;
        if ($email !== '')
            $tmp = str_replace($email, '', $tmp);
        if ($tel !== '')
            $tmp = preg_replace('/\d+/', '', $tmp);
        $nameCandidate = preg_replace('/[^\\p{L}\s]/u', '', $tmp);
        $nombre = trim(preg_replace('/\s+/', ' ', (string) $nameCandidate));

        if ($nombre === '' || mb_strlen($nombre) < 2)
            $nombre = 'Cliente';

        return ['nombre' => $nombre, 'telefono' => $tel, 'correo' => $email];
    }

    private function cleanName(string $text): string
    {
        $nameCandidate = preg_replace('/[^\\p{L}\s]/u', '', $text);
        return trim(preg_replace('/\s+/', ' ', (string) $nameCandidate));
    }

    private function finalizeLead(Request $request, string $cur, array $data, string $nombre, string $tel, string $email)
    {
        $to = 'info@webinizadev.com'; // Tu email real
        $subject = 'Nuevo Lead IA - ' . $cur;

        $body = "Nuevo Lead desde el Chatbot IA:\n\n";
        $body .= "Nombre: {$nombre}\n";
        $body .= "Email: {$email}\n";
        $body .= "Teléfono: {$tel}\n";
        $body .= "Interés: {$cur}\n";
        $body .= "Objetivo/Datos: " . json_encode($data, JSON_UNESCAPED_UNICODE) . "\n";

        try {
            Mail::raw($body, function ($message) use ($to, $subject) {
                $message->to($to)->subject($subject);
            });
        } catch (\Throwable $e) {
            Log::error('Fallo al enviar mail de lead', ['error' => $e->getMessage()]);
        }

        // Limpiamos el flujo
        $request->session()->forget('ai_flow');
    }
}