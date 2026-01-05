<section id="proyectos" class="relative py-24 px-4 md:px-8 bg-[#0f0014] text-white overflow-hidden">

  <div class="absolute inset-0 pointer-events-none z-0">
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-[#ff0056]/10 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-[#9900ff]/10 rounded-full blur-[120px]"></div>
  </div>

  <div class="relative z-10 text-center mb-16 max-w-4xl mx-auto px-6" data-aos="fade-up">
    <div
      class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-900/30 border border-purple-500/30 mb-6">
      <span class="w-2 h-2 rounded-full bg-[#ff0056] animate-pulse"></span>
      <span class="text-xs font-bold tracking-widest text-purple-200 uppercase">Portfolio 2025</span>
    </div>

    <h2 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
      Resultados que <br>
      <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#ff0056] to-[#9900ff]">hablan por sí
        solos</span>
    </h2>
    <p class="text-gray-400 text-lg max-w-2xl mx-auto">
      Sistemas reales en producción. Hacé clic en <b>"Ver Demo"</b> para ver la IA en acción.
    </p>
  </div>

  <div class="relative z-10 max-w-7xl mx-auto px-2">
    <div class="swiper projects-swiper !pb-16 !px-4">
      <div class="swiper-wrapper">

        <div class="swiper-slide">
          <div
            class="group relative rounded-2xl overflow-hidden bg-[#160b25] border border-white/5 hover:border-[#ff0056]/50 transition-all duration-500 hover:-translate-y-2 shadow-2xl h-full flex flex-col">

            <div class="relative h-56 overflow-hidden">
              <div
                class="absolute inset-0 bg-gradient-to-t from-[#160b25] via-transparent to-transparent z-10 opacity-90">
              </div>
              <img src="{{ asset('images/proyecto1.png') }}" alt="WebinizaDev"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />

              <div
                class="absolute top-4 left-4 z-20 bg-black/60 backdrop-blur-md border border-white/10 px-3 py-1 rounded-lg text-xs font-bold text-white flex items-center gap-2">
                <i class="fas fa-robot text-[#ff0056]"></i> IA Integrada
              </div>
            </div>

            <div class="relative p-6 -mt-6 z-20 flex-grow flex flex-col">
              <h3 class="text-2xl font-bold text-white mb-2 group-hover:text-[#ff0056] transition-colors">WebinizaDev
                (Oficial)</h3>
              <p class="text-gray-400 text-sm mb-6 leading-relaxed flex-grow">
                Nuestra plataforma con Agente de IA capaz de cotizar y capturar leads en tiempo real.
              </p>

              <div class="flex flex-wrap gap-2 mb-6">
                <span class="badge-tech">Laravel 11</span>
                <span class="badge-tech">OpenAI</span>
                <span class="badge-tech">Tailwind</span>
              </div>

              <div class="grid grid-cols-2 gap-3 mt-auto">
                <button onclick="openVideoModal('{{ asset('videos/demo-webiniza.mp4') }}')"
                  class="flex items-center justify-center gap-2 py-3 rounded-lg bg-[#ff0056] hover:bg-[#c00040] text-white font-bold text-sm transition-all shadow-lg hover:shadow-[#ff0056]/40">
                  <i class="fas fa-play"></i> Ver Demo
                </button>
                <a href="https://webinizadev.com" target="_blank"
                  class="flex items-center justify-center gap-2 py-3 rounded-lg border border-white/10 hover:bg-white/5 text-white font-semibold text-sm transition-all">
                  Visitar <i class="fas fa-external-link-alt text-xs"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="swiper-slide">
          <div
            class="group relative rounded-2xl overflow-hidden bg-[#160b25] border border-white/5 hover:border-purple-500/50 transition-all duration-500 hover:-translate-y-2 shadow-2xl h-full flex flex-col">

            <div class="relative h-56 overflow-hidden">
              <div
                class="absolute inset-0 bg-gradient-to-t from-[#160b25] via-transparent to-transparent z-10 opacity-90">
              </div>
              <img src="{{ asset('images/SDT_Audio.png') }}" alt="SDT"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
              <div
                class="absolute top-4 left-4 z-20 bg-black/60 backdrop-blur-md border border-white/10 px-3 py-1 rounded-lg text-xs font-bold text-white flex items-center gap-2">
                <i class="fas fa-comment-dots text-purple-400"></i> Chatbot Ventas
              </div>
            </div>

            <div class="relative p-6 -mt-6 z-20 flex-grow flex flex-col">
              <h3 class="text-2xl font-bold text-white mb-2 group-hover:text-purple-400 transition-colors">SDT Audio
                Visual</h3>
              <p class="text-gray-400 text-sm mb-6 leading-relaxed flex-grow">
                Gestión integral para productora audiovisual. Cotizador automático y Chatbot 24/7.
              </p>

              <div class="flex flex-wrap gap-2 mb-6">
                <span class="badge-tech">Chatbot</span>
                <span class="badge-tech">Dashboard</span>
                <span class="badge-tech">MySQL</span>
              </div>

              <div class="grid grid-cols-2 gap-3 mt-auto">
                <button onclick="openVideoModal('{{ asset('videos/demo-sdt.mp4') }}')"
                  class="flex items-center justify-center gap-2 py-3 rounded-lg bg-[#ff0056] hover:bg-[#c00040] text-white font-bold text-sm transition-all shadow-lg hover:shadow-[#ff0056]/40">
                  <i class="fas fa-play"></i> Ver Demo
                </button>
                <a href="https://sdtaudiovisual.com" target="_blank"
                  class="flex items-center justify-center gap-2 py-3 rounded-lg border border-white/10 hover:bg-white/5 text-white font-semibold text-sm transition-all">
                  Visitar <i class="fas fa-external-link-alt text-xs"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="swiper-slide">
          <div
            class="group relative rounded-2xl overflow-hidden bg-[#160b25] border border-white/5 hover:border-blue-500/50 transition-all duration-500 hover:-translate-y-2 shadow-2xl h-full flex flex-col">

            <div class="relative h-56 overflow-hidden">
              <div
                class="absolute inset-0 bg-gradient-to-t from-[#160b25] via-transparent to-transparent z-10 opacity-90">
              </div>
              <img src="{{ asset('images/medic.png') }}" alt="Medical"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
              <div
                class="absolute top-4 left-4 z-20 bg-yellow-500 text-black px-3 py-1 rounded-lg text-xs font-bold flex items-center gap-2 shadow-lg">
                <i class="fas fa-tools"></i> En Desarrollo
              </div>
            </div>

            <div class="relative p-6 -mt-6 z-20 flex-grow flex flex-col">
              <h3 class="text-2xl font-bold text-white mb-2 group-hover:text-blue-400 transition-colors">Clínica Digital
                SaaS</h3>
              <p class="text-gray-400 text-sm mb-6 leading-relaxed flex-grow">
                Sistema de turnos online, historia clínica y recordatorios automáticos por WhatsApp.
              </p>

              <div class="flex flex-wrap gap-2 mb-6">
                <span class="badge-tech">SaaS</span>
                <span class="badge-tech">WhatsApp API</span>
                <span class="badge-tech">PHP</span>
              </div>

              <div class="mt-auto">
                <button disabled
                  class="w-full py-3 rounded-lg border border-white/5 bg-white/5 text-white/40 font-semibold text-sm cursor-not-allowed">
                  Próximamente
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="swiper-slide">
          <div
            class="group relative rounded-2xl overflow-hidden bg-[#160b25] border border-white/5 hover:border-green-500/50 transition-all duration-500 hover:-translate-y-2 shadow-2xl h-full flex flex-col">

            <div class="relative h-56 overflow-hidden">
              <div
                class="absolute inset-0 bg-gradient-to-t from-[#160b25] via-transparent to-transparent z-10 opacity-90">
              </div>
              <img src="{{ asset('images/proyecto2.png') }}" alt="Ecommerce"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
              <div
                class="absolute top-4 left-4 z-20 bg-black/60 backdrop-blur-md border border-white/10 px-3 py-1 rounded-lg text-xs font-bold text-white flex items-center gap-2">
                <i class="fas fa-shopping-cart text-green-400"></i> E-commerce
              </div>
            </div>

            <div class="relative p-6 -mt-6 z-20 flex-grow flex flex-col">
              <h3 class="text-2xl font-bold text-white mb-2 group-hover:text-green-400 transition-colors">Tienda Solar
                (UV)</h3>
              <p class="text-gray-400 text-sm mb-6 leading-relaxed flex-grow">
                E-commerce de productos solares con calculadora de consumo energético integrada.
              </p>

              <div class="flex flex-wrap gap-2 mb-6">
                <span class="badge-tech">Livewire</span>
                <span class="badge-tech">Stripe</span>
                <span class="badge-tech">JS</span>
              </div>

              <div class="grid grid-cols-2 gap-3 mt-auto">
                <button onclick="openVideoModal('{{ asset('videos/demo-uv.mp4') }}')"
                  class="flex items-center justify-center gap-2 py-3 rounded-lg bg-[#ff0056] hover:bg-[#c00040] text-white font-bold text-sm transition-all shadow-lg hover:shadow-[#ff0056]/40">
                  <i class="fas fa-play"></i> Ver Demo
                </button>
                <a href="https://uvenergiasolar.com.ar" target="_blank"
                  class="flex items-center justify-center gap-2 py-3 rounded-lg border border-white/10 hover:bg-white/5 text-white font-semibold text-sm transition-all">
                  Visitar <i class="fas fa-external-link-alt text-xs"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="swiper-pagination !bottom-0"></div>
    </div>
  </div>

  <div id="videoModal"
    class="fixed inset-0 z-[100] hidden bg-black/90 backdrop-blur-xl flex items-center justify-center p-4 opacity-0 transition-opacity duration-300">
    <button onclick="closeVideoModal()"
      class="absolute top-6 right-6 text-white/50 hover:text-white transition-colors z-50">
      <i class="fas fa-times text-4xl"></i>
    </button>

    <div
      class="relative w-full max-w-5xl aspect-video rounded-2xl overflow-hidden shadow-[0_0_50px_rgba(255,0,86,0.3)] border border-white/10 bg-black">
      <video id="modalVideoPlayer" controls class="w-full h-full object-contain">
        <source src="" type="video/mp4">
        Tu navegador no soporta video.
      </video>
    </div>
  </div>

  {{-- Estilos Locales --}}
  <style>
    .badge-tech {
      @apply px-3 py-1 rounded-md bg-white/5 text-xs text-purple-300 border border-white/5;
    }

    .swiper-pagination-bullet {
      background: white;
      opacity: 0.2;
    }

    .swiper-pagination-bullet-active {
      background: #ff0056;
      opacity: 1;
    }
  </style>

  {{-- Scripts de Funcionalidad --}}
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // 1. Iniciar Swiper
      new Swiper('.projects-swiper', {
        slidesPerView: 1,
        spaceBetween: 24,
        loop: true,
        pagination: { el: '.swiper-pagination', clickable: true },
        breakpoints: {
          640: { slidesPerView: 1.2 },
          768: { slidesPerView: 2.2 },
          1024: { slidesPerView: 3.2 } // Muestra 3 y un poquito del 4to para invitar a scrollear
        }
      });
    });

    // 2. Lógica del Modal de Video
    const modal = document.getElementById('videoModal');
    const player = document.getElementById('modalVideoPlayer');

    function openVideoModal(videoUrl) {
      if (!videoUrl) return alert('Video no disponible por el momento.');

      player.src = videoUrl;
      modal.classList.remove('hidden');
      // Pequeño delay para la animación de opacidad
      setTimeout(() => modal.classList.remove('opacity-0'), 10);
      player.play();
    }

    function closeVideoModal() {
      modal.classList.add('opacity-0');
      setTimeout(() => {
        modal.classList.add('hidden');
        player.pause();
        player.src = ""; // Limpiar fuente
      }, 300);
    }

    // Cerrar con tecla ESC
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeVideoModal();
    });

    // Cerrar al hacer clic fuera del video
    modal.addEventListener('click', (e) => {
      if (e.target === modal) closeVideoModal();
    });
  </script>

</section>