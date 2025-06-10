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
                                    <h2 class="display-5 fw-bold text-white mb-3">Únete a Nosotros</h2>
                                    <p class="lead text-white mb-4">Crea tu cuenta y comienza a disfrutar de nuestros servicios</p>
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
                                <h3 class="h2 fw-bold mb-1">Crear Cuenta</h3>
                                <p class="text-muted">Regístrate para acceder a citas exclusivas</p>
                            </div>
                            
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                
                                <!-- Nombre -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nombre</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-user text-muted"></i>
                                        </span>
                                        <input id="name" type="text" class="form-control border-start-0 @error('name') is-invalid @enderror" 
                                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Tu nombre completo">
                                    </div>
                                    @error('name')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-envelope text-muted"></i>
                                        </span>
                                        <input id="email" type="email" class="form-control border-start-0 @error('email') is-invalid @enderror" 
                                            name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="email@ejemplo.com">
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <!-- Teléfono (opcional, si quieres añadirlo) -->
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Teléfono (opcional)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-phone text-muted"></i>
                                        </span>
                                        <input id="phone" type="tel" class="form-control border-start-0 @error('phone') is-invalid @enderror" 
                                            name="phone" value="{{ old('phone') }}" autocomplete="tel" placeholder="Tu número de teléfono">
                                    </div>
                                    @error('phone')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <!-- Contraseña -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-lock text-muted"></i>
                                        </span>
                                        <input id="password" type="password" class="form-control border-start-0 @error('password') is-invalid @enderror" 
                                            name="password" required autocomplete="new-password" placeholder="Mínimo 8 caracteres">
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
                                
                                <!-- Confirmar Contraseña -->
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-lock text-muted"></i>
                                        </span>
                                        <input id="password_confirmation" type="password" class="form-control border-start-0" 
                                            name="password_confirmation" required autocomplete="new-password" placeholder="Repite tu contraseña">
                                    </div>
                                </div>
                                
                                <!-- Términos y condiciones -->
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror" id="terms" name="terms" required>
                                    <label class="form-check-label" for="terms">
                                        Acepto los <a href="#" class="text-decoration-none">Términos y Condiciones</a> y la <a href="#" class="text-decoration-none">Política de Privacidad</a>
                                    </label>
                                    @error('terms')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <!-- Botones de acción -->
                                <div class="d-grid gap-2 mb-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-user-plus me-2"></i>Crear Cuenta
                                    </button>
                                </div>
                                
                                <!-- Login -->
                                <div class="text-center mb-3">
                                    <p class="mb-0">¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-decoration-none fw-medium">Inicia sesión aquí</a></p>
                                </div>
                                
                                <!-- Separador -->
                                <div class="d-flex align-items-center my-4">
                                    <hr class="flex-grow-1">
                                    <span class="px-2 text-muted small text-uppercase">o regístrate con</span>
                                    <hr class="flex-grow-1">
                                </div>
                                
                                <!-- Botones de redes sociales -->
                                <div class="d-grid gap-2">
                                    <a href="{{ route('calendar.login') }}" class="btn btn-outline-secondary">
                                        <img src="https://www.google.com/favicon.ico" alt="Google" class="me-2" height="16">
                                        Registrarse con Google
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
                    Al registrarte, aceptas recibir correos electrónicos de marketing. Puedes cancelar la suscripción en cualquier momento.
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