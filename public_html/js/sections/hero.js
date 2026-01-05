// Animaciones y funcionalidades para la sección Hero
document.addEventListener('DOMContentLoaded', () => {
  // Animaciones para los elementos del hero
  const heroTitle = document.querySelector('#inicio h1');
  const heroSubtitle = document.querySelector('#inicio p');
  const heroButton = document.querySelector('#inicio a.btn');

  // Función para animar elementos con clase
  const animateElement = (element, className) => {
    if (element) {
      setTimeout(() => {
        element.classList.add(className);
      }, 300);
    }
  };

  // Aplicar animaciones si los elementos existen
  if (heroTitle) animateElement(heroTitle, 'animate-fade-in');
  if (heroSubtitle) animateElement(heroSubtitle, 'animate-fade-in-up');
  if (heroButton) animateElement(heroButton, 'animate-pulse-slow');
});