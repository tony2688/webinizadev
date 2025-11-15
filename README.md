# WebinizaDev — Proyecto Laravel

Sitio institucional y asistente IA de Webiniza desarrollado con Laravel 12 (PHP 8.2), Vite 6 y Tailwind CSS 4. El código principal vive en `webinizadev/` dentro de este repositorio.

## Características
- Laravel 12, PHP 8.2 y SQLite por defecto en desarrollo.
- Frontend con Vite y Tailwind CSS 4.
- Rutas y vistas orientadas a landing institucional (`resources/views`).
- Endpoint de asistente IA con dominio temático y RAG opcional.

## Requisitos
- `PHP >= 8.2` y `Composer`.
- `Node.js >= 18` y `npm`.
- `SQLite` (desarrollo por defecto) o MySQL/PostgreSQL si se configura.

## Instalación
```bash
cd webinizadev
composer install
npm install

# Copiar variables de entorno (si no se hizo automáticamente)
copy .env.example .env   # Windows
# Establecer APP_KEY
php artisan key:generate

# Base de datos en desarrollo (SQLite)
mkdir database 2>NUL & type NUL > database\database.sqlite
php artisan migrate
```

Configurar en `.env` al menos:
```
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000
DB_CONNECTION=sqlite
```

## Desarrollo
- Todo en uno: `composer dev` (inicia servidor Laravel, cola, logs y Vite).
- Manual: `php artisan serve` y `npm run dev`.

Aplicación por defecto en `http://127.0.0.1:8000`.

## Testing
```bash
composer test
```
Ejecuta PHPUnit 11 y limpia configuración antes de testear.

## Build de producción
```bash
npm run build
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```
En producción, servir el directorio `public/` con `APP_ENV=production` y `APP_DEBUG=false`.

## Estructura del proyecto
- `app/` lógica de aplicación (controladores, servicios). Ej.: `app/Http/Controllers/AiChatController.php`.
- `resources/views/` vistas Blade (layouts y secciones).
- `routes/web.php` rutas HTTP, incluyendo el endpoint de chat.
- `config/` configuración de framework y del asistente (`config/ai_facts.php`).
- `database/` migraciones y base SQLite en desarrollo.

## API del asistente IA
- `POST /api/ai-chat` (`webinizadev/routes/web.php:15`)
- Body esperado: `prompt` (texto libre)
- Respuesta: `{ reply: string, model?: string, usage?: any }`

### Variables de entorno IA (principales)
- `AI_BASE_URL` URL base del proveedor de IA.
- `AI_PATH` ruta del endpoint de generación (por defecto `/v1/generate`).
- `AI_API_KEY` clave de acceso.
- `AI_TENANT_ID` tenant o espacio de trabajo.
- `AI_MODEL` modelo a utilizar.
- `AI_SYSTEM` mensaje de sistema (contexto del asistente).
- `AI_TEMP`, `AI_MAX_TOKENS`, `AI_TIMEOUT`, `AI_SSL_VERIFY` ajustes de inferencia.
- `AI_KB`, `AI_TOP_K`, `AI_MIN_SCORE`, `AI_FALLBACK`, `AI_REFUSAL_MESSAGE` parámetros de RAG y fallback.
- `AI_STRICT_DOMAIN` y `AI_ALLOWED_TERMS` guard de dominio temático.
- `CF_ACCESS_CLIENT_ID`, `CF_ACCESS_CLIENT_SECRET` headers para Cloudflare Access (opcional).

## Seguridad
- No subir `.env`, claves ni tokens. Ver `.gitignore` existente.
- Limitar el dominio del asistente con `AI_STRICT_DOMAIN=true` y `AI_ALLOWED_TERMS`.
- Revisar logs y errores sensibles antes de exponer públicos.

## Licencia de Autor
Copyright © 2025 Webiniza. Todos los derechos reservados.

- El código, diseño y contenido del sitio están protegidos por derechos de autor.
- No se permite la copia, distribución, modificación o uso comercial sin autorización previa y por escrito de Webiniza.
- El uso queda limitado a fines internos del propietario del repositorio y colaboradores autorizados.

## Contacto
Para permisos o dudas sobre la licencia: `info@webiniza.com`