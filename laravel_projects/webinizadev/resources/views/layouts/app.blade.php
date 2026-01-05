<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  {{-- TOKEN DE SEGURIDAD CRÍTICO --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'WebinizaDev | IA & Automatización')</title>

  {{-- LIBRERÍAS --}}
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  {{-- Vanta.js --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.net.min.js"></script>

  <style>
    /* 1. BASE */
    body { overflow-x: hidden !important; width: 100%; margin: 0; }
    ::-webkit-scrollbar { display: none; }
    .nav-dot { width: 12px; height: 12px; background: rgba(255,255,255,0.2); border-radius: 50%; transition: 0.3s; position: relative; }
    .nav-dot.active { background: #ff0056; box-shadow: 0 0 15px #ff0056; transform: scale(1.4); }
    .nav-dot .tooltip { position: absolute; right: 25px; top: 50%; transform: translateY(-50%); background: #000; padding: 4px 8px; border-radius: 4px; font-size: 10px; opacity: 0; pointer-events: none; transition: 0.3s; }
    .nav-dot:hover .tooltip { opacity: 1; }

    /* 2. ROBOT FLOTANTE (Tamaño Fijo) */
    #wz-fab { 
      position: fixed !important; right: 24px !important; bottom: 24px !important; 
      width: 64px !important; height: 64px !important; z-index: 10000 !important;
      background: linear-gradient(135deg, #9333ea, #ff0056); border-radius: 50%;
      display: flex; align-items: center; justify-content: center; border: none; cursor: pointer;
      box-shadow: 0 8px 24px rgba(255, 0, 86, 0.4); transition: transform 0.2s;
    }
    #wz-fab:hover { transform: scale(1.05); }
    #wz-robot-img { width: 38px !important; height: 38px !important; display: block; }

    /* 3. VENTANA DE CHAT */
    #wz-chat { 
      position: fixed !important; right: 24px !important; bottom: 100px !important; 
      width: 380px !important; max-width: 90vw; height: 500px !important; 
      background: #130521 !important; border: 1px solid rgba(255, 255, 255, 0.15); 
      border-radius: 20px; display: none; flex-direction: column; 
      z-index: 9999 !important; transition: all .3s ease; box-shadow: 0 25px 60px rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(15px);
    }

    /* 4. MENSAJES (CORRECCIÓN DE COLOR Y FORMATO) */
    #wz-messages { flex: 1; overflow-y: auto; padding: 20px; display: flex; flex-direction: column; gap: 15px; }
    
    .wz-msg { 
        max-width: 85%; padding: 12px 16px; border-radius: 15px; 
        font-size: 0.9rem; line-height: 1.5; word-wrap: break-word;
        color: #ffffff !important; /* TEXTO BLANCO OBLIGATORIO */
        white-space: pre-wrap; /* IMPORTANTE: Respeta saltos de línea y espacios */
    }
    
    .wz-msg.bot { 
        background: rgba(255,255,255,0.1); 
        align-self: flex-start; 
        border-bottom-left-radius: 4px; 
        border: 1px solid rgba(255,255,255,0.05); 
    }
    
    /* NEGRITAS EN ROSA NEÓN */
    .wz-msg.bot strong {
        color: #ff0056; 
        font-weight: 700;
    }
    
    .wz-msg.user { 
        background: linear-gradient(135deg, #7c3aed, #db2777); 
        align-self: flex-end; 
        border-bottom-right-radius: 4px; 
        box-shadow: 0 4px 15px rgba(219, 39, 119, 0.3); 
    }

    /* ESTILO PARA EL LINK DE WHATSAPP */
    .chat-link {
        color: #4ade80 !important; /* Verde brillante */
        font-weight: bold;
        text-decoration: underline;
        cursor: pointer;
    }
    .chat-link:hover {
        color: #86efac !important;
    }

    /* 5. FOOTER E INPUTS */
    .wz-footer { padding: 16px; border-top: 1px solid rgba(255,255,255,0.1); display: flex; gap: 10px; background: rgba(19, 5, 33, 0.9); border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; }
    .wz-input-container { flex: 1; position: relative; display: flex; align-items: center; }
    
    .wz-input { 
        width: 100%; background: rgba(0,0,0,0.3); 
        border: 1px solid rgba(255,255,255,0.2); padding: 12px 45px 12px 15px; 
        border-radius: 12px; color: #ffffff !important; /* INPUT BLANCO */
        outline: none; transition: border 0.3s; 
    }
    .wz-input::placeholder { color: rgba(255,255,255,0.5); }
    .wz-input:focus { border-color: #ff0056; }
    
    #wz-send { position: absolute; right: 8px; background: none; border: none; color: #ff0056; cursor: pointer; padding: 5px; transition: transform 0.2s; }
    #wz-send:hover { transform: scale(1.1); }

    /* Header */
    #wz-chat-header strong { color: #ffffff !important; }
    #wz-chat-header small { color: #a78bfa !important; }

    /* Animación Escribiendo */
    .typing-indicator span { animation: blink 1.4s infinite both; }
    .typing-indicator span:nth-child(2) { animation-delay: 0.2s; }
    .typing-indicator span:nth-child(3) { animation-delay: 0.4s; }
    @keyframes blink { 0% { opacity: 0.2; } 20% { opacity: 1; } 100% { opacity: 0.2; } }
  </style>
</head>

<body>
  @include('layouts.header')

  {{-- NAVEGACIÓN --}}
  <div id="nav-dots" class="fixed right-6 top-1/2 -translate-y-1/2 z-40 hidden lg:flex flex-col gap-6 items-center">
    @foreach(['inicio','nosotros','equipo','servicios','proyectos','planes','contacto'] as $sec)
      <a href="#{{$sec}}" class="nav-dot" data-target="{{$sec}}"><span class="tooltip">{{ucfirst($sec)}}</span></a>
    @endforeach
  </div>

  <main id="main">
    <div id="inicio" class="relative min-h-screen">@include('sections.hero')</div>
    <div id="nosotros">@include('sections.nosotros')</div>
    <div id="equipo">@include('sections.equipo')</div>
    <div id="servicios">@include('sections.servicios')</div>
    <div id="proyectos">@include('sections.proyectos')</div>
    <div id="planes">@include('sections.planes')</div>
    <div id="contacto">@include('sections.contacto')</div>
  </main>

  @include('layouts.footer')

  {{-- CHATBOT HTML --}}
  <div id="wz-chat-root">
    <button id="wz-fab"><img src="{{ asset('images/robot.svg') }}" id="wz-robot-img" /></button>
    <aside id="wz-chat" aria-hidden="true">
      <header id="wz-chat-header" style="padding: 18px 20px; border-bottom: 1px solid rgba(255,255,255,0.1); display: flex; justify-content: space-between; align-items: center; background: rgba(255,255,255,0.02);">
        <div style="display: flex; align-items: center; gap: 12px;">
          <img src="{{ asset('images/robot.svg') }}" style="width:34px; height:34px;" />
          <div><strong style="display:block; line-height:1;">WebinizaDev</strong><small>Agente IA</small></div>
        </div>
        <button id="wz-close" style="color:white; background:none; border:none; cursor:pointer; font-size:20px; opacity:0.7;">✕</button>
      </header>

      <div id="wz-messages">
        <div class="wz-msg bot">👋 ¡Hola! Soy el Agente virtual de WebinizaDev. ¿En qué puedo ayudarte hoy?</div>
      </div>

      <footer class="wz-footer">
        <div class="wz-input-container">
          <input id="wz-search" class="wz-input" placeholder="Escribe tu consulta aquí..." autocomplete="off">
          <button id="wz-send"><i class="fas fa-paper-plane text-lg"></i></button>
        </div>
      </footer>
    </aside>
  </div>

  {{-- SCRIPTS --}}
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      
      // 1. INICIALIZACIONES
      AOS.init({ once: true, duration: 800 });
      if (window.VANTA) {
        VANTA.NET({ el: "#inicio", mouseControls: true, touchControls: true, color: 0xff0056, backgroundColor: 0x0f0014, points: 12.0 });
      }
      new Swiper('.plans-swiper', { slidesPerView: 1, spaceBetween: 20, grabCursor: true, pagination: { el: '.plans-swiper-pagination', clickable: true }, breakpoints: { 768: { slidesPerView: 2 }, 1024: { slidesPerView: 3 } } });
      new Swiper('.projects-swiper', { slidesPerView: 1, spaceBetween: 30, loop: true, navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' }, breakpoints: { 1024: { slidesPerView: 2 } } });

      // 2. LÓGICA CHATBOT
      const dom = {
        fab: document.getElementById('wz-fab'),
        chat: document.getElementById('wz-chat'),
        close: document.getElementById('wz-close'),
        input: document.getElementById('wz-search'),
        send: document.getElementById('wz-send'),
        msgs: document.getElementById('wz-messages')
      };

      // ✨ FUNCIÓN MAESTRA DE FORMATO ✨
      // Esta función limpia el texto feo y lo pone bonito
      function formatBotResponse(text) {
        let formatted = text;

        // 1. Negritas: **texto** -> <strong>texto</strong> (Texto rosa neón)
        formatted = formatted.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
        
        // 2. Links: https://... -> Enlace verde clicable
        formatted = formatted.replace(/(https?:\/\/[^\s]+)/g, '<a href="$1" target="_blank" class="chat-link">$1</a>');

        // 3. Listas: - item -> • item (Viñeta bonita)
        formatted = formatted.replace(/(?:^|\n)- /g, '<br>• ');

        // 4. Saltos de línea (Para que no se vea todo pegado)
        formatted = formatted.replace(/\n/g, '<br>');

        return formatted;
      }

      function addMessage(text, type) {
        const div = document.createElement('div');
        div.className = `wz-msg ${type}`;
        
        if (type === 'bot') {
            // El bot recibe formato bonito (HTML)
            div.innerHTML = formatBotResponse(text);
        } else {
            // El usuario solo texto plano (seguridad)
            div.textContent = text;
        }
        
        dom.msgs.appendChild(div);
        dom.msgs.scrollTop = dom.msgs.scrollHeight;
      }

      function showTyping() {
        const div = document.createElement('div');
        div.id = 'typing-indicator';
        div.className = 'wz-msg bot typing-indicator';
        div.innerHTML = 'Escribiendo<span>.</span><span>.</span><span>.</span>';
        dom.msgs.appendChild(div);
        dom.msgs.scrollTop = dom.msgs.scrollHeight;
      }

      function removeTyping() {
        const el = document.getElementById('typing-indicator');
        if (el) el.remove();
      }

      async function handleChat() {
        const text = dom.input.value.trim();
        if (!text) return;

        addMessage(text, 'user');
        dom.input.value = '';
        dom.input.disabled = true;
        showTyping();

        try {
          const response = await fetch('/ai/chat', { 
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ prompt: text })
          });

          const data = await response.json();
          removeTyping();
          
          if (data.reply) {
            addMessage(data.reply, 'bot');
          } else {
            addMessage("Algo salió mal. Intenta de nuevo.", 'bot');
          }

        } catch (error) {
          console.error(error);
          removeTyping();
          addMessage("🔴 Error de conexión. Revisa tu internet.", 'bot');
        } finally {
          dom.input.disabled = false;
          dom.input.focus();
        }
      }

      dom.fab.onclick = () => { dom.chat.style.display = 'flex'; setTimeout(() => dom.chat.style.opacity = '1', 10); };
      dom.close.onclick = () => { dom.chat.style.opacity = '0'; setTimeout(() => dom.chat.style.display = 'none', 300); };
      dom.send.onclick = handleChat;
      dom.input.addEventListener('keypress', (e) => { if (e.key === 'Enter') handleChat(); });
    });
  </script>
</body>
</html>