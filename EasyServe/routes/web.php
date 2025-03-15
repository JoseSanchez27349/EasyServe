<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControlVistas;
use App\Http\Controllers\Auth\AuthController;

// Rutas públicas
Route::get('/', [ControlVistas::class, "vistaInicio"])->name("inicio");
Route::get('/mesas', [ControlVistas::class, "vistaMesas"])->name("mesas");
Route::get('/notificaciones', [ControlVistas::class, "vistaNotificaciones"])->name("notificaciones");
Route::get('/cuenta', [ControlVistas::class, 'vistaCuenta'])->name('cuenta');

// Ruta para finalizar la cuenta
Route::post('/cuenta/finalizar/{id}', [ControlVistas::class, 'finalizarCuenta'])->name('finalizarCuenta');

// Rutas para meseros
Route::get('/mesero', [ControlVistas::class, 'vistaMesero'])->name('mesero');
Route::get('/mesero/agregar', [ControlVistas::class, 'mostrarFormularioAgregar'])->name('mesero.agregar.form');
Route::post('/mesero/agregar', [ControlVistas::class, 'agregarMesero'])->name('mesero.agregar');
Route::get('/mesero/editar/{id}', [ControlVistas::class, 'editarMesero'])->name('mesero.editar');
Route::put('/mesero/editar/{id}', [ControlVistas::class, 'actualizarMesero'])->name('mesero.actualizar');
Route::delete('/mesero/eliminar/{id}', [ControlVistas::class, 'eliminarMesero'])->name('mesero.eliminar');

// Ruta de inicio de sesión (única para ambos roles)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas para el punto de venta (solo meseros autenticados)
Route::middleware('auth:mesero')->group(function () {
    Route::get('/menu', [ControlVistas::class, "vistaMenu"])->name("menu");
    Route::post('/menu', [ControlVistas::class, "guardarOrden"])->name("guardarOrden");
});

// Rutas protegidas para administradores (solo administradores autenticados)
Route::middleware('auth:web')->group(function () {
    Route::get('/admin/dashboard', [ControlVistas::class, 'vistaAdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/meseros', [ControlVistas::class, 'vistaMeserosAdmin'])->name('admin.meseros');
});