// JavaScript para la sección de planes mejorada
document.addEventListener("DOMContentLoaded", function () {
  // === helper: obtiene la instancia del Swiper de planes ===
  function getPlansSwiper() {
    const el = document.querySelector(".plans-swiper");
    // Swiper expone la instancia en el elemento
    return el && el.swiper ? el.swiper : null;
  }

  // Inicializar efectos de la sección de planes
  initPricingEffects();
  initPricingAnimations();
  initPricingInteractions();
  initPricingComparison();

  // Efectos principales de las tarjetas de precios
  function initPricingEffects() {
    const pricingCards = document.querySelectorAll(".pricing-card");

    pricingCards.forEach((card, index) => {
      // Efecto de entrada escalonada (si querés que empiece “oculto”, setealo por CSS)
      setTimeout(() => {
        card.style.opacity = "1";
        card.style.transform = "translateY(0)";
      }, index * 150);

      // Efectos de hover avanzados
      card.addEventListener("mouseenter", function () {
        createShimmerEffect(this);
        animatePriceNumber(this);
        createParticleEffect(this);
      });

      card.addEventListener("mouseleave", function () {
        removeParticleEffect(this);
      });
    });
  }

  // Animaciones dinámicas
  function initPricingAnimations() {
    const title = document.querySelector(".animated-gradient-text");
    if (title) animateTextWriting(title);

    const priceElements = document.querySelectorAll(
      ".pricing-card .text-4xl, .pricing-card .text-5xl"
    );

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) animateCountUp(entry.target);
        });
      },
      { threshold: 0.5 }
    );

    priceElements.forEach((el) => observer.observe(el));
  }

  // Interacciones avanzadas
  function initPricingInteractions() {
    const wrapper = document.querySelector("#estimaciones .max-w-7xl");
    const header = document.querySelector("#estimaciones .text-center");

    if (wrapper) {
      const compareButton = createCompareButton();
      wrapper.appendChild(compareButton);

      const calculator = createPriceCalculator();
      wrapper.appendChild(calculator);
    }

    if (header) {
      const filters = createPlanFilters();
      header.appendChild(filters);
    }

    addInformativeTooltips();
  }

  // Sistema de comparación de planes
  function initPricingComparison() {
    let selectedPlans = [];

    const pricingCards = document.querySelectorAll(".pricing-card");
    pricingCards.forEach((card, index) => {
      const checkbox = document.createElement("input");
      checkbox.type = "checkbox";
      checkbox.className =
        "compare-checkbox absolute top-4 left-4 w-5 h-5 rounded border-2 border-white/30 bg-transparent checked:bg-gradient-to-r checked:from-purple-500 checked:to-pink-500";
      checkbox.dataset.planIndex = index;

      checkbox.addEventListener("change", function () {
        if (this.checked) {
          selectedPlans.push(index);
          card.classList.add("selected-for-comparison");
        } else {
          selectedPlans = selectedPlans.filter((i) => i !== index);
          card.classList.remove("selected-for-comparison");
        }
        updateCompareButton(selectedPlans.length);
      });

      card.appendChild(checkbox);
    });
  }

  // Crear efecto de brillo
  function createShimmerEffect(card) {
    const shimmer = document.createElement("div");
    shimmer.className =
      "absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent transform -translate-x-full animate-shimmer pointer-events-none";
    shimmer.style.animation = "shimmer 1.5s ease-in-out";
    card.appendChild(shimmer);

    setTimeout(() => {
      shimmer.remove();
    }, 1500);
  }

  // Animar números de precio
  function animatePriceNumber(card) {
    const priceElement = card.querySelector(".text-4xl, .text-5xl");
    if (!priceElement) return;
    priceElement.style.transform = "scale(1.1) rotateY(10deg)";
    priceElement.style.textShadow = "0 0 20px rgba(204, 51, 255, 0.8)";
    setTimeout(() => {
      priceElement.style.transform = "scale(1)";
      priceElement.style.textShadow = "0 0 10px rgba(204, 51, 255, 0.5)";
    }, 300);
  }

  // Partículas
  function createParticleEffect(card) {
    const container = document.createElement("div");
    container.className =
      "particle-container absolute inset-0 pointer-events-none overflow-hidden rounded-2xl";

    for (let i = 0; i < 15; i++) {
      const p = document.createElement("div");
      p.className =
        "particle absolute w-1 h-1 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full opacity-70";
      p.style.left = Math.random() * 100 + "%";
      p.style.top = Math.random() * 100 + "%";
      p.style.animationDelay = Math.random() * 2 + "s";
      p.style.animation = "float 3s ease-in-out infinite";
      container.appendChild(p);
    }

    card.appendChild(container);
  }

  function removeParticleEffect(card) {
    const c = card.querySelector(".particle-container");
    if (c) c.remove();
  }

  // Efecto “escritura”
  function animateTextWriting(element) {
    const text = element.textContent;
    element.textContent = "";
    element.style.borderRight = "2px solid rgba(204, 51, 255, 0.8)";

    let i = 0;
    const typeWriter = setInterval(() => {
      element.textContent += text.charAt(i++);
      if (i >= text.length) {
        clearInterval(typeWriter);
        setTimeout(() => {
          element.style.borderRight = "none";
        }, 500);
      }
    }, 100);
  }

  // Contador
  function animateCountUp(element) {
    const finalNumber = parseInt(element.textContent.replace(/[^0-9]/g, ""));
    if (isNaN(finalNumber)) return;

    let current = 0;
    const inc = finalNumber / 50;
    const t = setInterval(() => {
      current += inc;
      if (current >= finalNumber) {
        current = finalNumber;
        clearInterval(t);
      }
      element.textContent = element.textContent.replace(
        /\d+/,
        Math.floor(current)
      );
    }, 30);
  }

  // Botón Comparar
  function createCompareButton() {
    const button = document.createElement("button");
    button.className =
      "compare-btn fixed bottom-8 right-8 bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-full shadow-2xl transform scale-0 transition-all duration-300 z-50";
    button.innerHTML = '🔍 Comparar Planes (<span class="count">0</span>)';
    button.style.display = "none";
    button.addEventListener("click", showComparisonModal);
    return button;
  }

  // Calculadora
  function createPriceCalculator() {
    const calculator = document.createElement("div");
    calculator.className =
      "price-calculator bg-gradient-to-r from-purple-900/20 to-pink-900/20 backdrop-blur-md border border-white/10 rounded-2xl p-6 mt-12 max-w-2xl mx-auto";
    calculator.innerHTML = `
      <h3 class="text-2xl font-bold text-center mb-6 bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">🧮 Calculadora de Precios</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-white/80 mb-2">Tipo de Proyecto:</label>
          <select class="project-type w-full bg-black/30 border border-white/20 rounded-lg px-4 py-2 text-white">
            <option value="200">Landing Page - $200</option>
            <option value="300">Portfolio - $300</option>
            <option value="350">Página Institucional - $350</option>
            <option value="400">SEO Optimizado - $400</option>
            <option value="500">E-commerce - $500</option>
            <option value="800">Dashboard - $800</option>
          </select>
        </div>
        <div>
          <label class="block text-white/80 mb-2">Funciones Extra:</label>
          <div class="space-y-2">
            <label class="flex items-center text-white/70"><input type="checkbox" class="extra-feature mr-2" data-price="100"> Blog (+$100)</label>
            <label class="flex items-center text-white/70"><input type="checkbox" class="extra-feature mr-2" data-price="150"> E-commerce (+$150)</label>
            <label class="flex items-center text-white/70"><input type="checkbox" class="extra-feature mr-2" data-price="200"> Panel Admin (+$200)</label>
          </div>
        </div>
      </div>
      <div class="mt-6 text-center">
        <div class="text-3xl font-bold bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">Total: $<span class="total-price">200</span> USD</div>
        <button class="mt-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white px-8 py-3 rounded-lg hover:shadow-lg transition-all duration-300">💬 Solicitar Cotización</button>
      </div>
    `;

    const projectType = calculator.querySelector(".project-type");
    const extraFeatures = calculator.querySelectorAll(".extra-feature");
    const totalPrice = calculator.querySelector(".total-price");

    function updateTotal() {
      let total = parseInt(projectType.value);
      extraFeatures.forEach((f) => {
        if (f.checked) total += parseInt(f.dataset.price);
      });
      totalPrice.textContent = total;
    }
    projectType.addEventListener("change", updateTotal);
    extraFeatures.forEach((f) => f.addEventListener("change", updateTotal));

    return calculator;
  }

  // Filtros
  function createPlanFilters() {
    const filters = document.createElement("div");
    filters.className = "plan-filters flex flex-wrap justify-center gap-4 mt-8";
    filters.innerHTML = `
      <button class="filter-btn active" data-filter="all">Todos los Planes</button>
      <button class="filter-btn" data-filter="basic">Básicos</button>
      <button class="filter-btn" data-filter="advanced">Avanzados</button>
      <button class="filter-btn" data-filter="premium">Premium</button>
    `;

    const style = document.createElement("style");
    style.textContent = `
      .filter-btn{padding:8px 16px;border:1px solid rgba(255,255,255,.2);background:rgba(0,0,0,.3);color:#fff;border-radius:20px;transition:all .3s;cursor:pointer}
      .filter-btn:hover,.filter-btn.active{background:linear-gradient(45deg,#9900ff,#ff0000);border-color:rgba(255,255,255,.5);transform:translateY(-2px)}
    `;
    document.head.appendChild(style);

    const buttons = filters.querySelectorAll(".filter-btn");
    buttons.forEach((btn) => {
      btn.addEventListener("click", function () {
        buttons.forEach((b) => b.classList.remove("active"));
        this.classList.add("active");
        filterPlans(this.dataset.filter);
      });
    });

    return filters;
  }

  // Filtrar planes —> ocultar/mostrar SLIDES, no solo la tarjeta
  function filterPlans(filter) {
    const slides = document.querySelectorAll(".plans-swiper .swiper-slide");

    slides.forEach((slide, index) => {
      let show = true;
      // (si tenés data-plan en cada slide, usalo aquí; mantenemos compat con índice)
      if (filter === "basic" && index > 2) show = false;
      if (filter === "advanced" && (index < 3 || index === 5)) show = false;
      if (filter === "premium" && index !== 5) show = false;

      slide.style.display = show ? "" : "none";
    });

    const swiper = getPlansSwiper();
    if (swiper) {
      swiper.update(); // recalcula anchos/posición
      swiper.slideTo(0, 0); // vuelve al inicio, sin animar
    }
  }

  // Tooltips
  function addInformativeTooltips() {
    const features = document.querySelectorAll(".pricing-card ul li");
    features.forEach((feature) => {
      feature.style.cursor = "help";
      feature.addEventListener("mouseenter", () => {
        showTooltip(feature, getFeatureDescription(feature.textContent));
      });
      feature.addEventListener("mouseleave", hideTooltip);
    });
  }

  function getFeatureDescription(feature) {
    const descriptions = {
      "Diseño responsive premium":
        "Adaptación perfecta a todos los dispositivos y tamaños de pantalla",
      "Formulario de contacto avanzado":
        "Formularios con validación, captcha y notificaciones automáticas",
      "Optimización SEO básica":
        "Meta tags, estructura de datos y optimización para buscadores",
      "Integración con Google Analytics":
        "Seguimiento completo de visitantes y conversiones",
      "Galería de proyectos interactiva":
        "Showcase dinámico con filtros y efectos visuales",
      "Secciones personalizables":
        "Contenido adaptable según tus necesidades específicas",
      "Carrito de compras avanzado":
        "Sistema completo de e-commerce con múltiples opciones",
      "Pasarelas de pago múltiples":
        "Integración con PayPal, Stripe, MercadoPago y más",
      "Panel de administración":
        "Gestión completa del contenido desde un dashboard intuitivo",
      "Estadísticas en tiempo real":
        "Métricas actualizadas al instante sobre el rendimiento",
      "API REST completa":
        "Integración con sistemas externos y aplicaciones móviles",
      "Soporte técnico 24/7":
        "Asistencia técnica disponible las 24 horas del día",
    };
    return (
      descriptions[feature.trim().replace("✓ ", "")] ||
      "Característica incluida en este plan"
    );
  }

  function showTooltip(element, text) {
    const tooltip = document.createElement("div");
    tooltip.className =
      "tooltip fixed bg-black/90 text-white px-3 py-2 rounded-lg text-sm max-w-xs z-50 pointer-events-none";
    tooltip.textContent = text;
    document.body.appendChild(tooltip);

    const rect = element.getBoundingClientRect();
    tooltip.style.left = rect.left + "px";
    tooltip.style.top = rect.top - tooltip.offsetHeight - 10 + "px";
  }

  function hideTooltip() {
    const t = document.querySelector(".tooltip");
    if (t) t.remove();
  }

  function updateCompareButton(count) {
    const button = document.querySelector(".compare-btn");
    if (!button) return;
    const countSpan = button.querySelector(".count");
    countSpan.textContent = count;

    if (count > 0) {
      button.style.display = "block";
      setTimeout(() => {
        button.style.transform = "scale(1)";
      }, 10);
    } else {
      button.style.transform = "scale(0)";
      setTimeout(() => {
        button.style.display = "none";
      }, 300);
    }
  }

  function showComparisonModal() {
    const modal = document.createElement("div");
    modal.className =
      "comparison-modal fixed inset-0 bg-black/80 flex items-center justify-center z-50 p-4";
    modal.innerHTML = `
      <div class="bg-gradient-to-br from-purple-900/90 to-pink-900/90 backdrop-blur-md border border-white/20 rounded-2xl p-8 max-w-4xl w-full max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-3xl font-bold bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">📊 Comparación de Planes</h2>
          <button class="close-modal text-white/60 hover:text-white text-2xl">&times;</button>
        </div>
        <div class="comparison-content"></div>
      </div>
    `;
    document.body.appendChild(modal);
    modal
      .querySelector(".close-modal")
      .addEventListener("click", () => modal.remove());
    modal.addEventListener("click", (e) => {
      if (e.target === modal) modal.remove();
    });
  }

  // Estilos adicionales
  const additionalStyles = document.createElement("style");
  additionalStyles.textContent = `
  @keyframes float { 0%,100%{transform:translateY(0) rotate(0)} 33%{transform:translateY(-10px) rotate(120deg)} 66%{transform:translateY(5px) rotate(240deg)} }
  @keyframes shimmer { 0%{transform:translateX(-100%)} 100%{transform:translateX(100%)} }

  .selected-for-comparison {
    border-color: rgba(204,51,255,.8) !important;
    box-shadow: 0 0 30px rgba(204,51,255,.4) !important;
  }
  .compare-checkbox:checked { background: linear-gradient(45deg,#9900ff,#ff0000); }

  /* --- FIX: no elevar la card dentro del Swiper para que no se recorte el borde --- */
  .plans-swiper .pricing-card { transform: translateY(0) !important; }
  .plans-swiper .pricing-card:hover {
    transform: translateY(0) scale(1.02) !important; /* mantiene el efecto sin cortar el borde */
  }
`;
  document.head.appendChild(additionalStyles);

  console.log(
    "🚀 Sección de planes inicializada con efectos avanzados (carrusel compatible)"
  );
});
