<section id="proyectos" class="py-24 bg-gradient-to-br from-[#120426] via-[#2D0A5A] to-[#E83399] text-white relative overflow-hidden">
  <!-- Background decorativo mejorado -->
  <div class="absolute inset-0 pointer-events-none overflow-hidden z-0">
    <div class="absolute top-10 left-10 w-32 h-32 rounded-full bg-gradient-to-r from-[#ff0000] to-[#9900ff] opacity-20 blur-3xl animate-floating-slow"></div>
    <div class="absolute bottom-20 right-10 w-48 h-48 rounded-full bg-gradient-to-r from-[#8A4FFF] to-[#E83399] opacity-15 blur-2xl animate-floating-medium"></div>
    <div class="absolute top-1/3 left-1/4 w-24 h-24 rounded-full bg-[#BEFA4F] opacity-10 blur-xl animate-floating-fast"></div>
    <div class="absolute bottom-1/4 right-1/3 w-16 h-16 rounded-full bg-[#5AA7B9] opacity-20 blur-lg animate-pulse-slow"></div>
  </div>

  <!-- Títulos -->
  <div class="relative z-10 text-center mb-12 max-w-4xl mx-auto px-6">
    <p class="text-4xl md:text-5xl uppercase tracking-[0.25em] text-white font-extrabold mb-6">
      Proyectos
    </p>
    <h2 class="text-4xl md:text-5xl font-extrabold leading-tight">
      <span class="animated-gradient-text">
        Experiencias que hablan por sí solas
      </span>
    </h2>
    <p class="text-white/80 text-lg mt-4">
      Soluciones digitales modernas y centradas en conversión para distintos tipos de negocio.
    </p>
  </div>

  <!-- Grid de Proyectos -->
  <div class="relative z-10 max-w-7xl mx-auto px-4 md:px-8">
    <div id="projects-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

      <!-- Proyecto 1 -->
      <div class="project-card group relative bg-gradient-to-br from-[#1a0b2e] to-[#16213e] rounded-xl p-6 shadow-2xl border border-white/10 cursor-pointer overflow-hidden transform transition-all duration-500 hover:-translate-y-3 hover:scale-105 hover:shadow-[0_0_40px_rgba(153,0,255,0.4)]"
        data-aos="fade-up" data-aos-delay="100"
        data-tech="laravel javascript"
        data-project='{"title":"Landing Page WebinizaDev","description":"Landing page institucional desarrollada con Laravel, Tailwind CSS y JavaScript. Incluye formularios de contacto, diseño responsive y optimización SEO. Sistema de gestión de contenido dinámico y integración con APIs.","image":"images/proyecto1.png","url":"https://webinizadev.com","technologies":["Laravel 13","Tailwind","JavaScript","MySQL"],"features":["Diseño Responsive","Formularios Dinámicos","SEO Optimizado","Panel Admin"],"year":"2024"}'>

        <!-- Efecto de brillo en hover -->
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>

        <!-- Imagen con overlay -->
        <div class="relative overflow-hidden rounded-lg mb-4">
          <img src="{{ asset('images/proyecto1.png') }}" alt="Landing Page WebinizaDev"
            class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110" />
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-4 group-hover:translate-x-0">
            <span class="bg-gradient-to-r from-[#ff0000] to-[#9900ff] text-white px-2 py-1 rounded-full text-xs font-semibold shadow-lg">En Vivo</span>
          </div>
        </div>

        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-[#ff0000] group-hover:to-[#9900ff] group-hover:bg-clip-text transition-all duration-300">
          Landing Page WebinizaDev
        </h3>

        <p class="text-white/80 text-sm mb-4 line-clamp-3">
          Landing page institucional desarrollada con Laravel, Tailwind CSS y JavaScript.
          Incluye formularios y diseño responsive.
        </p>

        <!-- Botones de acción -->
        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-4 group-hover:translate-y-0">
          <button class="flex-1 bg-gradient-to-r from-[#ff0000] to-[#9900ff] text-white py-2 px-4 rounded-lg text-sm font-semibold hover:shadow-lg transition-all duration-300 project-details-btn">
            Ver Detalles
          </button>
          <a href="https://webinizadev.com" target="_blank" class="bg-white/10 backdrop-blur-sm text-white py-2 px-4 rounded-lg text-sm font-semibold hover:bg-white/20 transition-all duration-300">
            <i class="fas fa-external-link-alt"></i>
          </a>
        </div>
      </div>

      <!-- Proyecto 2 -->
      <div class="project-card group relative bg-gradient-to-br from-[#1a0b2e] to-[#16213e] rounded-xl p-6 shadow-2xl border border-white/10 cursor-pointer overflow-hidden transform transition-all duration-500 hover:-translate-y-3 hover:scale-105 hover:shadow-[0_0_40px_rgba(153,0,255,0.4)]"
        data-aos="fade-up" data-aos-delay="200"
        data-tech="php javascript"
        data-project='{"title":"UV Energía Solar","description":"Plataforma institucional completa con sección de productos, calculadora solar interactiva, sistema de contacto y panel de login. Desarrollada con PHP nativo, JavaScript, CSS, Tailwind y base de datos MySQL.","image":"images/proyecto2.png","url":"https://uvenergiasolar.com.ar","technologies":["PHP","JavaScript","MySQL","Tailwind"],"features":["Calculadora Solar","Gestión Productos","Sistema Login","Panel Admin"],"year":"2024"}'>

        <!-- Efecto de brillo en hover -->
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>

        <!-- Imagen con overlay -->
        <div class="relative overflow-hidden rounded-lg mb-4">
          <img src="{{ asset('images/proyecto2.png') }}" alt="UV Energía Solar"
            class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110" />
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-4 group-hover:translate-x-0">
            <span class="bg-gradient-to-r from-[#ff0000] to-[#9900ff] text-white px-2 py-1 rounded-full text-xs font-semibold shadow-lg">En Vivo</span>
          </div>
        </div>

        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-[#ff0000] group-hover:to-[#9900ff] group-hover:bg-clip-text transition-all duration-300">
          UV Energía Solar
        </h3>

        <p class="text-white/80 text-sm mb-4 line-clamp-3">
          Plataforma institucional con sección de productos, calculadora solar, contacto y login.
          Desarrollada con PHP, JS, CSS, Tailwind y MySQL.
        </p>

        <!-- Botones de acción -->
        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-4 group-hover:translate-y-0">
          <button class="flex-1 bg-gradient-to-r from-[#ff0000] to-[#9900ff] text-white py-2 px-4 rounded-lg text-sm font-semibold hover:shadow-lg transition-all duration-300 project-details-btn">
            Ver Detalles
          </button>
          <a href="https://uvenergiasolar.com.ar" target="_blank" class="bg-white/10 backdrop-blur-sm text-white py-2 px-4 rounded-lg text-sm font-semibold hover:bg-white/20 transition-all duration-300">
            <i class="fas fa-external-link-alt"></i>
          </a>
        </div>
      </div>

      <!-- Proyecto 3 -->
      <div class="project-card group relative bg-gradient-to-br from-[#1a0b2e] to-[#16213e] rounded-xl p-6 shadow-2xl border border-white/10 cursor-pointer overflow-hidden transform transition-all duration-500 hover:-translate-y-3 hover:scale-105 hover:shadow-[0_0_40px_rgba(153,0,255,0.4)]"
        data-aos="fade-up" data-aos-delay="300"
        data-tech="laravel"
        data-project='{"title":"Tienda Web","description":"Aplicación completa de e-commerce para gestión de productos, carritos de compras, procesamiento de pagos y administración de usuarios. Sistema robusto ideal para negocios online con panel administrativo completo.","image":"images/proyecto3.png","url":"#","technologies":["Laravel 13","Livewire","MySQL","Stripe"],"features":["Carrito Compras","Pagos Online","Panel Admin","Gestión Stock"],"year":"2024"}'>

        <!-- Efecto de brillo en hover -->
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>

        <!-- Imagen con overlay -->
        <div class="relative overflow-hidden rounded-lg mb-4">
          <img src="{{ asset('images/proyecto3.png') }}" alt="Tienda Web"
            class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110" />
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-4 group-hover:translate-x-0">
            <span class="bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-semibold">En Desarrollo</span>
          </div>
        </div>

        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-[#ff0000] group-hover:to-[#9900ff] group-hover:bg-clip-text transition-all duration-300">
          Tienda Web
        </h3>

        <p class="text-white/80 text-sm mb-4 line-clamp-3">
          Aplicación de e-commerce para gestión de productos, carritos, pagos y usuarios. Ideal para negocios online.
        </p>

        <!-- Botones de acción -->
        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-4 group-hover:translate-y-0">
          <button class="flex-1 bg-gradient-to-r from-[#ff0000] to-[#9900ff] text-white py-2 px-4 rounded-lg text-sm font-semibold hover:shadow-lg transition-all duration-300 project-details-btn">
            Ver Detalles
          </button>
          <button class="bg-white/10 backdrop-blur-sm text-white py-2 px-4 rounded-lg text-sm font-semibold hover:bg-white/20 transition-all duration-300 opacity-50 cursor-not-allowed">
            <i class="fas fa-lock"></i>
          </button>
        </div>
      </div>

      <!-- Proyecto 4 -->
      <div class="project-card group relative bg-gradient-to-br from-[#1a0b2e] to-[#16213e] rounded-xl p-6 shadow-2xl border border-white/10 cursor-pointer overflow-hidden transform transition-all duration-500 hover:-translate-y-3 hover:scale-105 hover:shadow-[0_0_40px_rgba(153,0,255,0.4)]"
        data-aos="fade-up" data-aos-delay="400"
        data-tech="vue laravel"
        data-project='{"title":"Dashboard Administrativo","description":"Panel de control avanzado para visualización de métricas en tiempo real, gestión completa de usuarios, administración de tareas y generación de reportes personalizados. Ideal para sistemas internos empresariales.","image":"images/proyecto4.png","url":"#","technologies":["Vue.js","Laravel 13","Tailwind","Chart.js"],"features":["Métricas Tiempo Real","Gestión Usuarios","Reportes Custom","Multi-tenant"],"year":"2024"}'>

        <!-- Efecto de brillo en hover -->
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>

        <!-- Imagen con overlay -->
        <div class="relative overflow-hidden rounded-lg mb-4">
          <img src="{{ asset('images/proyecto4.png') }}" alt="Dashboard Administrativo"
            class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110" />
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-4 group-hover:translate-x-0">
            <span class="bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-semibold">En Desarrollo</span>
          </div>
        </div>

        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-[#ff0000] group-hover:to-[#9900ff] group-hover:bg-clip-text transition-all duration-300">
          Dashboard Administrativo
        </h3>

        <p class="text-white/80 text-sm mb-4 line-clamp-3">
          Panel de control para visualización de métricas, gestión de usuarios, tareas y reportes. Ideal para sistemas internos.
        </p>

        <!-- Botones de acción -->
        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-4 group-hover:translate-y-0">
          <button class="flex-1 bg-gradient-to-r from-[#ff0000] to-[#9900ff] text-white py-2 px-4 rounded-lg text-sm font-semibold hover:shadow-lg transition-all duration-300 project-details-btn">
            Ver Detalles
          </button>
          <button class="bg-white/10 backdrop-blur-sm text-white py-2 px-4 rounded-lg text-sm font-semibold hover:bg-white/20 transition-all duration-300 opacity-50 cursor-not-allowed">
            <i class="fas fa-lock"></i>
          </button>
        </div>
      </div>

      <!-- Proyecto 5 -->
      <div class="project-card group relative bg-gradient-to-br from-[#1a0b2e] to-[#16213e] rounded-xl p-6 shadow-2xl border border-white/10 cursor-pointer overflow-hidden transform transition-all duration-500 hover:-translate-y-3 hover:scale-105 hover:shadow-[0_0_40px_rgba(153,0,255,0.4)]"
        data-aos="fade-up" data-aos-delay="500"
        data-tech="laravel"
        data-project='{"title":"Landing Page SDT Audio Visual","description":"Sistema completo de gestión empresarial con módulos de proyectos, ventas, chatbot integrado y Dashboard Administrativo avanzado. Solución integral para empresas del sector audiovisual con automatización completa.","image":"images/SDT_Audio.png","url":"https://sdtaudiovisual.com","technologies":["Laravel 13","JavaScript","SCSS","Chatbot","MySQL"],"features":["Gestión Proyectos","Sistema Ventas","Chatbot IA","Dashboard Admin"],"year":"2024","status":"live"}'>

        <!-- Efecto de brillo en hover -->
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>

        <!-- Imagen con overlay -->
        <div class="relative overflow-hidden rounded-lg mb-4">
          <img src="{{ asset('images/SDT_Audio.png') }}" alt="Landing Page SDT Audio Visual"
            class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110" />
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-4 group-hover:translate-x-0">
            <span class="bg-gradient-to-r from-[#ff0000] to-[#9900ff] text-white px-2 py-1 rounded-full text-xs font-semibold shadow-lg">En Vivo</span>
          </div>
        </div>

        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-[#ff0000] group-hover:to-[#9900ff] group-hover:bg-clip-text transition-all duration-300">
          Landing Page SDT Audio Visual
        </h3>

        <p class="text-white/80 text-sm mb-4 line-clamp-3">
          Sistema completo de gestión empresarial con módulos de proyectos, ventas, chatbot, Dashboard Administrativo.
        </p>

        <!-- Botones de acción -->
        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-4 group-hover:translate-y-0">
          <button class="flex-1 bg-gradient-to-r from-[#ff0000] to-[#9900ff] text-white py-2 px-4 rounded-lg text-sm font-semibold hover:shadow-lg transition-all duration-300 project-details-btn">
            Ver Detalles
          </button>
          <a href="https://sdtaudiovisual.com" target="_blank" rel="noopener noreferrer"
            class="bg-white/10 backdrop-blur-sm text-white py-2 px-4 rounded-lg text-sm font-semibold hover:bg-white/20 transition-all duration-300">
            <i class="fas fa-external-link-alt"></i>
          </a>
        </div>
      </div>

      <!-- Proyecto 6 -->
      <div class="project-card group relative bg-gradient-to-br from-[#1a0b2e] to-[#16213e] rounded-xl p-6 shadow-2xl border border-white/10 cursor-pointer overflow-hidden transform transition-all duration-500 hover:-translate-y-3 hover:scale-105 hover:shadow-[0_0_40px_rgba(153,0,255,0.4)]"
        data-aos="fade-up" data-aos-delay="600"
        data-tech="laravel"
        data-project='{"title":"Landing Page + Turnos Online + Historia Clínica","description":"Aplicación médica completa con sistema de turnos online, historia clínica digital, landing page profesional y agente de IA para atención automatizada. Solución integral para centros médicos modernos.","image":"images/medic.png","url":"#","technologies":["Laravel 13","JavaScript","SCSS","Chatbot","Agente IA","MySQL"],"features":["Turnos Online","Historia Clínica","Landing Page","Agente IA"],"year":"2024"}'>

        <!-- Efecto de brillo en hover -->
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>

        <!-- Imagen con overlay -->
        <div class="relative overflow-hidden rounded-lg mb-4">
          <img src="{{ asset('images/medic.png') }}" alt="App Médica"
            class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110" />
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-4 group-hover:translate-x-0">
            <span class="bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-semibold">En Desarrollo</span>
          </div>
        </div>

        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-[#ff0000] group-hover:to-[#9900ff] group-hover:bg-clip-text transition-all duration-300">
          Landing Page + Turnos Online + Historia Clínica
        </h3>

        <p class="text-white/80 text-sm mb-4 line-clamp-3">
          Aplicación médica con turnos online, historia clínica digital y agente IA. Solución integral para centros médicos.
        </p>

        <!-- Botones de acción -->
        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-4 group-hover:translate-y-0">
          <button class="flex-1 bg-gradient-to-r from-[#ff0000] to-[#9900ff] text-white py-2 px-4 rounded-lg text-sm font-semibold hover:shadow-lg transition-all duration-300 project-details-btn">
            Ver Detalles
          </button>
          <button class="bg-white/10 backdrop-blur-sm text-white py-2 px-4 rounded-lg text-sm font-semibold hover:bg-white/20 transition-all duration-300 opacity-50 cursor-not-allowed">
            <i class="fas fa-lock"></i>
          </button>
        </div>
      </div>

    </div>
  </div>

  <!-- Modal para detalles del proyecto -->
  <div id="projectModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 opacity-0 invisible transition-all duration-300">
    <div class="flex items-center justify-center min-h-screen p-4">
      <div class="bg-gradient-to-br from-[#1a0b2e] to-[#16213e] rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto border border-white/20 shadow-2xl transform scale-95 transition-all duration-300 hover:scale-100" id="modalContent">

        <!-- Header del modal -->
        <div class="relative p-6 border-b border-white/10">
          <button id="closeModal" class="absolute top-4 right-4 text-white/60 hover:text-white transition-colors duration-200">
            <i class="fas fa-times text-xl"></i>
          </button>
          <div class="flex items-start gap-6">
            <img id="modalImage" src="" alt="" class="w-32 h-32 object-cover rounded-xl border border-white/20" />
            <div class="flex-1">
              <h2 id="modalTitle" class="text-3xl font-bold text-white mb-2"></h2>
              <div id="modalTechnologies" class="flex flex-wrap gap-2 mb-4"></div>
              <div class="flex items-center gap-4">
                <span id="modalYear" class="text-white/60 text-sm"></span>
                <span id="modalStatus" class="px-3 py-1 rounded-full text-xs font-semibold"></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Contenido del modal -->
        <div class="p-6">
          <div class="grid md:grid-cols-2 gap-8">

            <!-- Descripción -->
            <div>
              <h3 class="text-xl font-semibold text-white mb-4">Descripción del Proyecto</h3>
              <p id="modalDescription" class="text-white/80 leading-relaxed mb-6"></p>

              <h3 class="text-xl font-semibold text-white mb-4">Características Principales</h3>
              <ul id="modalFeatures" class="space-y-2"></ul>
            </div>

            <!-- Tecnologías y acciones -->
            <div>
              <h3 class="text-xl font-semibold text-white mb-4">Stack Tecnológico</h3>
              <div id="modalTechStack" class="grid grid-cols-2 gap-3 mb-8"></div>

              <!-- Botones de acción -->
              <div class="space-y-3">
                <a id="modalLiveLink" href="#" target="_blank" rel="noopener noreferrer"
                  class="w-full bg-gradient-to-r from-[#ff0000] to-[#9900ff] text-white py-3 px-6 rounded-lg font-semibold hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2">
                  <i class="fas fa-external-link-alt"></i>
                  Ver Proyecto en Vivo
                </a>
                <button class="w-full bg-white/10 backdrop-blur-sm text-white py-3 px-6 rounded-lg font-semibold hover:bg-white/20 transition-all duration-300 flex items-center justify-center gap-2">
                  <i class="fas fa-code"></i>
                  Ver Código Fuente
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>