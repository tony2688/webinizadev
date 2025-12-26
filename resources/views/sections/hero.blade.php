<section id="inicio"
    class="relative min-h-[90vh] flex items-center px-6 lg:px-20 py-20 text-white overflow-hidden bg-[#2a002a]">

    {{-- Vignette suave --}}
    <div
        class="pointer-events-none absolute inset-0 z-10 bg-[radial-gradient(ellipse_at_center,rgba(0,0,0,0)_20%,rgba(0,0,0,0.5)_70%,rgba(0,0,0,0.9)_100%)]">
    </div>

    {{-- Contenedor Principal --}}
    <div class="max-w-7xl mx-auto z-20 relative w-full grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

        {{-- COLUMNA IZQUIERDA --}}
        <div class="lg:col-span-7 flex flex-col justify-center animate-fade-in-left">

            {{-- 1. BADGE CENTRADO (Corrección solicitada) --}}
            <div class="w-full flex justify-center mb-8">
                <div
                    class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/5 border border-white/10 backdrop-blur-md">
                    <span class="relative flex h-3 w-3">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                    </span>
                    <span class="text-xs sm:text-sm font-medium tracking-wide text-white/90 uppercase">
                        IA & Automatización Activa
                    </span>
                </div>
            </div>

            {{-- Título (Mantenemos alineación izquierda para legibilidad, o centro si preferís todo centrado) --}}
            <div class="text-center lg:text-left">
                <h1
                    class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold leading-tight mb-6 drop-shadow-lg">
                    Poné tu negocio en <br />
                    <span
                        class="bg-gradient-to-r from-[#ff002e] via-[#ff0080] to-[#9900ff] bg-clip-text text-transparent">
                        Piloto Automático
                    </span>
                </h1>

                {{-- Descripción --}}
                <p
                    class="text-base sm:text-lg md:text-xl text-white/80 leading-relaxed max-w-2xl mb-10 mx-auto lg:mx-0">
                    Dejá de perder horas en tareas manuales. Creamos <b>Agentes de IA</b> como este, diseñados para
                    vender, responder y organizar tu empresa 24/7.
                </p>

                {{-- Botones (Centrados en móvil, izquierda en desktop para seguir flujo de lectura) --}}
                <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4 sm:gap-6 mb-12 w-full">
                    <a href="#contacto"
                        class="group relative inline-flex items-center justify-center gap-3 px-8 py-4 rounded-full leading-none text-white font-bold text-base sm:text-lg bg-gradient-to-r from-[#ff002e] to-[#c00040] hover:from-[#d90026] hover:to-[#a60036] transition-all duration-300 shadow-[0_0_20px_rgba(255,0,46,0.4)] hover:shadow-[0_0_30px_rgba(255,0,46,0.6)] hover:-translate-y-1 border border-white/10 overflow-hidden">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700">
                        </div>
                        <i class="fas fa-robot text-lg"></i>
                        <span>Quiero mi Auditoría de IA</span>
                    </a>
                    <a href="https://wa.me/543815555648" target="_blank"
                        class="group inline-flex items-center justify-center gap-3 px-8 py-4 rounded-full leading-none text-white font-semibold text-base sm:text-lg bg-white/5 hover:bg-white/10 border border-white/20 hover:border-white/40 transition-all duration-300 backdrop-blur-sm">
                        <i class="fab fa-whatsapp text-[#25D366] text-xl"></i>
                        <span>Hablar con un Experto</span>
                    </a>
                </div>
            </div>

            {{-- 2. STACK TECNOLÓGICO CENTRADO (Corrección solicitada) --}}
            <div class="w-full flex justify-center lg:justify-center border-t border-white/10 pt-8 mt-4">
                <div
                    class="flex flex-wrap items-center justify-center gap-6 opacity-60 hover:opacity-100 transition-all duration-500 grayscale hover:grayscale-0">
                    <span class="text-[10px] uppercase tracking-widest text-white/60">Potenciado por:</span>
                    <div class="flex items-center gap-4 text-2xl">
                        <i class="fab fa-laravel" title="Laravel"></i>
                        <i class="fas fa-brain" title="IA Generativa"></i>
                        <i class="fas fa-bolt" title="Automatización"></i>
                        <i class="fab fa-python" title="Python"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- COLUMNA DERECHA: Robot --}}
        <div class="lg:col-span-5 relative hidden lg:flex justify-center items-center perspective-1000 animate-fade-in-right"
            style="animation-delay: 0.3s;">
            <div
                class="absolute bottom-[-40px] left-1/2 -translate-x-1/2 w-[60%] h-[20%] bg-[#ff0056] blur-[50px] opacity-30 animate-pulse-slow">
            </div>

            <img src="{{ asset('images/robot.svg') }}" alt="Agente IA WebinizaDev"
                class="relative z-10 w-full max-w-[380px] h-auto object-contain animate-float drop-shadow-[0_0_30px_rgba(255,0,86,0.25)]"
                style="transform-style: preserve-3d;">

            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] border border-white/5 rounded-full animate-spin-slow -z-10">
            </div>
            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[300px] h-[300px] border border-dashed border-white/10 rounded-full -z-10">
            </div>
        </div>
    </div>

    {{-- Indicador Scroll --}}
    <a href="#servicios"
        class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-white/50 hover:text-white transition-colors duration-300 z-20">
        <span class="text-[10px] uppercase tracking-[0.2em]">Descubrí cómo</span>
        <i class="fa-solid fa-chevron-down animate-bounce text-sm"></i>
    </a>

    {{-- SCRIPTS VANTA --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.net.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            try {
                VANTA.NET({
                    el: "#inicio",
                    mouseControls: true, touchControls: true, gyroControls: false, minHeight: 200.00, minWidth: 200.00, scale: 1.00, scaleMobile: 1.00,
                    color: 0xff0056, backgroundColor: 0x2a002a, points: 14.00, maxDistance: 23.00, spacing: 18.00
                });
            } catch (e) { console.warn('Vanta JS error', e); }
        });
    </script>

    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-25px);
            }
        }

        .animate-float {
            animation: float 5s ease-in-out infinite;
        }

        @keyframes pulse-slow {

            0%,
            100% {
                opacity: 0.3;
                transform: translateX(-50%) scale(1);
            }

            50% {
                opacity: 0.15;
                transform: translateX(-50%) scale(1.1);
            }
        }

        .animate-pulse-slow {
            animation: pulse-slow 4s ease-in-out infinite;
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
            animation: spin-slow 20s linear infinite;
        }

        .perspective-1000 {
            perspective: 1000px;
        }
    </style>
</section>