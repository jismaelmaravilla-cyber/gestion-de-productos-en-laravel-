<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

// Raíz: redirige al catálogo (si no hay sesión, 'auth' llevará al login)
Route::get('/', function () {
    return redirect()->route('productos.index');
});

// Login (solo para visitantes sin sesión iniciada)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'mostrarLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.procesar');
});

// Logout (solo para usuarios autenticados)
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Catálogo, búsqueda, filtros y ordenamiento: disponibles para ambos roles
Route::middleware(['auth', 'rol:administrador,empleado'])->group(function () {
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
});

// Administración de productos: solo para el Administrador
Route::middleware(['auth', 'rol:administrador'])->group(function () {
    Route::get('/productos/crear', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');

    Route::get('/productos/{producto}/editar', [ProductoController::class, 'edit'])
        ->whereNumber('producto')
        ->name('productos.edit');

    Route::put('/productos/{producto}', [ProductoController::class, 'update'])
        ->whereNumber('producto')
        ->name('productos.update');

    Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])
        ->whereNumber('producto')
        ->name('productos.destroy');
});