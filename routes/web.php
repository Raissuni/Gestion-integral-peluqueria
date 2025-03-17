<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\StylistsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
//use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminMiddleware;


// Página de inicio
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas de Servicios (solo visibles)
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');

Route::delete('/appointments/{id}', [AppointmentsController::class, 'destroy'])->name('appointments.destroy');


// Rutas de Citas para usuarios autenticados (pueden ver y crear sus propias citas)
Route::middleware(['auth'])->group(function () {
    Route::get('/appointments', [AppointmentsController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create', [AppointmentsController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentsController::class, 'store'])->name('appointments.store');
    Route::get('/appointments/{id}', [AppointmentsController::class, 'show'])->name('appointments.show');
});

// Rutas de Estilistas (todos pueden ver)
Route::get('/stylists', [StylistsController::class, 'index'])->name('stylists.index');

// Ruta de Contacto
Route::get('contacto/contact', [ContactController::class, 'create'])->name('user.contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Rutas del Panel de Administración (solo administradores)
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/stylists/create', [StylistsController::class, 'create'])->name('stylists.create'); 
    Route::get('/admin/services/create', [ServiceController::class, 'create'])->name('services.create'); 
    Route::get('/admin/appointments/create', [AppointmentsController::class, 'create'])->name('appoinments.create');
    
    Route::get('/admin/contacto/mensajes', [ContactController::class, 'index'])->name('admin.mensaje'); 
    

    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::post('/stylists', [StylistsController::class, 'store'])->name('stylists.store');
});

// Route::middleware(['auth', 'admin'])->group(function () {
    
// });




require __DIR__.'/auth.php';
