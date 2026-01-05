<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/**
 * Nueva ruta al root de Laravel desde /public_html
 * Estructura:
 *   /home/USUARIO/laravel_projects/webinizadev   <-- raíz Laravel
 *   /home/USUARIO/public_html                    <-- document root del sitio
 */
$laravelRoot = realpath(__DIR__ . '/../laravel_projects/webinizadev');

if ($laravelRoot === false) {
    http_response_code(500);
    echo 'Error: ruta a la app de Laravel no encontrada.';
    exit;
}

// Modo mantenimiento
if (file_exists($laravelRoot . '/storage/framework/maintenance.php')) {
    require $laravelRoot . '/storage/framework/maintenance.php';
}

// Autoload de Composer
require $laravelRoot . '/vendor/autoload.php';

// Bootstrap de la app
/** @var Application $app */
$app = require_once $laravelRoot . '/bootstrap/app.php';

$app->handleRequest(Request::capture());
