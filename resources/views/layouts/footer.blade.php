<footer class="bg-[#0f0014] text-white pt-20 pb-10 border-t border-white/10 relative overflow-hidden">

    {{-- Fondo Decorativo Sutil --}}
    <div class="absolute inset-0 pointer-events-none -z-10 overflow-hidden">
        <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-[#9900ff]/10 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-[#ff0056]/10 rounded-full blur-[120px]"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 mb-16 border-b border-white/10 pb-12">

            {{-- 1. COLUMNA MARCA (Ocupa 4 columnas) --}}
            <div class="lg:col-span-4 space-y-6">
                <a href="#" class="inline-flex items-center gap-2 group">
                    <div
                        class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#ff0056] to-[#9900ff] flex items-center justify-center text-white font-bold text-xl shadow-lg group-hover:scale-110 transition-transform">
                        W
                    </div>
                    <span
                        class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-white/70">
                        WebinizaDev
                    </span>
                </a>

                <p class="text-white/60 leading-relaxed text-sm">
                    Transformamos negocios mediante <strong>Inteligencia Artificial</strong>, Automatización de procesos
                    y Análisis de Datos. Tecnología que genera rentabilidad.
                </p>

                {{-- Redes Sociales (Tus links reales) --}}
                <div class="flex gap-4 pt-2">
                    <a href="https://www.linkedin.com/in/antonio-orlando-romero-7158b414b/" target="_blank"
                        class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-white/70 hover:bg-[#0077b5] hover:text-white transition-all hover:-translate-y-1">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="https://www.instagram.com/personatony/" target="_blank"
                        class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-white/70 hover:bg-gradient-to-br hover:from-[#833ab4] hover:via-[#fd1d1d] hover:to-[#fcb045] hover:text-white transition-all hover:-translate-y-1">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.facebook.com/profile.php?id=61575826704205" target="_blank"
                        class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-white/70 hover:bg-[#1877f2] hover:text-white transition-all hover:-translate-y-1">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </div>
            </div>

            {{-- 2. COLUMNA SERVICIOS (Ocupa 3 columnas) --}}
            <div class="lg:col-span-3">
                <h4 class="text-white font-bold mb-6 text-lg">Soluciones</h4>
                <ul class="space-y-4 text-sm text-white/60">
                    <li>
                        <a href="#planes" class="hover:text-[#ff0056] transition-colors flex items-center gap-2">
                            <i class="fas fa-robot text-xs"></i> Agentes de IA & Chatbots
                        </a>
                    </li>
                    <li>
                        <a href="#planes" class="hover:text-[#ff0056] transition-colors flex items-center gap-2">
                            <i class="fas fa-chart-pie text-xs"></i> Power BI & Datos
                        </a>
                    </li>
                    <li>
                        <a href="#planes" class="hover:text-[#ff0056] transition-colors flex items-center gap-2">
                            <i class="fas fa-bolt text-xs"></i> Automatización (n8n)
                        </a>
                    </li>
                    <li>
                        <a href="#planes" class="hover:text-[#ff0056] transition-colors flex items-center gap-2">
                            <i class="fas fa-code text-xs"></i> Desarrollo Web & SaaS
                        </a>
                    </li>
                </ul>
            </div>

            {{-- 3. COLUMNA EMPRESA (Ocupa 2 columnas) --}}
            <div class="lg:col-span-2">
                <h4 class="text-white font-bold mb-6 text-lg">Empresa</h4>
                <ul class="space-y-4 text-sm text-white/60">
                    <li><a href="#nosotros" class="hover:text-white transition-colors">Sobre Nosotros</a></li>
                    <li><a href="#equipo" class="hover:text-white transition-colors">Nuestro Equipo</a></li>
                    <li><a href="#proyectos" class="hover:text-white transition-colors">Casos de Éxito</a></li>
                    <li><a href="#contacto" class="hover:text-white transition-colors">Contacto</a></li>
                </ul>
            </div>

            {{-- 4. COLUMNA CONTACTO RÁPIDO (Ocupa 3 columnas) --}}
            <div class="lg:col-span-3">
                <h4 class="text-white font-bold mb-6 text-lg">Hablemos</h4>
                <ul class="space-y-4 text-sm text-white/60">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-map-marker-alt mt-1 text-[#ff0056]"></i>
                        <span>Muñecas 85<br>San Miguel de Tucumán, AR</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fab fa-whatsapp text-[#ff0056]"></i>
                        <a href="https://wa.me/543815555648" target="_blank" class="hover:text-white transition-colors">
                            +54 9 381 555-5648
                        </a>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fas fa-envelope text-[#ff0056]"></i>
                        <a href="mailto:info@webinizadev.com" class="hover:text-white transition-colors">
                            info@webinizadev.com
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        {{-- BARRA INFERIOR --}}
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-white/40">
            <div>
                &copy; {{ date('Y') }} WebinizaDev. Todos los derechos reservados.
            </div>
            <div class="flex gap-6">
                <button onclick="abrirModal('modal-terminos')" class="hover:text-white transition-colors">Términos y
                    Condiciones</button>
                <button onclick="abrirModal('modal-privacidad')" class="hover:text-white transition-colors">Política de
                    Privacidad</button>
            </div>
        </div>
    </div>
</footer>