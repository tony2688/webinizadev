// Footer interactivo
document.addEventListener('DOMContentLoaded', () => {
  // Animación para los enlaces del footer
  const footerLinks = document.querySelectorAll('footer a');
  
  footerLinks.forEach(link => {
    link.addEventListener('mouseenter', () => {
      // La animación ya está manejada por las clases de Tailwind
    });
  });

  // Inicializar cualquier funcionalidad adicional del footer aquí
});