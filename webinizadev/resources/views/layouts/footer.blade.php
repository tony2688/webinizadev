<footer class="bg-gradient-to-br from-[#120426] via-[#2D0A5A] to-[#E83399]/80 text-white pt-16 pb-8 border-t border-[#FF4FA3]/30 relative overflow-hidden w-full overflow-x-hidden">
    <!-- Elementos decorativos animados -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden -z-10">
        <div class="absolute top-10 left-10 w-32 h-32 rounded-full bg-gradient-to-r from-[#ff0000] to-[#9900ff] opacity-20 blur-3xl animate-floating-slow"></div>
        <div class="absolute bottom-20 right-10 w-48 h-48 rounded-full bg-gradient-to-r from-[#8A4FFF] to-[#E83399] opacity-15 blur-2xl animate-floating-medium"></div>
        <div class="absolute top-1/3 left-1/4 w-24 h-24 rounded-full bg-[#BEFA4F] opacity-10 blur-xl animate-floating-fast"></div>
        <div class="absolute bottom-1/4 right-1/3 w-16 h-16 rounded-full bg-[#5AA7B9] opacity-20 blur-lg animate-pulse-slow"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <!-- Logo y Descripción -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 pb-12 border-b border-white/10">
            <div class="mb-8 md:mb-0 max-w-md">
                <h3 class="text-3xl font-bold flex items-center gap-3 group transition-transform hover:scale-105 mb-4">
                    <span class="bg-gradient-to-br from-[#ff0000] to-[#9900ff] text-white px-3 py-1 rounded-lg shadow-lg font-black text-xl tracking-wide transition-all group-hover:shadow-[0_0_15px_rgba(255,0,0,0.6)]">
                        W
                    </span>
                    <span class="bg-gradient-to-r from-[#ff0000] to-[#9900ff] bg-clip-text text-transparent font-extrabold tracking-tight animate-gradient-x">
                        WebinizaDev
                    </span>
                </h3>
                <p class="text-base text-white/80 leading-relaxed">
                    Creamos experiencias digitales modernas, optimizadas y enfocadas en resultados para potenciar tu marca online.
                </p>
            </div>

            <!-- Botón WhatsApp -->
            <a href="https://wa.me/543815555648" target="_blank"
                class="relative inline-flex items-center gap-3 px-6 py-3 rounded-full text-white font-bold text-lg bg-gradient-to-r from-[#ff0000] to-[#9900ff] hover:scale-105 hover:shadow-[0_0_20px_rgba(255,0,0,0.4)] transition-all duration-300 overflow-hidden">
                <span class="absolute inset-0 bg-gradient-to-r from-[#ff0000] to-[#9900ff] blur-md opacity-30"></span>
                <i class="fab fa-whatsapp text-xl relative z-10 animate-pulse"></i>
                <span class="relative z-10">¡Contáctanos ahora!</span>
            </a>
        </div>

        <!-- Grilla de links -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">
            <!-- Navegación -->
            <div>
                <h4 class="text-lg font-semibold mb-5 bg-gradient-to-r from-[#ff0000] to-[#9900ff] bg-clip-text text-transparent">Navegación</h4>
                <ul class="space-y-3">
                    @foreach(['Inicio', 'Servicios', 'Proyectos', 'Nosotros', 'Equipo', 'Contacto'] as $item)
                    <li>
                        <a href="#{{ strtolower($item) }}" class="group text-white/80 hover:text-white transition-all flex items-center gap-2">
                            <span class="bg-gradient-to-r from-[#ff0000] to-[#9900ff] bg-clip-text text-transparent opacity-0 group-hover:opacity-100 transition-opacity">›</span>
                            {{ $item }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Servicios -->
            <div>
                <h4 class="text-lg font-semibold mb-5 bg-gradient-to-r from-[#ff0000] to-[#9900ff] bg-clip-text text-transparent">Servicios</h4>
                <ul class="space-y-3">
                    @foreach(['Diseño Web', 'Frontend', 'Backend', 'SEO Marketing', 'Consultoría IA'] as $service)
                    <li>
                        <a href="#servicios" class="group text-white/80 hover:text-white transition-all flex items-center gap-2">
                            <span class="bg-gradient-to-r from-[#ff0000] to-[#9900ff] bg-clip-text text-transparent opacity-0 group-hover:opacity-100 transition-opacity">›</span>
                            {{ $service }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Contacto -->
            <div>
                <h4 class="text-lg font-semibold mb-5 bg-gradient-to-r from-[#ff0000] to-[#9900ff] bg-clip-text text-transparent">Contacto</h4>
                <ul class="space-y-4 text-sm text-white/80">
                    <li class="flex items-center gap-3">
                        <i class="fas fa-envelope"></i> info@webinizadev.com
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fab fa-whatsapp"></i> +54 381 555-5648
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fas fa-map-marker-alt"></i> Tucumán, Argentina
                    </li>
                </ul>
            </div>

            <!-- Redes Sociales -->
            <div>
                <h4 class="text-lg font-semibold mb-5 bg-gradient-to-r from-[#ff0000] to-[#9900ff] bg-clip-text text-transparent">Síguenos</h4>
                <div class="flex flex-wrap gap-4">
                    @foreach(['facebook-f', 'instagram', 'linkedin-in', 'github'] as $social)
                    <a href="#" class="group w-10 h-10 flex items-center justify-center rounded-full bg-white/10 hover:bg-gradient-to-r from-[#ff0000] to-[#9900ff] hover:scale-110 transition-all">
                        <i class="fab fa-{{ $social }}"></i>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Separador -->
        <div class="h-px w-full bg-gradient-to-r from-transparent via-white/20 to-transparent my-8"></div>

        <!-- Copyright -->
        <div class="flex flex-col md:flex-row justify-between items-center text-sm text-white/60">
            <div>&copy; {{ date('Y') }} WebinizaDev. Todos los derechos reservados.</div>
            <div class="flex flex-col md:flex-row gap-4 items-center text-sm text-white/60">
                <button onclick="abrirModal('modal-terminos')" class="hover:text-white hover:underline transition-colors duration-300">
                    Términos y Condiciones
                </button>
                <button onclick="abrirModal('modal-privacidad')" class="hover:text-white hover:underline transition-colors duration-300">
                    Política de Privacidad
                </button>
            </div>
        </div>
    </div>
</footer>