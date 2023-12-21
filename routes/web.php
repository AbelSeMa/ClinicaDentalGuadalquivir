<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PlanesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkerController;
use App\Models\Patient;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class);


Route::get('/planes', [PlanesController::class, 'index'])->name('index.plan');

Route::get('plan/{id}', [PlanesController::class, 'show'])->name('show.plan');




Route::get('/user/dashboard', [PatientController::class, 'index'])
    ->middleware(['auth'])
    ->name('user.dashboard');

Route::get('/altapaciente', [PatientController::class])
    ->middleware(['auth', 'admin'])
    ->name('altapaciente');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/reservar-cita',[CitasController::class, 'formulario']);
    Route::get('/horas-disponibles', [CitasController::class, 'horasDisponibles']);
    Route::get('/obtener-dias-sin-citas', [CitasController::class, 'diasSinCitas']);
    Route::post('/almacenar-cita', [CitasController::class, 'store']);
    Route::delete('citas/{appointment}', [CitasController::class, 'destroy'])->name('citas.destroy');
            
});

Route::get('/prueba',[CitasController::class, 'diasSinCitas']);

Route::middleware('admin')->group(function () {
    Route::get('/editarworker/{id}', [WorkerController::class, 'edit'])->name('edit.worker');
    Route::put('/update-worker/{id}', [WorkerController::class, 'update'])->name('update.worker');
    Route::get('/altapaciente', [PatientController::class, 'create'])->name('altapaciente');
    Route::post('/altapaciente', [PatientController::class, 'storage'])->name('altapaciente');
    Route::get('/admin/dashboard', [CitasController::class, 'index'])->name('admin.dashboard');

});

require __DIR__ . '/auth.php';
