@extends('layouts.app')
@section('title', 'Inicio')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        .hero-btn {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .hero-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .feature-card {
            transition: all 0.3s ease;
            border: none;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .service-item {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .service-item:hover {
            transform: translateY(-5px);
        }

        .testimonial-card {
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            transform: scale(1.03);
        }

        .section-heading {
            position: relative;
            display: inline-block;
            margin-bottom: 2rem;
        }

        .section-heading:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: var(--bs-primary);
        }

        .counter-item {
            text-align: center;
            padding: 2rem 1rem;
            border-radius: 10px;
        }

        .counter-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            background: linear-gradient(45deg, var(--bs-primary), var(--bs-info));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
@endpush

@section('content')

    {{-- Hero Section con Video --}}
    <div class="position-relative" style="height: 100vh; overflow: hidden;">
        <video autoplay muted loop playsinline class="position-absolute top-0 start-0 w-100 h-100"
            style="object-fit: cover; z-index: -2;">
            <source src="{{ asset('videos/VIDEO.mp4') }}" type="video/mp4">
            Tu navegador no soporta la reproducción de video.
        </video>
        {{-- Overlay con gradiente --}}
        <div class="position-absolute top-0 start-0 w-100 h-100"
            style="background: linear-gradient(to right, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.4) 100%); z-index: -1;"></div>

        <div class="container h-100 d-flex align-items-center">
            <div class="row w-100">
                <div class="col-lg-7 text-white animate__animated animate__fadeInLeft">
                    <h1 class="display-3 fw-bold mb-3">Descubre Tu Estilo Perfecto</h1>
                    <p class="lead fs-4 mb-4">En nuestra peluquería, transformamos tu imagen y te ayudamos a expresar tu
                        verdadera personalidad a través de tu estilo.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('appointments.create') }}" class="btn btn-primary btn-lg hero-btn">
                            <i class="fas fa-calendar-alt me-2"></i>Reservar Cita
                        </a>
                        <a href="{{ route('services.index') }}" class="btn btn-outline-light btn-lg hero-btn">
                            <i class="fas fa-list me-2"></i>Ver Servicios
                        </a>
                    </div>
                    <div class="mt-5 d-flex gap-4">
                        <div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-star text-warning me-2"></i>
                                <span class="fs-5 fw-bold">4.9</span>
                            </div>
                            <span class="text-white-50">Valoración</span>
                        </div>
                        <div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-users text-warning me-2"></i>
                                <span class="fs-5 fw-bold">2500+</span>
                            </div>
                            <span class="text-white-50">Clientes</span>
                        </div>
                        <div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-award text-warning me-2"></i>
                                <span class="fs-5 fw-bold">15+</span>
                            </div>
                            <span class="text-white-50">Años</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Flecha de scroll --}}
        <div
            class="position-absolute bottom-0 start-50 translate-middle-x mb-4 animate__animated animate__fadeInUp animate__delay-1s">
            <a href="#about" class="text-white">
                <i class="fas fa-chevron-down fa-2x" style="animation: bounce 2s infinite;"></i>
            </a>
        </div>
    </div>

    {{-- Sobre Nosotros con diseño mejorado --}}
    <section id="about" class="py-5 my-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="position-relative">

                        <!-- Círculo de experiencia: Z-index alto -->
                        <div class="position-absolute top-0 start-0 translate-middle bg-primary text-white p-4 rounded-circle shadow-lg d-none d-md-flex align-items-center justify-content-center"
                            style="width: 130px; height: 130px; z-index: 10;">
                            <div class="text-center">
                                <span class="d-block fw-bold" style="font-size: 1.5rem;">15+</span>
                                <span class="small">AÑOS DE EXPERIENCIA</span>
                            </div>
                        </div>

                        <!-- Carrusel de imágenes -->
                        <div class="ratio ratio-1x1 rounded-4 overflow-hidden shadow-lg">
                            <div id="aboutCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel"
                                data-bs-interval="2000">
                                <div class="carousel-inner h-100">
                                    <div class="carousel-item active h-100">
                                        <img src="{{ asset('images/corte1.jpg') }}"
                                            class="d-block w-100 h-100 object-fit-cover" alt="Nuestro salón">
                                    </div>
                                    <div class="carousel-item h-100">
                                        <img src="{{ asset('images/corte3.jpg') }}"
                                            class="d-block w-100 h-100 object-fit-cover" alt="Nuestro salón">
                                    </div>
                                    <div class="carousel-item h-100">
                                        <img src="{{ asset('images/corte4.jpg') }}"
                                            class="d-block w-100 h-100 object-fit-cover" alt="Nuestro salón">
                                    </div>
                                    <div class="carousel-item h-100">
                                        <img src="{{ asset('images/corte2.jpg') }}"
                                            class="d-block w-100 h-100 object-fit-cover" alt="Nuestros servicios">
                                    </div>
                                    <div class="carousel-item h-100">
                                        <img src="{{ asset('images/corte5.jpg') }}"
                                            class="d-block w-100 h-100 object-fit-cover" alt="Nuestro equipo">
                                    </div>
                                    <div class="carousel-item h-100">
                                        <img src="{{ asset('images/imagen2.jpg') }}"
                                            class="d-block w-100 h-100 object-fit-cover" alt="Resultados">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 ps-lg-5">
                    <div class="mb-4">
                        <span class="badge bg-primary rounded-pill px-3 py-2 mb-2">Sobre Nosotros</span>
                        <h2 class="display-5 fw-bold mb-3">Más que una peluquería, una experiencia de belleza</h2>
                    </div>
                    <p class="lead mb-4">
                        En nuestra peluquería, combinamos arte, pasión y técnica para brindarte una experiencia única.
                        Nuestro equipo de profesionales está comprometido con tu satisfacción y bienestar.
                    </p>
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="fas fa-check-circle text-primary fa-2x"></i>
                                </div>
                                <div>
                                    <h5 class="mb-2">Estilistas certificados</h5>
                                    <p class="text-muted mb-0">Nuestro equipo se actualiza constantemente con las últimas
                                        tendencias.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="fas fa-check-circle text-primary fa-2x"></i>
                                </div>
                                <div>
                                    <h5 class="mb-2">Productos premium</h5>
                                    <p class="text-muted mb-0">Usamos solo los mejores productos para tu cabello y piel.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <a href="{{ route('stylists.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-users me-2"></i>Conoce al Equipo
                        </a>
                        <a href="{{ route('user.contact') }}" class="btn btn-outline-dark">
                            <i class="fas fa-phone-alt me-2"></i>Contáctanos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Estadísticas en contadores --}}
    <section class="bg-light py-5">
        <div class="container">
            <div class="row g-3">
                <div class="col-6 col-md-3">
                    <div class="counter-item bg-white shadow-sm">
                        <i class="fas fa-cut fa-2x text-primary mb-3"></i>
                        <div class="counter-number" data-count="14820">0</div>
                        <p class="mb-0 text-uppercase fw-bold">Servicios Realizados</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="counter-item bg-white shadow-sm">
                        <i class="fas fa-medal fa-2x text-primary mb-3"></i>
                        <div class="counter-number" data-count="8">0</div>
                        <p class="mb-0 text-uppercase fw-bold">Premios Ganados</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="counter-item bg-white shadow-sm">
                        <i class="fas fa-user-tie fa-2x text-primary mb-3"></i>
                        <div class="counter-number" data-count="4">0</div>
                        <p class="mb-0 text-uppercase fw-bold">Profesionales</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="counter-item bg-white shadow-sm">
                        <i class="fas fa-user-tie fa-2x text-primary mb-3"></i>
                        <div class="counter-number" data-count="10">0</div>
                        <p class="mb-0 text-uppercase fw-bold">Servicios</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ¿Por qué elegirnos? --}}
    <section class="features-section py-5 my-5">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-primary rounded-pill px-3 py-2 mb-2">Nuestros Valores</span>
                <h2 class="section-heading display-5 fw-bold">¿Por qué Elegirnos?</h2>
                <p class="lead text-muted mx-auto" style="max-width: 700px;">Descubre lo que nos distingue y por qué somos
                    la elección preferida para cuidar de tu imagen y belleza.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card feature-card h-100 rounded-4 shadow-sm p-4 text-center">
                        <div class="icon-wrapper mx-auto mb-4 rounded-circle bg-primary bg-opacity-10 p-3"
                            style="width: 80px; height: 80px;">
                            <i class="fas fa-award fa-2x text-primary"></i>
                        </div>
                        <h5 class="card-title">Productos Premium</h5>
                        <p class="card-text text-muted">Utilizamos solo productos de alta calidad que cuidan y protegen tu
                            cabello a largo plazo.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card feature-card h-100 rounded-4 shadow-sm p-4 text-center">
                        <div class="icon-wrapper mx-auto mb-4 rounded-circle bg-primary bg-opacity-10 p-3"
                            style="width: 80px; height: 80px;">
                            <i class="fas fa-users fa-2x text-primary"></i>
                        </div>
                        <h5 class="card-title">Estilistas Expertos</h5>
                        <p class="card-text text-muted">Nuestro equipo cuenta con amplia experiencia y se capacita
                            constantemente en las últimas tendencias.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card feature-card h-100 rounded-4 shadow-sm p-4 text-center">
                        <div class="icon-wrapper mx-auto mb-4 rounded-circle bg-primary bg-opacity-10 p-3"
                            style="width: 80px; height: 80px;">
                            <i class="fas fa-magic fa-2x text-primary"></i>
                        </div>
                        <h5 class="card-title">Servicios Personalizados</h5>
                        <p class="card-text text-muted">Cada servicio se adapta a tus necesidades específicas y a tu tipo de
                            cabello y rostro.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card feature-card h-100 rounded-4 shadow-sm p-4 text-center">
                        <div class="icon-wrapper mx-auto mb-4 rounded-circle bg-primary bg-opacity-10 p-3"
                            style="width: 80px; height: 80px;">
                            <i class="fas fa-euro-sign fa-2x text-primary"></i>
                        </div>
                        <h5 class="card-title">Precios Competitivos</h5>
                        <p class="card-text text-muted">Ofrecemos la mejor relación calidad-precio en todos nuestros
                            servicios y tratamientos.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Servicios Destacados --}}
    <section class="services-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-primary rounded-pill px-3 py-2 mb-2">Nuestros Servicios</span>
                <h2 class="section-heading display-5 fw-bold">Servicios Destacados</h2>
                <p class="lead text-muted mx-auto" style="max-width: 700px;">Ofrecemos una amplia gama de servicios de
                    belleza para realzar tu imagen y estilo personal.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card service-item h-100 border-0 shadow-sm overflow-hidden">
                        <img src="{{ asset('images/corte1.jpg') }}" class="card-img-top" alt="Corte de Cabello"
                            style="height: 200px; object-fit: cover;">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-3">Corte de Cabello</h5>
                            <p class="card-text text-muted">Cortes personalizados adaptados a tu estilo, tipo de cabello y
                                forma de rostro.</p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="badge bg-primary rounded-pill px-3 py-2">Desde 20€</span>
                                <a href="{{ route('appointments.create') }}"
                                    class="btn btn-sm btn-outline-primary">Reservar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card service-item h-100 border-0 shadow-sm overflow-hidden">
                        <img src="{{ asset('images/corte2.jpg') }}" class="card-img-top" alt="Coloración"
                            style="height: 200px; object-fit: cover;">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-3">Coloración</h5>
                            <p class="card-text text-muted">Amplia gama de colores y técnicas para dar vida y personalidad a
                                tu cabello.</p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="badge bg-primary rounded-pill px-3 py-2">Desde 35€</span>
                                <a href="{{ route('appointments.create') }}"
                                    class="btn btn-sm btn-outline-primary">Reservar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card service-item h-100 border-0 shadow-sm overflow-hidden">
                        <img src="{{ asset('images/corte4.jpg') }}" class="card-img-top" alt="Tratamientos"
                            style="height: 200px; object-fit: cover;">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-3">Tratamientos Capilares</h5>
                            <p class="card-text text-muted">Hidratación, nutrición y reparación para mantener tu cabello
                                saludable y brillante.</p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="badge bg-primary rounded-pill px-3 py-2">Desde 25€</span>
                                <a href="{{ route('appointments.create') }}"
                                    class="btn btn-sm btn-outline-primary">Reservar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('services.index') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-list-ul me-2"></i>Ver Todos los Servicios
                </a>
            </div>
        </div>
    </section>

    {{-- Testimonios con diseño mejorado --}}
    <section class="testimonials-section py-5 my-5">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-primary rounded-pill px-3 py-2 mb-2">Testimonios</span>
                <h2 class="section-heading display-5 fw-bold">Lo Que Dicen Nuestros Clientes</h2>
                <p class="lead text-muted mx-auto" style="max-width: 700px;">Descubre las experiencias de quienes ya confían
                    en nosotros.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card testimonial-card h-100 border-0 shadow-sm p-4">
                        <div class="d-flex mb-4">
                            <img src="{{ asset('images/imagenicon.jpg') }}" class="rounded-circle"
                                style="width: 70px; height: 70px; object-fit: cover;" alt="Cliente 1">
                            <div class="ms-3">
                                <h5 class="mb-1">Pepe Martínez</h5>
                                <div class="text-warning mb-1">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <small class="text-muted">Cliente desde 2020</small>
                            </div>
                        </div>
                        <p class="card-text fst-italic">"Me encantó el trato, fueron muy profesionales y salí feliz con mi
                            nuevo look. La atención personalizada hace toda la diferencia. Sin duda, volveré a confiar en
                            ellos."</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card testimonial-card h-100 border-0 shadow-sm p-4">
                        <div class="d-flex mb-4">
                            <img src="{{ asset('images/imagenicon.jpg') }}" class="rounded-circle"
                                style="width: 70px; height: 70px; object-fit: cover;" alt="Cliente 2">
                            <div class="ms-3">
                                <h5 class="mb-1">Carlos Torres</h5>
                                <div class="text-warning mb-1">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <small class="text-muted">Cliente desde 2021</small>
                            </div>
                        </div>
                        <p class="card-text fst-italic">"Siempre vuelvo porque la atención es excelente y los resultados son
                            de 10. El ambiente es muy agradable y el equipo profesional y amable. Lo recomiendo sin
                            dudarlo."</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card testimonial-card h-100 border-0 shadow-sm p-4">
                        <div class="d-flex mb-4">
                            <img src="{{ asset('images/imagenicon.jpg') }}" class="rounded-circle"
                                style="width: 70px; height: 70px; object-fit: cover;" alt="Cliente 3">
                            <div class="ms-3">
                                <h5 class="mb-1">Juan Jiménez</h5>
                                <div class="text-warning mb-1">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <small class="text-muted">Cliente desde 2019</small>
                            </div>
                        </div>
                        <p class="card-text fst-italic">"Muy buena experiencia, desde que entras te hacen sentir como en
                            casa. Los tratamientos son excelentes y el resultado siempre supera mis expectativas. Un 10 en
                            todo."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Sección de contacto mejorada --}}
    <section class="contact-section py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <span class="badge bg-primary rounded-pill px-3 py-2 mb-2">Contacto</span>
                    <h2 class="display-5 fw-bold mb-3">¿Tienes alguna pregunta?</h2>
                    <p class="lead mb-4">Estamos aquí para ayudarte. No dudes en contactarnos para cualquier consulta o para
                        reservar tu cita.</p>

                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3 p-3 rounded-circle bg-primary bg-opacity-10">
                                <i class="fas fa-map-marker-alt text-primary"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Dirección</h5>
                                <p class="mb-0 text-muted">Calle Principal 123, 28001 Madrid</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3 p-3 rounded-circle bg-primary bg-opacity-10">
                                <i class="fas fa-phone text-primary"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Teléfono</h5>
                                <p class="mb-0 text-muted">+34 91 123 4567</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3 p-3 rounded-circle bg-primary bg-opacity-10">
                                <i class="fas fa-envelope text-primary"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Email</h5>
                                <p class="mb-0 text-muted">info@peluqueria.com</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="me-3 p-3 rounded-circle bg-primary bg-opacity-10">
                                <i class="fas fa-clock text-primary"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Horario</h5>
                                <p class="mb-0 text-muted">Lunes a Sábado: 9:00 - 20:00</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('user.contact') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-paper-plane me-2"></i>Enviar Mensaje
                        </a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="rounded-4 overflow-hidden shadow-sm">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3037.6057936722953!2d-3.7031398846047457!3d40.416889679365896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd422997800a3c81%3A0xc436dec1618c2269!2sPuerta%20del%20Sol%2C%20Madrid!5e0!3m2!1ses!2ses!4v1653324612776!5m2!1ses!2ses"
                            height="450" style="border:0; width: 100%;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Animación de contadores
                const counterElements = document.querySelectorAll('.counter-number');
                const animateCounter = function (element) {
                    const target = parseInt(element.getAttribute('data-count'));
                    const duration = 2000; // duración en milisegundos
                    const step = target / (duration / 16); // 16ms por frame (aprox 60fps)
                    let current = 0;

                    const updateCounter = function () {
                        current += step;
                        if (current < target) {
                            element.textContent = Math.ceil(current);
                            requestAnimationFrame(updateCounter);
                        } else {
                            element.textContent = target;
                        }
                    };

                    updateCounter();
                };

                // Opciones del observador de intersección
                const options = {
                    root: null,
                    rootMargin: '0px',
                    threshold: 0.1
                };

                // Crear observador de intersección
                const observer = new IntersectionObserver(function (entries, observer) {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            animateCounter(entry.target);
                            observer.unobserve(entry.target);
                        }
                    });
                }, options);

                // Observar cada elemento contador
                counterElements.forEach(counter => {
                    observer.observe(counter);
                });

                // Carousel automático para la sección About
                const aboutCarousel = document.getElementById('aboutCarousel');
                if (aboutCarousel) {
                    const carousel = new bootstrap.Carousel(aboutCarousel, {
                        interval: 2000,
                        wrap: true
                    });
                }

                // Función para saltar a slide específico desde miniatura
                window.jumpToSlide = function (index) {
                    const carousel = bootstrap.Carousel.getInstance(document.getElementById('galeriaCarousel'));
                    if (carousel) {
                        carousel.to(index);
                    }
                };
            });
        </script>
    @endpush
@endsection