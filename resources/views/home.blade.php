@extends('layouts.app')
@section('title', 'Inicio')
@section('content')

<div class="container text-center py-5">
    <div class="hero-section bg-dark text-white rounded-3 p-5 mb-5">
        <h1 class="display-4 fw-bold">¡Bienvenido a Nuestra Peluquería!</h1>
        <p class="lead">Transforma tu estilo con los mejores servicios y estilistas de la ciudad.</p>
        <a href="{{ route('appointments.create') }}" class="btn btn-primary btn-lg mt-3">Reserva tu Cita Ahora</a>
    </div>

    <section class="services-section my-5">
        <h2 class="mb-4">Nuestros Servicios</h2>
        <div class="row">
            @foreach ($services as $service)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $service->service_name }}</h5>
                            <p class="card-text">{{ Str::limit($service->description, 100) }}</p>
                            <p class="fw-bold text-primary">Desde {{ $service->price }}€</p>
                            <a href="{{ route('services.index') }}" class="btn btn-outline-primary">Más Información</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="about-section my-5">
        <h2 class="mb-4">¿Por qué Elegirnos?</h2>
        <p>
            Nuestra peluquería ofrece una experiencia única que combina profesionalismo, atención al detalle y
            un ambiente acogedor. Contamos con:
        </p>
        <ul class="list-group list-group-flush text-start">
            <li class="list-group-item">✔️ Los mejores productos para el cuidado de tu cabello.</li>
            <li class="list-group-item">✔️ Estilistas con amplia experiencia y formación continua.</li>
            <li class="list-group-item">✔️ Servicios personalizados para satisfacer todas tus necesidades.</li>
            <li class="list-group-item">✔️ Precios competitivos sin comprometer la calidad.</li>
        </ul>
    </section>

    <section class="contact-section my-5 bg-light rounded-3 p-4">
        <h2 class="mb-4">Contáctanos</h2>
        <p>Si tienes preguntas o necesitas ayuda, no dudes en comunicarte con nosotros:</p>
        <a href="{{ route('user.contact') }}" class="btn btn-success">Escríbenos</a>
    </section>
</div>

@endsection
