// public/js/tawkChat.js

export function initTawkTo() {
    if (window.Tawk_API) return; // Evitar doble carga
  
    window.Tawk_API = window.Tawk_API || {};
    window.Tawk_LoadStart = new Date();
  
    try {
        const s1 = document.createElement("script");
        s1.async = true;
        s1.src = "https://embed.tawk.to/680b1a23c5e00019080795f0/1iplls77a";
        s1.charset = "UTF-8";
        s1.setAttribute("crossorigin", "*");
      
        const s0 = document.getElementsByTagName("script")[0];
        if (s0 && s0.parentNode) {
            s0.parentNode.insertBefore(s1, s0);
            console.log('Tawk.to chat inicializado correctamente');
        } else {
            console.warn('No se pudo encontrar un elemento script para insertar Tawk.to');
            document.head.appendChild(s1);
        }
    } catch (error) {
        console.error('Error al inicializar Tawk.to:', error);
    }
}
  