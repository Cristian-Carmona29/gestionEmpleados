<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\DepartamentosController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Ruta principal
Route::get('/', function () {
    return view('welcome');
});

// Empleados
Route::resource('empleados', EmpleadosController::class)->middleware('auth');
Route::get('/empleados/buscar', [EmpleadosController::class, 'buscar'])->name('empleados.buscar');

// Departamentos
Route::resource('departamentos', DepartamentosController::class)->middleware('auth');

// Perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Autenticación
Auth::routes();
Route::get('/home', [EmpleadosController::class, 'index'])->name('home');

// Redirigir al home después del login
Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [EmpleadosController::class, 'index'])->name('home');
});
