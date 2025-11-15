<section id="inicio" class="relative min-h-[85vh] lg:min-h-[90vh] flex items-center justify-center px-6 lg:px-20 py-16 text-white overflow-hidden">

    {{-- Vignette suave para foco --}}
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_at_center,rgba(0,0,0,0.0)_0%,rgba(0,0,0,0.25)_70%,rgba(0,0,0,0.45)_100%)]"></div>

    <div class="max-w-5xl mx-auto text-center z-10 relative">
        {{-- Subtítulo --}}
        <p class="uppercase tracking-[0.2em] text-[#ff0000] font-bold text-sm sm:text-base lg:text-lg mb-3">
            🚀 Tecnología, Diseño, Impacto
        </p>

        {{-- Chips de valor (añadido) --}}
        <div class="flex flex-wrap items-center justify-center gap-2.5 mb-6">
            <span class="px-3 py-1 rounded-full text-xs sm:text-sm bg-white/10 ring-1 ring-white/15">Sitios rápidos</span>
            <span class="px-3 py-1 rounded-full text-xs sm:text-sm bg-white/10 ring-1 ring-white/15">Optimización SEO</span>
            <span class="px-3 py-1 rounded-full text-xs sm:text-sm bg-white/10 ring-1 ring-white/15">Integración con IA</span>
        </div>

        {{-- Título --}}
        <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold leading-tight mb-6 drop-shadow-[0_3px_6px_rgba(0,0,0,0.5)]">
            Lanza tu <span class="bg-gradient-to-r from-[#ff0000] to-[#9900ff] bg-clip-text text-transparent">sitio web</span><br class="hidden md:block" />
            y hacé <span class="bg-gradient-to-r from-[#ff0000] to-[#9900ff] bg-clip-text text-transparent">despegar tu negocio</span>
        </h1>

        {{-- Descripción --}}
        <p class="text-base sm:text-lg md:text-xl text-white/80 leading-relaxed max-w-3xl mx-auto mb-8">
            Creamos sitios web modernos, responsivos y optimizados con inteligencia artificial, listos para impulsar tus ventas y posicionar tu marca en el mundo digital.
        </p>

        {{-- Botones (compactos y centrados) --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4 mb-6">
            <a href="#contacto"
                class="group relative inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl leading-none
                text-white font-semibold text-sm sm:text-base
                bg-gradient-to-r from-[#ff002e] to-[#ff4757] hover:from-[#e6002a] hover:to-[#ff3742]
                transition-all duration-300 shadow-xl hover:shadow-[0_14px_28px_rgba(255,0,46,0.35)]
                hover:-translate-y-[2px] border border-white/15 backdrop-blur-sm overflow-hidden
                w-auto min-w-[180px] sm:min-w-[200px] md:min-w-[220px]">
                <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                <i class="fas fa-paper-plane text-sm sm:text-base relative z-10"></i>
                <span class="relative z-10">Solicitá tu web ahora</span>
            </a>

            <a href="https://wa.me/543815555648" target="_blank"
                class="group relative inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl leading-none
                text-white font-semibold text-sm sm:text-base
                bg-gradient-to-r from-[#25D366] to-[#20c997] hover:from-[#22c55e] hover:to-[#1db584]
                transition-all duration-300 shadow-xl hover:shadow-[0_14px_28px_rgba(37,211,102,0.35)]
                hover:-translate-y-[2px] border border-white/15 backdrop-blur-sm overflow-hidden
                w-auto min-w-[180px] sm:min-w-[200px] md:min-w-[220px]">
                <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                <i class="fab fa-whatsapp text-sm sm:text-base relative z-10"></i>
                <span class="relative z-10">Escribinos por WhatsApp</span>
            </a>
        </div>

        {{-- Indicador de scroll (añadido) --}}
        <a href="#servicios" class="inline-flex items-center gap-2 text-white/70 hover:text-white transition">
            <span class="text-xs tracking-widest uppercase">Seguí bajando</span>
            <i class="fa-solid fa-chevron-down animate-bounce text-sm"></i>
        </a>
    </div>

    {{-- Vanta --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.fog.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            VANTA.FOG({
                el: "#inicio",
                mouseControls: true,
                touchControls: true,
                gyroControls: false,
                minHeight: 200.00,
                minWidth: 200.00,
                highlightColor: 0xff086d,
                midtoneColor: 0x4c2866,
                lowlightColor: 0xfc0522,
                baseColor: 0x4a7,
                blurFactor: 0.42,
                speed: 2.60,
                zoom: 0.40
            });
        });
    </script>
</section>