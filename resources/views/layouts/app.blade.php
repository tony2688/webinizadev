<!DOCTYPE html>
<html lang="es" data-theme="synthwave">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'WebinizaDev | IA & Automatización')</title>

  {{-- Canonical --}}
  @if (request()->is('/'))
    <link rel="canonical" href="https://webinizadev.com/" />
  @else
    <link rel="canonical" href="{{ url()->current() }}" />
  @endif

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="{{ asset('css/custom-animations.css') }}" rel="stylesheet">
  <link href="{{ asset('css/hero-carousel.css') }}" rel="stylesheet">

  <link rel="icon" type="image/svg+xml" href="{{ asset('images/icono.svg') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/icono-32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/icono-16.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/icono-180.png') }}">
  <link rel="manifest" href="{{ asset('site.webmanifest') }}">

  <meta http-equiv="Content-Security-Policy" content="default-src 'self';
                 font-src 'self' data: https://fonts.gstatic.com https://cdnjs.cloudflare.com https://cdn.jsdelivr.net https://*.fontawesome.com;
                 script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.tailwindcss.com https://cdn.jsdelivr.net https://unpkg.com https://cdnjs.cloudflare.com https://*.fontawesome.com;
                 style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com https://unpkg.com https://cdn.jsdelivr.net https://*.fontawesome.com;
                 img-src 'self' data: https://cdn.jsdelivr.net https://*.fontawesome.com blob:;
                 connect-src 'self' https://*.fontawesome.com;
                 frame-src https://www.google.com https://maps.googleapis.com;
                 media-src 'self';
                 worker-src 'self' blob:;">
</head>

<body class="overflow-x-hidden w-full relative">

  {{-- Header --}}
  @include('layouts.header')

  {{-- Secciones --}}
  @include('sections.hero')
  @include('sections.nosotros')
  @include('sections.equipo')
  @include('sections.servicios')
  @include('sections.proyectos')
  @include('sections.planes')
  @include('sections.contacto')

  {{-- Footer --}}
  @include('layouts.footer')

  <div id="modal-terminos"
    class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-[999] hidden">
    <div
      class="bg-gradient-to-br from-[#120426] via-[#2D0A5A] to-[#E83399]/90 p-8 rounded-xl shadow-2xl max-w-2xl w-full mx-4 relative">
      <button onclick="cerrarModal('modal-terminos')"
        class="absolute top-4 right-4 text-white text-2xl hover:text-[#ff0000] transition">&times;</button>
      <h2 class="text-2xl font-bold mb-4 text-white">Términos y Condiciones</h2>
      <p class="text-white/80 text-sm leading-relaxed space-y-4">
        <strong>1. Aceptación:</strong> Al usar este sitio aceptas estos términos.<br>
        <strong>2. Uso:</strong> Contenido informativo y de contratación.<br>
        <strong>3. Propiedad:</strong> Todo el contenido es de WebinizaDev.<br>
        <strong>4. Contacto:</strong> info@webinizadev.com
      </p>
    </div>
  </div>

  <div id="modal-privacidad"
    class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center min-h-screen p-4 z-[999] hidden">
    <div
      class="bg-gradient-to-br from-[#120426] via-[#2D0A5A] to-[#E83399]/90 p-6 md:p-8 rounded-xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto relative">
      <button onclick="cerrarModal('modal-privacidad')"
        class="absolute top-4 right-4 text-white text-2xl hover:text-[#ff0000] transition">&times;</button>
      <h2 class="text-2xl font-bold mb-4 text-white">Política de Privacidad</h2>
      <p class="text-white/80 text-sm leading-relaxed space-y-4">
        <strong>1. Datos:</strong> Recopilamos nombre, correo y teléfono para contacto.<br>
        <strong>2. Uso:</strong> Solo para responder consultas y presupuestos.<br>
        <strong>3. Seguridad:</strong> Protegemos tus datos y no los compartimos con terceros.
      </p>
    </div>
  </div>

  <a id="topButton" href="#inicio" aria-label="Volver arriba"
    class="fixed bottom-6 left-6 z-[9990] group opacity-0 pointer-events-none transition-all duration-300 ease-out [--size:2.75rem] md:[--size:3rem]">
    <span
      class="absolute inset-0 rounded-full bg-gradient-to-r from-[#ff0000] to-[#9900ff] blur-md opacity-40 group-hover:opacity-70 transition-opacity"></span>
    <span
      class="relative grid place-items-center rounded-full backdrop-blur-md bg-white/10 ring-1 ring-white/15 shadow-[0_10px_30px_rgba(0,0,0,0.35)] hover:scale-[1.04] active:scale-[0.98] transition-transform"
      style="width:var(--size);height:var(--size)">
      <i class="fa-solid fa-arrow-up-long text-white text-sm md:text-base"></i>
    </span>
  </a>

  <div id="wz-chat-root">
    <button id="wz-fab" aria-label="Abrir chat">
      <img src="{{ asset('images/robot.svg') }}" alt="robot" id="wz-robot-img" />
    </button>

    <aside id="wz-chat" aria-hidden="true" style="display:none;">
      <header id="wz-chat-header">
        <div class="wz-header-left">
          <img src="{{ asset('images/robot.svg') }}" alt="robot" />
          <div>
            <strong>WebinizaDev</strong>
            <small>Consultor IA & Automatización</small>
          </div>
        </div>
        <button id="wz-close" aria-label="Cerrar">✕</button>
      </header>

      <main id="wz-chat-body">
        <div id="wz-messages"></div>
        <div id="wz-chips"></div>
      </main>

      <footer id="wz-chat-footer" class="wz-footer">
        <div class="wz-input-wrap">
          <input id="wz-search" class="wz-input" placeholder="Escribí tu consulta..."
            aria-label="Buscar o escribir pregunta" />
          <button id="wz-send" class="wz-btn wz-btn--send wz-btn--icon" type="button" title="Enviar" aria-label="Enviar"
            disabled>
            <i class="fas fa-paper-plane text-sm"></i>
          </button>
        </div>
        <button id="wz-wa" class="wz-btn wz-btn--wa wz-btn--icon" type="button" title="WhatsApp" aria-label="WhatsApp">
          <i class="fab fa-whatsapp text-lg"></i>
        </button>
      </footer>
    </aside>
  </div>

  {{-- Scripts base --}}
  <script src="{{ asset('js/layout/header.js') }}" defer></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

  <script>
    /* Inicializaciones Generales */
    AOS.init();
    const swiper = new Swiper('.swiper-container', {
      loop: true, autoplay: { delay: 4000 }, effect: 'fade', fadeEffect: { crossFade: true }, speed: 800,
      navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
      pagination: { el: '.swiper-pagination', clickable: true }
    });
    function abrirModal(id) { document.getElementById(id).classList.remove('hidden'); }
    function cerrarModal(id) { document.getElementById(id).classList.add('hidden'); }

    // Scroll Top Button
    (function () {
      const btn = document.getElementById('topButton');
      if (!btn) return;
      window.addEventListener('scroll', () => {
        const show = window.scrollY > 240;
        btn.style.opacity = show ? '1' : '0';
        btn.style.pointerEvents = show ? 'auto' : 'none';
      });
    })();
  </script>

  <script>
    (function () {
      /* --- CONFIGURACIÓN --- */
      const ROBOT_IMG = "{{ asset('images/robot.svg') }}";
      const AI_ENDPOINT = "{{ route('ai.chat') }}";
      const WHATSAPP_NUMBER = '5493815555648';

      // Respuestas locales por si falla la IA (Fallback)
      const FAQS_FALLBACK = [
        { q: "Automatización", a: "Creamos empleados digitales que responden WhatsApp, agendan citas y clasifican correos las 24hs." },
        { q: "Desarrollo Web", a: "Sitios diseñados para vender. Rápidos, seguros y optimizados para Google (SEO)." },
        { q: "Precios", a: "Planes desde USD 399. ¿Querés una cotización a medida?" },
        { q: "Contacto", a: "WhatsApp directo: +54 381 555-5648." }
      ];

      /* --- ELEMENTOS DOM --- */
      const dom = {
        fab: document.getElementById('wz-fab'),
        chat: document.getElementById('wz-chat'),
        close: document.getElementById('wz-close'),
        msgs: document.getElementById('wz-messages'),
        chips: document.getElementById('wz-chips'),
        input: document.getElementById('wz-search'),
        send: document.getElementById('wz-send'),
        wa: document.getElementById('wz-wa')
      };

      // Corregir imágenes rotas si las hay
      document.querySelectorAll('#wz-chat img').forEach(img => { if (!img.src) img.src = ROBOT_IMG; });

      /* --- FUNCIONES UI --- */

      function scrollToBottom() {
        if (dom.msgs) dom.msgs.scrollTop = dom.msgs.scrollHeight;
      }

      function renderUserMsg(text) {
        const div = document.createElement('div');
        div.className = 'wz-msg user';
        div.textContent = text;
        dom.msgs.appendChild(div);
        scrollToBottom();
      }

      function formatBotText(text) {
        // Convierte **negrita** a <b> y newlines a <br>
        let html = text
          .replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;")
          .replace(/\*\*(.*?)\*\*/g, '<b>$1</b>')
          .replace(/\n/g, '<br>');

        // Linkea teléfonos
        const variants = ['+54 381 555-5648', '5493815555648'];
        variants.forEach(v => {
          const re = new RegExp(v.replace('+', '\\+'), 'g');
          html = html.replace(re, `<a href="https://wa.me/${WHATSAPP_NUMBER}" target="_blank" class="underline text-blue-300">${v}</a>`);
        });
        return html;
      }

      function renderBotMsg(text) {
        const div = document.createElement('div');
        div.className = 'wz-msg bot';
        div.innerHTML = `<img src="${ROBOT_IMG}" class="wz-avatar" alt="IA"><div class="wz-text">${formatBotText(text)}</div>`;
        dom.msgs.appendChild(div);
        scrollToBottom();
      }

      function showTyping() {
        const id = 'wz-typing';
        if (document.getElementById(id)) return;
        const div = document.createElement('div');
        div.id = id;
        div.className = 'wz-msg bot';
        div.innerHTML = `<img src="${ROBOT_IMG}" class="wz-avatar"><div class="wz-text flex items-center gap-1">Escribiendo<span class="animate-pulse">...</span></div>`;
        dom.msgs.appendChild(div);
        scrollToBottom();
      }

      function hideTyping() {
        const el = document.getElementById('wz-typing');
        if (el) el.remove();
      }

      function renderChips(list) {
        dom.chips.innerHTML = '';
        dom.chips.style.display = 'flex';
        list.forEach(item => {
          const btn = document.createElement('button');
          btn.className = 'wz-chip';
          btn.textContent = item.q;
          btn.onclick = () => handleInput(item.q); // Manda el texto como si el usuario lo escribiera
          dom.chips.appendChild(btn);
        });
      }

      /* --- LÓGICA PRINCIPAL --- */

      async function handleInput(text) {
        if (!text || !text.trim()) return;
        text = text.trim();

        // 1. Mostrar mensaje usuario
        renderUserMsg(text);
        dom.input.value = '';
        dom.send.disabled = true;

        // 2. Ocultar chips temporalmente
        dom.chips.style.display = 'none';

        // 3. Mostrar escribiendo
        showTyping();

        try {
          // 4. Intentar llamar a la IA
          const response = await fetch(AI_ENDPOINT, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ prompt: text })
          });

          const data = await response.json();

          hideTyping();

          if (data.reply) {
            renderBotMsg(data.reply);
          } else {
            throw new Error('Respuesta vacía');
          }

        } catch (error) {
          console.error('IA Error:', error);
          hideTyping();

          // 5. Fallback local si falla la IA
          const localMatch = FAQS_FALLBACK.find(f =>
            f.q.toLowerCase().includes(text.toLowerCase()) ||
            text.toLowerCase().includes(f.q.toLowerCase())
          );

          if (localMatch) {
            renderBotMsg(localMatch.a);
          } else {
            renderBotMsg("Tuve un problema de conexión momentáneo. 😓 ¿Te puedo ayudar con nuestros servicios básicos?");
            renderChips(FAQS_FALLBACK); // Volver a mostrar chips
          }
        }
      }

      /* --- EVENTOS --- */

      function openChat() {
        dom.chat.style.display = 'flex';
        setTimeout(() => dom.chat.setAttribute('aria-hidden', 'false'), 10);

        // Mensaje de Bienvenida (Solo si está vacío)
        if (!dom.msgs.hasChildNodes()) {
          renderBotMsg("Hola 👋 Soy el **Consultor Virtual** de WebinizaDev.\n\nEstoy aquí para ayudarte a automatizar tu negocio y ahorrar tiempo.\n\n¿Qué te interesa hoy?\n\n1️⃣ Automatización con IA\n2️⃣ Desarrollo Web\n3️⃣ E-commerce\n4️⃣ Hablar con un Humano");
          renderChips(FAQS_FALLBACK);
        }
        dom.input.focus();
      }

      function closeChat() {
        dom.chat.setAttribute('aria-hidden', 'true');
        setTimeout(() => dom.chat.style.display = 'none', 300);
      }

      dom.fab.addEventListener('click', openChat);
      dom.close.addEventListener('click', closeChat);

      dom.send.addEventListener('click', () => handleInput(dom.input.value));

      dom.input.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') handleInput(dom.input.value);
      });

      dom.input.addEventListener('input', () => {
        dom.send.disabled = dom.input.value.trim().length === 0;
      });

      dom.wa.addEventListener('click', () => {
        window.open(`https://wa.me/${WHATSAPP_NUMBER}`, '_blank');
      });

    })();
  </script>

  <style>
    html {
      scroll-behavior: smooth;
    }

    #wz-chat[aria-hidden="true"] {
      opacity: 0;
      transform: translateY(20px) scale(0.95);
      pointer-events: none;
    }

    #wz-fab {
      position: fixed;
      right: 24px;
      bottom: 24px;
      z-index: 9999;
      width: 64px;
      height: 64px;
      border-radius: 50%;
      border: none;
      cursor: pointer;
      background: linear-gradient(135deg, #9333ea, #e11d48);
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
      transition: all .2s;
    }

    #wz-fab:hover {
      transform: scale(1.1);
    }

    #wz-robot-img {
      width: 40px;
      height: 40px;
    }

    #wz-chat {
      position: fixed;
      right: 24px;
      bottom: 100px;
      width: 360px;
      max-width: 90vw;
      height: 500px;
      max-height: 80vh;
      z-index: 9998;
      border-radius: 16px;
      background: #0f172a;
      border: 1px solid rgba(255, 255, 255, 0.1);
      display: flex;
      flex-direction: column;
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
      transition: all .3s cubic-bezier(0.4, 0, 0.2, 1);
      opacity: 1;
      transform: translateY(0) scale(1);
    }

    #wz-chat-header {
      padding: 16px;
      background: rgba(255, 255, 255, 0.03);
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
      display: flex;
      justify-content: space-between;
      align-items: center;
      color: white;
    }

    .wz-header-left {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .wz-header-left img {
      width: 32px;
      height: 32px;
    }

    #wz-close {
      background: transparent;
      border: none;
      color: white;
      font-size: 1.2rem;
      cursor: pointer;
    }

    #wz-chat-body {
      flex: 1;
      overflow-y: auto;
      padding: 16px;
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .wz-msg {
      max-width: 85%;
      padding: 10px 14px;
      border-radius: 12px;
      font-size: 0.95rem;
      line-height: 1.4;
      word-wrap: break-word;
    }

    .wz-msg.bot {
      background: rgba(255, 255, 255, 0.05);
      color: #e2e8f0;
      align-self: flex-start;
      border-bottom-left-radius: 2px;
      display: flex;
      gap: 8px;
    }

    .wz-msg.user {
      background: linear-gradient(135deg, #9333ea, #e11d48);
      color: white;
      align-self: flex-end;
      border-bottom-right-radius: 2px;
    }

    .wz-avatar {
      width: 24px;
      height: 24px;
      margin-top: 2px;
    }

    #wz-chips {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
      margin-top: 10px;
    }

    .wz-chip {
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.1);
      color: white;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.85rem;
      cursor: pointer;
      transition: background .2s;
    }

    .wz-chip:hover {
      background: rgba(255, 255, 255, 0.2);
    }

    .wz-footer {
      padding: 12px;
      border-top: 1px solid rgba(255, 255, 255, 0.05);
      display: flex;
      gap: 8px;
    }

    .wz-input-wrap {
      flex: 1;
      position: relative;
      display: flex;
    }

    .wz-input {
      width: 100%;
      background: rgba(0, 0, 0, 0.2);
      border: 1px solid rgba(255, 255, 255, 0.1);
      color: white;
      padding: 10px 40px 10px 12px;
      border-radius: 8px;
      outline: none;
    }

    .wz-input:focus {
      border-color: #9333ea;
    }

    .wz-btn {
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      color: white;
      transition: all .2s;
    }

    .wz-btn--send {
      position: absolute;
      right: 4px;
      top: 4px;
      background: transparent;
      color: #9333ea;
      width: 32px;
      height: 32px;
    }

    .wz-btn--send:hover {
      background: rgba(147, 51, 234, 0.1);
    }

    .wz-btn--send:disabled {
      color: gray;
      cursor: default;
    }

    .wz-btn--wa {
      background: #25D366;
    }

    .wz-btn--wa:hover {
      background: #20bd5a;
    }

    /* Scrollbar */
    #wz-chat-body::-webkit-scrollbar {
      width: 6px;
    }

    #wz-chat-body::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 3px;
    }
  </style>

</body>

</html>