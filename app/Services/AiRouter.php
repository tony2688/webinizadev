<?php

namespace App\Services;

class AiRouter
{
    public static function answer(string $input): ?string
    {
        $q = mb_strtolower(trim($input));

        // Obtenemos la configuración, pero definimos fallbacks por si falta el archivo
        $fx = config('ai_facts') ?? [];
        $rechazo = $fx['rechazo'] ?? 'Solo puedo ayudarte con temas de eficiencia, IA y desarrollo de WebinizaDev.';

        // 1) SALUDOS: Identidad de IA y Eficiencia
        // Presentación fuerte como "Agente de IA" que ayuda a escalar negocios
        if (self::has($q, ['hola', 'buenas', 'buen dia', 'buen día', 'hello', 'hi', 'inicio', 'start', 'comenzar'])) {
            $wa = $fx['contacto']['whatsapp'] ?? '+54 381 555-5648';
            return "¡Hola! Soy el **Agente de IA** de WebinizaDev 🤖.\n\nMi trabajo es simple: ayudarte a escalar tu negocio y automatizar tareas repetitivas para que ganes tiempo.\n\n¿En qué área te gustaría enfocarte hoy?\n\n1️⃣ Automatización & Chatbots (IA)\n2️⃣ Desarrollo Web de Alto Impacto\n3️⃣ E-commerce Inteligente\n4️⃣ Auditoría Gratuita de Procesos";
        }

        // 2) PREGUNTA SOBRE IDENTIDAD (BOT)
        // Respuesta transparente pero con autoridad técnica
        if (self::has($q, ['sos un bot', 'eres un bot', 'sos bot', 'sos una ia', 'sos humano', 'sos real', 'quién sos', 'quien sos'])) {
            return "¡Buena pregunta! 😉 Soy un **Consultor Virtual** basado en IA, entrenado con la experiencia técnica de WebinizaDev (7+ años en soporte y desarrollo).\n\nEstoy acá para diagnosticar problemas de tu negocio y sugerir soluciones automáticas. ¿Querés que analicemos algún proceso manual que te quite tiempo?";
        }

        // 3) CONTACTO: Cierre Directo
        // Redirige a la acción humana cuando es necesario
        if (self::has($q, ['contacto', 'whatsapp', 'tel', 'telefono', 'mail', 'correo', 'cotizar', 'presupuesto', 'hablar', 'humano'])) {
            $c = $fx['contacto'] ?? [];
            $wa = $c['whatsapp'] ?? '+54 381 555-5648';
            $email = $c['email'] ?? 'info@webinizadev.com';
            $horario = $c['horario'] ?? 'L-V 9 a 18 h';
            return "Perfecto. A veces hace falta la visión humana.\n\n📲 **WhatsApp Directo:** {$wa}\n📧 **Email:** {$email}\n📆 **Horario:** {$horario}\n\nSi me dejás tu número por acá, le pido a Antonio (nuestro CEO) que te llame personalmente.";
        }

        // 4) SERVICIOS: Venta de Valor (IA y Automatización primero)
        if (self::has($q, ['servicio', 'servicios', 'ofrecen', 'que hacen', 'qué hacen', 'a que se dedican'])) {
            return "Nos especializamos en **Tecnología de Eficiencia**:\n\n🚀 **Agentes de IA y Chatbots:** Atendé a tus clientes 24/7 sin pagar sueldos extra.\n⚡ **Automatización (n8n):** Conectamos tu WhatsApp con tu Excel/CRM para que dejes de copiar y pegar datos.\n🌐 **Webs de Conversión:** Sitios diseñados para vender, no solo para verse bonitos.\n\n¿Cuál de estos te interesa implementar en tu empresa?";
        }

        // 5) IA y AUTOMATIZACIÓN (El producto estrella)
        if (self::has($q, ['ia', 'inteligencia', 'artificial', 'bot', 'chatbot', 'n8n', 'automatiza', 'automatizacion'])) {
            return "💡 **Automatización Inteligente:**\nCreamos 'empleados digitales' que trabajan 24/7 por vos. Pueden:\n\n✅ Responder consultas frecuentes en WhatsApp.\n✅ Agendar turnos o citas sin intervención humana.\n✅ Clasificar emails y crear tareas en tu agenda.\n\n¿Tenés alguna tarea repetitiva que te gustaría delegar a una IA?";
        }

        // 6) PLANES Y PRECIOS: Filtrado Profesional
        // Muestra precios base pero enfoca en el valor del retorno de inversión
        if (self::has($q, ['plan', 'planes', 'precio', 'precios', 'cuesta', 'tarifa', 'valen', 'landing', 'portfolio', 'institucional', 'seo', 'ecommerce', 'e-commerce', 'dashboard'])) {
            return "Nuestros desarrollos se pagan solos con el tiempo que ahorrás.\n\n• **Células de Automatización IA:** Desde USD 499 (pago único).\n• **Webs Inteligentes:** Desde USD 399.\n• **E-commerce:** Desde USD 1.499.\n\nPara darte un precio exacto, necesito entender tu problema. ¿Te animás a contarme brevemente qué proceso querés mejorar?";
        }

        // 7) PLAZOS: Velocidad y Eficiencia
        if (self::has($q, ['plazo', 'plazos', 'tiempo', 'tardan', 'tarda', 'entrega', 'timeline', 'proceso', 'cómo trabajan', 'como trabajan'])) {
            return "🛠️ Trabajamos con metodología ágil para entregas rápidas:\n\n• **Chatbots y Automatizaciones:** 7–10 días.\n• **Landing Pages:** 3–5 días.\n• **E-commerce Completo:** 10–14 días.\n\nTodo comienza con una auditoría gratuita de tu necesidad. ¿Querés agendar una?";
        }

        // 8) UBICACIÓN Y EQUIPO
        if (self::has($q, ['ubicación', 'ubicacion', 'dónde están', 'donde estan', 'dirección', 'direccion', 'equipo', 'quiénes', 'quienes'])) {
            $e = $fx['empresa'] ?? [];
            $ubicacion = $e['ubicacion'] ?? 'Tucumán, Argentina';
            return "📍 Operamos desde **{$ubicacion}** para todo el mundo.\n\nSomos un equipo técnico liderado por **Antonio Romero** (Especialista en Automatización) con más de 7 años de experiencia en soporte crítico y desarrollo.\n\n¿Buscás un socio tecnológico local o remoto?";
        }

        // 9) FALLBACK INTELIGENTE (Deja pasar a Gemini)
        // IMPORTANTE: Eliminé el bloqueo estricto aquí. Si no coincide con nada de arriba,
        // devolvemos NULL para que el controlador le pase la consulta a la IA de Google (Gemini).
        // Esto permite que el bot responda preguntas complejas o variadas.
        return null;
    }

    private static function has(string $text, array $terms): bool
    {
        foreach ($terms as $t) {
            if ($t !== '' && mb_strpos($text, mb_strtolower($t)) !== false)
                return true;
        }
        return false;
    }
}