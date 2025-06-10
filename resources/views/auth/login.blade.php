@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow overflow-hidden border-0">
                <div class="row g-0">
                    <!-- Imagen lateral -->
                    <div class="col-lg-6 d-none d-lg-block">
                        <div class="position-relative h-100">
                            <img src="{{ asset('images/salon.jpg') }}" alt="Salón de belleza" class="w-100 h-100 object-fit-cover">
                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.4);">
                                <div class="text-center px-4">
                                    <h2 class="display-5 fw-bold text-white mb-3">Bienvenido a nuestro Salón</h2>
                                    <p class="lead text-white mb-4">Tu destino de belleza y estilo</p>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('services.index') }}" class="btn btn-outline-light me-2">Nuestros servicios</a>
                                        <a href="{{ route('stylists.index') }}" class="btn btn-outline-light">Conoce al equipo</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Formulario -->
                    <div class="col-lg-6">
                        <div class="card-body p-4 p-lg-5">
                            <div class="text-center mb-4">
                                <h3 class="h2 fw-bold mb-1">Iniciar Sesión</h3>
                                <p class="text-muted">Accede a tu cuenta para gestionar tus citas</p>
                            </div>
                            
                            @if (session('status'))
                                <div class="alert alert-success mb-4" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                
                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-envelope text-muted"></i>
                                        </span>
                                        <input id="email" type="email" class="form-control border-start-0 @error('email') is-invalid @enderror" 
                                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="email@ejemplo.com">
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <!-- Contraseña -->
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label for="password" class="form-label">Contraseña</label>
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="text-decoration-none small">
                                                ¿Olvidaste tu contraseña?
                                            </a>
                                        @endif
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-lock text-muted"></i>
                                        </span>
                                        <input id="password" type="password" class="form-control border-start-0 @error('password') is-invalid @enderror" 
                                            name="password" required autocomplete="current-password" placeholder="••••••••">
                                        <button type="button" class="btn btn-outline-secondary border border-start-0" id="togglePassword">
                                            <i class="fas fa-eye" id="toggleIcon"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <!-- Remember Me -->
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="remember_me" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember_me">Recordarme</label>
                                </div>
                                
                                <!-- Botones de acción -->
                                <div class="d-grid gap-2 mb-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                                    </button>
                                </div>
                                
                                <!-- Registro -->
                                <div class="text-center mb-3">
                                    <p class="mb-0">¿No tienes una cuenta? <a href="{{ route('register') }}" class="text-decoration-none fw-medium">Regístrate ahora</a></p>
                                </div>
                                
                                <!-- Separador -->
                                <div class="d-flex align-items-center my-4">
                                    <hr class="flex-grow-1">
                                    <span class="px-2 text-muted small text-uppercase">o continúa con</span>
                                    <hr class="flex-grow-1">
                                </div>
                                
                                <!-- Botones de redes sociales -->
                                <div class="d-grid gap-2">
                                    <a href="{{ route('calendar.login') }}" class="btn btn-outline-secondary">
                                        <img src="https://www.google.com/favicon.ico" alt="Google" class="me-2" height="16">
                                        Continuar con Google
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Información adicional -->
            <div class="text-center mt-4">
                <p class="small text-muted">
                    Al iniciar sesión, aceptas nuestros <a href="#" class="text-decoration-none">Términos de servicio</a> y 
                    <a href="#" class="text-decoration-none">Política de privacidad</a>
                </p>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .object-fit-cover {
        object-fit: cover;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (togglePassword && passwordInput && toggleIcon) {
            togglePassword.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                }
            });
        }
    });
</script>
@endpush
@endsection