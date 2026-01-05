// Funcionalidades para la sección de contacto
document.addEventListener('DOMContentLoaded', () => {
  // Formulario de contacto
  const contactForm = document.querySelector('#contacto form');
  
  if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
      // Aquí se puede agregar la lógica para manejar el envío del formulario
      // Por ahora solo prevenimos el comportamiento por defecto
      // e.preventDefault();
      
      // Animación de envío
      const submitButton = this.querySelector('button[type="submit"]');
      if (submitButton) {
        submitButton.classList.add('animate-pulse');
      }
    });
  }
  
  // Animación para los iconos de contacto
  const contactIcons = document.querySelectorAll('#contacto .contact-icon');
  contactIcons.forEach(icon => {
    icon.addEventListener('mouseenter', () => {
      icon.classList.add('animate-bounce');
      setTimeout(() => {
        icon.classList.remove('animate-bounce');
      }, 1000);
    });
  });
});