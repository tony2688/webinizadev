// Utilidades generales para el sitio

// Función para animar elementos al hacer scroll
document.addEventListener('DOMContentLoaded', () => {
  // Inicializar AOS (Animate On Scroll)
  if (typeof AOS !== 'undefined') {
    AOS.init({
      duration: 800,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    });
  }

  // Función para manejar el desplazamiento suave a las secciones
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      const targetId = this.getAttribute('href');
      if (targetId === '#') return;
      
      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        window.scrollTo({
          top: targetElement.offsetTop - 80, // Ajuste para el header fijo
          behavior: 'smooth'
        });
      }
    });
  });
});