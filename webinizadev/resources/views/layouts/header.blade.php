<header class="bg-gradient-to-br from-[#000000] via-[#310068] to-[#310068]/80 text-white sticky top-0 z-40 shadow-lg backdrop-blur-md border-b border-[#FF4FA3]/20 transition-all duration-300">
  {{-- Skip to content (accesibilidad) --}}
  <a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:z-[100] focus:px-3 focus:py-1.5 focus:rounded-md focus:bg-black/70">
    Saltar al contenido
  </a>

  @php
    // Base absoluta para que #anchors funcionen desde cualquier ruta
    $BASE = url('/');
    $SECCIONES = ['inicio','servicios','proyectos','nosotros','contacto'];
  @endphp

  <div class="max-w-7xl mx-auto px-3 sm:px-4 py-3 flex items-center justify-between">
    {{-- Logo --}}
    <a href="{{ $BASE }}" class="inline-flex items-center gap-2 group">
      <span class="bg-gradient-to-br from-[#ff0000] to-[#9900ff] text-white px-2.5 py-0.5 rounded-md shadow font-black text-base tracking-wide transition-transform duration-300 group-hover:scale-105">
        W
      </span>
      <span class="bg-gradient-to-r from-[#ff0000] to-[#9900ff] bg-clip-text text-transparent font-extrabold tracking-tight text-lg">
        WebinizaDev
      </span>
    </a>

    {{-- Menú Desktop --}}
    <nav class="hidden lg:flex items-center gap-4 xl:gap-5 text-[13px] font-semibold uppercase tracking-wide">
      @foreach($SECCIONES as $section)
        <a
          href="{{ $BASE.'#'.$section }}"
          class="relative px-2 py-1.5 rounded-md text-white/90 hover:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FF4FA3]/50 transition"
        >
          <span>{{ ucfirst($section) }}</span>
          <span class="pointer-events-none absolute left-2 right-2 -bottom-[3px] h-[2px] scale-x-0 origin-left rounded bg-gradient-to-r from-[#ff0000] to-[#9900ff] transition-transform duration-300 group-hover/nav:scale-x-100"></span>
        </a>
      @endforeach

      {{-- CTA compacto --}}
      <a
        href="{{ $BASE.'#contacto' }}"
        class="ml-2 inline-flex items-center gap-1.5 rounded-full bg-gradient-to-r from-[#ff0000] to-[#9900ff] px-4 py-1.5 text-[12px] font-bold shadow hover:shadow-md transition-transform hover:scale-[1.02] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FF4FA3]/50"
        aria-label="Agenda tu web"
      >
        <i class="fa-regular fa-calendar-check text-xs"></i>
        <span>¡Agenda tu web!</span>
      </a>
    </nav>

    {{-- Menú Mobile --}}
    <div class="lg:hidden">
      <details class="relative">
        <summary
          class="w-9 h-9 inline-flex items-center justify-center rounded-md border border-white/20 hover:border-transparent hover:bg-gradient-to-r hover:from-[#ff0000] hover:to-[#9900ff] transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FF4FA3]/50 cursor-pointer"
          aria-label="Abrir menú"
        >
          <i class="fas fa-bars text-sm"></i>
        </summary>

        <ul
          class="absolute right-0 mt-2 w-56 rounded-lg border border-[#FF4FA3]/20 bg-gradient-to-br from-[#000000] via-[#310068] to-[#310068]/90 shadow-[0_8px_24px_rgba(255,79,163,0.25)] backdrop-blur-md p-2 text-sm"
          role="menu"
        >
          @foreach($SECCIONES as $section)
            <li role="none">
              <a
                role="menuitem"
                href="{{ $BASE.'#'.$section }}"
                class="flex items-center gap-2 rounded-md px-3 py-2 text-white/90 hover:text-white hover:bg-white/5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FF4FA3]/50 transition"
                onclick="this.closest('details')?.removeAttribute('open')"
              >
                <span class="inline-block w-1.5 h-1.5 rounded-full bg-gradient-to-r from-[#ff0000] to-[#9900ff]"></span>
                {{ ucfirst($section) }}
              </a>
            </li>
          @endforeach

          <li class="mt-1 pt-1 border-t border-white/10" role="none">
            <a
              role="menuitem"
              href="{{ $BASE.'#contacto' }}"
              class="flex items-center justify-center gap-2 rounded-md px-3 py-2 bg-gradient-to-r from-[#ff0000] to-[#9900ff] text-[12px] font-bold shadow hover:shadow-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FF4FA3]/50 transition"
              onclick="this.closest('details')?.removeAttribute('open')"
            >
              <i class="fa-regular fa-calendar-check text-xs"></i>
              ¡Agenda tu web!
            </a>
          </li>
        </ul>
      </details>
    </div>
  </div>
</header>

{{-- Utilidades --}}
<style>
  /* Subrayado suave en desktop al hover del nav */
  @media (min-width: 1024px){
    nav:hover { --nav-hover: 1; }
    .group-hover\/nav\:scale-x-100 { transform: scaleX(var(--nav-hover,0)); }
  }
  /* Desplazamiento suave a anclas */
  html { scroll-behavior: smooth; }
</style>
