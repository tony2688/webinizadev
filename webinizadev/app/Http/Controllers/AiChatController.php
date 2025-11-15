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
        // 1) Input
        $promptRaw = (string) $request->input('prompt', '');
        $prompt = trim($promptRaw);
        $flowState = $request->session()->get('ai_flow');
        $flowActive = is_array($flowState) && isset($flowState['flow'], $flowState['step']);
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

        // 2) Config env
        $base        = rtrim(env('AI_BASE_URL', ''), '/');
        $path        = '/' . ltrim(env('AI_PATH', '/v1/generate'), '/');
        $model       = env('AI_MODEL', 'qwen2.5:7b-instruct-q4_K_M');
        $system      = env('AI_SYSTEM', 'Sos el asistente oficial de WebinizaDev.');
        $apiKey      = env('AI_API_KEY', '');
        $tenant      = env('AI_TENANT_ID', 'default');

        $temperature = (float) env('AI_TEMP', 0.3);
        $maxTokens   = (int) env('AI_MAX_TOKENS', 400);
        $timeout     = (int) env('AI_TIMEOUT', 45);
        $sslVerify   = filter_var(env('AI_SSL_VERIFY', true), FILTER_VALIDATE_BOOL);

        // RAG
        $kbRaw       = env('AI_KB', 'kb-webinizadev-v1');
        $kbName      = $kbRaw;
        if (str_contains($kbRaw, '/')) {
            $kbName = pathinfo($kbRaw, PATHINFO_FILENAME);
        } elseif (str_ends_with($kbRaw, '.json')) {
            $kbName = pathinfo($kbRaw, PATHINFO_FILENAME);
        }
        $topK        = (int) env('AI_TOP_K', 5);
        $minScore    = (float) env('AI_MIN_SCORE', 0.12);
        $fallback    = env('AI_FALLBACK', 'refuse'); // 'refuse' | 'llm'
        $refusalMsg  = env('AI_REFUSAL_MESSAGE', 'Solo puedo responder sobre WebinizaDev. ¿Querés consultar servicios, plazos o contacto?');

        // Guard de dominio
        $strict      = filter_var(env('AI_STRICT_DOMAIN', true), FILTER_VALIDATE_BOOL);
        $allowTerms  = $this->parseAllowTerms(env('AI_ALLOWED_TERMS', ''));

        if ($base === '')   return response()->json(['error' => 'AI_BASE_URL no configurado'], 500);
        if ($apiKey === '' || $tenant === '')
            return response()->json(['error' => 'Faltan credenciales AI_API_KEY / AI_TENANT_ID'], 500);

        // 3) Prefiltro de dominio (bloquea fuera de tema), pero permite identidad del bot
        $identityTerms = ['sos un bot','eres un bot','sos bot','sos una ia','sos humano','sos real','quién sos','quien sos'];
        $isIdentity = false;
        foreach ($identityTerms as $t) { if ($t !== '' && mb_stripos(mb_strtolower($prompt), $t) !== false) { $isIdentity = true; break; } }
        if ($strict && !$flowActive && !$this->isOnDomain($prompt, $allowTerms) && !$isIdentity) {
            return response()->json(['reply' => $this->humanize($refusalMsg, $request)]);
        }

        // 4) Desambiguación leve
        if (!$flowActive) {
            $prompt = $this->normalizePrompt($prompt);
        }

        // 4.1) Short-circuits locales: identidad, contacto y planes
        $pLower = mb_strtolower($promptRaw);

        // Priorizar flujo activo sobre atajos de identidad/contacto
        $flowReplyEarly = $this->progressFlow($request, $promptRaw);
        if (is_string($flowReplyEarly) && $flowReplyEarly !== '') {
            return response()->json(['reply' => $flowReplyEarly]);
        }

        // Atajos solo si NO hay flujo activo
        if (!$flowActive) {
            $identityTerms = ['sos un bot','eres un bot','sos bot','sos una ia','sos humano','sos real','quién sos','quien sos'];
            foreach ($identityTerms as $t) {
                if ($t !== '' && mb_stripos($pLower, $t) !== false) {
                    return response()->json(['reply' => 'Soy un asistente basado en IA, desarrollado por WebinizaDev, entrenado con información real de WebinizaDev para ayudarte como si charlaras con alguien del equipo.']);
                }
            }
            $contactTerms = ['contacto','whatsapp','tel','telefono','email','correo','contactarme','contactarte','agendar','llamar','llamada','reunion','reunión'];
            foreach ($contactTerms as $t) {
                if ($t !== '' && mb_stripos($pLower, $t) !== false) {
                    $c = config('ai_facts.contacto');
                    $wa = $c['whatsapp'] ?? '';
                    $em = $c['email'] ?? '';
                    $ho = $c['horario'] ?? '';
                    $cta = $c['cta'] ?? '';
                    return response()->json(['reply' => "Podés escribirnos por WhatsApp {$wa} o por email {$em}. Horario: {$ho}. {$cta}"]); 
                }
            }
            $genericSiteTerms = ['quiero una pagina','quiero una página','necesito una pagina','necesito una página','hacer una pagina','hacer una página','crear una web','necesito una web'];
            foreach ($genericSiteTerms as $t) {
                if ($t !== '' && mb_stripos($pLower, $t) !== false) {
                    $reply = "Perfecto, te ayudo a definir la mejor solución para tu empresa.\n\nResumen: querés una página para tu negocio.\n\nPara avanzar rápido, contame de a una por vez:\n1) Rubro/actividad\n2) Objetivo principal (vender online, recibir consultas, portfolio)\n3) Plazo estimado\n4) Rango de presupuesto (orientativo)\n\nMientras, opciones habituales:\n1️⃣ Landing Page — 3–5 días — USD 349\n2️⃣ Página Institucional — 7–10 días — USD 749\n3️⃣ Tienda Online — 10–14 días — USD 1.299\n4️⃣ Otro / No estoy seguro, necesito asesoría\n\n¿Querés que te contactemos por WhatsApp para una propuesta? Dejame nombre y número.";
                    return response()->json(['reply' => $reply]);
                }
            }
        }
        $planTerms = ['plan','planes','precio','precios','cuesta','tarifa','valen','landing','portfolio','institucional','seo','ecommerce','e-commerce','dashboard','ia'];
        foreach ($planTerms as $t) {
            if ($t !== '' && mb_stripos($pLower, $t) !== false) {
                $r = \App\Services\AiRouter::answer($promptRaw);
                if (is_string($r) && $r !== '') {
                    return response()->json(['reply' => $r]);
                }
                break;
            }
        }
        if ($flowActive) {
            $q = $this->flowQuestion($flowState);
            if (is_string($q) && $q !== '') {
                return response()->json(['reply' => $q]);
            }
        }

        // 5) Headers
        $headers = [
            'Content-Type' => 'application/json',
            'X-API-Key'    => $apiKey,
            'X-Tenant'     => $tenant,
        ];
        if (env('CF_ACCESS_CLIENT_ID') && env('CF_ACCESS_CLIENT_SECRET')) {
            $headers['CF-Access-Client-Id']     = env('CF_ACCESS_CLIENT_ID');
            $headers['CF-Access-Client-Secret'] = env('CF_ACCESS_CLIENT_SECRET');
        }

        // 6) Mensajes
        $messages = [
            ['role' => 'system', 'content' => $system],
        ];
        $messages[] = ['role' => 'user', 'content' => $prompt];

        $conversationId = 'wz-' . bin2hex(random_bytes(8));

        // 7) Payload
        $payload = [
            'tenant_id'       => $tenant,
            'model'           => $model,

            'messages'        => $messages,
            'prompt'          => $prompt,
            'system'          => $system,

            'stream'          => false,
            'temperature'     => $temperature,
            'max_tokens'      => $maxTokens,

            // RAG
            'search'          => true,
            'kb'              => $kbName,
            'top_k'           => $topK,
            'min_score'       => $minScore,
            'fallback'        => $fallback,
            'refusal_message' => $refusalMsg,

            'reset_context'   => true,
            'conversation_id' => $conversationId,
        ];

        try {
            $http = Http::withHeaders($headers)->timeout($timeout);
            if (!$sslVerify) $http = $http->withoutVerifying();

            $resp = $http->post($base . $path, $payload);

            if (!$resp->successful()) {
                $fallbackReply = \App\Services\AiRouter::answer($promptRaw);
                if (!is_string($fallbackReply) || trim((string) $fallbackReply) === '') {
                    $fallbackReply = $refusalMsg;
                }
                $fallbackReply = $this->sanitizeReply($fallbackReply, $promptRaw);
                $fallbackReply = $this->humanize($fallbackReply, $request);
                return response()->json(['reply' => $fallbackReply]);
            }

            $json  = $resp->json() ?? [];
            $reply =
                $json['reply'] ??
                $json['response'] ??
                ($json['choices'][0]['message']['content'] ?? null) ??
                ($json['message']['content'] ?? null) ?? null;

            if (!is_string($reply) || trim($reply) === '') {
                $reply = $refusalMsg;
            }
        if ($strict && !$flowActive && !$this->isOnDomain($promptRaw, $allowTerms)) {
            $reply = $refusalMsg;
        }

            $reply = $this->sanitizeReply($reply, $promptRaw);
            $reply = $this->routeReply($reply, $promptRaw);
            $reply = $this->humanize($reply, $request);

            return response()->json([
                'reply' => $reply,
                'model' => $json['model'] ?? $model,
                'usage' => $json['usage'] ?? null,
            ]);
        } catch (\Throwable $e) {
            Log::warning('Fallo llamada a LLM', ['msg' => $e->getMessage()]);
            $fallbackReply = \App\Services\AiRouter::answer($promptRaw);
            if (!is_string($fallbackReply) || trim((string) $fallbackReply) === '') {
                $fallbackReply = $refusalMsg;
            }
            $fallbackReply = $this->sanitizeReply($fallbackReply, $promptRaw);
            $fallbackReply = $this->humanize($fallbackReply, $request);
            return response()->json(['reply' => $fallbackReply]);
        }
    }

    private function sanitizeReply(string $text, string $prompt): string
    {
        $t = $text;
        $brands = ['Alibaba Cloud','Aliyun','OpenAI','ChatGPT','Anthropic','Claude','Qwen'];
        foreach ($brands as $b) {
            if (mb_stripos($t, $b) !== false) {
                $t = str_ireplace($b, 'WebinizaDev', $t);
            }
        }
        $p = mb_strtolower($prompt);
        $botQ = ['sos un bot','eres un bot','sos bot','sos una ia','sos humano','sos real','quién sos','quien sos'];
        foreach ($botQ as $q) {
            if ($q !== '' && mb_stripos($p, $q) !== false) {
                return 'Soy un asistente basado en IA, desarrollado por WebinizaDev, entrenado con información real de WebinizaDev para ayudarte como si charlaras con alguien del equipo.';
            }
        }
        return $t;
    }

    private function routeReply(string $text, string $prompt): string
    {
        $q = mb_strtolower($prompt);
        $contactTerms = ['contacto','whatsapp','tel','telefono','email','correo','contactarme','contactarte','agendar','llamar','llamada','reunion','reunión'];
        foreach ($contactTerms as $t) {
            if ($t !== '' && mb_stripos($q, $t) !== false) {
                $c = config('ai_facts.contacto');
                $wa = $c['whatsapp'] ?? '';
                $em = $c['email'] ?? '';
                $ho = $c['horario'] ?? '';
                $cta = $c['cta'] ?? '';
                return "Podés escribirnos por WhatsApp {$wa} o por email {$em}. Horario: {$ho}. {$cta}";
            }
        }
        $genericSiteTerms = ['quiero una pagina','quiero una página','necesito una pagina','necesito una página','hacer una pagina','hacer una página','crear una web','necesito una web'];
        foreach ($genericSiteTerms as $t) {
            if ($t !== '' && mb_stripos($q, $t) !== false) {
                $reply = "Perfecto, te ayudo a definir la mejor solución para tu empresa.\n\nResumen: querés una página para tu negocio.\n\nPara avanzar rápido, contame de a una por vez:\n1) Rubro/actividad\n2) Objetivo principal (vender online, recibir consultas, portfolio)\n3) Plazo estimado\n4) Rango de presupuesto (orientativo)\n\nMientras, opciones habituales:\n1️⃣ Landing Page — 3–5 días — USD 349\n2️⃣ Página Institucional — 7–10 días — USD 749\n3️⃣ Tienda Online — 10–14 días — USD 1.299\n4️⃣ Otro / No estoy seguro, necesito asesoría\n\n¿Querés que te contactemos por WhatsApp para una propuesta? Dejame nombre y número.";
                return $reply;
            }
        }
        $planTerms = ['plan','planes','precio','precios','cuesta','tarifa','valen','landing','portfolio','institucional','seo','ecommerce','e-commerce','dashboard','ia'];
        foreach ($planTerms as $t) {
            if ($t !== '' && mb_stripos($q, $t) !== false) {
                $r = AiRouter::answer($prompt);
                if (is_string($r) && $r !== '') return $r;
                break;
            }
        }
        return $text;
    }

    private function replyForMenuIntent(Request $request, string $intent): string
    {
        $i = mb_strtolower(trim($intent));
        if ($i === mb_strtolower('Crear mi primera página web (Landing o Institucional) para mi negocio')) {
            $request->session()->put('ai_flow', ['flow' => 'first_web', 'step' => 0, 'data' => []]);
            return $this->pick([
                '¿Me pasás tu nombre y apellido completo y tu correo? Ejemplo: Juan Pérez, juan@correo.com',
                'Para seguir, necesito nombre y apellido y tu email. Ej: Ana García, ana@mail.com',
            ]);
        }
        if ($i === mb_strtolower('Mejorar una web existente (rediseño/optimización/SEO)')) {
            $request->session()->put('ai_flow', ['flow' => 'improve_web', 'step' => 0, 'data' => []]);
            return $this->pick([
                '¿Me pasás tu nombre y apellido completo y tu correo? Ejemplo: Juan Pérez, juan@correo.com',
                'Para seguir, necesito nombre y apellido y tu email. Ej: Ana García, ana@mail.com',
            ]);
        }
        if ($i === mb_strtolower('Hacer una tienda online para vender productos (e-commerce)')) {
            $request->session()->put('ai_flow', ['flow' => 'ecommerce', 'step' => 0, 'data' => []]);
            return $this->pick([
                '¿Me pasás tu nombre y apellido completo y tu correo? Ejemplo: Juan Pérez, juan@correo.com',
                'Para seguir, necesito nombre y apellido y tu email. Ej: Ana García, ana@mail.com',
            ]);
        }
        if ($i === mb_strtolower('Otro / No estoy seguro, necesito asesoría para elegir la mejor solución')) {
            $request->session()->put('ai_flow', ['flow' => 'advisory', 'step' => 0, 'data' => []]);
            return $this->pick([
                '¿Me pasás tu nombre y apellido completo y tu correo? Ejemplo: Juan Pérez, juan@correo.com',
                'Para seguir, necesito nombre y apellido y tu email. Ej: Ana García, ana@mail.com',
            ]);
        }
        return '';
    }

    private function progressFlow(Request $request, string $input): ?string
    {
        $flow = $request->session()->get('ai_flow');
        if (!is_array($flow) || !isset($flow['flow'], $flow['step'])) return null;
        $cur = (string) $flow['flow'];
        $step = (int) $flow['step'];
        $data = is_array($flow['data'] ?? null) ? $flow['data'] : [];
        $in = trim($input);
        if ($cur === 'first_web') {
            if ($step === 0) {
                $c = $this->extractContact($in);
                $nombreIn = (string) ($c['nombre'] ?? '');
                $emailIn  = (string) ($c['correo'] ?? '');
                $telIn    = (string) ($c['telefono'] ?? '');
                $nombre = $nombreIn !== '' ? $nombreIn : (string) ($data['contact_name'] ?? '');
                $email  = $emailIn  !== '' ? $emailIn  : (string) ($data['contact_email'] ?? '');
                $tel    = $telIn    !== '' ? $telIn    : (string) ($data['contact_tel'] ?? '');
                if (($nombre === '' || mb_strlen($nombre) < 2) && $email === '') {
                    return $this->pick([
                        '¿Me pasás tu nombre y apellido completo y tu correo? Ejemplo: Juan Pérez, juan@correo.com',
                        'Para seguir, necesito nombre y apellido y tu email. Ej: Ana García, ana@mail.com',
                    ]);
                }
                if (($nombre === '' || mb_strlen($nombre) < 2) && $email !== '') {
                    $data['contact_email'] = $email;
                    if ($tel !== '') $data['contact_tel'] = $tel;
                    $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                    return $this->pick([
                        '¿Tu nombre y apellido completo?','Me pasás tu nombre y apellido, por favor?'
                    ]);
                }
                if (($nombre !== '' && mb_strlen($nombre) >= 2) && $email === '') {
                    $data['contact_name'] = $nombre;
                    if ($tel !== '') $data['contact_tel'] = $tel;
                    $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                    return $this->pick([
                        '¿Tu correo electrónico?','Me pasás tu email de contacto?'
                    ]);
                }
                $data['contact_name'] = $nombre;
                $data['contact_email'] = $email;
                if ($tel !== '') $data['contact_tel'] = $tel;
                $flow['step'] = 1; $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                return $this->pick([
                    'Genial, querés tu primera web. ¿Qué rubro/actividad tenés y en qué provincia estás? Podés responder con número o con tus palabras.',
                    'Buenísimo. Para entenderte, decime rubro/actividad y provincia. Podés responder con número o con tus palabras.',
                ]);
            }
            if ($step === 1) {
                $data['rubro_provincia'] = $in;
                $flow['step'] = 2; $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                return $this->pick([
                    "Perfecto. ¿Cuál es el objetivo principal?\n1) Presencia / recibir consultas\n2) Portfolio\n3) Vender online\n4) Otro\nPodés responder con número o con tus palabras.",
                    "Bien. ¿Cuál sería el objetivo principal?\n1) Presencia / consultas\n2) Portfolio\n3) Vender online\n4) Otro",
                ]);
            }
            if ($step === 2) {
                $obj = $this->mapObjective($in);
                $data['objetivo'] = $obj;
                $flow['step'] = 3; $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                return $this->pick([
                    "¿Para cuándo la necesitás?\n1) Esta semana\n2) 2–3 semanas\n3) Más de 3 semanas.",
                    "Timing: ¿para cuándo la querés?\n1) Esta semana\n2) 2–3 semanas\n3) Más de 3 semanas.",
                ]);
            }
            if ($step === 3) {
                $data['plazo'] = $in;
                $flow['step'] = 4; $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                return $this->pick([
                    "Rango de presupuesto orientativo:\n1) Menos de USD 400\n2) USD 400–900\n3) Más de USD 900\n4) No estoy seguro.",
                    "Presupuesto orientativo, para ubicar: \n1) < USD 400\n2) USD 400–900\n3) > USD 900\n4) No estoy seguro.",
                ]);
            }
            if ($step === 4) {
                $data['presupuesto'] = $in;
                $plan = $this->recommendPlan($data['objetivo'] ?? '');
                $fx = config('ai_facts');
                $planes = $fx['planes'] ?? [];
                $p = $planes[$plan] ?? [];
                $precio = isset($p['precio']) ? (string) $p['precio'] : 'a confirmar';
                $entrega = isset($p['entrega']) ? (string) $p['entrega'] : 'a confirmar';
                $incluye = (isset($p['incluye']) && is_array($p['incluye'])) ? implode(', ', $p['incluye']) : '';
                $obj = isset($data['objetivo']) ? (string) $data['objetivo'] : 'a definir';
                $plz = isset($data['plazo']) ? (string) $data['plazo'] : 'a definir';
                $pres = isset($data['presupuesto']) ? (string) $data['presupuesto'] : 'a definir';
                $resumen = "Resumen: {$data['rubro_provincia']} — objetivo: {$obj} — plazo: {$plz} — presupuesto: {$pres}.";
                $cta = $this->pick([
                    '¿Te preparo una propuesta y te contacto por WhatsApp? Dejame tu nombre y número.',
                    '¿Querés que armemos tu propuesta y te escribamos por WhatsApp? Decime nombre y número.',
                    'Si te parece, te contacto por WhatsApp con una propuesta. Pasame tu nombre y número.',
                ]);
                $msg = "Con lo que me contaste, lo ideal para vos es: \n• {$plan} — Entrega: {$entrega} — Precio: {$precio}" . ($incluye ? "\nIncluye: {$incluye}" : "") . "\n\n{$resumen}\n\n{$cta}";
                $data['plan'] = $plan;
                $flow['step'] = 5; $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                return $msg;
            }
            if ($step === 5) {
                $contact = $this->extractContact($in);
                $tel = (string) ($contact['telefono'] ?? '');
                $email = (string) ($contact['correo'] ?? '');
                $nombre = (string) ($contact['nombre'] ?? 'Cliente');
                if ($tel === '' && $email === '') {
                    return $this->pick([
                        'No pude ver tu número. Pasalo así: 381 555 5648 o +54 381 5555648. También podés dejar tu email.',
                        '¿Me pasás tu número? Ejemplo: +54 381 5555648. Si preferís, dejá tu correo electrónico.',
                    ]);
                }
                if ($nombre === 'Cliente' || mb_strlen($nombre) < 2) {
                    $data['contact_tel'] = $tel;
                    $data['contact_email'] = $email;
                    $flow['step'] = 6; $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                    return $this->pick([
                        'Perfecto. ¿Me pasás tu nombre y apellido completo?','Dale, ¿tu nombre y apellido?'
                    ]);
                }
                return $this->finalizeLead($request, $cur, $data, $nombre, $tel, $email);
            }
            if ($step === 6) {
                $nombre = $this->cleanName($in);
                if ($nombre === '' || mb_strlen($nombre) < 2) {
                    return $this->pick([
                        'Perdón, no pude ver tu nombre completo. ¿Me pasás nombre y apellido?',
                        '¿Tu nombre y apellido completo?'
                    ]);
                }
                $tel = (string) ($data['contact_tel'] ?? '');
                $email = (string) ($data['contact_email'] ?? '');
                if ($tel === '' && $email === '') {
                    $c = $this->extractContact($in);
                    $tel = (string) ($c['telefono'] ?? '');
                    $email = (string) ($c['correo'] ?? '');
                }
                return $this->finalizeLead($request, $cur, $data, $nombre, $tel, $email);
            }
        }
        if ($cur === 'ecommerce') {
            if ($step === 0) {
                $c = $this->extractContact($in);
                $nombreIn = (string) ($c['nombre'] ?? '');
                $emailIn  = (string) ($c['correo'] ?? '');
                $telIn    = (string) ($c['telefono'] ?? '');
                $nombre = $nombreIn !== '' ? $nombreIn : (string) ($data['contact_name'] ?? '');
                $email  = $emailIn  !== '' ? $emailIn  : (string) ($data['contact_email'] ?? '');
                $tel    = $telIn    !== '' ? $telIn    : (string) ($data['contact_tel'] ?? '');
                if (($nombre === '' || mb_strlen($nombre) < 2) && $email === '') {
                    return $this->pick([
                        '¿Me pasás tu nombre y apellido completo y tu correo? Ejemplo: Juan Pérez, juan@correo.com',
                        'Para seguir, necesito nombre y apellido y tu email. Ej: Ana García, ana@mail.com',
                    ]);
                }
                if (($nombre === '' || mb_strlen($nombre) < 2) && $email !== '') {
                    $data['contact_email'] = $email;
                    if ($tel !== '') $data['contact_tel'] = $tel;
                    $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                    return $this->pick([
                        '¿Tu nombre y apellido completo?','Me pasás tu nombre y apellido, por favor?'
                    ]);
                }
                if (($nombre !== '' && mb_strlen($nombre) >= 2) && $email === '') {
                    $data['contact_name'] = $nombre;
                    if ($tel !== '') $data['contact_tel'] = $tel;
                    $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                    return $this->pick([
                        '¿Tu correo electrónico?','Me pasás tu email de contacto?'
                    ]);
                }
                $data['contact_name'] = $nombre;
                $data['contact_email'] = $email;
                if ($tel !== '') $data['contact_tel'] = $tel;
                $flow['step'] = 1; $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                return $this->pick([
                    'Genial, querés vender por internet. ¿Qué tipo de productos vendés y en qué provincia estás?',
                    'Excelente. ¿Qué productos vendés y en qué provincia?',
                ]);
            }
            if ($step === 1) {
                $data['productos_provincia'] = $in;
                $flow['step'] = 2; $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                return $this->pick([
                    "¿Cuántos productos pensás cargar?\n1) Hasta 20\n2) 20–100\n3) 100+",
                    "Aproximadamente, ¿cuántos productos?\n1) Hasta 20\n2) 20–100\n3) 100+",
                ]);
            }
            if ($step === 2) {
                $data['cantidad_productos'] = $in;
                $flow['step'] = 3; $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                return $this->pick([
                    "¿Para cuándo querés salir online?\n1) Esta semana\n2) 2–3 semanas\n3) Más de 3 semanas.",
                    "Timing de lanzamiento: \n1) Esta semana\n2) 2–3 semanas\n3) Más de 3 semanas.",
                ]);
            }
            if ($step === 3) {
                $data['plazo'] = $in;
                $flow['step'] = 4; $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                return $this->pick([
                    "Rango de presupuesto orientativo:\n1) Menos de USD 900\n2) USD 900–1.500\n3) Más de USD 1.500\n4) No estoy seguro.",
                    "Presupuesto orientativo: \n1) < USD 900\n2) USD 900–1.500\n3) > USD 1.500\n4) No estoy seguro.",
                ]);
            }
            if ($step === 4) {
                $data['presupuesto'] = $in;
                $plan = 'E-commerce';
                $fx = config('ai_facts');
                $p = ($fx['planes'][$plan] ?? []);
                $precio = isset($p['precio']) ? (string) $p['precio'] : 'a confirmar';
                $entrega = isset($p['entrega']) ? (string) $p['entrega'] : 'a confirmar';
                $incluye = (isset($p['incluye']) && is_array($p['incluye'])) ? implode(', ', $p['incluye']) : '';
                $cant = isset($data['cantidad_productos']) ? (string) $data['cantidad_productos'] : 'a definir';
                $plz = isset($data['plazo']) ? (string) $data['plazo'] : 'a definir';
                $pres = isset($data['presupuesto']) ? (string) $data['presupuesto'] : 'a definir';
                $resumen = "Resumen: {$data['productos_provincia']} — productos: {$cant} — plazo: {$plz} — presupuesto: {$pres}.";
                $cta = $this->pick([
                    '¿Te preparo una propuesta y te contacto por WhatsApp? Dejame tu nombre y número.',
                    '¿Querés que armemos tu propuesta y te escribamos por WhatsApp? Decime nombre y número.',
                    'Si te parece, te contacto por WhatsApp con una propuesta. Pasame tu nombre y número.',
                ]);
                $msg = "Para tu tienda online, te recomiendo: \n• {$plan} — Entrega: {$entrega} — Precio: {$precio}" . ($incluye ? "\nIncluye: {$incluye}" : "") . "\n\n{$resumen}\n\n{$cta}";
                $data['plan'] = $plan;
                $flow['step'] = 5; $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                return $msg;
            }
            if ($step === 5) {
                $contact = $this->extractContact($in);
                $tel = (string) ($contact['telefono'] ?? '');
                $email = (string) ($contact['correo'] ?? '');
                $nombre = (string) ($contact['nombre'] ?? 'Cliente');
                if ($tel === '' && $email === '') {
                    return $this->pick([
                        'No pude ver tu número. Pasalo así: 381 555 5648 o +54 381 5555648. También podés dejar tu email.',
                        '¿Me pasás tu número? Ejemplo: +54 381 5555648. Si preferís, dejá tu correo electrónico.',
                    ]);
                }
                if ($nombre === 'Cliente' || mb_strlen($nombre) < 2) {
                    $data['contact_tel'] = $tel;
                    $data['contact_email'] = $email;
                    $flow['step'] = 6; $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                    return $this->pick([
                        'Perfecto. ¿Me pasás tu nombre y apellido completo?','Dale, ¿tu nombre y apellido?'
                    ]);
                }
                return $this->finalizeLead($request, $cur, $data, $nombre, $tel, $email);
            }
            if ($step === 6) {
                $nombre = $this->cleanName($in);
                if ($nombre === '' || mb_strlen($nombre) < 2) {
                    return $this->pick([
                        'Perdón, no pude ver tu nombre completo. ¿Me pasás nombre y apellido?',
                        '¿Tu nombre y apellido completo?'
                    ]);
                }
                $tel = (string) ($data['contact_tel'] ?? '');
                $email = (string) ($data['contact_email'] ?? '');
                if ($tel === '' && $email === '') {
                    $c = $this->extractContact($in);
                    $tel = (string) ($c['telefono'] ?? '');
                    $email = (string) ($c['correo'] ?? '');
                }
                return $this->finalizeLead($request, $cur, $data, $nombre, $tel, $email);
            }
        }
        if ($cur === 'improve_web') {
            if ($step === 0) {
                $c = $this->extractContact($in);
                $nombreIn = (string) ($c['nombre'] ?? '');
                $emailIn  = (string) ($c['correo'] ?? '');
                $telIn    = (string) ($c['telefono'] ?? '');
                $nombre = $nombreIn !== '' ? $nombreIn : (string) ($data['contact_name'] ?? '');
                $email  = $emailIn  !== '' ? $emailIn  : (string) ($data['contact_email'] ?? '');
                $tel    = $telIn    !== '' ? $telIn    : (string) ($data['contact_tel'] ?? '');
                if (($nombre === '' || mb_strlen($nombre) < 2) && $email === '') {
                    return $this->pick([
                        '¿Me pasás tu nombre y apellido completo y tu correo? Ejemplo: Juan Pérez, juan@correo.com',
                        'Para seguir, necesito nombre y apellido y tu email. Ej: Ana García, ana@mail.com',
                    ]);
                }
                if (($nombre === '' || mb_strlen($nombre) < 2) && $email !== '') {
                    $data['contact_email'] = $email;
                    if ($tel !== '') $data['contact_tel'] = $tel;
                    $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                    return $this->pick([
                        '¿Tu nombre y apellido completo?','Me pasás tu nombre y apellido, por favor?'
                    ]);
                }
                if (($nombre !== '' && mb_strlen($nombre) >= 2) && $email === '') {
                    $data['contact_name'] = $nombre;
                    if ($tel !== '') $data['contact_tel'] = $tel;
                    $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                    return $this->pick([
                        '¿Tu correo electrónico?','Me pasás tu email de contacto?'
                    ]);
                }
                $data['contact_name'] = $nombre;
                $data['contact_email'] = $email;
                if ($tel !== '') $data['contact_tel'] = $tel;
                $flow['step'] = 1; $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                return $this->pick([
                    'Perfecto, mejorar una web existente. ¿Me compartís la URL y qué te gustaría mejorar (diseño, velocidad, SEO, conversiones)?',
                    'Dale, optimicemos tu web. Pasame la URL y contame qué puntos querés mejorar (diseño, performance, SEO, conversiones).',
                ]);
            }
            if ($step === 1) {
                $data['url_mejoras'] = $in;
                $flow['step'] = 2; $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                return $this->pick([
                    "¿Qué objetivo querés lograr con la mejora?\n1) Presencia / consultas\n2) Portfolio\n3) Vender online\n4) Otro",
                    "Objetivo de la mejora: \n1) Presencia / consultas\n2) Portfolio\n3) Vender online\n4) Otro",
                ]);
            }
            if ($step === 2) {
                $obj = $this->mapObjective($in);
                $data['objetivo'] = $obj;
                $flow['step'] = 3; $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                return $this->pick([
                    "¿Para cuándo querés tenerla lista?\n1) Esta semana\n2) 2–3 semanas\n3) Más de 3 semanas.",
                    "Plazo deseado: \n1) Esta semana\n2) 2–3 semanas\n3) Más de 3 semanas.",
                ]);
            }
            if ($step === 3) {
                $data['plazo'] = $in;
                $flow['step'] = 4; $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                return $this->pick([
                    "Rango de presupuesto orientativo:\n1) Menos de USD 600\n2) USD 600–1.200\n3) Más de USD 1.200\n4) No estoy seguro.",
                    "Presupuesto orientativo: \n1) < USD 600\n2) USD 600–1.200\n3) > USD 1.200\n4) No estoy seguro.",
                ]);
            }
            if ($step === 4) {
                $data['presupuesto'] = $in;
                $plan = $this->recommendImprovePlan($data['url_mejoras'] ?? '', $data['objetivo'] ?? '');
                $fx = config('ai_facts');
                $p = ($fx['planes'][$plan] ?? []);
                $precio = isset($p['precio']) ? (string) $p['precio'] : 'a confirmar';
                $entrega = isset($p['entrega']) ? (string) $p['entrega'] : 'a confirmar';
                $incluye = (isset($p['incluye']) && is_array($p['incluye'])) ? implode(', ', $p['incluye']) : '';
                $obj = isset($data['objetivo']) ? (string) $data['objetivo'] : 'a definir';
                $plz = isset($data['plazo']) ? (string) $data['plazo'] : 'a definir';
                $pres = isset($data['presupuesto']) ? (string) $data['presupuesto'] : 'a definir';
                $resumen = "Resumen: {$data['url_mejoras']} — objetivo: {$obj} — plazo: {$plz} — presupuesto: {$pres}.";
                $cta = $this->pick([
                    '¿Te preparo una propuesta y te contacto por WhatsApp? Dejame tu nombre y número.',
                    '¿Querés que armemos tu propuesta y te escribamos por WhatsApp? Decime nombre y número.',
                    'Si te parece, te contacto por WhatsApp con una propuesta. Pasame tu nombre y número.',
                ]);
                $msg = "Con lo que me contaste, lo ideal para mejorar tu sitio es: \n• {$plan} — Entrega: {$entrega} — Precio: {$precio}" . ($incluye ? "\nIncluye: {$incluye}" : "") . "\n\n{$resumen}\n\n{$cta}";
                $data['plan'] = $plan;
                $flow['step'] = 5; $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                return $msg;
            }
            if ($step === 5) {
                $contact = $this->extractContact($in);
                $tel = (string) ($contact['telefono'] ?? '');
                $email = (string) ($contact['correo'] ?? '');
                $nombre = (string) ($contact['nombre'] ?? 'Cliente');
                if ($tel === '' && $email === '') {
                    return $this->pick([
                        'No pude ver tu número. Pasalo así: 381 555 5648 o +54 381 5555648. También podés dejar tu email.',
                        '¿Me pasás tu número? Ejemplo: +54 381 5555648. Si preferís, dejá tu correo electrónico.',
                    ]);
                }
                if ($nombre === 'Cliente' || mb_strlen($nombre) < 2) {
                    $data['contact_tel'] = $tel;
                    $data['contact_email'] = $email;
                    $flow['step'] = 6; $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                    return $this->pick([
                        'Perfecto. ¿Me pasás tu nombre y apellido completo?','Dale, ¿tu nombre y apellido?'
                    ]);
                }
                return $this->finalizeLead($request, $cur, $data, $nombre, $tel, $email);
            }
            if ($step === 6) {
                $nombre = $this->cleanName($in);
                if ($nombre === '' || mb_strlen($nombre) < 2) {
                    return $this->pick([
                        'Perdón, no pude ver tu nombre completo. ¿Me pasás nombre y apellido?',
                        '¿Tu nombre y apellido completo?'
                    ]);
                }
                $tel = (string) ($data['contact_tel'] ?? '');
                $email = (string) ($data['contact_email'] ?? '');
                if ($tel === '' && $email === '') {
                    $c = $this->extractContact($in);
                    $tel = (string) ($c['telefono'] ?? '');
                    $email = (string) ($c['correo'] ?? '');
                }
                return $this->finalizeLead($request, $cur, $data, $nombre, $tel, $email);
            }
        }
        if ($cur === 'advisory') {
            if ($step === 0) {
                $c = $this->extractContact($in);
                $nombreIn = (string) ($c['nombre'] ?? '');
                $emailIn  = (string) ($c['correo'] ?? '');
                $telIn    = (string) ($c['telefono'] ?? '');
                $nombre = $nombreIn !== '' ? $nombreIn : (string) ($data['contact_name'] ?? '');
                $email  = $emailIn  !== '' ? $emailIn  : (string) ($data['contact_email'] ?? '');
                $tel    = $telIn    !== '' ? $telIn    : (string) ($data['contact_tel'] ?? '');
                if (($nombre === '' || mb_strlen($nombre) < 2) && $email === '') {
                    return $this->pick([
                        '¿Me pasás tu nombre y apellido completo y tu correo? Ejemplo: Juan Pérez, juan@correo.com',
                        'Para seguir, necesito nombre y apellido y tu email. Ej: Ana García, ana@mail.com',
                    ]);
                }
                if (($nombre === '' || mb_strlen($nombre) < 2) && $email !== '') {
                    $data['contact_email'] = $email;
                    if ($tel !== '') $data['contact_tel'] = $tel;
                    $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                    return $this->pick([
                        '¿Tu nombre y apellido completo?','Me pasás tu nombre y apellido, por favor?'
                    ]);
                }
                if (($nombre !== '' && mb_strlen($nombre) >= 2) && $email === '') {
                    $data['contact_name'] = $nombre;
                    if ($tel !== '') $data['contact_tel'] = $tel;
                    $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                    return $this->pick([
                        '¿Tu correo electrónico?','Me pasás tu email de contacto?'
                    ]);
                }
                $data['contact_name'] = $nombre;
                $data['contact_email'] = $email;
                if ($tel !== '') $data['contact_tel'] = $tel;
                $flow['step'] = 1; $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                return $this->pick([
                    'Ok, contame con tus palabras qué necesitás y te asesoro. Podés decirme objetivo, plazo y presupuesto orientativo.',
                    'Te escucho. Describí lo que buscás: objetivo, plazo y presupuesto aproximado.',
                ]);
            }
            if ($step === 1) {
                $data['descripcion'] = $in;
                $obj = $this->mapObjective($in);
                $data['objetivo'] = $obj;
                $flow['step'] = 2; $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                return $this->pick([
                    "¿Para cuándo la necesitás?\n1) Esta semana\n2) 2–3 semanas\n3) Más de 3 semanas.",
                    "Timing: ¿para cuándo la querés?\n1) Esta semana\n2) 2–3 semanas\n3) Más de 3 semanas.",
                ]);
            }
            if ($step === 2) {
                $data['plazo'] = $in;
                $flow['step'] = 3; $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                return $this->pick([
                    "Rango de presupuesto orientativo:\n1) Menos de USD 400\n2) USD 400–900\n3) Más de USD 900\n4) No estoy seguro.",
                    "Presupuesto orientativo, para ubicar: \n1) < USD 400\n2) USD 400–900\n3) > USD 900\n4) No estoy seguro.",
                ]);
            }
            if ($step === 3) {
                $data['presupuesto'] = $in;
                $plan = $this->recommendPlan($data['objetivo'] ?? '');
                $fx = config('ai_facts');
                $p = ($fx['planes'][$plan] ?? []);
                $precio = isset($p['precio']) ? (string) $p['precio'] : 'a confirmar';
                $entrega = isset($p['entrega']) ? (string) $p['entrega'] : 'a confirmar';
                $incluye = (isset($p['incluye']) && is_array($p['incluye'])) ? implode(', ', $p['incluye']) : '';
                $obj = isset($data['objetivo']) ? (string) $data['objetivo'] : 'a definir';
                $plz = isset($data['plazo']) ? (string) $data['plazo'] : 'a definir';
                $pres = isset($data['presupuesto']) ? (string) $data['presupuesto'] : 'a definir';
                $resumen = "Resumen: {$data['descripcion']} — objetivo: {$obj} — plazo: {$plz} — presupuesto: {$pres}.";
                $cta = $this->pick([
                    '¿Te preparo una propuesta y te contacto por WhatsApp? Dejame tu nombre y número.',
                    '¿Querés que armemos tu propuesta y te escribamos por WhatsApp? Decime nombre y número.',
                    'Si te parece, te contacto por WhatsApp con una propuesta. Pasame tu nombre y número.',
                ]);
                $msg = "Con lo que me contaste, te recomiendo: \n• {$plan} — Entrega: {$entrega} — Precio: {$precio}" . ($incluye ? "\nIncluye: {$incluye}" : "") . "\n\n{$resumen}\n\n{$cta}";
                $data['plan'] = $plan;
                $flow['step'] = 4; $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                return $msg;
            }
            if ($step === 4) {
                $contact = $this->extractContact($in);
                $tel = (string) ($contact['telefono'] ?? '');
                $email = (string) ($contact['correo'] ?? '');
                $nombre = (string) ($contact['nombre'] ?? 'Cliente');
                if ($tel === '' && $email === '') {
                    return $this->pick([
                        'No pude ver tu número. Pasalo así: 381 555 5648 o +54 381 5555648. También podés dejar tu email.',
                        '¿Me pasás tu número? Ejemplo: +54 381 5555648. Si preferís, dejá tu correo electrónico.',
                    ]);
                }
                if ($nombre === 'Cliente' || mb_strlen($nombre) < 2) {
                    $data['contact_tel'] = $tel;
                    $data['contact_email'] = $email;
                    $flow['step'] = 5; $flow['data'] = $data; $request->session()->put('ai_flow', $flow);
                    return $this->pick([
                        'Perfecto. ¿Me pasás tu nombre y apellido completo?','Dale, ¿tu nombre y apellido?'
                    ]);
                }
                return $this->finalizeLead($request, $cur, $data, $nombre, $tel, $email);
            }
            if ($step === 5) {
                $nombre = $this->cleanName($in);
                if ($nombre === '' || mb_strlen($nombre) < 2) {
                    return $this->pick([
                        'Perdón, no pude ver tu nombre completo. ¿Me pasás nombre y apellido?',
                        '¿Tu nombre y apellido completo?'
                    ]);
                }
                $tel = (string) ($data['contact_tel'] ?? '');
                $email = (string) ($data['contact_email'] ?? '');
                if ($tel === '' && $email === '') {
                    $c = $this->extractContact($in);
                    $tel = (string) ($c['telefono'] ?? '');
                    $email = (string) ($c['correo'] ?? '');
                }
                return $this->finalizeLead($request, $cur, $data, $nombre, $tel, $email);
            }
        }
        return null;
    }

    private function extractContact(string $text): array
    {
        $raw = trim($text);
        $email = '';
        if (preg_match('/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}/i', $raw, $m)) {
            $email = (string) ($m[0] ?? '');
        }
        $digits = preg_replace('/[^0-9]/', '', $raw);
        $tel = '';
        if (is_string($digits) && strlen($digits) >= 7) {
            $tel = $digits;
        } else {
            if (preg_match('/\+?\d[\d\s\-]{6,}\d/', $raw, $mm)) {
                $tel = preg_replace('/\D+/', '', (string) $mm[0]);
            }
        }
        $tmp = $raw;
        if ($email !== '') $tmp = str_replace($email, '', $tmp);
        if ($tel !== '') $tmp = preg_replace('/\d+/', '', $tmp);
        $nameCandidate = preg_replace('/[^\\p{L}\s]/u', '', $tmp);
        $nombre = trim(preg_replace('/\s+/', ' ', (string) $nameCandidate));
        if ($nombre === '' || mb_strlen($nombre) < 2) $nombre = 'Cliente';
        return ['nombre' => $nombre, 'telefono' => $tel, 'correo' => $email];
    }

    private function cleanName(string $text): string
    {
        $nameCandidate = preg_replace('/[^\\p{L}\s]/u', '', $text);
        return trim(preg_replace('/\s+/', ' ', (string) $nameCandidate));
    }

    private function finalizeLead(Request $request, string $cur, array $data, string $nombre, string $tel, string $email): string
    {
        $fx = config('ai_facts.contacto');
        $to = (string) ($fx['email'] ?? 'info@webinizadev.com');
        $subject = 'Nuevo lead del chat';
        $body = "Lead del chat — {$cur}\nNombre: {$nombre}\nTeléfono: " . ($tel !== '' ? $tel : '—') . "\nEmail: " . ($email !== '' ? $email : '—') . "\nResumen: " . (isset($data['plan']) ? ($data['plan'] . ' — ' . ($data['presupuesto'] ?? '')) : '') . "\nDatos: " . json_encode($data, JSON_UNESCAPED_UNICODE);
        try {
            Mail::send([], [], function ($message) use ($to, $subject, $body) {
                $message->to($to)->subject($subject)->text($body);
            });
        } catch (\Throwable $e) {}
        $request->session()->forget('ai_flow');
        if ($tel !== '' && $email === '') {
            return $this->pick([
                "Gracias, {$nombre}. Te contacto por WhatsApp al {$tel} con la propuesta.",
                "¡Listo! Te escribo por WhatsApp al {$tel} para coordinar detalles.",
                "Perfecto, {$nombre}. Te contacto al {$tel} por WhatsApp con la propuesta.",
            ]);
        }
        if ($email !== '' && $tel === '') {
            return $this->pick([
                "Gracias, {$nombre}. Te envío la propuesta por correo a {$email}. Si preferís WhatsApp, dejame tu número.",
                "Genial, {$nombre}. Te escribo al correo {$email} con la propuesta. Si querés, pasame tu número para WhatsApp.",
            ]);
        }
        return $this->pick([
            "Gracias, {$nombre}. Te escribo por WhatsApp al {$tel} y por correo a {$email}.",
            "¡Perfecto! Te contacto al {$tel} y te envío el detalle a {$email}.",
        ]);
    }

    private function isTerminalStep(array $flow): bool
    {
        $cur = (string) ($flow['flow'] ?? '');
        $step = (int) ($flow['step'] ?? 0);
        if (in_array($cur, ['first_web','ecommerce','improve_web'], true)) {
            return $step >= 5;
        }
        if ($cur === 'advisory') {
            return $step >= 4;
        }
        return false;
    }

    private function mapObjective(string $input): string
    {
        $t = mb_strtolower(trim($input));
        if (in_array($t, ['1','uno'])) return 'presencia';
        if (in_array($t, ['2','dos'])) return 'portfolio';
        if (in_array($t, ['3','tres'])) return 'ecommerce';
        if (in_array($t, ['4','cuatro'])) return 'otro';
        if (mb_strpos($t, 'presencia') !== false || mb_strpos($t, 'consulta') !== false) return 'presencia';
        if (mb_strpos($t, 'portfolio') !== false) return 'portfolio';
        if (mb_strpos($t, 'vender') !== false || mb_strpos($t, 'tienda') !== false || mb_strpos($t, 'e-commerce') !== false || mb_strpos($t, 'ecommerce') !== false) return 'ecommerce';
        return 'otro';
    }

    private function recommendPlan(string $objective): string
    {
        $o = mb_strtolower(trim($objective));
        if ($o === 'presencia') return 'Landing Page';
        if ($o === 'portfolio') return 'Portfolio';
        if ($o === 'ecommerce') return 'E-commerce';
        return 'Página Institucional';
    }

    private function recommendImprovePlan(string $url, string $objective): string
    {
        $o = mb_strtolower(trim($objective));
        $u = mb_strtolower($url);
        if (mb_strpos($u, 'http') !== false || mb_strpos($o, 'seo') !== false || mb_strpos($o, 'velocidad') !== false || mb_strpos($o, 'performance') !== false) {
            return 'Sitio SEO Optimizado';
        }
        if ($o === 'ecommerce') return 'E-commerce';
        if ($o === 'portfolio') return 'Portfolio';
        return 'Página Institucional';
    }

    private function parseAllowTerms(?string $csv): array
    {
        $base = [
            'hola','holaa','buenas','buen dia','buen día','hey','saludo','ayuda',
            'webinizadev','webiniza','web inicia dev','webiniza dev',
            'servicio','servicios','plan','planes','paquete','paquetes',
            'landing','landingpage','portfolio','institucional','seo','marketing','seo marketing',
            'ecommerce','e-commerce','tienda',
            'dashboard','crm','ia','inteligencia artificial','chatbot','n8n','automatizacion','automatización',
            'sitio','página','web','desarrollo web','diseño web','hosting','mantenimiento',
            'cotización','presupuesto','precios','proceso','plazo','soporte',
            'contacto','contactarme','contactarte','agendar','llamar','llamada','reunion','reunión','whatsapp',
            // Provincias de Argentina (con y sin acentos)
            'buenos aires','catamarca','chaco','chubut','cordoba','córdoba','corrientes','entre rios','entre ríos','formosa','jujuy','la pampa','la rioja','mendoza','misiones','neuquen','neuquén','rio negro','río negro','salta','san juan','san luis','santa cruz','santa fe','santiago del estero','tierra del fuego','tucuman','tucumán',
            'gabriela bollati','antonio romero','matias giacobbe',
            'sos un bot','eres un bot','sos bot','sos una ia','sos humano','sos real','quién sos','quien sos',
            '1','2','3','4','1️⃣','2️⃣','3️⃣','4️⃣',
            'presencia','vender online','tienda online',
        ];
        $extra = array_filter(array_map('trim', explode(',', (string) $csv)));
        return array_values(array_unique(array_map('mb_strtolower', array_merge($base, $extra))));
    }

    private function isOnDomain(string $text, array $allowList): bool
    {
        $q = mb_strtolower($text);
        foreach ($allowList as $kw) {
            if ($kw !== '' && mb_strpos($q, $kw) !== false) return true;
        }
        return false;
    }

    private function normalizePrompt(string $prompt): string
    {
        $q = mb_strtolower($prompt);
        $hasPlanes = (mb_strpos($q, 'planes') !== false) || (mb_strpos($q, 'plan') !== false);
        $off = (mb_strpos($q, 'viaje') !== false) || (mb_strpos($q, 'vuelo') !== false) ||
               (mb_strpos($q, 'hotel') !== false)  || (mb_strpos($q, 'turismo') !== false);

        if ($hasPlanes && !$off) {
            return 'Consulta sobre PLANES de servicios web de WebinizaDev (Landing / Portfolio / Página Institucional / Sitio SEO / E-commerce / Dashboard / Pack IA & Automatización). ' . $prompt;
        }
        return $prompt;
    }

    private function normalizeMenu(string $raw): ?string
    {
        $t = trim(mb_strtolower($raw));
        $map = [
            '1' => 'Crear mi primera página web (Landing o Institucional) para mi negocio',
            '1️⃣' => 'Crear mi primera página web (Landing o Institucional) para mi negocio',
            '2' => 'Mejorar una web existente (rediseño/optimización/SEO)',
            '2️⃣' => 'Mejorar una web existente (rediseño/optimización/SEO)',
            '3' => 'Hacer una tienda online para vender productos (e-commerce)',
            '3️⃣' => 'Hacer una tienda online para vender productos (e-commerce)',
            '4' => 'Otro / No estoy seguro, necesito asesoría para elegir la mejor solución',
            '4️⃣' => 'Otro / No estoy seguro, necesito asesoría para elegir la mejor solución',
        ];
        return $map[$t] ?? null;
    }

    private function humanize(string $text, Request $r): string
    {
        $topic = (string) $r->session()->get('ai_last_topic', '');
        $closers = [
            'planes'    => 'Si me contás tu objetivo, te recomiendo un plan en 1 línea.',
            'servicios' => '¿Querés que te muestre ejemplos o tiempos de entrega?',
            'landing'   => '¿La querés para leads por WhatsApp o para presupuestos?',
            'seo'       => '¿Tenés la URL para mirar performance y darte tips?',
            'n8n'       => 'Decime tu proceso y te digo cómo lo automatizamos.',
            'sobre'     => '¿Te paso links a proyectos que te puedan servir de referencia?',
            'soporte'   => '¿Preferís mantenimiento mensual o por horas?',
            'identidad' => '¿Seguimos por servicios, planes o contacto?',
            ''          => '¿Te doy una mano con servicios, planes o contacto?',
        ];
        $tail = $closers[$topic] ?? $closers[''];
        $flow = $r->session()->get('ai_flow');
        $flowActive = is_array($flow) && isset($flow['flow'], $flow['step']);
        if ($flowActive) {
            $tail = '';
        }
        if (mb_stripos($text, '¿') === false && mb_stripos($text, '?') === false) {
            return rtrim($text) . ' ' . $tail;
        }
        return $text;
    }

    private function flowQuestion(array $flow): string
    {
        $cur = (string) ($flow['flow'] ?? '');
        $step = (int) ($flow['step'] ?? 0);
        if ($cur === 'first_web') {
            if ($step === 0) return $this->pick([
                '¿Me pasás tu nombre y apellido completo y tu correo? Ejemplo: Juan Pérez, juan@correo.com',
                'Para seguir, necesito nombre y apellido y tu email. Ej: Ana García, ana@mail.com',
            ]);
            if ($step === 1) return $this->pick([
                'Genial, querés tu primera web. ¿Qué rubro/actividad tenés y en qué provincia estás? Podés responder con número o con tus palabras.',
                'Buenísimo. Para entenderte, decime rubro/actividad y provincia. Podés responder con número o con tus palabras.',
            ]);
            if ($step === 2) return $this->pick([
                "Perfecto. ¿Cuál es el objetivo principal?\n1) Presencia / recibir consultas\n2) Portfolio\n3) Vender online\n4) Otro\nPodés responder con número o con tus palabras.",
                "Bien. ¿Cuál sería el objetivo principal?\n1) Presencia / consultas\n2) Portfolio\n3) Vender online\n4) Otro",
            ]);
            if ($step === 3) return $this->pick([
                "¿Para cuándo la necesitás?\n1) Esta semana\n2) 2–3 semanas\n3) Más de 3 semanas.",
                "Timing: ¿para cuándo la querés?\n1) Esta semana\n2) 2–3 semanas\n3) Más de 3 semanas.",
            ]);
            if ($step === 4) return $this->pick([
                "Rango de presupuesto orientativo:\n1) Menos de USD 400\n2) USD 400–900\n3) Más de USD 900\n4) No estoy seguro.",
                "Presupuesto orientativo, para ubicar: \n1) < USD 400\n2) USD 400–900\n3) > USD 900\n4) No estoy seguro.",
            ]);
        }
        if ($cur === 'ecommerce') {
            if ($step === 0) return $this->pick([
                '¿Me pasás tu nombre y apellido completo y tu correo? Ejemplo: Juan Pérez, juan@correo.com',
                'Para seguir, necesito nombre y apellido y tu email. Ej: Ana García, ana@mail.com',
            ]);
            if ($step === 1) return $this->pick([
                'Genial, querés vender por internet. ¿Qué tipo de productos vendés y en qué provincia estás?',
                'Excelente. ¿Qué productos vendés y en qué provincia?',
            ]);
            if ($step === 2) return $this->pick([
                "¿Cuántos productos pensás cargar?\n1) Hasta 20\n2) 20–100\n3) 100+",
                "Aproximadamente, ¿cuántos productos?\n1) Hasta 20\n2) 20–100\n3) 100+",
            ]);
            if ($step === 3) return $this->pick([
                "¿Para cuándo querés salir online?\n1) Esta semana\n2) 2–3 semanas\n3) Más de 3 semanas.",
                "Timing de lanzamiento: \n1) Esta semana\n2) 2–3 semanas\n3) Más de 3 semanas.",
            ]);
            if ($step === 4) return $this->pick([
                "Rango de presupuesto orientativo:\n1) Menos de USD 900\n2) USD 900–1.500\n3) Más de USD 1.500\n4) No estoy seguro.",
                "Presupuesto orientativo: \n1) < USD 900\n2) USD 900–1.500\n3) > USD 1.500\n4) No estoy seguro.",
            ]);
        }
        if ($cur === 'improve_web') {
            if ($step === 0) return $this->pick([
                '¿Me pasás tu nombre y apellido completo y tu correo? Ejemplo: Juan Pérez, juan@correo.com',
                'Para seguir, necesito nombre y apellido y tu email. Ej: Ana García, ana@mail.com',
            ]);
            if ($step === 1) return $this->pick([
                'Perfecto, mejorar una web existente. ¿Me compartís la URL y qué te gustaría mejorar (diseño, velocidad, SEO, conversiones)?',
                'Dale, optimicemos tu web. Pasame la URL y contame qué puntos querés mejorar (diseño, performance, SEO, conversiones).',
            ]);
            if ($step === 2) return $this->pick([
                "¿Qué objetivo querés lograr con la mejora?\n1) Presencia / consultas\n2) Portfolio\n3) Vender online\n4) Otro",
                "Objetivo de la mejora: \n1) Presencia / consultas\n2) Portfolio\n3) Vender online\n4) Otro",
            ]);
            if ($step === 3) return $this->pick([
                "¿Para cuándo querés tenerla lista?\n1) Esta semana\n2) 2–3 semanas\n3) Más de 3 semanas.",
                "Plazo deseado: \n1) Esta semana\n2) 2–3 semanas\n3) Más de 3 semanas.",
            ]);
            if ($step === 4) return $this->pick([
                "Rango de presupuesto orientativo:\n1) Menos de USD 600\n2) USD 600–1.200\n3) Más de USD 1.200\n4) No estoy seguro.",
                "Presupuesto orientativo: \n1) < USD 600\n2) USD 600–1.200\n3) > USD 1.200\n4) No estoy seguro.",
            ]);
        }
        if ($cur === 'advisory') {
            if ($step === 0) return $this->pick([
                '¿Me pasás tu nombre y apellido completo y tu correo? Ejemplo: Juan Pérez, juan@correo.com',
                'Para seguir, necesito nombre y apellido y tu email. Ej: Ana García, ana@mail.com',
            ]);
            if ($step === 1) return $this->pick([
                'Ok, contame con tus palabras qué necesitás y te asesoro. Podés decirme objetivo, plazo y presupuesto orientativo.',
                'Te escucho. Describí lo que buscás: objetivo, plazo y presupuesto aproximado.',
            ]);
            if ($step === 2) return $this->pick([
                "¿Para cuándo la necesitás?\n1) Esta semana\n2) 2–3 semanas\n3) Más de 3 semanas.",
                "Timing: ¿para cuándo la querés?\n1) Esta semana\n2) 2–3 semanas\n3) Más de 3 semanas.",
            ]);
            if ($step === 3) return $this->pick([
                "Rango de presupuesto orientativo:\n1) Menos de USD 400\n2) USD 400–900\n3) Más de USD 900\n4) No estoy seguro.",
                "Presupuesto orientativo, para ubicar: \n1) < USD 400\n2) USD 400–900\n3) > USD 900\n4) No estoy seguro.",
            ]);
        }
        return '';
    }

    private function pick(array $options): string
    {
        if (!is_array($options) || count($options) === 0) return '';
        $i = mt_rand(0, count($options) - 1);
        return (string) $options[$i];
    }
}
