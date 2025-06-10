@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-md-8 mx-auto text-center">
            <h2 class="display-4 mb-3">Nuestros Servicios</h2>
            <p class="lead text-muted">Descubre nuestra amplia gama de servicios diseñados para realzar tu belleza natural</p>
        </div>
    </div>

    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Categorías de servicios --}}
    <div class="mb-4">
        <ul class="nav nav-pills justify-content-center mb-5">
            <li class="nav-item mx-1">
                <a class="nav-link active" href="#todos">Todos los servicios</a>
            </li>
            <li class="nav-item mx-1">
                <a class="nav-link" href="#cortes">Cortes</a>
            </li>
            <li class="nav-item mx-1">
                <a class="nav-link" href="#color">Color</a>
            </li>
            <li class="nav-item mx-1">
                <a class="nav-link" href="#tratamientos">Tratamientos</a>
            </li>
        </ul>
    </div>

    {{-- Servicios en tarjetas --}}
    <div class="row g-4">
        @forelse ($services as $service)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm hover-shadow transition">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title mb-0">{{ $service->service_name }}</h5>
                            <span class="badge bg-primary rounded-pill">{{ $service->price }}€</span>
                        </div>
                        <p class="card-text text-muted">{{ $service->description }}</p>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">Duración aprox: 60 min</small>
                            <a href="{{ route('appointments.create') }}" class="btn btn-outline-primary btn-sm">Reservar</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="py-5">
                    <i class="fas fa-scissors fa-3x text-muted mb-3"></i>
                    <h4>No hay servicios disponibles en este momento</h4>
                    <p class="text-muted">Por favor, vuelve a consultar más tarde.</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Información adicional --}}
    <div class="row mt-5 pt-5 border-top">
        <div class="col-md-6 mb-4">
            <h3 class="h4 mb-4">Preguntas frecuentes</h3>
            <div class="accordion" id="accordionFAQ">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            ¿Necesito reservar cita?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionFAQ">
                        <div class="accordion-body">
                            Sí, recomendamos reservar cita con antelación para garantizar la disponibilidad de nuestros estilistas y evitar tiempos de espera.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            ¿Qué incluye una consulta de color?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionFAQ">
                        <div class="accordion-body">
                            Nuestra consulta de color incluye un análisis detallado del tono de piel, color de ojos y preferencias personales para recomendar el mejor color para tu cabello.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            ¿Ofrecen descuentos para estudiantes?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionFAQ">
                        <div class="accordion-body">
                            Sí, ofrecemos un 10% de descuento para estudiantes con identificación válida, de lunes a jueves.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <h3 class="h4 mb-4">Nuestro compromiso</h3>
            <div class="d-flex mb-3">
                <div class="me-3">
                    <i class="fas fa-check-circle text-success fs-4"></i>
                </div>
                <div>
                    <h5>Productos de calidad</h5>
                    <p class="text-muted">Utilizamos solo productos de alta calidad y respetuosos con el medio ambiente.</p>
                </div>
            </div>
            <div class="d-flex mb-3">
                <div class="me-3">
                    <i class="fas fa-check-circle text-success fs-4"></i>
                </div>
                <div>
                    <h5>Estilistas profesionales</h5>
                    <p class="text-muted">Nuestro equipo está formado por profesionales con amplia experiencia y formación continua.</p>
                </div>
            </div>
            <div class="d-flex mb-3">
                <div class="me-3">
                    <i class="fas fa-check-circle text-success fs-4"></i>
                </div>
                <div>
                    <h5>Satisfacción garantizada</h5>
                    <p class="text-muted">Tu satisfacción es nuestra prioridad, y nos esforzamos para superar tus expectativas en cada visita.</p>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Call to action --}}
    <div class="text-center mt-5 py-4 bg-light rounded-3">
        <h3 class="mb-3">¿Listo para renovar tu look?</h3>
        <p class="mb-4">Reserva tu cita hoy y déjate asesorar por nuestros profesionales</p>
        <a href="{{ route('appointments.create') }}" class="btn btn-primary btn-lg px-4">Reservar cita</a>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .transition {
        transition: all 0.3s ease;
    }
</style>
@endpush
@endsection
