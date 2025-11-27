<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\PropinaController;
use App\Http\Controllers\ContrasenaController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\EventoController;

Route::get('/', function () {
    return view('home');
})->name('home');

//Ejercicios Tareas
Route::get('/tareas', [TareaController::class, 'index'])->name('tareas.index');
Route::post('/tareas', [TareaController::class, 'store'])->name('tareas.store');
Route::get('/tareas/eliminar/{id}', [TareaController::class, 'destroy'])->name('tareas.destroy');

//Ejercicios Propinas
Route::get('/propinas', [PropinaController::class, 'index'])->name('propinas.index');
Route::post('/propinas', [PropinaController::class, 'calcular'])->name('propinas.calcular');

//Ejercicios Contraseñas
Route::get('/contrasenas', [ContrasenaController::class, 'index'])->name('contrasenas.index');
Route::post('/contrasenas', [ContrasenaController::class, 'generar'])->name('contrasenas.generar');

//Ejercicios Gastos
Route::get('/gastos', [GastoController::class, 'index'])->name('gastos.index');
Route::post('/gastos', [GastoController::class, 'store'])->name('gastos.store');
Route::get('/gastos/eliminar/{id}', [GastoController::class, 'destroy'])->name('gastos.destroy');

//Ejercicios Reservas
Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');
Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');
Route::get('/reservas/eliminar/{id}', [ReservaController::class, 'destroy'])->name('reservas.destroy');

//Ejercicios Notas
Route::get('/notas', [NotaController::class, 'index'])->name('notas.index');
Route::post('/notas', [NotaController::class, 'store'])->name('notas.store');
Route::get('/notas/eliminar/{id}', [NotaController::class, 'destroy'])->name('notas.destroy');

//Ejercicios Eventos
Route::get('/calendario', [EventoController::class, 'index'])->name('eventos.index');
Route::post('/calendario', [EventoController::class, 'store'])->name('eventos.store');
Route::get('/calendario/eliminar/{id}', [EventoController::class, 'destroy'])->name('eventos.destroy');

