<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\StylistsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GoogleCalendarController;

// ======================
// 🔐 Autenticación con Google
Route::middleware(['auth'])->group(function () {
    Route::get('/auth/google', [GoogleCalendarController::class, 'redirectToGoogle'])->name('calendar.login');
    Route::get('/auth/google/callback', [GoogleCalendarController::class, 'handleGoogleCallback']);
    Route::post('/calendar/event', [GoogleCalendarController::class, 'createEvent'])->name('calendar.create-event');
    Route::get('/disconnect-google', function() {
        if (Auth::check()) {
            Auth::user()->update([
                'token' => null,
                'google_id' => null
            ]);
            return redirect()->back()->with('success', 'Desconectado de Google Calendar correctamente');
        }
        return redirect()->back();
    })->name('google.disconnect');
});

// ======================
// 🏠 Página de inicio
// ======================
Route::get('/', [HomeController::class, 'index'])->name('home');

// ======================
// 💇 Servicios (públicos)
// ======================
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');

// ======================
// ✂️ Estilistas (públicos)
// ======================
Route::get('/stylists', [StylistsController::class, 'index'])->name('stylists.index');

// ======================
// 📬 Contacto (público)
// ======================
Route::get('/contacto/contact', [ContactController::class, 'create'])->name('user.contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// ======================
// 👤 Rutas autenticadas (usuarios)
// ======================
Route::middleware(['auth'])->group(function () {
    // Citas
    Route::get('/appointments', [AppointmentsController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create', [AppointmentsController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentsController::class, 'store'])->name('appointments.store');
    Route::get('/appointments/available-slots', [AppointmentsController::class, 'getAvailableSlots'])->name('appointments.available-slots');
    Route::get('/appointments/{id}', [AppointmentsController::class, 'show'])->name('appointments.show');
    Route::delete('/appointments/{id}', [AppointmentsController::class, 'destroy'])->name('appointments.destroy');
});

// ======================
// 👑 Rutas de administrador
// ======================
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/appointments', [AdminController::class, 'appointments'])->name('admin.appointments');
    Route::get('/admin/services', [AdminController::class, 'services'])->name('admin.services');
    Route::get('/admin/stylists', [AdminController::class, 'stylists'])->name('admin.stylists');
    Route::get('/admin/stylists/create', [StylistsController::class, 'create'])->name('stylists.create');
    Route::get('/admin/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::post('/stylists', [StylistsController::class, 'store'])->name('stylists.store');
    Route::get('/admin/contacto/mensajes', [ContactController::class, 'index'])->name('admin.mensaje');
    Route::get('/admin/stylist/{stylist}/appointments', [AdminController::class, 'allAppointmentsByStylist'])->name('admin.stylist.appointments');
    Route::get('/admin/estadisticas', [AdminController::class, 'estadisticas'])->name('admin.estadisticas');
});

// ======================
// 🛡 Autenticación por defecto de Laravel
// ======================
require __DIR__ . '/auth.php';
