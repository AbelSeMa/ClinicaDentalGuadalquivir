<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\PlanesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkerController;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Plan;
use App\Models\User;
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
Route::get('/horas-disponibles', [CitasController::class, 'horasDisponibles']);
Route::get('/obtener-dias-sin-citas', [CitasController::class, 'diasSinCitas']);


Route::middleware(['patient', 'verified'])->group(function () {
    Route::get('/usuario/dashboard', [PatientController::class, 'index'])->name('user.dashboard');

    Route::get('/usuario/dashboard/editar-perfil', [UserController::class, 'edit'])->name('usuario.editar-perfil');
    Route::put('/usuario/dashboard/actualizar-perfil', [UserController::class, 'update'])->name('usuario.actualizar');
    Route::put('/usuario/dashboard/actualizar-contraseña', [UserController::class, 'updatePassword'])->name('usuario.actualizar-contraseña');
    Route::delete('/usuario/dashboard/baja/{user}', [UserController::class, 'delete'])->name('usuario.baja');

    Route::get('usuario/dashboard/ver-pagos', [UserController::class, 'pagos'])->name('usuario.pagos');
    Route::get('usuario/ver-factura/{id}', [UserController::class, 'verFactura'])->name('usuario.factura');

    
    Route::get('/reservar-cita', [CitasController::class, 'formulario']);
    Route::post('/almacenar-cita', [CitasController::class, 'store']);
    Route::delete('/citas/{appointment}', [CitasController::class, 'destroy'])->name('citas.destroy');
    Route::put('/actualizar-hora-cita/{id}', [CitasController::class, 'update'])->name('citas.update');
    
    
    Route::get('plan/{id}/pagar', [PaypalController::class, 'resumen'])->name('pagar.paypal');
    Route::post('/paypal/payment', [PayPalController::class, 'payment'])->name('paypal.payment');
    Route::get('/paypal/payment/success', [PayPalController::class, 'paymentSuccess'])->name('paypal.payment.success');
    Route::get('/paypal/payment/cancel', [PayPalController::class, 'paymentCancel'])->name('paypal.payment/cancel');

    Route::get('/usuario/citas/historial', [CitasController::class, 'historial'])->name('citas.historial');
    Route::get('/usuario/ver-informe/{id}', [CitasController::class, 'verInforme'])->name('usuario.ver-informe');
});

Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [CitasController::class, 'index'])->name('admin.dashboard');
    Route::get('/usuarios-sin-roles', [AdminController::class, 'sinRoles'])->name('usuarios.sinroles');

    Route::get('/admin/crear-usuario', [AdminController::class, 'crearUsuario'])->name('user.create');
    Route::post('/admin/almacenar-usuario', [AdminController::class, 'storeUser'])->name('user.storage');
    Route::get('/admin/editar-usuario', [AdminController::class, 'editarUsuario'])->name('index.user');
    Route::get('/admin/editar-usuario/{id}', [AdminController::class, 'editUser'])->name('edit.user');
    Route::put('/admin/update-usuario/{id}', [AdminController::class, 'updateUser'])->name('update.user');
    Route::get('/admin/eliminar-usuario', [AdminController::class, 'borrarUsuario'])->name('user.delete');
    Route::delete('/admin/eliminar-usuario/{user}', [AdminController::class, 'destroyUser'])->name('user.destroy');
    Route::post('/admin/denegar-acceso/{user}', [AdminController::class, 'banear'])->name('user.ban');

    Route::get('/admin/crear-trabajador', [AdminController::class, 'crearTrabajador'])->name('worker.create');
    Route::post('/admin/almacenar-trabajador', [AdminController::class, 'storeWorker'])->name('worker.storage');
    Route::get('/admin/editar-trabajador', [AdminController::class, 'editarTrabajador'])->name('index.worker');
    Route::get('/admin/editar-trabajador/{id}', [AdminController::class, 'editWorker'])->name('edit.worker');
    Route::put('/admin/update-trabajador/{id}', [AdminController::class, 'updateWorker'])->name('update.worker');

    Route::get('/admin/eliminar-trabajador', [AdminController::class, 'borrarTrabajador'])->name('worker.delete');
    Route::delete('/admin/eliminar-trabajador/{worker}', [AdminController::class, 'destroyWorker'])->name('worker.destroy');


    Route::get('/admin/planes', [AdminController::class, 'planes'])->name('admin.planes');
    Route::post('/admin/crear-plan', [AdminController::class, 'storePlan'])->name('admin.store-plan');
    Route::get('/admin/editar-plan/{id}', [AdminController::class, 'editPlan']);
    Route::put('/admin/update-plan/{id}', [AdminController::class, 'updatePlan'])->name('admin.update-plan');
    Route::post('/admin/plan/{id}/desactivar', [AdminController::class, 'togglePlan'])->name('admin.desactivar-plan');
});

Route::middleware('worker')->group(function () {
    Route::get('/trabajador/dashboard', [CitasController::class, 'workerDashboard'])->name('worker.dashboard');
    Route::put('/trabajador/atender-cita', [WorkerController::class, 'atenderCita'])->name('worker-atender-cita');
    Route::get('/trabajador/datos-paciente/{citaId}', [WorkerController::class, 'datosPaciente'])->name('trabajardor.datos-paciente');
    Route::get('/trabajador/nueva-cita', [WorkerController::class, 'asignarCita'])->name('trabajador.nueva-cita');
    Route::post('/trabajador/almacenar-cita', [WorkerController::class, 'almacenarCita'])->name('trabajador.almacenar-cita');
});

Route::middleware('worker', 'patient')->group(function () {
    Route::get('elegir-perfil', [UserController::class, 'elegirPerfil'])->name('usuario.elegir-perfil');
});

Route::get('/obtener-usuario', [PatientController::class, 'buscar'])->middleware('worker_admin')->name('obtener.usuario');

require __DIR__ . '/auth.php';
