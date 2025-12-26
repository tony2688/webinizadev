<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\AiChatController;

Route::get('/', function () {
    return view('layouts.app');
});

Route::post('/contacto/enviar', [ContactoController::class, 'enviar'])->name('contacto.enviar');

// Ruta API Chat (sin CSRF para llamadas desde frontend externo)
Route::post('/api/ai-chat', [AiChatController::class, 'chat'])
    ->name('ai.chat')
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
