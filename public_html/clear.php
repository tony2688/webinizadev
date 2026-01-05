<?php

// Ruta absoluta al base path de Laravel
$basePath = '/home/c2162521/laravel_projects/webinizadev';

$autoload = $basePath . '/vendor/autoload.php';
$appPath = $basePath . '/bootstrap/app.php';

if (!file_exists($autoload)) {
    echo "? Error: No se encuentra autoload. Verifica la ruta base.<br>";
    echo "Ruta buscada: $autoload";
    exit;
}

require $autoload;

use Illuminate\Contracts\Console\Kernel;

$app = require_once $appPath;
$kernel = $app->make(Kernel::class);

echo "<pre>";

$commands = [
    'config:clear',
    'route:clear',
    'view:clear',
    'cache:clear',
];

foreach ($commands as $command) {
    echo "php artisan $command\n";
    $kernel->call($command);
    echo $kernel->output() . "\n";
}

echo "? Limpieza completada.";
echo "</pre>";
