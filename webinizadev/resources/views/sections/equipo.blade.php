<section id="equipo" class="relative py-28 px-6 text-[#ffffff] overflow-hidden bg-gradient-to-br from-[#120426] via-[#2D0A5A] to-[#E83399]">
    {{-- Elementos decorativos flotantes mejorados --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden z-0">
        <div class="absolute top-10 left-10 w-32 h-32 rounded-full bg-gradient-to-r from-[#ff0000] to-[#9900ff] opacity-20 blur-3xl animate-floating-slow"></div>
        <div class="absolute bottom-20 right-10 w-48 h-48 rounded-full bg-gradient-to-r from-[#9900ff] to-[#ff0000] opacity-15 blur-2xl animate-floating-medium"></div>
        <div class="absolute top-1/3 left-1/4 w-24 h-24 rounded-full bg-gradient-to-r from-[#ff0000] to-[#9900ff] opacity-10 blur-xl animate-floating-fast"></div>
        <div class="absolute bottom-1/4 right-1/3 w-16 h-16 rounded-full bg-gradient-to-r from-[#9900ff] to-[#ff0000] opacity-20 blur-lg animate-pulse-slow"></div>
        <div class="absolute top-1/2 right-1/4 w-20 h-20 rounded-full bg-gradient-to-r from-[#ff0000] to-[#9900ff] opacity-15 blur-2xl animate-floating-slow"></div>
        <div class="absolute bottom-1/3 left-1/2 w-28 h-28 rounded-full bg-gradient-to-r from-[#9900ff] to-[#ff0000] opacity-10 blur-xl animate-floating-medium"></div>
    </div>

    {{-- Título mejorado --}}
    <div class="relative z-10 max-w-7xl mx-auto text-center mb-20" data-aos="fade-up">
        <div class="inline-block mb-6">
            <span class="bg-gradient-to-r from-[#ff0000] to-[#9900ff] text-white px-6 py-2 rounded-full text-sm font-bold uppercase tracking-wider shadow-lg">
                 Nuestro Equipo
            </span>
        </div>
        <h2 class="text-5xl md:text-6xl font-extrabold leading-tight mb-6">
            <span class="animated-gradient-text">
                Las mentes creativas detrás de WebinizaDev
            </span>
        </h2>
        <p class="text-xl text-gray-300 mt-4 max-w-3xl mx-auto leading-relaxed">
            Un equipo multidisciplinario de desarrolladores apasionados por crear soluciones digitales innovadoras que transforman ideas en experiencias extraordinarias.
        </p>
    </div>

    {{-- Grid de equipo mejorado para 3 personas --}}
    <div class="relative z-10 grid gap-8 lg:gap-12 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 max-w-7xl mx-auto" data-aos="fade-up" data-aos-delay="100">

        <!-- Gabriela Bollati -->
        <div class="team-member bg-gradient-to-br from-[#330033]/50 to-[#1a0b2e]/50 backdrop-blur-md border border-[#9900ff]/30 rounded-3xl p-8 shadow-2xl hover:shadow-[0_0_40px_rgba(153,0,255,0.4)] hover:-translate-y-3 hover:scale-105 transition-all duration-700 text-center group relative overflow-hidden">
            {{-- Efecto de brillo en hover --}}
            <div class="absolute inset-0 bg-gradient-to-r from-[#ff0000]/0 via-[#9900ff]/10 to-[#ff0000]/0 opacity-0 group-hover:opacity-100 transition-opacity duration-700 rounded-3xl"></div>

            <div class="relative z-10">
                <div class="relative mx-auto w-40 h-40 mb-8 rounded-full overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-[#ff0000] to-[#9900ff] rounded-full blur-lg opacity-60 animate-pulse group-hover:opacity-80 transition-opacity duration-500"></div>
                    <img src="{{ asset('images/equipo/fotog.jpg') }}" alt="Gabriela Bollati"
                        class="relative w-full h-full object-[top_20%] object-cover rounded-full border-4 border-[#9900ff] transition-transform duration-700 ease-in-out group-hover:scale-110 group-hover:rotate-6" />
                    <div class="absolute inset-0 rounded-full bg-gradient-to-t from-[#9900ff]/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>

                <h3 class="text-3xl font-extrabold text-white mb-3 transition-all duration-500 group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-[#ff0000] group-hover:to-[#9900ff] group-hover:bg-clip-text">
                    Gabriela Bollati
                </h3>

                <div class="mb-6">
                    <p class="text-lg font-bold bg-gradient-to-r from-[#ff0000] to-[#9900ff] bg-clip-text text-transparent mb-2">
                        CTO • Backend Developer
                    </p>
                </div>

                <p class="text-base text-white/90 leading-relaxed group-hover:text-white transition-colors duration-300">
                    CTO y desarrolladora backend con 5+ años de experiencia en arquitecturas robustas y escalables, especializada en bases de datos Oracle y desarrollo empresarial.
                </p>
            </div>
        </div>

        <!-- Antonio Romero -->
        <div class="team-member bg-gradient-to-br from-[#330033]/50 to-[#1a0b2e]/50 backdrop-blur-md border border-[#ff0000]/30 rounded-3xl p-8 shadow-2xl hover:shadow-[0_0_40px_rgba(255,0,0,0.4)] hover:-translate-y-3 hover:scale-105 transition-all duration-700 text-center group relative overflow-hidden">
            {{-- Efecto de brillo en hover --}}
            <div class="absolute inset-0 bg-gradient-to-r from-[#9900ff]/0 via-[#ff0000]/10 to-[#9900ff]/0 opacity-0 group-hover:opacity-100 transition-opacity duration-700 rounded-3xl"></div>

            <div class="relative z-10">
                <div class="relative mx-auto w-40 h-40 mb-8 rounded-full overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-[#9900ff] to-[#ff0000] rounded-full blur-lg opacity-60 animate-pulse group-hover:opacity-80 transition-opacity duration-500"></div>
                    <img src="{{ asset('images/equipo/fotot.jpg') }}" alt="Antonio Romero"
                        class="relative w-full h-full object-[top_25%] object-cover rounded-full border-4 border-[#ff0000] transition-transform duration-700 ease-in-out group-hover:scale-110 group-hover:rotate-6" />
                    <div class="absolute inset-0 rounded-full bg-gradient-to-t from-[#ff0000]/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>

                <h3 class="text-3xl font-extrabold text-white mb-3 transition-all duration-500 group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-[#9900ff] group-hover:to-[#ff0000] group-hover:bg-clip-text">
                    Antonio Romero
                </h3>

                <div class="mb-6">
                    <p class="text-lg font-bold bg-gradient-to-r from-[#9900ff] to-[#ff0000] bg-clip-text text-transparent mb-2">
                        CEO • Técnico en Programación
                    </p>
                </div>

                <p class="text-base text-white/90 leading-relaxed group-hover:text-white transition-colors duration-300">
                    CEO y desarrollador con 4+ años de experiencia en desarrollo web moderno y especialización en inteligencia artificial aplicada a soluciones empresariales.
                </p>
            </div>
        </div>

        <!-- Matias Giacobbe -->
        <div class="team-member bg-gradient-to-br from-[#330033]/50 to-[#1a0b2e]/50 backdrop-blur-md border border-[#9900ff]/30 rounded-3xl p-8 shadow-2xl hover:shadow-[0_0_40px_rgba(153,0,255,0.4)] hover:-translate-y-3 hover:scale-105 transition-all duration-700 text-center group relative overflow-hidden md:col-span-2 lg:col-span-1">
            {{-- Efecto de brillo en hover --}}
            <div class="absolute inset-0 bg-gradient-to-r from-[#ff0000]/0 via-[#9900ff]/10 to-[#ff0000]/0 opacity-0 group-hover:opacity-100 transition-opacity duration-700 rounded-3xl"></div>

            <div class="relative z-10">
                <div class="relative mx-auto w-40 h-40 mb-8 rounded-full overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-[#ff0000] to-[#9900ff] rounded-full blur-lg opacity-60 animate-pulse group-hover:opacity-80 transition-opacity duration-500"></div>
                    <img src="{{ asset('images/equipo/fotom.jpg') }}" alt="Matias Giacobbe"
                        class="relative w-full h-full object-[top_20%] object-cover rounded-full border-4 border-[#9900ff] transition-transform duration-700 ease-in-out group-hover:scale-110 group-hover:rotate-6" />
                    <div class="absolute inset-0 rounded-full bg-gradient-to-t from-[#9900ff]/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>

                <h3 class="text-3xl font-extrabold text-white mb-3 transition-all duration-500 group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-[#ff0000] group-hover:to-[#9900ff] group-hover:bg-clip-text">
                    Matias Giacobbe
                </h3>

                <div class="mb-6">
                    <p class="text-lg font-bold bg-gradient-to-r from-[#ff0000] to-[#9900ff] bg-clip-text text-transparent mb-2">
                        Desarrollador Full-Stack
                    </p>
                </div>

                <p class="text-base text-white/90 leading-relaxed group-hover:text-white transition-colors duration-300">
                    Desarrollador full-stack con 3+ años de experiencia en tecnologías modernas, especializado en aplicaciones web escalables y arquitecturas de microservicios.
                </p>
            </div>
        </div>
    </div>

    {{-- Estadísticas del equipo --}}
    <div class="relative z-10 mt-20 max-w-4xl mx-auto" data-aos="fade-up" data-aos-delay="200">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div class="group">
                <div class="text-4xl font-bold bg-gradient-to-r from-[#ff0000] to-[#9900ff] bg-clip-text text-transparent mb-2 group-hover:scale-110 transition-transform duration-300">15+</div>
                <p class="text-white/80 text-sm uppercase tracking-wider">Proyectos Completados</p>
            </div>
            <div class="group">
                <div class="text-4xl font-bold bg-gradient-to-r from-[#9900ff] to-[#ff0000] bg-clip-text text-transparent mb-2 group-hover:scale-110 transition-transform duration-300">3</div>
                <p class="text-white/80 text-sm uppercase tracking-wider">Años de Experiencia</p>
            </div>
            <div class="group">
                <div class="text-4xl font-bold bg-gradient-to-r from-[#ff0000] to-[#cc33ff] bg-clip-text text-transparent mb-2 group-hover:scale-110 transition-transform duration-300">100%</div>
                <p class="text-white/80 text-sm uppercase tracking-wider">Clientes Satisfechos</p>
            </div>
            <div class="group">
                <div class="text-4xl font-bold bg-gradient-to-r from-[#cc33ff] to-[#9900ff] bg-clip-text text-transparent mb-2 group-hover:scale-110 transition-transform duration-300">24/7</div>
                <p class="text-white/80 text-sm uppercase tracking-wider">Soporte Técnico</p>
            </div>
        </div>
    </div>
</section>