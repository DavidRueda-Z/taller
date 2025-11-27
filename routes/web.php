<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\PropinaController;
use App\Http\Controllers\ContrasenaController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\MemoriaController;
use App\Http\Controllers\EncuestaController;
use App\Http\Controllers\CronometroController;

Route::get('/', function () {
    return view('home');
})->name('home');

//Ejercicios Tareas
Route::get('/tareas', [TareaController::class, 'index'])->name('tareas.index');
Route::post('/tareas', [TareaController::class, 'store'])->name('tareas.store');
Route::get('/tareas/editar/{id}', [TareaController::class, 'edit'])->name('tareas.edit');
Route::post('/tareas/actualizar/{id}', [TareaController::class, 'update'])->name('tareas.update');
Route::post('/tareas/marcar/{id}', [TareaController::class, 'marcar'])->name('tareas.marcar');
Route::post('/tareas/eliminar/{id}', [TareaController::class, 'destroy'])->name('tareas.destroy');

//Ejercicios Propinas
Route::get('/propinas', [PropinaController::class, 'index'])->name('propinas.index');
Route::post('/propinas', [PropinaController::class, 'calcular'])->name('propinas.calcular');

//Ejercicios Contraseñas
Route::get('/contrasenas', [ContrasenaController::class, 'index'])->name('contrasenas.index');
Route::post('/contrasenas', [ContrasenaController::class, 'generar'])->name('contrasenas.generar');

//Ejercicio Gastos
Route::get('/gastos', [GastoController::class, 'index'])->name('gastos.index');
Route::post('/gastos', [GastoController::class, 'store'])->name('gastos.store');
Route::post('/gastos/eliminar/{id}', [GastoController::class, 'destroy'])->name('gastos.destroy');
Route::get('/gastos/editar/{id}', [GastoController::class, 'edit'])->name('gastos.edit');
Route::post('/gastos/actualizar/{id}', [GastoController::class, 'update'])->name('gastos.update');


//Ejercicios Reservas
Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');
Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');
Route::post('/reservas/eliminar/{id}', [ReservaController::class, 'destroy'])->name('reservas.destroy');
Route::get('/reservas/editar/{id}', [ReservaController::class, 'edit'])->name('reservas.edit');
Route::post('/reservas/actualizar/{id}', [ReservaController::class, 'update'])->name('reservas.update');


//Ejercicios Notas
Route::get('/notas', [NotaController::class, 'index'])->name('notas.index');
Route::post('/notas', [NotaController::class, 'store'])->name('notas.store');
Route::post('/notas/eliminar/{id}', [NotaController::class, 'destroy'])->name('notas.destroy');
Route::get('/notas/editar/{id}', [NotaController::class, 'edit'])->name('notas.edit');
Route::post('/notas/actualizar/{id}', [NotaController::class, 'update'])->name('notas.update');


//Ejercicios Eventos
Route::get('/calendario', [EventoController::class, 'index'])->name('eventos.index');
Route::post('/calendario', [EventoController::class, 'store'])->name('eventos.store');
Route::post('/calendario/eliminar/{id}', [EventoController::class, 'destroy'])->name('eventos.destroy');
Route::get('/calendario/editar/{id}', [EventoController::class, 'edit'])->name('eventos.edit');
Route::post('/calendarios/actualizar/{id}', [EventoController::class, 'update'])->name('eventos.update');


//Ejercicios Recetas
Route::get('/recetas', [RecetaController::class, 'index'])->name('recetas.index');
Route::post('/recetas', [RecetaController::class, 'store'])->name('recetas.store');
Route::get('/recetas/eliminar/{id}', [RecetaController::class, 'destroy'])->name('recetas.destroy');
Route::get('/recetas/editar/{id}', [RecetaController::class, 'edit'])->name('recetas.edit');
Route::post('/recetas/actualizar/{id}', [RecetaController::class, 'update'])->name('recetas.update');


//Ejercicios Memoria
Route::get('/memoria', [MemoriaController::class, 'index'])->name('memoria.index');

//Ejercicios Encuestas
Route::get('/encuestas', [EncuestaController::class, 'index'])->name('encuestas.index');
Route::post('/encuestas', [EncuestaController::class, 'store'])->name('encuestas.store');
Route::post('/encuestas/eliminar/{id}', [EncuestaController::class, 'destroy'])->name('encuestas.destroy');
Route::post('/encuestas/votar/{id}/{opcion}', [EncuestaController::class, 'votar'])
    ->name('encuestas.votar');


//Ejercicios Cronometro
Route::get('/cronometro', [CronometroController::class, 'index'])->name('cronometro.index');
