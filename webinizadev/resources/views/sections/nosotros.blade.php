<section id="nosotros" class="py-28 px-6 md:px-12 bg-gradient-to-br from-[#0f0014] via-[#2a0638] to-[#190424] text-[#ffffff] relative overflow-hidden">
    {{-- Elementos decorativos flotantes --}}
    <div class="absolute inset-0 pointer-events-none z-0">
        <div class="absolute top-16 left-8 w-44 h-44 rounded-full bg-gradient-to-r from-[#ff0000] to-[#9900ff] opacity-20 blur-3xl animate-pulse"></div>
        <div class="absolute bottom-16 right-8 w-64 h-64 rounded-full bg-gradient-to-r from-[#9900ff] to-[#ff0000] opacity-10 blur-2xl animate-pulse delay-1000"></div>
    </div>

    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-16 items-center relative z-10">

        {{-- Imagen a la izquierda --}}
        <div data-aos="fade-right" class="relative flex justify-center group">
            <div class="absolute inset-0 bg-gradient-to-br from-[#ff0000]/20 to-[#9900ff]/20 rounded-3xl blur-xl opacity-70 transform rotate-6 animate-pulse"></div>
            <img src="{{ asset('images/nosotros-ilustracion.svg') }}" alt="Nosotros WebinizaDev"
                class="w-full max-w-lg mx-auto relative z-10 drop-shadow-[0_8px_30px_rgba(153,0,255,0.3)] transition-all duration-500 hover:scale-105 hover:drop-shadow-[0_12px_40px_rgba(255,0,0,0.4)]" />
        </div>

        {{-- Texto a la derecha --}}
        <div data-aos="fade-left" class="text-center md:text-left">
            <p class="text-4xl md:text-5xl uppercase tracking-[0.25em] text-white font-extrabold mb-6">
                Sobre Nosotros
            </p>

            <h2 class="text-5xl md:text-6xl font-extrabold mb-6 leading-tight">
                <span class="animated-gradient-text">
                    Conocé nuestros proyectos
                </span>
            </h2>

            <p class="text-xl md:text-2xl text-white/90 leading-relaxed mb-10 max-w-2xl">
                Somos un equipo apasionado por <span class="bg-gradient-to-r from-[#ff0000] to-[#9900ff] bg-clip-text text-transparent font-bold">transformar ideas</span>
                en experiencias visuales que venden. Combinamos <span class="bg-gradient-to-r from-[#9900ff] to-[#ff0000] bg-clip-text text-transparent font-bold">tecnología, diseño y estrategia</span>
                para impulsar tu presencia online.
            </p>

            <div class="flex flex-col sm:flex-row justify-center md:justify-start gap-4">
                <a href="#proyectos" class="btn px-6 py-3 rounded-full bg-gradient-to-r from-[#ff0000] to-[#9900ff] text-white font-bold shadow-lg hover:shadow-[0_0_25px_rgba(153,0,255,0.3)] hover:-translate-y-1 transition-all duration-300">
                    🚀 Conocé nuestros proyectos
                </a>
                <a href="#contacto" class="btn px-6 py-3 rounded-full border border-[#9900ff] text-white hover:bg-[#9900ff] hover:text-black font-semibold hover:shadow-[0_0_15px_rgba(255,0,0,0.3)] hover:-translate-y-1 transition-all duration-300">
                    ✉️ Hablemos
                </a>
            </div>
        </div>
    </div>
</section>