<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Muestra el formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Maneja el login del usuario
    public function login(Request $request)
    {
        // Validación de los datos de login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Intentamos autenticar al usuario
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Redirigimos al usuario al dashboard si la autenticación es exitosa
            return redirect()->intended(route('dashboard'));
        }

        // Si la autenticación falla, devolvemos un mensaje de error
        return back()->withErrors(['email' => 'Las credenciales son incorrectas.']);
    }

    // Cierra la sesión del usuario
    public function logout(Request $request)
    {
        Auth::logout();

        // Limpiamos la sesión y redirigimos al login
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
