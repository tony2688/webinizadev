<section id="equipo" class="relative py-24 px-6 text-white overflow-hidden bg-[#0f0014]">

    {{-- Elementos decorativos de fondo (Sutiles) --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden z-0">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-[#9900ff]/10 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-[#ff0056]/10 rounded-full blur-[120px]"></div>
    </div>

    {{-- HEADER --}}
    <div class="relative z-10 max-w-7xl mx-auto text-center mb-20" data-aos="fade-up">
        <p class="text-lg md:text-xl uppercase tracking-[0.2em] font-bold mb-4 text-[#ff0056] drop-shadow-md">
            Liderazgo Técnico
        </p>
        <h2 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-white to-white/70">
                Ingenieros de Eficiencia
            </span>
        </h2>
        <p class="text-xl text-white/60 mt-4 max-w-3xl mx-auto leading-relaxed">
            Un equipo senior enfocado en resultados. Combinamos <strong class="text-white">7+ años de
                experiencia</strong> técnica con las últimas innovaciones en Inteligencia Artificial.
        </p>
    </div>

    {{-- GRID DE EQUIPO (Diseño Tarjetas Limpias) --}}
    <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto" data-aos="fade-up"
        data-aos-delay="100">

        <div
            class="group relative rounded-2xl overflow-hidden bg-[#160b25] border border-white/5 hover:border-[#ff0056]/30 transition-all duration-500 hover:-translate-y-2">
            <div
                class="absolute inset-0 bg-gradient-to-b from-transparent to-[#ff0056]/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
            </div>

            <div class="p-8 text-center relative z-10">
                <div
                    class="relative w-32 h-32 mx-auto mb-6 rounded-full p-1 bg-gradient-to-br from-[#ff0056] to-[#9900ff]">
                    <div class="w-full h-full rounded-full overflow-hidden border-2 border-[#0f0014]">
                        <img src="{{ asset('images/equipo/fotog.jpg') }}" alt="Gabriela Bollati"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                    </div>
                </div>

                <h3 class="text-2xl font-bold text-white mb-1 group-hover:text-[#ff0056] transition-colors">Gabriela
                    Bollati</h3>
                <p class="text-sm font-semibold text-[#9900ff] uppercase tracking-wider mb-4">CTO • Backend Specialist
                </p>

                <p class="text-white/60 text-sm leading-relaxed">
                    Líder técnica experta en arquitecturas robustas. Se asegura de que tu sistema soporte miles de
                    operaciones sin fallar, priorizando la seguridad y la escalabilidad.
                </p>
            </div>
        </div>

        <div
            class="group relative rounded-2xl overflow-hidden bg-[#1a0e2e] border border-[#ff0056]/20 hover:border-[#ff0056] transition-all duration-500 hover:-translate-y-2 shadow-2xl lg:-mt-4">
            <div
                class="absolute inset-0 bg-gradient-to-b from-transparent to-[#ff0056]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
            </div>

            <div class="p-8 text-center relative z-10">
                <div
                    class="relative w-40 h-40 mx-auto mb-6 rounded-full p-1 bg-gradient-to-br from-[#ff0056] to-[#9900ff] shadow-[0_0_20px_rgba(255,0,86,0.3)]">
                    <div class="w-full h-full rounded-full overflow-hidden border-4 border-[#0f0014]">
                        <img src="{{ asset('images/equipo/fotot.jpg') }}" alt="Antonio Romero"
                            class="w-full h-full object-cover object-top transform group-hover:scale-110 transition-transform duration-700">
                    </div>
                </div>

                <h3 class="text-3xl font-bold text-white mb-1 group-hover:text-[#ff0056] transition-colors">Antonio
                    Romero</h3>
                <p class="text-sm font-semibold text-[#ff0056] uppercase tracking-wider mb-4">CEO • Director de
                    Tecnología</p>

                <p class="text-white/70 text-base leading-relaxed">
                    Arquitecto de soluciones con <b>7+ años de trayectoria</b>. Especialista en transformar procesos
                    manuales en flujos automáticos rentables con IA.
                </p>
            </div>
        </div>

        <div
            class="group relative rounded-2xl overflow-hidden bg-[#160b25] border border-white/5 hover:border-[#9900ff]/30 transition-all duration-500 hover:-translate-y-2">
            <div
                class="absolute inset-0 bg-gradient-to-b from-transparent to-[#9900ff]/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
            </div>

            <div class="p-8 text-center relative z-10">
                <div
                    class="relative w-32 h-32 mx-auto mb-6 rounded-full p-1 bg-gradient-to-br from-[#9900ff] to-[#ff0056]">
                    <div class="w-full h-full rounded-full overflow-hidden border-2 border-[#0f0014]">
                        <img src="{{ asset('images/equipo/fotom.jpg') }}" alt="Matias Giacobbe"
                            class="w-full h-full object-cover object-top transform group-hover:scale-110 transition-transform duration-700">
                    </div>
                </div>

                <h3 class="text-2xl font-bold text-white mb-1 group-hover:text-[#9900ff] transition-colors">Matias
                    Giacobbe</h3>
                <p class="text-sm font-semibold text-[#9900ff] uppercase tracking-wider mb-4">Desarrollador Full-Stack
                </p>

                <p class="text-white/60 text-sm leading-relaxed">
                    Obsesionado con la performance y la experiencia de usuario. Crea interfaces modernas que convierten
                    visitas en clientes y códigos limpios que no fallan.
                </p>
            </div>
        </div>

    </div>

    {{-- ESTADÍSTICAS (Diseño Minimalista) --}}
    <div class="relative z-10 mt-24 max-w-5xl mx-auto px-6" data-aos="fade-up" data-aos-delay="200">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 py-8 border-t border-white/10">
            <div class="text-center group">
                <div
                    class="text-4xl md:text-5xl font-black text-white mb-2 group-hover:text-[#ff0056] transition-colors">
                    15+</div>
                <div class="text-xs font-bold text-white/40 uppercase tracking-widest">Proyectos Exitosos</div>
            </div>
            <div class="text-center group">
                <div
                    class="text-4xl md:text-5xl font-black text-white mb-2 group-hover:text-[#ff0056] transition-colors">
                    7+</div>
                <div class="text-xs font-bold text-white/40 uppercase tracking-widest">Años de Trayectoria</div>
            </div>
            <div class="text-center group">
                <div
                    class="text-4xl md:text-5xl font-black text-white mb-2 group-hover:text-[#9900ff] transition-colors">
                    100%</div>
                <div class="text-xs font-bold text-white/40 uppercase tracking-widest">Compromiso ROI</div>
            </div>
            <div class="text-center group">
                <div
                    class="text-4xl md:text-5xl font-black text-white mb-2 group-hover:text-[#9900ff] transition-colors">
                    24/7</div>
                <div class="text-xs font-bold text-white/40 uppercase tracking-widest">Soporte IA</div>
            </div>
        </div>
    </div>

</section>