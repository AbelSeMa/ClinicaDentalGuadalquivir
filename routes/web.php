<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\PlanesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkerController;
use App\Models\Patient;
use App\Models\Worker;
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
    Route::get('/reservar-cita', [CitasController::class, 'formulario']);
    Route::get('/horas-disponibles', [CitasController::class, 'horasDisponibles']);
    Route::get('/obtener-dias-sin-citas', [CitasController::class, 'diasSinCitas']);
    Route::post('/almacenar-cita', [CitasController::class, 'store']);
    Route::delete('citas/{appointment}', [CitasController::class, 'destroy'])->name('citas.destroy');
    Route::put('/actualizar-hora-cita/{id}', [CitasController::class, 'update'])->name('citas.update');
    Route::get('plan/{id}/pagar', [PaypalController::class, 'resumen'])->name('pagar.paypal');

    Route::post('paypal/payment', [PayPalController::class, 'payment'])->name('paypal.payment');
    Route::get('paypal/payment/success', [PayPalController::class, 'paymentSuccess'])->name('paypal.payment.success');
    Route::get('paypal/payment/cancel', [PayPalController::class, 'paymentCancel'])->name('paypal.payment/cancel');
});

Route::get('/prueba', [CitasController::class, 'diasSinCitas']);

Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [CitasController::class, 'index'])->name('admin.dashboard');

    Route::get('admin/crear-trabajador', [WorkerController::class, 'crearTrabajador'])->name('worker.create');
    Route::post('admin/almacenar-trabajador', [WorkerController::class, 'store'])->name('worker.storage');
    Route::get('admin/eliminar-trabajador', [WorkerController::class, 'borrarTrabajador'])->name('worker.delete');
    Route::delete('admin/eliminar-trabajador/{worker}', [WorkerController::class, 'destroy'])->name('worker.destroy');
    Route::get('/usuarios-sin-roles', [AdminController::class, 'sinRoles'])->name('usuarios.sinroles');
    Route::get('admin/editar-trabajador', [WorkerController::class, 'editarTrabajador'])->name('index.worker');
    Route::get('admin/editar-trabajador/{id}', [WorkerController::class, 'edit'])->name('edit.worker');
    Route::put('admin/update-trabajador/{id}', [WorkerController::class, 'update'])->name('update.worker');
});

require __DIR__ . '/auth.php';
