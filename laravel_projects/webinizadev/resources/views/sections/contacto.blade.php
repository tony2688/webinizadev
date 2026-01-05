<section id="contacto" class="relative py-24 px-4 md:px-8 lg:px-16 bg-[#0f0014] text-white overflow-hidden">

    {{-- Background Profundo --}}
    <div class="absolute inset-0 pointer-events-none z-0">
        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-gradient-to-t from-[#9900ff]/20 to-transparent rounded-full blur-[100px]"></div>
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-gradient-to-b from-[#ff0056]/10 to-transparent rounded-full blur-[100px]"></div>
    </div>

    {{-- Título --}}
    <div class="text-center mb-16 relative z-10" data-aos="fade-up">
        <p class="text-lg md:text-xl uppercase tracking-[0.2em] font-bold mb-4 text-[#ff0056] drop-shadow-md">
            Contacto
        </p>
        <h2 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
            <span class="text-white">¿Listo para</span>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#ff0056] to-[#9900ff]">escalar?</span>
        </h2>
        <p class="mt-4 text-white/70 max-w-2xl mx-auto text-lg leading-relaxed">
            Contanos tu desafío. Ya sea automatizar procesos, analizar datos o desarrollar software, tenemos la solución técnica.
        </p>
    </div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-start relative z-10">

        {{-- COLUMNA IZQUIERDA: Info + Mapa Dark + CTA Reunión --}}
        <div class="space-y-8" data-aos="fade-right">

            {{-- Tarjeta de Contacto Rápido --}}
            <div class="bg-[#1a0b2e]/80 backdrop-blur-md border border-white/10 rounded-2xl p-8 shadow-xl relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-r from-[#ff0056]/5 to-[#9900ff]/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                <h3 class="text-2xl font-bold text-white mb-6 flex items-center gap-2">
                    <i class="fas fa-location-dot text-[#ff0056]"></i> Nuestra Base
                </h3>

                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center text-purple-400 shrink-0">
                            <i class="fas fa-map"></i>
                        </div>
                        <div>
                            <p class="text-white font-semibold">Oficina Central</p>
                            <p class="text-white/60 text-sm">Muñecas 85, San Miguel de Tucumán</p>
                            <p class="text-white/60 text-sm">Tucumán, Argentina</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center text-green-400 shrink-0">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div>
                            <p class="text-white font-semibold">WhatsApp Directo</p>
                            <a href="https://wa.me/5493815555648" target="_blank" class="text-white/60 text-sm hover:text-green-400 transition-colors">
                                +54 9 381 555-5648
                            </a>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center text-blue-400 shrink-0">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <p class="text-white font-semibold">Email Corporativo</p>
                            <a href="mailto:info@webinizadev.com" class="text-white/60 text-sm hover:text-blue-400 transition-colors">
                                info@webinizadev.com
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Redes Sociales --}}
                <div class="mt-8 pt-6 border-t border-white/10 flex gap-4">
                    <a href="https://www.linkedin.com/in/antonio-orlando-romero-7158b414b/" target="_blank" class="w-10 h-10 rounded-full bg-white/5 hover:bg-[#0077b5] flex items-center justify-center text-white transition-all hover:-translate-y-1">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="https://www.instagram.com/personatony/" target="_blank" class="w-10 h-10 rounded-full bg-white/5 hover:bg-[#E1306C] flex items-center justify-center text-white transition-all hover:-translate-y-1">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.facebook.com/profile.php?id=61575826704205" target="_blank" class="w-10 h-10 rounded-full bg-white/5 hover:bg-[#1877F2] flex items-center justify-center text-white transition-all hover:-translate-y-1">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </div>
            </div>

            {{-- MAPA DARK MODE --}}
            <div class="rounded-2xl overflow-hidden shadow-xl border border-white/10 h-64 relative group">
                <div class="absolute inset-0 bg-[#9900ff]/10 pointer-events-none z-10 mix-blend-overlay"></div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3560.1234!2d-65.2056!3d-26.8300!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94225c0e27f91c9f%3A0x6731e808168e6467!2sMu%C3%B1ecas%2085%2C%20T4000%20San%20Miguel%20de%20Tucum%C3%A1n%2C%20Tucum%C3%A1n!5e0!3m2!1ses!2sar!4v1700000000000!5m2!1ses!2sar" width="100%" height="100%" style="border:0; filter: grayscale(100%) invert(92%) contrast(83%);" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

        {{-- COLUMNA DERECHA: Formulario Pro --}}
        <div class="bg-[#1a0b2e]/80 backdrop-blur-xl border border-white/10 p-8 md:p-10 rounded-3xl shadow-2xl relative" data-aos="fade-left">

            {{-- Badge Superior --}}
            <div class="absolute top-0 right-0 bg-[#ff0056] text-white text-[10px] font-bold px-3 py-1 rounded-bl-xl uppercase tracking-wider">
                Respuesta < 24hs 
            </div>

            <form action="{{ route('contacto.enviar') }}" method="POST" class="space-y-6" id="contactForm">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs uppercase tracking-wider text-white/50 font-bold ml-1">Tu Nombre</label>
                        <input type="text" name="nombre" required placeholder="Ej: Juan Pérez" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/20 focus:outline-none focus:border-[#ff0056] focus:bg-white/10 transition-all">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs uppercase tracking-wider text-white/50 font-bold ml-1">Empresa</label>
                        <input type="text" name="empresa" placeholder="Opcional" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/20 focus:outline-none focus:border-[#ff0056] focus:bg-white/10 transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs uppercase tracking-wider text-white/50 font-bold ml-1">Email</label>
                        <input type="email" name="correo" required placeholder="juan@empresa.com" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/20 focus:outline-none focus:border-[#ff0056] focus:bg-white/10 transition-all">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs uppercase tracking-wider text-white/50 font-bold ml-1">Teléfono</label>
                        <input type="tel" name="telefono" placeholder="+54 ..." class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/20 focus:outline-none focus:border-[#ff0056] focus:bg-white/10 transition-all">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-xs uppercase tracking-wider text-white/50 font-bold ml-1">¿Qué solución buscás?</label>
                    <div class="relative">
                        <select name="servicio" required class="w-full bg-[#0f0014] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#ff0056] appearance-none cursor-pointer">
                            <option value="" disabled selected>Seleccioná una opción...</option>
                            <option value="IA y Chatbots">🤖 Automatización con IA & Chatbots</option>
                            <option value="Analisis de Datos">📊 Análisis de Datos (Power BI)</option>
                            <option value="Desarrollo Web">🚀 Desarrollo Web / Landing Page</option>
                            <option value="Ecommerce">🛍️ E-commerce / Tienda Online</option>
                            <option value="Sistemas a Medida">⚙️ Sistemas de Gestión a Medida</option>
                            <option value="Otro">💬 Consultoría General</option>
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-white/50">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-xs uppercase tracking-wider text-white/50 font-bold ml-1">Detalles del Proyecto</label>
                    <textarea name="mensaje" rows="4" required placeholder="Contanos brevemente qué necesitás resolver..." class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/20 focus:outline-none focus:border-[#ff0056] focus:bg-white/10 transition-all resize-none"></textarea>
                </div>

                {{-- Botón Enviar --}}
                <button type="submit" id="submitBtn" class="w-full bg-gradient-to-r from-[#ff0056] to-[#c00040] text-white font-bold py-4 rounded-xl hover:shadow-[0_0_30px_rgba(255,0,86,0.4)] hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2 group">
                    <span>Enviar Consulta</span>
                    <i class="fas fa-paper-plane group-hover:translate-x-1 transition-transform"></i>
                </button>

                <p class="text-center text-xs text-white/40 mt-4">
                    Tus datos están protegidos. Respondemos en menos de 24hs hábiles.
                </p>
            </form>
        </div>

    </div>

{{-- Script Inteligente para envío AJAX --}}
<script>
    document.getElementById('contactForm').addEventListener('submit', async function (e) {
        e.preventDefault(); // 👈 ESTO EVITA QUE LA PÁGINA SE RECARGUE

        const form = this;
        const btn = document.getElementById('submitBtn');
        const span = btn.querySelector('span');
        const icon = btn.querySelector('i');
        const originalText = span.innerText;

        // 1. Estado de carga
        btn.disabled = true;
        btn.classList.add('opacity-75', 'cursor-wait');
        span.innerText = 'Enviando...';
        icon.className = 'fas fa-circle-notch fa-spin';

        try {
            // 2. Enviar datos al servidor
            const formData = new FormData(form);
            const response = await fetch("{{ route('contacto.enviar') }}", {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            });

            const data = await response.json();

            // 3. Manejar respuesta
            if (response.ok && data.status === 'ok') {
                // ÉXITO 🟢
                span.innerText = '¡Enviado!';
                icon.className = 'fas fa-check';
                btn.classList.remove('from-[#ff0056]', 'to-[#c00040]');
                btn.classList.add('bg-green-500');
                
                form.reset(); // Limpiar formulario

                // Volver a la normalidad después de 3 segundos
                setTimeout(() => {
                    btn.disabled = false;
                    btn.classList.remove('opacity-75', 'cursor-wait', 'bg-green-500');
                    btn.classList.add('from-[#ff0056]', 'to-[#c00040]');
                    span.innerText = originalText;
                    icon.className = 'fas fa-paper-plane';
                }, 3000);

            } else {
                throw new Error(data.message || 'Error de validación');
            }

        } catch (error) {
            // ERROR 🔴
            console.error(error);
            span.innerText = 'Error. Intenta por WhatsApp.';
            icon.className = 'fab fa-whatsapp';
            btn.disabled = false;
            btn.classList.remove('opacity-75', 'cursor-wait');
            
            alert('Hubo un problema: ' + error.message); // Aviso visible al usuario
        }
    });
</script>

</section>