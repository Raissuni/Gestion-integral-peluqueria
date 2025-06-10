@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <h2 class="display-4 mb-3">Nuestro Equipo</h2>
            <p class="lead text-muted mb-4">Profesionales apasionados y con talento, comprometidos con tu belleza y bienestar</p>
        </div>
    </div>

    <!-- Imagen de equipo destacada -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="position-relative rounded overflow-hidden shadow-sm">
                <img src="https://images.unsplash.com/photo-1560066984-138dadb4c035?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80" class="img-fluid w-100" alt="Equipo de profesionales">
                <div class="position-absolute bottom-0 start-0 p-4 p-md-5 text-white" style="background: linear-gradient(to top, rgba(0,0,0,0.7), rgba(0,0,0,0));">
                    <h3 class="h2 mb-2">Un equipo con experiencia</h3>
                    <p class="mb-0">Nuestros estilistas combinan creatividad, técnica y pasión para lograr resultados excepcionales.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Estilistas -->
    <div class="row g-4 mb-5">
        @forelse ($stylists as $stylist)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="position-relative">
                        <!-- Placeholder para imagen de estilista, en un sistema real cada estilista tendría su propia foto -->
                        <img src="https://randomuser.me/api/portraits/men/{{ ($loop->iteration * 7) % 99 }}.jpg" class="card-img-top" alt="{{ $stylist->stylist_name }}">

                        <div class="position-absolute top-0 end-0 p-2">
                            <span class="badge bg-primary">{{ $loop->iteration > 2 ? 'Estilista' : 'Master Stylist' }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title mb-1">{{ $stylist->stylist_name }}</h5>
                        <p class="text-muted small mb-3">{{ $loop->iteration > 2 ? 'Estilista Profesional' : 'Director Creativo' }}</p>
                        <p class="card-text">{{ $stylist->description }}</p>
                        
                        <div class="mt-3">
                            <h6 class="mb-2">Especialidades:</h6>
                            <div class="d-flex flex-wrap gap-1">
                                @foreach(explode(',', 'Corte,Color,Peinados,Tratamientos') as $index => $especialidad)
                                    @if($loop->iteration % ($index+2) != 0)
                                        <span class="badge bg-light text-dark border">{{ $especialidad }}</span>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0 pt-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-warning mb-1">
                                    @for($i = 0; $i < 5; $i++)
                                        <i class="fas fa-star{{ $i >= 4 ? '-half-alt' : '' }}"></i>
                                    @endfor
                                </div>
                                <small class="text-muted">{{ rand(50, 150) }} reseñas</small>
                            </div>
                            <a href="{{ route('appointments.create', ['stylist_id' => $stylist->id]) }}" class="btn btn-sm btn-outline-primary">Reservar cita</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="py-5">
                    <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                    <h4>No hay estilistas disponibles por el momento</h4>
                    <p class="text-muted">Estamos en proceso de ampliar nuestro equipo.</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Testimonios de clientes -->
    <div class="row mb-5">
        <div class="col-12 text-center mb-4">
            <h3 class="h2">Lo que dicen nuestros clientes</h3>
            <p class="text-muted">Descubre por qué nuestros clientes confían en nosotros</p>
        </div>
        
        <div class="col-md-4 mb-4 mb-md-0">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://randomuser.me/api/portraits/women/33.jpg" class="rounded-circle me-3" width="60" height="60" alt="Cliente">
                        <div>
                            <h6 class="mb-0">María García</h6>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="card-text fst-italic">"¡Mi experiencia fue increíble! El estilista entendió exactamente lo que quería y el resultado superó mis expectativas. Sin duda volveré."</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4 mb-md-0">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://randomuser.me/api/portraits/men/45.jpg" class="rounded-circle me-3" width="60" height="60" alt="Cliente">
                        <div>
                            <h6 class="mb-0">Carlos Rodríguez</h6>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <p class="card-text fst-italic">"Ambiente agradable, profesionales cualificados y un resultado perfecto. El servicio es rápido y el precio muy razonable."</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://randomuser.me/api/portraits/women/67.jpg" class="rounded-circle me-3" width="60" height="60" alt="Cliente">
                        <div>
                            <h6 class="mb-0">Laura Martínez</h6>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="card-text fst-italic">"He probado muchas peluquerías, pero esta es sin duda la mejor. Los tratamientos capilares son fantásticos y el personal es muy amable."</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-light p-4 p-md-5 rounded-3 text-center">
        <h3 class="mb-3">¿Listo para descubrir la diferencia?</h3>
        <p class="lead mb-4">Reserva tu cita ahora y déjate transformar por los mejores profesionales</p>
        <a href="{{ route('appointments.create') }}" class="btn btn-primary btn-lg px-4">Reservar cita</a>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .card {
        transition: all 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
</style>
@endpush
@endsection