document.addEventListener('DOMContentLoaded', () => {
  const toggleBtn = document.querySelector('#menu-toggle');
  const menu = document.querySelector('#mobile-menu');

  if (toggleBtn && menu) {
    // Abrir/cerrar menú al hacer clic en el botón hamburguesa
    toggleBtn.addEventListener('click', () => {
      menu.classList.toggle('open');
    });

    // Cierra el menú si se hace clic fuera
    document.addEventListener('click', (e) => {
      if (!menu.contains(e.target) && !toggleBtn.contains(e.target)) {
        menu.classList.remove('open');
      }
    });

    // Cierra el menú si se hace clic en un enlace del menú
    const links = menu.querySelectorAll('a');
    links.forEach(link => {
      link.addEventListener('click', () => {
        menu.classList.remove('open');
      });
    });
  }
});
