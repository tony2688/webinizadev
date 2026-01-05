<section id="nosotros" class="relative py-24 px-6 bg-[#0f0014] text-white overflow-hidden">

    {{-- Fondo Decorativo --}}
    <div class="absolute inset-0 pointer-events-none z-0">
        <div
            class="absolute top-1/2 left-0 w-[600px] h-[600px] bg-[#9900ff]/10 rounded-full blur-[120px] -translate-y-1/2">
        </div>
        <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-[#ff0056]/5 rounded-full blur-[100px]"></div>
    </div>

    <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-16 items-center relative z-10">

        {{-- COLUMNA VISUAL (Reemplazo de la ilustración) --}}
        <div class="relative" data-aos="fade-right">

            {{-- Efecto de brillo trasero --}}
            <div
                class="absolute inset-0 bg-gradient-to-br from-[#ff0056] to-[#9900ff] rounded-full blur-3xl opacity-20 animate-pulse">
            </div>

            {{-- Tarjeta Principal: "El Código" --}}
            <div
                class="relative bg-[#1a0b2e]/80 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-2xl transform rotate-[-2deg] hover:rotate-0 transition-transform duration-500">

                {{-- Header de la ventana --}}
                <div class="flex items-center gap-2 mb-6 border-b border-white/5 pb-4">
                    <div class="w-3 h-3 rounded-full bg-red-500"></div>
                    <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                    <div class="ml-auto text-xs text-white/30 font-mono">system_core.py</div>
                </div>

                {{-- Simulación de Código --}}
                <div class="space-y-3 font-mono text-sm">
                    <div class="flex gap-4">
                        <span class="text-white/20">01</span>
                        <span class="text-[#ff0056]">class</span> <span class="text-white">WebinizaDev</span>:
                    </div>
                    <div class="flex gap-4">
                        <span class="text-white/20">02</span>
                        <span class="pl-4 text-purple-400">def</span> <span
                            class="text-blue-300">optimize_business</span>(self):
                    </div>
                    <div class="flex gap-4">
                        <span class="text-white/20">03</span>
                        <span class="pl-8 text-white/60"># 7+ años de experiencia aplicada</span>
                    </div>
                    <div class="flex gap-4">
                        <span class="text-white/20">04</span>
                        <span class="pl-8 text-[#ff0056]">return</span> <span
                            class="text-green-400">"ROI_Garantizado"</span>
                    </div>
                    <div class="flex gap-4">
                        <span class="text-white/20">05</span>
                    </div>
                    <div class="flex gap-4">
                        <span class="text-white/20">06</span>
                        <span class="pl-4 text-purple-400">def</span> <span
                            class="text-blue-300">integrate_ai</span>(self, data):
                    </div>
                    <div class="flex gap-4">
                        <span class="text-white/20">07</span>
                        <span class="pl-8 text-white/60"># Automatización inteligente</span>
                    </div>
                    <div class="flex gap-4">
                        <span class="text-white/20">08</span>
                        <span class="pl-8 text-[#ff0056]">return</span> <span
                            class="text-green-400">data.process(auto=True)</span>
                    </div>
                </div>
            </div>

            {{-- Tarjeta Flotante: "Resultados" --}}
            <div
                class="absolute -bottom-6 -right-6 bg-[#0f0014]/90 backdrop-blur-md border border-[#9900ff]/50 rounded-xl p-4 shadow-[0_0_30px_rgba(153,0,255,0.3)] animate-floating-slow hidden md:block">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-lg bg-gradient-to-br from-[#9900ff] to-[#ff0056] flex items-center justify-center text-white text-xl">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div>
                        <p class="text-xs text-white/50 uppercase tracking-wider">Eficiencia</p>
                        <p class="text-xl font-bold text-white">+300%</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- COLUMNA TEXTO --}}
        <div data-aos="fade-left">
            <p class="text-lg uppercase tracking-[0.2em] font-bold mb-4 text-[#ff0056] drop-shadow-md">
                Nuestro ADN
            </p>

            <h2 class="text-4xl md:text-5xl font-extrabold mb-6 leading-tight text-white">
                Más que código, <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#ff0056] to-[#9900ff]">
                    soluciones de negocio.
                </span>
            </h2>

            <p class="text-lg text-white/70 leading-relaxed mb-6">
                No somos una agencia que solo hace "webs bonitas". Somos consultores técnicos con <strong
                    class="text-white">más de 7 años de trayectoria</strong> en soporte crítico y desarrollo de
                software.
            </p>

            <p class="text-lg text-white/70 leading-relaxed mb-8">
                Entendemos que la tecnología es una inversión, no un gasto. Por eso, combinamos <span
                    class="text-purple-300 font-semibold">Inteligencia Artificial</span> y programación sólida para
                crear sistemas que te ahorren tiempo y dinero real.
            </p>

            {{-- Botones --}}
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="#contacto"
                    class="inline-flex justify-center items-center gap-2 px-8 py-3 rounded-xl bg-gradient-to-r from-[#ff0056] to-[#c00040] text-white font-bold shadow-lg hover:shadow-[0_0_20px_rgba(255,0,86,0.4)] hover:-translate-y-1 transition-all duration-300">
                    🚀 Hablemos de tu Proyecto
                </a>
                <a href="#proyectos"
                    class="inline-flex justify-center items-center gap-2 px-8 py-3 rounded-xl border border-white/20 text-white font-semibold hover:bg-white/10 hover:-translate-y-1 transition-all duration-300">
                    Ver Qué Hacemos
                </a>
            </div>

            {{-- Stats Rápidos --}}
            <div class="mt-12 flex items-center gap-8 border-t border-white/10 pt-8">
                <div>
                    <div class="text-3xl font-bold text-white">+7</div>
                    <div class="text-xs text-white/40 uppercase tracking-wider">Años Exp.</div>
                </div>
                <div class="w-px h-10 bg-white/10"></div>
                <div>
                    <div class="text-3xl font-bold text-white">100%</div>
                    <div class="text-xs text-white/40 uppercase tracking-wider">Enfoque ROI</div>
                </div>
                <div class="w-px h-10 bg-white/10"></div>
                <div>
                    <div class="text-3xl font-bold text-white">24/7</div>
                    <div class="text-xs text-white/40 uppercase tracking-wider">Soporte IA</div>
                </div>
            </div>

        </div>
    </div>
</section>