@extends('layouts.app')
@section('title', 'Contacto')
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6 mb-4 mb-md-0">
            <h2 class="display-5 mb-4">Contacto</h2>
            <p class="lead mb-4">Estamos aquí para ayudarte. No dudes en contactarnos para cualquier consulta o reserva.</p>
            
            <!-- Información de contacto -->
            <div class="mb-4">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-map-marker-alt me-3 text-primary fs-5"></i>
                    <span>Calle Principal 123, 28001 Madrid</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-phone me-3 text-primary fs-5"></i>
                    <span>+34 91 123 4567</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-envelope me-3 text-primary fs-5"></i>
                    <span>info@peluqueria.com</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-clock me-3 text-primary fs-5"></i>
                    <span>Lunes a Sábado: 9:00 - 20:00</span>
                </div>
            </div>
            
            <!-- Redes sociales -->
            <div class="mb-4">
                <h5 class="mb-3">Síguenos en redes sociales</h5>
                <div class="d-flex">
                    <a href="#" class="me-3 text-primary fs-4"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="me-3 text-primary fs-4"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="me-3 text-primary fs-4"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h4 class="card-title mb-4">Envíanos un mensaje</h4>
                    
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <form action="/contact" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Tu nombre" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Tu email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="phone" class="form-label">Teléfono (opcional)</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Tu teléfono" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="message" class="form-label">Mensaje</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" placeholder="Tu mensaje" required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">Enviar mensaje</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Mapa de Google -->
    <div class="mt-5">
        <h4 class="mb-3">Nuestra ubicación</h4>
        <div class="ratio ratio-21x9">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3037.6057936722953!2d-3.7031398846047457!3d40.416889679365896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd422997800a3c81%3A0xc436dec1618c2269!2sPuerta%20del%20Sol%2C%20Madrid!5e0!3m2!1ses!2ses!4v1653324612776!5m2!1ses!2ses" 
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush
@endsection