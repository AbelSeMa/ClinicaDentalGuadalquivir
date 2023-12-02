<?php

use App\Http\Controllers\AdminController;
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

Route::get('plan/{plan}', [PlanesController::class, 'show'])->name('show.plan');

Route::get('/editarworker/{id}', [WorkerController::class, 'edit'])->middleware('auth')->name('edit.worker');
Route::put('/update-worker/{id}', [WorkerController::class, 'update'])->middleware(['auth', 'verified'])->name('update.worker');

Route::get('/admin/dashboard', [AdminController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');

Route::get('/user/dashboard', [PatientController::class, 'index'])
    ->middleware(['auth'])
    ->name('user.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('admin')->group(function () {
    Route::get('/editarworker/{id}', [WorkerController::class, 'edit'])->name('edit.worker');
    Route::put('/update-worker/{id}', [WorkerController::class, 'update'])->name('update.worker');
});

require __DIR__ . '/auth.php';
