<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControlVistas;
use App\Http\Controllers\Auth\MeseroAuthController;

// Rutas públicas
Route::get('/inicio', [ControlVistas::class, "vistaInicio"])->name("inicio");
Route::get('/mesas', [ControlVistas::class, "vistaMesas"])->name("mesas");
Route::get('/notificaciones', [ControlVistas::class, "vistaNotificaciones"])->name("notificaciones");
Route::get('/cuenta', [ControlVistas::class, 'vistaCuenta'])->name('cuenta');

// Ruta para finalizar la cuenta
Route::post('/cuenta/finalizar/{id}', [ControlVistas::class, 'finalizarCuenta'])->name('finalizarCuenta');

// Rutas para meseros
Route::get('/mesero', [ControlVistas::class, 'vistaMesero'])->name('mesero');
Route::post('/mesero/agregar', [ControlVistas::class, 'agregarMesero'])->name('mesero.agregar');
Route::get('/mesero/editar/{id}', [ControlVistas::class, 'editarMesero'])->name('mesero.editar');
Route::put('/mesero/editar/{id}', [ControlVistas::class, 'actualizarMesero'])->name('mesero.actualizar');
Route::delete('/mesero/eliminar/{id}', [ControlVistas::class, 'eliminarMesero'])->name('mesero.eliminar');

// Rutas de autenticación para meseros
Route::get('/mesero/login', [MeseroAuthController::class, 'showLoginForm'])->name('mesero.login');
Route::post('/mesero/login', [MeseroAuthController::class, 'login'])->name('mesero.login.submit');
Route::post('/mesero/logout', [MeseroAuthController::class, 'logout'])->name('mesero.logout');

// Rutas protegidas para el punto de venta
Route::middleware('auth:mesero')->group(function () {
    Route::get('/menu', [ControlVistas::class, "vistaMenu"])->name("menu");
    Route::post('/menu', [ControlVistas::class, "guardarOrden"])->name("guardarOrden");
});