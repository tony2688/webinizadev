// Layout
import './layout/header.js'
import './layout/footer.js'

// Secciones
import './sections/hero.js'
import './sections/contacto.js'
import './sections/proyectos.js'

// Utils
import './base/utils.js'

// Chat de soporte
import { initTawkTo } from './tawkChat.js'

// Inicializar el chat cuando el DOM esté cargado
document.addEventListener('DOMContentLoaded', () => {
  // Inicializar el chat de soporte
  initTawkTo();
});
