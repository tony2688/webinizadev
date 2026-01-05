# Webinizadev Project

Este repositorio contiene el código fuente del proyecto **Webinizadev**, estructurado específicamente para un despliegue optimizado en entornos de hosting compartido (como Hostinger) y desarrollado con asistencia de Agentes de Inteligencia Artificial.

## 📂 Estructura del Proyecto

El proyecto sigue una arquitectura separada para mejorar la seguridad y la organización:

- **`laravel_projects/webinizadev/`**: Contiene el núcleo de la aplicación Laravel (backend, lógica, dependencias). Esta carpeta está diseñada para residir fuera del directorio público accesible vía web, protegiendo así el código fuente y las variables de entorno.
- **`public_html/`**: Contiene únicamente los archivos públicos necesarios para que el servidor web sirva la aplicación (index.php, imágenes, assets compilados). Este directorio actúa como el "Document Root".

Esta separación garantiza que los archivos sensibles de configuración y el código del framework no sean accesibles directamente desde el navegador.

## 🤖 Implementación de Agente IA

Este proyecto destaca por la integración de flujos de trabajo basados en **Agentes de Inteligencia Artificial** para su desarrollo y mantenimiento.

### Metodología
La implementación de "Agente IA" en este contexto refiere al uso de asistentes avanzados de codificación (como sistemas basados en LLMs) que colaboran activamente en el ciclo de vida del software:

1.  **Refactorización Estructural**: El agente se encarga de analizar y reorganizar la estructura de directorios para cumplir con estándares de seguridad (como la separación de `public_html`), sin intervención manual propensa a errores.
2.  **Gestión de Versiones**: Automatización de la configuración de Git, ignorando archivos innecesarios de forma inteligente y gestionando ramas de producción.
3.  **Preparación para Escalabilidad**: La base del código (Laravel 12) ha sido validada para soportar futuras integraciones de módulos de IA, tales como:
    - Chatbots de atención al cliente.
    - Análisis predictivo de datos.
    - Generación dinámica de contenido.

El uso de agentes permite una iteración rápida y una adherencia estricta a las mejores prácticas de seguridad y arquitectura desde el primer día.

## 🚀 Despliegue

Para desplegar cambios en producción:

1.  Asegúrese de que el contenido de `laravel_projects` esté en el nivel superior a `public_html` en su servidor.
2.  El archivo `public_html/index.php` ya está configurado para apuntar correctamente al `autoload.php` y `app.php` dentro de `../laravel_projects/webinizadev/`.

---
*Desarrollado con Laravel 12 y Potenciado por IA.*
