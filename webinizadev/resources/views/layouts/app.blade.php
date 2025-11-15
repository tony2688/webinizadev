<!DOCTYPE html>
<html lang="es" data-theme="synthwave">
<head>
<meta charset="utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title', 'WebinizaDev')</title>

  {{-- Canonical (home fija, internas dinámicas) --}}
  @if (request()->is('/'))
    <link rel="canonical" href="https://webinizadev.com/" />
  @else
    <link rel="canonical" href="{{ url()->current() }}" />
  @endif

  <!-- Dependencias visuales -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="{{ asset('css/custom-animations.css') }}" rel="stylesheet">
  <link href="{{ asset('css/hero-carousel.css') }}" rel="stylesheet">

  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="{{ asset('images/icono.svg') }}">
  <!-- (opcional, si existen los PNG reales de 32/16) -->
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/icono-32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/icono-16.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/icono-180.png') }}">
  <link rel="manifest" href="{{ asset('site.webmanifest') }}">

  <!-- CSP (relajada para este layout) -->
  <meta http-equiv="Content-Security-Policy"
        content="default-src 'self';
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

  <!-- ===========================
      Modal de Términos (estático)
      =========================== -->
  <div id="modal-terminos" class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-[999] hidden">
    <div class="bg-gradient-to-br from-[#120426] via-[#2D0A5A] to-[#E83399]/90 p-8 rounded-xl shadow-2xl max-w-2xl w-full mx-4 relative">
      <button onclick="cerrarModal('modal-terminos')" class="absolute top-4 right-4 text-white text-2xl hover:text-[#ff0000] transition">&times;</button>
      <h2 class="text-2xl font-bold mb-4 text-white">Términos y Condiciones</h2>
      <p class="text-white/80 text-sm leading-relaxed space-y-4">
        <strong>1. Aceptación de los Términos:</strong> Al acceder y utilizar el sitio web de WebinizaDev, aceptas cumplir con estos Términos y Condiciones en su totalidad. Si no estás de acuerdo, por favor abstente de usar nuestros servicios.
        <br><br>
        <strong>2. Uso Permitido:</strong> El contenido de este sitio es únicamente para fines informativos y de contratación de servicios digitales. No está permitido el uso indebido, copia no autorizada o distribución del contenido.
        <br><br>
        <strong>3. Propiedad Intelectual:</strong> Todos los derechos de propiedad intelectual sobre los contenidos, imágenes, diseños y códigos son de WebinizaDev o de sus respectivos titulares. Queda prohibida su reproducción sin autorización.
        <br><br>
        <strong>4. Modificaciones:</strong> WebinizaDev se reserva el derecho de actualizar, modificar o eliminar cualquier parte del sitio o de estos términos en cualquier momento sin previo aviso.
        <br><br>
        <strong>5. Responsabilidad:</strong> WebinizaDev no se hace responsable por daños o perjuicios derivados del acceso, uso o mal uso de la información contenida en este sitio.
        <br><br>
        <strong>6. Legislación Aplicable:</strong> Estos términos se rigen por las leyes vigentes en la República Argentina. Cualquier disputa será resuelta ante los tribunales competentes de San Miguel de Tucumán.
        <br><br>
        <strong>7. Contacto:</strong> Para consultas sobre estos términos, puedes escribirnos a
        <a href="mailto:info@webinizadev.com" class="underline hover:text-white">info@webinizadev.com</a>.
      </p>
    </div>
  </div>

  <!-- ==============================
      Modal de Privacidad (estático)
      ============================== -->
  <div id="modal-privacidad" class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center min-h-screen p-4 z-[999] hidden">
    <div class="bg-gradient-to-br from-[#120426] via-[#2D0A5A] to-[#E83399]/90 p-6 md:p-8 rounded-xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto relative transform transition-all duration-300 scale-95 hover:scale-100">
      <button onclick="cerrarModal('modal-privacidad')" class="absolute top-4 right-4 text-white text-2xl hover:text-[#ff0000] transition">&times;</button>
      <h2 class="text-2xl font-bold mb-4 text-white">Política de Privacidad</h2>
      <p class="text-white/80 text-sm leading-relaxed space-y-4">
        <strong>1. Información que Recopilamos:</strong> Recopilamos información personal como nombre, correo electrónico y número de teléfono cuando completas formularios de contacto o solicitas nuestros servicios.
        <br><br>
        <strong>2. Uso de la Información:</strong> Utilizamos tus datos exclusivamente para responder consultas, gestionar proyectos, enviar presupuestos y mejorar nuestros servicios.
        <br><br>
        <strong>3. Protección de Datos:</strong> Implementamos medidas de seguridad administrativas, técnicas y físicas para proteger tus datos personales contra accesos no autorizados, pérdidas o alteraciones.
        <br><br>
        <strong>4. Divulgación a Terceros:</strong> No compartimos tus datos personales con terceros, salvo que sea necesario para la prestación del servicio o que la ley lo requiera.
        <br><br>
        <strong>5. Cookies:</strong> Este sitio puede utilizar cookies para mejorar la experiencia de navegación. Puedes configurar tu navegador para rechazar el uso de cookies si lo prefieres.
        <br><br>
        <strong>6. Derechos del Usuario:</strong> Puedes solicitar el acceso, rectificación o eliminación de tus datos personales enviándonos un correo a
        <a href="mailto:info@webinizadev.com" class="underline hover:text-white">info@webinizadev.com</a>.
        <br><br>
        <strong>7. Cambios en la Política:</strong> WebinizaDev se reserva el derecho de actualizar esta Política de Privacidad. Las modificaciones serán publicadas en este sitio web.
      </p>
    </div>
  </div>

  <!-- =========================================================
      Botón flotante "Volver arriba" — Opción A (IZQUIERDA)
      ========================================================= -->
  <a id="topButton" href="#inicio" aria-label="Volver arriba"
     class="fixed bottom-6 left-6 z-[9990] group opacity-0 pointer-events-none transition-all duration-300 ease-out [--size:2.75rem] md:[--size:3rem]">
    <span class="absolute inset-0 rounded-full bg-gradient-to-r from-[#ff0000] to-[#9900ff] blur-md opacity-40 group-hover:opacity-70 transition-opacity"></span>
    <span class="relative grid place-items-center rounded-full backdrop-blur-md bg-white/10 ring-1 ring-white/15 shadow-[0_10px_30px_rgba(0,0,0,0.35)] hover:scale-[1.04] active:scale-[0.98] transition-transform" style="width:var(--size);height:var(--size)">
      <i class="fa-solid fa-arrow-up-long text-white text-sm md:text-base"></i>
      <span class="absolute -top-8 px-2 py-0.5 rounded-md text-xs whitespace-nowrap bg-black/70 text-white opacity-0 translate-y-1 group-hover:opacity-100 group-hover:translate-y-0 transition">Arriba</span>
      <svg class="absolute inset-0" viewBox="0 0 100 100" fill="none" stroke-linecap="round" aria-hidden="true">
        <circle cx="50" cy="50" r="46" stroke="rgba(255,255,255,.2)" stroke-width="6" />
        <defs>
          <linearGradient id="topGrad" x1="0" y1="0" x2="100" y2="100">
            <stop offset="0%" stop-color="#ff0000" />
            <stop offset="100%" stop-color="#9900ff" />
          </linearGradient>
        </defs>
        <circle id="topProgress" cx="50" cy="50" r="46" stroke="url(#topGrad)" stroke-width="6" stroke-dasharray="289" stroke-dashoffset="289" transform="rotate(-90 50 50)" />
      </svg>
    </span>
  </a>

  <!-- =========================================
      Chatbot FAQ (no-IA) — Botón + Ventana
      ========================================= -->
  <div id="wz-chat-root">
    <!-- Botón flotante (a la DERECHA) -->
    <button id="wz-fab" aria-label="Abrir chat">
      <img src="{{ asset('images/robot.svg') }}" alt="robot" id="wz-robot-img" />
    </button>

    <!-- Ventana de chat -->
    <aside id="wz-chat" aria-hidden="true" style="display:none;">
      <header id="wz-chat-header">
        <div class="wz-header-left">
          <img src="{{ asset('images/robot.svg') }}" alt="robot" />
          <div>
            <strong>WebinizaDev</strong>
            <small>Asistente — Preguntas frecuentes</small>
          </div>
        </div>
        <button id="wz-close" aria-label="Cerrar">✕</button>
      </header>

      <main id="wz-chat-body">
        <div id="wz-messages"></div>
        <div id="wz-chips"></div>
      </main>

      <!-- Footer del chatbot mejorado -->
      <footer id="wz-chat-footer" class="wz-footer">
        <div class="wz-input-wrap">
          <input id="wz-search" class="wz-input" placeholder="Busca una pregunta o escribe..." aria-label="Buscar o escribir pregunta" />
          <button id="wz-send" class="wz-btn wz-btn--send wz-btn--icon" type="button" title="Enviar" aria-label="Enviar" disabled>
            <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true">
              <path d="M21.88 2.12a1 1 0 0 0-1.06-.23L2.93 8.67a1 1 0 0 0 .02 1.87l6.77 2.28 2.28 6.77a1 1 0 0 0 1.87.02l6.78-17.89a1 1 0 0 0-.77-1.4ZM11.3 13.52l-4.6-1.55 10.88-4.21-6.28 5.76Z" fill="currentColor" />
            </svg>
          </button>
        </div>

        <!-- Botón WhatsApp (icon-only, verde sólido) -->
        <button id="wz-wa" class="wz-btn wz-btn--wa wz-btn--icon" type="button" title="Enviar por WhatsApp" aria-label="Enviar por WhatsApp">
          <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true">
            <path d="M20 3.9A10 10 0 0 0 3.1 20L2 22l2-.9A10 10 0 1 0 20 3.9Zm-8.1 16a8 8 0 0 1-4-.9l-.3-.2-2.4 1 .9-2.4-.2-.3a8 8 0 1 1 6 2.8Zm4.5-5.9c-.3-.2-1.7-.9-1.9-1s-.4-.2-.6.2-.7 1-1 1.2-.5.2-.8 0-1.6-.6-3-1.9c-1.1-1-1.9-2.3-2.1-2.6s0-.6.1-.7l.5-.6c.2-.2.3-.5.5-.7.2-.2.1-.4 0-.6s-.6-1.5-.9-2.1c-.3-.6-.5-.5-.7-.5h-.6a1.2 1.2 0 0 0-.9.4c-.3.3-1.1 1-1.1 2.6s1.1 3 1.3 3.2 2.2 3.3 5.4 4.6c.7.3 1.3.5 1.7.6.7.2 1.3.2 1.8.1.6-.1 1.7-.7 1.9-1.4s.2-1.3.1-1.4-.3-.2-.6-.4Z" fill="currentColor" />
          </svg>
        </button>
      </footer>
    </aside>
  </div>

  {{-- Scripts base --}}
  <script src="{{ asset('js/layout/header.js') }}" defer></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

  {{-- Inicializaciones visuales --}}
  <script>
    AOS.init();
    const swiper = new Swiper('.swiper-container', {
      loop: true,
      autoplay: { delay: 4000, disableOnInteraction: false },
      effect: 'fade',
      fadeEffect: { crossFade: true },
      speed: 800,
      navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
      pagination: { el: '.swiper-pagination', clickable: true, dynamicBullets: true },
      grabCursor: true,
      keyboard: { enabled: true },
      on: { init(){ setTimeout(()=>{ this.el.classList.add('swiper-initialized'); },100); } }
    });
  </script>

  <!-- Modales (abrir/cerrar) -->
  <script>
    function abrirModal(id){ document.getElementById(id).classList.remove('hidden'); }
    function cerrarModal(id){ document.getElementById(id).classList.add('hidden'); }
  </script>

  <!-- Lógica botón "Volver arriba" -->
  <script>
    (function(){
      const btn = document.getElementById('topButton');
      const prog = document.getElementById('topProgress');
      if (!btn || !prog) return;
      const CIRC = 2 * Math.PI * 46;
      prog.style.strokeDasharray = String(CIRC);

      const toggleAndProgress = () => {
        const doc = document.documentElement;
        const scrollTop = window.scrollY || doc.scrollTop;
        const max = (doc.scrollHeight - doc.clientHeight) || 1;
        const pct = Math.min(scrollTop / max, 1);
        const show = scrollTop > 240;
        btn.style.opacity = show ? '1' : '0';
        btn.style.pointerEvents = show ? 'auto' : 'none';
        prog.style.strokeDashoffset = String(CIRC * (1 - pct));
      };

      window.addEventListener('scroll', toggleAndProgress, { passive: true });
      window.addEventListener('resize', toggleAndProgress);
      toggleAndProgress();

      btn.addEventListener('click', (e) => {
        if (!document.getElementById('inicio')) {
          e.preventDefault();
          window.scrollTo({ top: 0, behavior: 'smooth' });
        }
      });
    })();
  </script>

  <!-- =========================================
      Chatbot FAQ (no-IA) — JS
      ========================================= -->
  <script>
    (function(){
      /* ---- CONFIG ---- */
      const ROBOT_IMG = "{{ asset('images/robot.svg') }}";
      const WHATSAPP_PHONE = '5493815555648'; // internacional

      const FAQS = [
        { q:"¿Qué servicios ofrece WebinizaDev?", a:"Desarrollo web (sitios, landing pages), e-commerce, integraciones con WhatsApp y MercadoPago, CRM a medida, mantenimiento y optimización de rendimiento. Trabajamos con PHP, Laravel, Flask, React y diseños responsivos." },
        { q:"¿Hacen sitios para energía solar?", a:"Sí. Tenemos experiencia en proyectos de UV Energía Solar: calculadoras solares, cotizaciones automáticas, y catálogos de paneles, baterías e inversores." },
        { q:"¿Hacen landing pages para productoras audiovisuales?", a:"Sí. Ejemplo: SDT Audio Visual – Landing page + sistema de administración. Podemos integrar portfolios, videos, y reservas de turnos." },
        { q:"¿Ofrecen mantenimiento y hosting?", a:"Ofrecemos configuración inicial, optimización de performance y asesoramiento para hosting (VPS, Hostinger, Railway, Render). También ayudamos con backups y seguridad básica." },
        { q:"¿Cómo contacto a WebinizaDev?", a:"WhatsApp: +54 9 381 5555648. También podés usar el formulario de contacto en la web o escribir a info@webiniza.dev." },
        { q:"¿Hacen integraciones con WhatsApp Business?", a:"Sí: automatizamos mensajes comerciales, botones para comprar por WhatsApp y generación de cotizaciones precompletas." },
        { q:"¿Pueden crear calculadoras o cotizadores?", a:"Sí: calculadoras solares, cotizadores de productos, exportación a PDF y botón directo a WhatsApp con los resultados." },
        { q:"¿Dónde están ubicados?", a:"Estamos en Tucumán, Argentina. Trabajamos con clientes en todo el país y también remoto." }
      ];
      window.FAQS = FAQS;

      /* ---- UI refs ---- */
      const fab = document.getElementById('wz-fab');
      const chat = document.getElementById('wz-chat');
      const closeBtn = document.getElementById('wz-close');
      const messages = document.getElementById('wz-messages');
      const chips = document.getElementById('wz-chips');
      const search = document.getElementById('wz-search');
      const sendBtn = document.getElementById('wz-send');
      const waBtn = document.getElementById('wz-wa');

      document.querySelectorAll('#wz-chat img').forEach(img => { if (!img.src) img.src = ROBOT_IMG; });

      function openChat(){
        chat.style.display = 'flex';
        requestAnimationFrame(()=> chat.setAttribute('aria-hidden','false'));
        if (!messages.hasChildNodes()){
          renderBotMessage("Bienvenido/a a WebinizaDev 👋\nTe ayudo a elegir la mejor página web para tu negocio.\nDecime, ¿qué estás buscando hoy? Respondé con el número o escribí con tus palabras:\n1️⃣ Crear mi primera página web\n2️⃣ Mejorar una web que ya tengo\n3️⃣ Hacer una tienda online para vender productos\n4️⃣ Otro / No estoy seguro, necesito asesoría");
          if (!window.WZ_AI_ACTIVE || window.WZ_AI_LAST_FAILED){
            renderChips(FAQS.slice(0,5));
          } else {
            chips.style.display = 'none';
          }
        }
        search.focus();
      }
      function closeChat(){ chat.setAttribute('aria-hidden','true'); chat.style.display='none'; }
      fab.addEventListener('click', openChat);
      closeBtn.addEventListener('click', closeChat);

      function renderChips(list){
        chips.innerHTML = '';
        list.forEach(item=>{
          const el = document.createElement('button');
          el.className = 'wz-chip';
          el.textContent = item.q;
          el.onclick = () => (window.WZChat?.ask || handleQuestion)(item.q);
          chips.appendChild(el);
        });
        chips.style.display = 'flex';
      }
      // Exponer para que la capa IA pueda invocar cuando caiga a FAQ
      window.WZ_renderChips = renderChips;
      function renderUserMessage(text){
        const el = document.createElement('div');
        el.className = 'wz-msg user';
        el.innerHTML = `<div class="wz-text">${escapeHtml(text)}</div>`;
        messages.appendChild(el); messages.scrollTop = messages.scrollHeight;
      }
      function formatBotText(text){
        let html = escapeHtml(text).replace(/\n/g, '<br>');
        const variants = ['+54 381 555-5648','+54 9 381 5555648','5493815555648'];
        const wa = typeof WHATSAPP_PHONE === 'string' ? WHATSAPP_PHONE : '5493815555648';
        variants.forEach(v => {
          const re = new RegExp(v.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'), 'g');
          html = html.replace(re, `<a href="https://wa.me/${wa}" target="_blank" rel="noopener">${v}</a>`);
        });
        return html;
      }
      window.formatBotText = formatBotText;
      function renderBotMessage(text){
        const el = document.createElement('div');
        el.className = 'wz-msg bot';
        el.innerHTML = `<img src="${ROBOT_IMG}" class="wz-avatar" alt="robot"/><div class="wz-text">${formatBotText(text)}</div>`;
        messages.appendChild(el); messages.scrollTop = messages.scrollHeight;
      }
      function renderBotTypingThen(text, delay=700){
        const typingEl = document.createElement('div');
        typingEl.className = 'wz-msg bot';
        typingEl.innerHTML = `<img src="${ROBOT_IMG}" class="wz-avatar" alt="robot"/><div class="wz-text"> escribiendo<span class="dot">.</span></div>`;
        messages.appendChild(typingEl); messages.scrollTop = messages.scrollHeight;
        let dotCount=0;
        const dotInterval = setInterval(()=>{
          dotCount=(dotCount+1)%4;
          typingEl.querySelector('.wz-text').innerHTML = ` escribiendo${'.'.repeat(dotCount)}`;
          messages.scrollTop = messages.scrollHeight;
        },300);
        setTimeout(()=>{ clearInterval(dotInterval); typingEl.remove(); renderBotMessage(text); }, delay + Math.min(1200, text.length*20));
      }
      function handleQuestion(q){
        renderUserMessage(q);
        const found = FAQS.find(f => f.q.toLowerCase() === q.toLowerCase());
        if (found) renderBotTypingThen(found.a);
        else {
          const candidate = FAQS.filter(f => f.q.toLowerCase().includes(q.toLowerCase()) || f.a.toLowerCase().includes(q.toLowerCase()));
          if (candidate.length) renderBotTypingThen(candidate[0].a);
          else renderBotTypingThen("Perdón, no encontré una respuesta exacta. Podés escribir tu consulta y la recibimos por WhatsApp o email.");
        }
        setTimeout(()=> {
          if (!window.WZ_AI_ACTIVE || window.WZ_AI_LAST_FAILED){
            renderChips(FAQS.slice(0,5));
          }
        }, 900);
      }
      function updateSendState(){ const hasText = search.value.trim().length>0; sendBtn.disabled = !hasText; }
      search.addEventListener('input', updateSendState);
      window.addEventListener('load', updateSendState);
      search.addEventListener('keydown', function(e){
        if (e.key === 'Enter'){
          const text = this.value.trim(); if (!text) return;
          handleQuestion(text); this.value=''; updateSendState();
        }
      });
      sendBtn.addEventListener('click', ()=>{
        const text = search.value.trim(); if (!text) return;
        handleQuestion(text); search.value=''; updateSendState();
      });
      waBtn.addEventListener('click', ()=>{
        const lastBot = Array.from(messages.querySelectorAll('.wz-msg.bot .wz-text')).pop();
        const text = lastBot ? lastBot.innerText : "Hola, quiero más info sobre WebinizaDev";
        const encoded = encodeURIComponent(text + "\n\n(Enviado desde WebinizaDev widget)");
        if (!WHATSAPP_PHONE){ alert("No se configuró número de WhatsApp (WHATSAPP_PHONE en el script)."); return; }
        const url = `https://wa.me/${WHATSAPP_PHONE}?text=${encoded}`;
        window.open(url, '_blank');
      });
      function escapeHtml(unsafe){ return unsafe.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/"/g,"&quot;").replace(/'/g,"&#039;"); }

      setTimeout(()=>{ fab.animate([{transform:'translateY(0)'},{transform:'translateY(-6px)'},{transform:'translateY(0)'}],{duration:900,iterations:1}); },1200);

      if (window.WZ_FAQ && Array.isArray(window.WZ_FAQ)){ window.WZ_FAQ.forEach(f=>{ if (f.q && f.a) FAQS.push(f); }); }

      window.WZChat = { open: openChat, close: closeChat, ask: handleQuestion, addFAQ: (q,a)=>{ FAQS.push({q,a}); renderChips(FAQS.slice(0,5)); } };
    })();
  </script>

<!-- =========================================
      Chatbot IA Webinizadev (si-IA) — JS
      ========================================= -->

  <script>
  // === Config ===
  const AI_CHAT_URL = window.AI_CHAT_URL || "{{ route('ai.chat') }}";
  // Señal global de estado IA
  window.WZ_AI_ACTIVE = true;
  window.WZ_AI_LAST_FAILED = false;

  // === Helpers de UI (usan tus funciones si existen; si no, hacen fallback) ===
  function uiUser(msg){
    if (window.renderUserMessage) return renderUserMessage(msg);
    const box = document.querySelector('#wz-messages') || document.body;
    const el = document.createElement('div'); el.className='wz-msg user'; el.textContent=msg; box.appendChild(el);
  }
  
  function uiBot(msg){
    if (window.renderBotMessage) return renderBotMessage(msg);
    const box = document.querySelector('#wz-messages') || document.body;
    const el = document.createElement('div');
    el.className = 'wz-msg bot';
    el.innerHTML = `<div class="wz-text">${formatBotText(msg)}</div>`;
    box.appendChild(el);
    box.scrollTop = box.scrollHeight;
  }

  function sanitize(text) {
    return text
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;")
      .replace(/\n/g, "<br>");
  }

  function uiTyping(show){
    if (window.renderBotTypingThen && show) return renderBotTypingThen('Pensando…'); // usa tu spinner si lo tenés
    const box = document.querySelector('#wz-messages'); if (!box) return;
    const id='wz-typing'; let t = document.getElementById(id);
    if (show){ if (!t){ t=document.createElement('div'); t.id=id; t.className='wz-msg bot'; t.textContent='Pensando…'; box.appendChild(t); } }
    else { if (t) t.remove(); }
  }

  // === Llamado a tu backend ===
  async function askAI(text){
    const res = await fetch(AI_CHAT_URL, {
      method: 'POST',
      headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN':'{{ csrf_token() }}' },
      credentials: 'same-origin',
      body: JSON.stringify({ prompt: text })
    });
    const data = await res.json();
    if (!res.ok) throw new Error((data && (data.error || data.detail)) || 'AI upstream');
    if (!data.reply) throw new Error('Respuesta vacía');
    return data.reply;
  }

  // === Handler principal (FAQ → primero IA, luego fallback FAQ) ===
  async function handleQuestion(q){
    if (!q || !q.trim()) return;
    q = q.trim();
    uiUser(q);

    uiTyping(true);
    let aiReply = '';
    let aiError  = null;
    try {
      aiReply = await askAI(q);
    } catch (err) {
      aiError = err;
      console.warn('AI request failed, will fallback to FAQ:', err);
    }

    if (aiReply){
      uiTyping(false);
      uiBot(aiReply);
      // Actualiza la referencia pública si existe
      if (window.WZChat) window.WZChat.ask = handleQuestion;
      // Ocultar chips si IA respondió
      window.WZ_AI_LAST_FAILED = false;
      const chipsEl = document.getElementById('wz-chips');
      if (chipsEl) chipsEl.style.display = 'none';
      return;
    }

    // --- Fallback a FAQ ---
    let found = null;
    try {
      if (Array.isArray(window.FAQS)){
        found = window.FAQS.find(f => (f.q || '').toLowerCase() === q.toLowerCase());
        if (!found){
          const cand = window.FAQS.filter(f => (f.q || '').toLowerCase().includes(q.toLowerCase()) || (f.a || '').toLowerCase().includes(q.toLowerCase()));
          if (cand.length) found = cand[0];
        }
      }
    } catch(_){}

    uiTyping(false);
    if (found){
      uiBot(found.a);
    } else {
      uiBot('Lo siento, no encontré una respuesta en este momento. Por favor, intentá nuevamente más tarde.');
    }

    // Mostrar chips porque se usó FAQ (la IA falló)
    window.WZ_AI_LAST_FAILED = true;
    const chipsEl2 = document.getElementById('wz-chips');
    if (chipsEl2) chipsEl2.style.display = 'flex';
    if (window.WZ_renderChips) window.WZ_renderChips(FAQS.slice(0,5));
  }

  // Re-vincula la función al objeto global en caso de que se definiera antes
  if (window.WZChat) window.WZChat.ask = handleQuestion;
  
  // === Wire del formulario del chat ===
  document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('wz-search');   // usa el campo existente del chat
    const send  = document.getElementById('wz-send');

    const getInput = () => document.getElementById('wz-search');
    const setSendEnabled = () => {
      const el = getInput();
      const btn = document.getElementById('wz-send');
      const hasText = !!el && el.value.trim().length > 0;
      if (btn) btn.disabled = !hasText;
    };

    const triggerSend = () => {
      const el = getInput();
      const text = (el?.value || '').trim();
      if (!text) return;
      handleQuestion(text);
      if (el) { el.value = ''; }
      setSendEnabled();
    };
  
    if (send){
      // Elimina posibles listeners anteriores para evitar doble envío
      send.replaceWith(send.cloneNode(true));
      const newSend = document.getElementById('wz-send');
      newSend.addEventListener('click', triggerSend);
    }
  
    if (input){
      // Clonar el input para remover listeners antiguos del script FAQ
      const clone = input.cloneNode(true);
      input.parentNode.replaceChild(clone, input);
      // Estado del botón enviar en móviles y desktop
      clone.addEventListener('input', setSendEnabled);
      clone.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' && !e.shiftKey){ e.preventDefault(); triggerSend(); }
      });
      // Inicializar estado
      setSendEnabled();
    }
  });
</script>

  <!-- =========================
      Estilos del Chatbot (CSS)
      ========================= -->
  <style>
    html { scroll-behavior: smooth; }
    #wz-chat[aria-hidden="true"] { display: none; }
    #wz-chat-root { --accent:#9333ea; --bg:#0f1724; font-family: Inter, Poppins, system-ui, sans-serif; }
    #wz-fab{ position:fixed; right:24px; bottom:24px; z-index:9999; width:64px; height:64px; border-radius:999px; border:none; cursor:pointer; background:linear-gradient(135deg,var(--accent),#e11d48); display:flex; align-items:center; justify-content:center; box-shadow:0 8px 24px rgba(0,0,0,0.3); transition:transform .18s ease; }
    #wz-fab:hover{ transform:translateY(-4px) scale(1.03); }
    #wz-robot-img{ width:46px; height:46px; }

    #wz-chat{ position:fixed; right:24px; bottom:100px; width:360px; max-width:94vw; height:520px; z-index:9998; border-radius:12px; overflow:hidden; box-shadow:0 20px 60px rgba(2,6,23,0.6); transform:translateY(20px) scale(.98); opacity:0; transition:all .25s ease; background:linear-gradient(180deg,#0b1220 0%,#071023 100%); color:#e6eef8; display:flex; flex-direction:column; border:1px solid rgba(255,255,255,0.04); }
    #wz-chat[aria-hidden="false"]{ transform:translateY(0) scale(1); opacity:1; }

    #wz-chat-header{ display:flex; align-items:center; justify-content:space-between; padding:12px 14px; background:linear-gradient(90deg, rgba(255,255,255,0.02), transparent); }
    .wz-header-left{ display:flex; gap:10px; align-items:center; }
    .wz-header-left img{ width:44px; height:44px; border-radius:8px; }
    #wz-chat-header small{ display:block; opacity:.8; font-size:12px; line-height:1; color:#cfe6ff; }
    #wz-close{ background:none; border:0; color:#cfe6ff; font-size:18px; cursor:pointer; opacity:.9; }

    #wz-chat-body{ flex:1; padding:14px; overflow:auto; display:flex; flex-direction:column; gap:10px; }
    #wz-messages{ display:flex; flex-direction:column; gap:12px; }
    .wz-msg{ max-width:82%; padding:10px 12px; border-radius:12px; line-height:1.35; box-shadow:0 6px 18px rgba(2,6,23,0.5); }
    .wz-msg.bot{ background:linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.01)); align-self:flex-start; color:#e6eef8; display:flex; gap:8px; }
    .wz-msg.user{ background:linear-gradient(180deg,#9333ea,#e11d48); align-self:flex-end; color:#fff; }
    .wz-msg .wz-avatar{ width:34px; height:34px; border-radius:8px; flex-shrink:0; }
    .wz-msg .wz-text{ white-space:pre-wrap; }

    #wz-chips{ display:flex; gap:8px; flex-wrap:wrap; padding-top:6px; }
    .wz-chip{ background:rgba(255,255,255,0.06); padding:8px 10px; border-radius:999px; cursor:pointer; font-size:13px; border:1px solid rgba(255,255,255,0.08); }
    .wz-chip:hover{ background:rgba(255,255,255,0.1); }

    .wz-footer{ position:relative; padding:10px; padding-bottom:calc(10px + env(safe-area-inset-bottom)); display:flex; gap:10px; align-items:center; border-top:1px solid rgba(255,255,255,0.06); }
    .wz-input-wrap{ position:relative; flex:1; display:flex; }
    .wz-input{ flex:1; height:44px; padding:0 48px 0 14px; border-radius:12px; border:1px solid rgba(255,255,255,0.06); background:rgba(255,255,255,0.04); color:#e6eef8; outline:none; transition:border-color .2s, background .2s, box-shadow .2s; }
    .wz-input::placeholder{ color:rgba(230,238,248,0.55); }
    .wz-input:focus{ border-color:rgba(147,51,234,0.6); background:rgba(255,255,255,0.06); box-shadow:0 0 0 3px rgba(147,51,234,0.15); }

    .wz-btn{ display:inline-flex; align-items:center; justify-content:center; gap:8px; height:44px; border:0; border-radius:12px; padding:0 14px; font-weight:600; cursor:pointer; transition:transform .15s, box-shadow .15s, opacity .15s; color:#fff; }
    .wz-btn--icon{ width:36px; height:36px; padding:0; border-radius:999px; }
    .wz-btn--send{ position:absolute; right:6px; top:50%; transform:translateY(-50%); width:36px; height:36px; padding:0; border-radius:999px; background:linear-gradient(135deg,var(--accent,#9333ea),#e11d48); box-shadow:0 8px 20px rgba(0,0,0,.28); }
    .wz-btn--send:hover{ transform:translateY(-50%) scale(1.03); }
    .wz-btn--send:active{ transform:translateY(-50%) scale(.98); }
    .wz-btn--send:focus-visible{ outline:3px solid rgba(255,255,255,.75); outline-offset:2px; }
    .wz-btn--send[disabled]{ opacity:.45; cursor:not-allowed; box-shadow:none; }

    .wz-btn--wa{ background:#25D366; color:#fff; box-shadow:0 8px 20px rgba(37,211,102,0.25); border:0; }
    .wz-btn--wa:hover{ background:#21c25c; box-shadow:0 10px 24px rgba(37,211,102,0.35); transform:translateY(-1px); }
    .wz-btn--wa:active{ transform:translateY(0); background:#1bab53; }
    .wz-btn--wa:focus-visible{ outline:3px solid rgba(37,211,102,0.45); outline-offset:2px; }

    #wz-chat-body::-webkit-scrollbar{ width:8px; }
    #wz-chat-body::-webkit-scrollbar-thumb{ background:rgba(255,255,255,0.03); border-radius:8px; }

    .wz-msg .wz-text {
    white-space: pre-wrap;
  }
  /* Ajustes móviles para visibilidad del botón enviar */
  @media (max-width: 420px) {
    #wz-chat { width: 94vw; height: 72vh; right: 3vw; }
    .wz-footer { gap: 8px; }
    .wz-btn--icon { width: 34px; height: 34px; }
    .wz-input { padding-right: 46px; }
    .wz-btn--send { right: 6px; width: 34px; height: 34px; }
    .wz-btn--wa { width: 42px; height: 42px; padding: 0; }
  }
  </style>

</body>
</html>
