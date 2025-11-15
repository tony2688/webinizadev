<?php

namespace App\Services;

class AiRouter
{
    public static function answer(string $q): ?string
    {
        $q = mb_strtolower(trim($q));
        $fx = config('ai_facts');
        $rechazo = $fx['rechazo'] ?? 'Estoy entrenado para ayudarte solo con temas de WebinizaDev: diseño, desarrollo web, automatización, SEO e IA. ¿Querés que te pase nuestros planes o agendamos una llamada?';

        // --- Saludos / apertura ---
        if (self::has($q, ['hola','holaa','buenas','buen día','buen dia','buenas tardes','buenas noches','que tal','qué tal','hey'])) {
            $c = $fx['contacto'];
            return "¡Hola! ¿Cómo estás? 👋 Soy parte del equipo de **WebinizaDev**.\n\nPuedo ayudarte con:\n• Servicios\n• Planes y precios\n• Plazos\n• Contacto\n\nWhatsApp directo: **{$c['whatsapp']}**\n\n¿Sobre qué querés saber?";
        }

        // --- ¿Sos un bot? ---
        if (self::has($q, ['sos un bot', 'eres un bot', 'sos bot', 'sos una ia', 'sos humano', 'sos real', 'quién sos', 'quien sos'])) {
            return "¡Buena pregunta! 😉 Soy un asistente basado en IA, entrenado con toda la info real de WebinizaDev para ayudarte como si charlaras con alguien del equipo.\n\nEstoy acá para ayudarte de verdad. ¿Querés que te pase los planes o vemos tu idea?";
        }

        // --- Contacto ---
        if (self::has($q, ['contacto','whatsapp','tel','telefono','mail','correo','cotizar','presupuesto','hablar'])) {
            $c = $fx['contacto'];
            return "Podés escribirnos por *WhatsApp* **{$c['whatsapp']}** o por *email* **{$c['email']}**.\n\n📆 Horario: **{$c['horario']}**\n{$c['cta']}";
        }

        // --- Servicios ---
        if (self::has($q, ['servicio','servicios','ofrecen','desarrollo','ux','ui','seo','ia','automatiza'])) {
            $s = $fx['servicios'];
            return "Ofrecemos:\n\n• **Desarrollo Web** — {$s['Desarrollo Web']}\n• **Diseño UI/UX** — {$s['Diseño UI/UX']}\n• **SEO & Performance** — {$s['SEO & Performance']}\n• **IA & Automatización** — {$s['IA & Automatización']}\n\n¿Sobre cuál querés que te cuente más?";
        }

        // --- ¿Qué es una landing? ---
        if (self::has($q, ['qué es una landing','que es una landing','que es landing','qué es landing','landing page qué es','landingpage','landing page'])) {
            return "Una *landing page* es una página enfocada en una sola acción (como WhatsApp, presupuesto o registro) y pensada para convertir visitas en clientes. 🧲\n\nTe la entregamos responsive, con formulario, SEO básico e instalación de Analytics.\n\n⏱️ Suele estar lista en **3–5 días**.\n\n¿Querés que te pase precios o vemos tu caso?";
        }

        // --- Planes / precios ---
        if (self::has($q, ['plan','planes','precio','precios','cuesta','tarifa','valen','landing','portfolio','institucional','seo','ecommerce','e-commerce','dashboard','ia'])) {
            $p = $fx['planes'];
            $msg = "📦 *Planes y precios*:\n\n";
            foreach ($p as $k => $v) {
                if (!is_array($v)) continue;
                $inc = isset($v['incluye']) ? "\n🧩 Incluye: " . implode(', ', $v['incluye']) : '';
                $pitch = isset($v['pitch']) ? "\n🟢 " . $v['pitch'] : '';
                $msg .= "• **{$k}** — {$v['precio']} (Entrega: {$v['entrega']}){$inc}{$pitch}\n\n";
            }
            $msg .= $p['nota'] ?? '';
            return $msg;
        }

        // --- Plazos / proceso ---
        if (self::has($q, ['plazo','plazos','tiempo','tardan','tarda','entrega','timeline','proceso','cómo trabajan','como trabajan'])) {
            return "🛠️ Nuestro proceso:\n\n1. Kickoff y relevamiento\n2. Wireframe y diseño UI\n3. Desarrollo\n4. Revisión y pruebas\n5. Publicación y soporte\n\n⏱️ Tiempos estimados:\n• Landing: **3–5 días**\n• Portfolio: **5–7 días**\n• Institucional: **7–10 días**\n• SEO: **7–10 días**\n• E-commerce: **10–14 días**\n• Dashboard: **14–21 días**\n\n¿Querés que veamos el tuyo?";
        }

        // --- Ubicación ---
        if (self::has($q, ['ubicación','ubicacion','dónde están','donde estan','dirección','direccion'])) {
            $e = $fx['empresa'];
            return "📍 Estamos en **{$e['ubicacion']}** (Tucumán, Argentina), pero trabajamos con clientes de todo el país y también del exterior. 💻";
        }

        // --- Equipo ---
        if (self::has($q, ['equipo','quiénes','quienes','personas','fundadores','ceo','cto','matias','gabriela','antonio'])) {
            $e = $fx['equipo'];
            return "👥 Nuestro equipo:\n\n• **Antonio Romero** — {$e['Antonio Romero']}\n• **Gabriela Bollati** — {$e['Gabriela Bollati']}\n• **Matías Giacobbe** — {$e['Matías Giacobbe']}\n\n¿Querés que uno del equipo te contacte?";
        }

        // --- Proyectos ---
        if (self::has($q, ['proyecto','proyectos','trabajos','casos','portfolio','uv energía','uv energia','sdt'])) {
            $p = $fx['proyectos'];
            return "📌 Algunos de nuestros trabajos:\n\n• **UV Energía Solar** — {$p['UV Energía Solar']}\n• **SDT Audio Visual** — {$p['SDT Audio Visual']}\n• **WebinizaDev (landing)** — {$p['WebinizaDev (landing)']}\n\n¿Querés que te pase más referencias por WhatsApp?";
        }

        // --- Identidad / quiénes somos ---
        if (self::has($q, ['quién es webinizadev','que es webinizadev','quienes son','sobre webinizadev','acerca de webinizadev','webinizadev','webiniza dev'])) {
            $e = $fx['empresa'];
            return "🙋‍♂️ **{$e['nombre']}**: {$e['descripcion']} {$e['valor']}\n\n📍 Estamos en {$e['ubicacion']}\n\n¿Querés que te pase nuestros planes o hablamos de tu proyecto?";
        }

        // --- Dominio cerrado ---
        $dom = array_merge(
            ['webinizadev','servicio','plan','precio','landing','ecommerce','portfolio','institucional','seo','dashboard','ia','automatiza','contacto','whatsapp','correo','equipo','proyecto','uv energía','sdt','tucumán'],
            $fx['sinonimos'] ?? []
        );
        if (!self::has($q, $dom)) return $rechazo;

        // Sugerencia por default si no entendió la intención
        return "💡 Puedo ayudarte con:\n• Servicios\n• Planes y precios\n• Plazos\n• Proyectos\n• Equipo\n• Contacto\n\n¿Querés que te pase el WhatsApp o un resumen de nuestros planes?";
    }

    private static function has(string $text, array $terms): bool
    {
        foreach ($terms as $t) {
            if ($t !== '' && mb_strpos($text, mb_strtolower($t)) !== false) return true;
        }
        return false;
    }
}
