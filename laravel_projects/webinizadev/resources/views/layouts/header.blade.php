<header id="main-header" class="fixed top-0 w-full z-50 transition-all duration-300 border-b border-transparent">

  {{-- Skip to content (accesibilidad) --}}
  <a href="#main"
    class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:z-[100] focus:px-3 focus:py-1.5 focus:rounded-md focus:bg-black/70 focus:text-white">
    Saltar al contenido
  </a>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-20">

      {{-- LOGO --}}
      <a href="{{ url('/') }}" class="flex items-center gap-2 group">
        <div
          class="w-8 h-8 rounded-lg bg-gradient-to-br from-[#ff0056] to-[#9900ff] flex items-center justify-center text-white font-bold shadow-[0_0_15px_rgba(255,0,86,0.5)] group-hover:scale-110 transition-transform duration-300">
          W
        </div>
        <span class="text-xl font-bold text-white tracking-tight">
          Webiniza<span class="text-[#ff0056]">Dev</span>
        </span>
      </a>

      {{-- MENÚ DESKTOP --}}
      <nav class="hidden lg:flex items-center gap-8">
        @foreach(['Inicio', 'Servicios', 'Proyectos', 'Nosotros', 'Contacto'] as $item)
          <a href="#{{ strtolower($item) }}"
            class="text-sm font-medium text-white/80 hover:text-white relative group py-2 transition-colors">
            {{ $item }}
            {{-- Línea animada --}}
            <span
              class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#ff0056] to-[#9900ff] transition-all duration-300 group-hover:w-full"></span>
          </a>
        @endforeach

        {{-- CTA --}}
        <a href="#contacto"
          class="ml-4 inline-flex items-center gap-2 px-5 py-2 rounded-full bg-gradient-to-r from-[#ff0056] to-[#c00040] text-white text-sm font-bold shadow-[0_0_15px_rgba(255,0,86,0.4)] hover:shadow-[0_0_25px_rgba(255,0,86,0.6)] hover:-translate-y-0.5 transition-all duration-300">
          <i class="fas fa-calendar-check"></i>
          <span>Agendar Web</span>
        </a>
      </nav>

      {{-- BOTÓN HAMBURGUESA (MÓVIL) --}}
      <div class="lg:hidden flex items-center">
        <button id="mobile-menu-btn" class="text-white hover:text-[#ff0056] focus:outline-none transition-colors">
          <i class="fas fa-bars text-2xl"></i>
        </button>
      </div>
    </div>
  </div>

  {{-- MENÚ MÓVIL (Desplegable con Backdrop Blur) --}}
  <div id="mobile-menu"
    class="lg:hidden absolute top-20 left-0 w-full bg-[#0f0014]/95 backdrop-blur-xl border-t border-white/10 shadow-2xl transition-all duration-300 origin-top transform scale-y-0 opacity-0 pointer-events-none">
    <nav class="flex flex-col p-6 gap-4">
      @foreach(['Inicio', 'Servicios', 'Proyectos', 'Nosotros', 'Contacto'] as $item)
        <a href="#{{ strtolower($item) }}"
          class="mobile-link text-lg font-medium text-white/80 hover:text-[#ff0056] border-b border-white/5 pb-3 transition-colors">
          {{ $item }}
        </a>
      @endforeach
      <a href="#contacto"
        class="mt-4 w-full text-center px-5 py-3 rounded-lg bg-gradient-to-r from-[#ff0056] to-[#9900ff] text-white font-bold shadow-lg">
        ¡Agenda tu Web!
      </a>
    </nav>
  </div>
</header>

{{-- SCRIPT: Efecto Scroll + Menú Móvil --}}
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const header = document.getElementById('main-header');
    const mobileBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileIcon = mobileBtn.querySelector('i');
    const mobileLinks = document.querySelectorAll('.mobile-link');
    let isMenuOpen = false;

    // 1. Efecto Scroll (Vidrio)
    window.addEventListener('scroll', () => {
      if (window.scrollY > 20) {
        // Al bajar: Fondo oscuro + Blur + Sombra
        header.classList.add('bg-[#0f0014]/80', 'backdrop-blur-md', 'shadow-lg', 'border-white/10');
        header.classList.remove('border-transparent');
      } else {
        // Arriba: Transparente
        header.classList.remove('bg-[#0f0014]/80', 'backdrop-blur-md', 'shadow-lg', 'border-white/10');
        header.classList.add('border-transparent');
      }
    });

    // 2. Toggle Menú
    mobileBtn.addEventListener('click', () => {
      isMenuOpen = !isMenuOpen;
      if (isMenuOpen) {
        mobileMenu.classList.remove('scale-y-0', 'opacity-0', 'pointer-events-none');
        mobileIcon.classList.replace('fa-bars', 'fa-times');
      } else {
        mobileMenu.classList.add('scale-y-0', 'opacity-0', 'pointer-events-none');
        mobileIcon.classList.replace('fa-times', 'fa-bars');
      }
    });

    // 3. Cerrar al hacer click
    mobileLinks.forEach(link => {
      link.addEventListener('click', () => {
        isMenuOpen = false;
        mobileMenu.classList.add('scale-y-0', 'opacity-0', 'pointer-events-none');
        mobileIcon.classList.replace('fa-times', 'fa-bars');
      });
    });
  });
</script>