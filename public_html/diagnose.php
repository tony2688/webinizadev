<?php

echo "<pre>";

echo "?? Diagnóstico de rutas Laravel\n";
echo "-----------------------------\n";

// Base path desde este archivo (public/)
$current = __DIR__;
echo "?? Directorio actual (__DIR__): \n$current\n\n";

// Laravel root esperado
$laravelRoot = realpath($current . '/../../laravel_projects/webinizadev');

if ($laravelRoot && file_exists($laravelRoot . '/bootstrap/app.php')) {
    echo "? Ruta Laravel encontrada correctamente:\n$laravelRoot\n";
} else {
    echo "? ERROR: No se encontró Laravel en:\n$current/../../laravel_projects/webinizadev\n";
}

// Revisión autoload
$autoloadPath = $laravelRoot . '/vendor/autoload.php';
if (file_exists($autoloadPath)) {
    echo "\n? Autoload existe: $autoloadPath\n";
} else {
    echo "\n? Autoload NO encontrado: $autoloadPath\n";
}

// Revisión bootstrap/app.php
$bootstrapPath = $laravelRoot . '/bootstrap/app.php';
if (file_exists($bootstrapPath)) {
    echo "? Bootstrap existe: $bootstrapPath\n";
} else {
    echo "? Bootstrap NO encontrado: $bootstrapPath\n";
}

echo "\n?? Finalizado.\n";

echo "</pre>";
