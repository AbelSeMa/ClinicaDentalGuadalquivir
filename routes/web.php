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
use App\Models\Plan;
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


Route::middleware(['patient', 'verified'])->group(function () {
    Route::get('/user/dashboard', [PatientController::class, 'index'])->name('user.dashboard');

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

Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [CitasController::class, 'index'])->name('admin.dashboard');
    Route::get('/usuarios-sin-roles', [AdminController::class, 'sinRoles'])->name('usuarios.sinroles');

    Route::get('/admin/crear-usuario', [AdminController::class, 'crearUsuario'])->name('user.create');
    Route::post('/admin/almacenar-usuario', [AdminController::class, 'storeUser'])->name('user.storage');
    Route::get('admin/editar-usuario', [AdminController::class, 'editarUsuario'])->name('index.user');
    Route::get('admin/editar-usuario/{id}', [AdminController::class, 'editUser'])->name('edit.user');
    Route::put('admin/update-usuario/{id}', [AdminController::class, 'updateUser'])->name('update.user');
    Route::get('admin/eliminar-usuario', [AdminController::class, 'borrarUsuario'])->name('user.delete');
    Route::delete('admin/eliminar-usuario/{user}', [AdminController::class, 'destroyUser'])->name('user.destroy');
    Route::post('admin/denegar-acceso/{user}', [AdminController::class, 'banear'])->name('user.ban');

    Route::get('admin/crear-trabajador', [AdminController::class, 'crearTrabajador'])->name('worker.create');
    Route::post('admin/almacenar-trabajador', [AdminController::class, 'storeWorker'])->name('worker.storage');
    Route::get('admin/editar-trabajador', [AdminController::class, 'editarTrabajador'])->name('index.worker');
    Route::get('admin/editar-trabajador/{id}', [AdminController::class, 'editWorker'])->name('edit.worker');
    Route::put('admin/update-trabajador/{id}', [AdminController::class, 'updateWorker'])->name('update.worker');
    
    Route::get('admin/eliminar-trabajador', [AdminController::class, 'borrarTrabajador'])->name('worker.delete');
    Route::delete('admin/eliminar-trabajador/{worker}', [AdminController::class, 'destroyWorker'])->name('worker.destroy');

    Route::get('obtener-usuario', [PatientController::class, 'buscar'])->name('obtener.usuario');

    Route::get('/admin/planes', [AdminController::class, 'planes'])->name('admin.planes');
    Route::post('/admin/crear-plan', [AdminController::class, 'storePlan'])->name('admin.store-plan');
    Route::get('admin/editar-plan/{id}', [AdminController::class, 'editPlan']);
    Route::put('/admin/update-plan/{id}', [AdminController::class, 'updatePlan'])->name('admin.update-plan');
    Route::post('/admin/plan/{id}/desactivar', [AdminController::class, 'togglePlan'])->name('admin.desactivar-plan');

});

require __DIR__ . '/auth.php';
