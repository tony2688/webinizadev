<section
    class="relative min-h-screen flex items-center px-4 sm:px-6 lg:px-20 pt-24 pb-12 lg:pt-32 lg:pb-20 text-white overflow-hidden bg-transparent">

    {{-- Vignette --}}
    <div
        class="pointer-events-none absolute inset-0 z-10 bg-[radial-gradient(ellipse_at_center,rgba(0,0,0,0)_0%,rgba(0,0,0,0.4)_60%,rgba(15,0,20,1)_100%)]">
    </div>

    {{-- Contenedor Principal --}}
    <div class="max-w-7xl mx-auto z-20 relative w-full grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">

        {{-- COLUMNA IZQUIERDA (Texto y CTA) --}}
        <div class="lg:col-span-7 flex flex-col justify-center animate-fade-in-left text-center lg:text-left">

            {{-- 1. BADGE --}}
            <div class="w-full flex justify-center lg:justify-start mb-6 lg:mb-8">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/5 border border-white/10 backdrop-blur-md shadow-lg">
                    <span class="relative flex h-2.5 w-2.5">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
                    </span>
                    <span class="text-[10px] sm:text-xs font-medium tracking-wide text-white/90 uppercase">
                        IA & Automatización
                    </span>
                </div>
            </div>

            {{-- 2. TÍTULO PRINCIPAL (Ajustado Responsive) --}}
            <div>
                <h1
                    class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold leading-tight mb-4 lg:mb-6 drop-shadow-2xl tracking-tight">
                    Poné tu negocio en <br />
                    <span
                        class="bg-gradient-to-r from-[#ff0056] via-[#ff0080] to-[#9900ff] bg-clip-text text-transparent animate-gradient-x pb-1 inline-block">
                        Piloto Automático
                    </span>
                </h1>

                {{-- Descripción --}}
                <p
                    class="text-sm sm:text-base md:text-lg lg:text-xl text-gray-200 leading-relaxed max-w-xl mx-auto lg:mx-0 mb-8 lg:mb-10 font-light px-2 lg:px-0">
                    Dejá de perder horas en tareas manuales. Creamos <b class="font-bold text-white">Agentes de IA</b>
                    diseñados para vender, responder y organizar tu empresa 24/7.
                </p>

                {{-- Botones de Acción --}}
                <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4 w-full px-4 lg:px-0">
                    {{-- Botón Primario --}}
                    <a href="#contacto"
                        class="group relative inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl text-white font-bold text-sm sm:text-base bg-gradient-to-r from-[#ff0056] to-[#c00040] shadow-lg overflow-hidden border border-white/10 active:scale-95 transition-transform">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700">
                        </div>
                        <i class="fas fa-robot"></i>
                        <span>Quiero Auditoría IA</span>
                    </a>

                    {{-- Botón Secundario --}}
                    <a href="https://wa.me/5493815555648" target="_blank"
                        class="group inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl text-white font-semibold text-sm sm:text-base bg-white/5 border border-white/20 backdrop-blur-sm active:scale-95 transition-transform">
                        <i class="fab fa-whatsapp text-[#25D366] text-lg"></i>
                        <span>Hablar con Experto</span>
                    </a>
                </div>
            </div>

            {{-- 3. STACK TECNOLÓGICO --}}
            <div class="w-full flex justify-center lg:justify-start border-t border-white/10 pt-6 mt-8 lg:mt-10">
                <div
                    class="flex flex-wrap items-center justify-center lg:justify-start gap-4 sm:gap-6 opacity-70 grayscale hover:grayscale-0 transition-all duration-500">
                    <span
                        class="text-[10px] uppercase tracking-widest text-white/60 font-semibold w-full lg:w-auto text-center">Potenciado
                        por:</span>
                    <div class="flex items-center gap-5 text-xl sm:text-2xl text-white/90">
                        <i class="fab fa-laravel"></i>
                        <i class="fas fa-brain"></i>
                        <i class="fas fa-bolt"></i>
                        <i class="fab fa-python"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- COLUMNA DERECHA: Robot 3D (Oculto en móvil muy pequeño, visible en tablet/PC) --}}
        {{-- "hidden lg:flex" asegura que no ocupe espacio ni moleste en celulares --}}
        <div
            class="lg:col-span-5 relative hidden lg:flex justify-center items-center perspective-1000 animate-fade-in-right">
            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-gradient-to-tr from-[#ff0056]/20 to-[#9900ff]/20 rounded-full blur-[80px] -z-10 animate-pulse-slow">
            </div>

            <img src="{{ asset('images/robot.svg') }}" alt="Agente IA"
                class="relative z-10 w-full max-w-[450px] h-auto object-contain animate-float drop-shadow-[0_25px_50px_rgba(0,0,0,0.5)]">

            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[450px] h-[450px] border border-white/5 rounded-full animate-spin-slow -z-10">
            </div>
        </div>
    </div>

    {{-- Indicador Scroll (Solo visible si hay altura suficiente) --}}
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-30 animate-bounce hidden sm:block">
        <a href="#nosotros"
            class="flex flex-col items-center gap-2 text-white/30 hover:text-white transition-colors cursor-pointer">
            <span class="text-[10px] uppercase tracking-widest">Descubrí cómo</span>
            <i class="fa-solid fa-chevron-down text-sm"></i>
        </a>
    </div>

    <style>
        /* Animaciones (sin cambios) */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes spin-slow {
            from {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            to {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        .animate-spin-slow {
            animation: spin-slow 25s linear infinite;
        }
    </style>
</section>