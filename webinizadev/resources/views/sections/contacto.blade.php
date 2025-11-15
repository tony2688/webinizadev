<section id="contacto" class="relative py-24 px-4 md:px-8 lg:px-16 bg-gradient-to-br from-[#120426] via-[#2D0A5A] to-[#E83399] text-white overflow-hidden">
    {{-- Fondos decorativos --}}
    <div class="absolute inset-0 pointer-events-none z-0">
        <div class="absolute top-20 left-1/4 w-40 h-40 rounded-full bg-gradient-to-r from-[#9900ff] to-[#ff0000] opacity-20 blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-1/4 w-56 h-56 rounded-full bg-gradient-to-r from-[#ff0000] to-[#9900ff] opacity-10 blur-2xl animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-[#310068] rounded-full blur-3xl animate-pulse opacity-10"></div>
    </div>

    {{-- Título --}}
    <div class="text-center mb-16 relative z-10" data-aos="fade-up">
        <p class="text-4xl md:text-5xl uppercase tracking-[0.25em] font-extrabold mb-6">Contacto</p>
        <h2 class="text-4xl md:text-5xl font-extrabold leading-tight">
            <span class="animated-gradient-text">¿Tenés un proyecto o consulta?</span>
        </h2>
    </div>

    {{-- Grid: Izquierda (oficina + mapa) / Derecha (form) --}}
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 items-stretch relative z-10">

        {{-- Columna izquierda: Oficina + Mapa integrado --}}
        <div class="grid md:grid-rows-[auto_1fr] gap-6 h-full min-h-0" data-aos="fade-right">
            {{-- Tarjeta: Oficina --}}
            <div class="space-y-6 bg-[#330033]/30 backdrop-blur-md border border-[#cc33ff]/30 rounded-2xl p-8 shadow-lg relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-r from-[#9900ff]/0 via-[#ff0000]/10 to-[#9900ff]/0 opacity-0 group-hover:opacity-100 blur-xl transition-opacity duration-700 translate-x-[-100%] group-hover:translate-x-[100%] ease-in-out"></div>

                <h3 class="text-2xl font-bold bg-gradient-to-r from-[#9900ff] to-[#ff0000] bg-clip-text text-transparent">Nuestra oficina</h3>

                <p class="text-white/90">
                    Estamos ubicados en Tucumán, Argentina.<br>
                    Dirección:
                    <strong class="text-white relative inline-block after:content-[''] after:absolute after:w-0 after:h-[2px] after:bg-gradient-to-r after:from-[#9900ff] after:to-[#ff0000] after:bottom-0 after:left-0 group-hover:after:w-full after:transition-all after:duration-500">
                        Muñecas 85 – San Miguel de Tucumán
                    </strong>
                </p>

                <div class="flex items-center gap-3 text-white group/item hover:text-[#cc33ff] transition-colors duration-300">
                    <i class="fas fa-envelope bg-[#ff0000]/20 p-3 rounded-full group-hover/item:bg-[#ff0000]/40 transition-all duration-300"></i>
                    <a href="mailto:info@webinizadev.com" class="hover:underline">info@webinizadev.com</a>
                </div>

                <div class="flex items-center gap-3 text-white group/item hover:text-[#cc33ff] transition-colors duration-300">
                    <i class="fab fa-whatsapp bg-[#cc33ff]/20 p-3 rounded-full group-hover/item:bg-[#cc33ff]/40 transition-all duration-300"></i>
                    <a href="https://wa.me/543815555648" target="_blank" rel="noopener" class="hover:underline">+54 9 381 555 5648</a>
                </div>

                <h3 class="text-xl font-bold bg-gradient-to-r from-[#9900ff] to-[#cc33ff] bg-clip-text text-transparent mt-6">Síguenos</h3>
                <div class="flex items-center gap-6 pt-2">
                    <a href="https://www.facebook.com/profile.php?id=61575826704205" target="_blank" rel="noopener" aria-label="Facebook" class="text-white hover:text-[#cc33ff] text-xl hover:scale-110 transition-all">
                        <i class="fab fa-facebook bg-[#cc33ff]/10 p-3 rounded-full"></i>
                    </a>
                    <a href="https://www.instagram.com/personatony/" target="_blank" rel="noopener" aria-label="Instagram" class="text-white hover:text-[#cc33ff] text-xl hover:scale-110 transition-all">
                        <i class="fab fa-instagram bg-[#cc33ff]/10 p-3 rounded-full"></i>
                    </a>
                    <a href="https://www.linkedin.com/in/antonio-orlando-romero-7158b414b/" target="_blank" rel="noopener" aria-label="LinkedIn" class="text-white hover:text-[#cc33ff] text-xl hover:scale-110 transition-all">
                        <i class="fab fa-linkedin bg-[#cc33ff]/10 p-3 rounded-full"></i>
                    </a>
                </div>
            </div>

            {{-- Tarjeta: Mapa (integrado debajo de “Nuestra oficina”) --}}
            <div class="relative group h-[240px] md:h-full min-h-0">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-[#9900ff] to-[#cc33ff] rounded-xl opacity-75 blur-sm group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative rounded-xl overflow-hidden shadow-2xl border border-[#cc33ff]/30 h-full">
                    <div class="absolute inset-0 bg-gradient-to-br from-[#9900ff]/10 to-transparent z-10 pointer-events-none"></div>
                    <iframe
                        title="Mapa - Muñecas 85, San Miguel de Tucumán"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4264.972745380555!2d-65.20844782388826!3d-26.8296110766968!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94225c110390b12d%3A0xd3a99d76a6e1aa89!2sIldefonso%20de%20las%20Mu%C3%B1ecas%2085%2C%20T4000%20San%20Miguel%20de%20Tucum%C3%A1n%2C%20Tucum%C3%A1n!5e1!3m2!1ses!2sar!4v1745424323765!5m2!1ses!2sar"
                        class="w-full h-full"
                        style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

        </div>

        {{-- Columna derecha: formulario --}}
        <div class="bg-[#330033]/30 p-6 md:p-10 rounded-xl shadow-xl backdrop-blur-md border border-[#cc33ff]/30 relative overflow-hidden group" data-aos="fade-left">
            <div class="absolute inset-0 bg-gradient-to-r from-[#9900ff]/0 via-[#ff0000]/10 to-[#9900ff]/0 opacity-0 group-hover:opacity-100 blur-xl transition-opacity duration-700 translate-x-[-100%] group-hover:translate-x-[100%] ease-in-out"></div>

            <form action="{{ route('contacto.enviar') }}" method="POST" class="space-y-6 relative group" novalidate>
                @csrf

                {{-- fila 1 --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="fl-wrap">
                        <i class="fa-regular fa-user fl-ic"></i>
                        <input id="nombre" name="nombre" type="text" autocomplete="name" required placeholder=" "
                            class="fl-in w-full bg-[#330033]/50 border-0 border-b-2 border-[#cc33ff]/30 focus:border-[#cc33ff] rounded-t-lg rounded-b-none px-4 py-3 text-white focus:outline-none">
                        <label for="nombre" class="fl-lb">Nombre</label>
                    </div>
                    <div class="fl-wrap">
                        <i class="fa-regular fa-building fl-ic"></i>
                        <input id="empresa" name="empresa" type="text" autocomplete="organization" placeholder=" "
                            class="fl-in w-full bg-[#330033]/50 border-0 border-b-2 border-[#cc33ff]/30 focus:border-[#cc33ff] rounded-t-lg rounded-b-none px-4 py-3 text-white focus:outline-none">
                        <label for="empresa" class="fl-lb">Empresa (opcional)</label>
                    </div>
                </div>

                {{-- fila 2 --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="fl-wrap">
                        <i class="fa-regular fa-envelope fl-ic"></i>
                        <input id="correo" name="correo" type="email" autocomplete="email" required placeholder=" "
                            class="fl-in w-full bg-[#330033]/50 border-0 border-b-2 border-[#cc33ff]/30 focus:border-[#cc33ff] rounded-t-lg rounded-b-none px-4 py-3 text-white focus:outline-none">
                        <label for="correo" class="fl-lb">Correo</label>
                    </div>
                    <div class="fl-wrap">
                        <i class="fa-solid fa-phone fl-ic"></i>
                        <input id="telefono" name="telefono" type="tel" inputmode="tel" pattern="^[0-9+\-\s()]{6,}$" placeholder=" "
                            class="fl-in w-full bg-[#330033]/50 border-0 border-b-2 border-[#cc33ff]/30 focus:border-[#cc33ff] rounded-t-lg rounded-b-none px-4 py-3 text-white focus:outline-none">
                        <label for="telefono" class="fl-lb">Teléfono (opcional)</label>
                    </div>
                </div>

                {{-- fila 3: selects --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="servicio" class="block text-sm text-white/70 mb-1">¿Qué necesitás?</label>
                        <select id="servicio" name="servicio" required
                            class="w-full bg-[#330033]/50 border-0 border-b-2 border-[#cc33ff]/30 focus:border-[#cc33ff] rounded-t-lg rounded-b-none px-4 py-3 text-white focus:outline-none">
                            <option value="" disabled selected>Seleccioná una opción</option>
                            <option>Sitio web / Landing</option>
                            <option>Portfolio</option>
                            <option>Página institucional</option>
                            <option>SEO / Performance</option>
                            <option>E-commerce</option>
                            <option>Dashboard / Backoffice</option>
                            <option>Asesoría / Otro</option>
                        </select>
                    </div>

                    <div>
                        <label for="presupuesto" class="block text-sm text-white/70 mb-1">Presupuesto estimado</label>
                        <select id="presupuesto" name="presupuesto"
                            class="w-full bg-[#330033]/50 border-0 border-b-2 border-[#cc33ff]/30 focus:border-[#cc33ff] rounded-t-lg rounded-b-none px-4 py-3 text-white focus:outline-none">
                            <option value="" selected>Lo vemos juntos</option>
                            <option>Hasta USD 400</option>
                            <option>USD 400 – 800</option>
                            <option>USD 800 – 1.500</option>
                            <option>USD 1.500 – 3.000</option>
                            <option>+ USD 3.000</option>
                        </select>
                    </div>
                </div>

                {{-- Pack IA --}}
                <label class="flex items-center gap-3 text-white/90">
                    <input type="checkbox" name="pack_ia" class="h-4 w-4 rounded border-[#cc33ff]/40 text-[#cc33ff] focus:ring-[#cc33ff]/30">
                    <span>Quiero sumar el <strong>Pack IA & Automatización</strong></span>
                </label>

                {{-- Asunto --}}
                <div class="fl-wrap">
                    <i class="fa-regular fa-pen-to-square fl-ic"></i>
                    <input id="asunto" name="asunto" type="text" required placeholder=" "
                        class="fl-in w-full bg-[#330033]/50 border-0 border-b-2 border-[#cc33ff]/30 focus:border-[#cc33ff] rounded-t-lg rounded-b-none px-4 py-3 text-white focus:outline-none">
                    <label for="asunto" class="fl-lb">Asunto</label>
                </div>

                {{-- Mensaje + contador --}}
                <div class="relative">
                    <label for="mensaje" class="block text-sm text-white/70 mb-1">Contanos brevemente tu proyecto (máx. 1200 caracteres)</label>
                    <textarea id="mensaje" name="mensaje" maxlength="1200" required
                        class="w-full bg-[#330033]/50 border-0 border-b-2 border-[#cc33ff]/30 focus:border-[#cc33ff] rounded-t-lg rounded-b-none px-4 py-3 text-white focus:outline-none min-h-[140px] placeholder-white/50"
                        placeholder="Objetivo, plazos, referencias…"></textarea>
                    <div class="mt-1 text-right text-xs text-white/60">
                        <span id="charLeft">1200</span> caracteres disponibles
                    </div>
                </div>

                {{-- Honeypot anti-spam (oculto) --}}
                <div class="sr-only" aria-hidden="true">
                    <label>Dejar en blanco</label>
                    <input type="text" name="company_website" tabindex="-1" autocomplete="off">
                </div>

                {{-- Estado --}}
                <p id="form-status" class="text-sm text-white/80" aria-live="polite"></p>

                {{-- Botón enviar con spinner --}}
                <button id="submitBtn" type="submit"
                    class="w-full md:w-auto px-8 py-4 text-white font-bold bg-gradient-to-r from-[#ff0000] to-[#9900ff] hover:scale-105 transition-all duration-300 hover:shadow-[0_0_20px_rgba(255,0,0,0.7)] relative overflow-hidden flex items-center justify-center rounded-lg">
                    <span class="btn__spinner" aria-hidden="true"></span>
                    <span>Enviar</span>
                </button>
            </form>
        </div>
    </div>

    {{-- Estilos puntuales (labels flotantes + spinner) --}}
    <style>
        .fl-wrap {
            position: relative
        }

        .fl-in {
            padding-left: 2.25rem
        }

        .fl-ic {
            position: absolute;
            left: .75rem;
            top: 50%;
            transform: translateY(-50%);
            opacity: .6
        }

        .fl-lb {
            position: absolute;
            left: 2.25rem;
            top: .9rem;
            font-size: .875rem;
            color: rgba(255, 255, 255, .55);
            transition: all .15s ease;
            pointer-events: none
        }

        .fl-in:focus+.fl-lb,
        .fl-in:not(:placeholder-shown)+.fl-lb {
            top: -.55rem;
            font-size: .7rem;
            color: #cc33ff;
            background: linear-gradient(to right, rgba(18, 4, 38, .8), rgba(45, 10, 90, .6));
            padding: 0 .35rem;
            border-radius: .35rem
        }

        .fl-in:focus {
            box-shadow: 0 0 0 3px rgba(204, 51, 255, .25)
        }

        .btn--loading {
            pointer-events: none;
            opacity: .9
        }

        .btn--loading .btn__spinner {
            display: inline-block
        }

        .btn__spinner {
            display: none;
            width: 1rem;
            height: 1rem;
            border: .15rem solid rgba(255, 255, 255, .5);
            border-right-color: transparent;
            border-radius: 50%;
            animation: spin .8s linear infinite;
            margin-right: .5rem
        }

        @keyframes spin {
            to {
                transform: rotate(360deg)
            }
        }
    </style>

    {{-- JS del formulario (contador + spinner) --}}
    <script>
        (function() {
            const ta = document.getElementById('mensaje');
            const left = document.getElementById('charLeft');
            const btn = document.getElementById('submitBtn');
            const status = document.getElementById('form-status');

            if (ta && left) {
                const update = () => left.textContent = (ta.maxLength - ta.value.length);
                ta.addEventListener('input', update);
                update();
            }

            if (btn) {
                const form = btn.closest('form');
                form.addEventListener('submit', () => {
                    btn.classList.add('btn--loading');
                    status.textContent = 'Enviando…';
                });
            }
        })();
    </script>
</section>