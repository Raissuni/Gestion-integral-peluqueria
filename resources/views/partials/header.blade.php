<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="position: sticky;">
    <div class="container">
        <a class="navbar-brand" href="/">TrendsCuts</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/services">Servicios</a></li>
                <li class="nav-item"><a class="nav-link" href="/appointments">Citas</a></li>
                <li class="nav-item"><a class="nav-link" href="/stylists">Equipo</a></li>
                <li class="nav-item"><a class="nav-link" href="contacto/contact">Contacto</a></li>
                @guest
                <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                @else
                {{-- Mostrar el botón "Panel Administrador" solo si el usuario es administrador --}}
                @if (auth()->check() && auth()->user()->is_admin)
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-white ms-2" href="{{ route('admin.dashboard') }}">
                            Panel Administrador
                        </a>
                    </li>
                @endif
                {{-- Botón de cerrar sesión --}}
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <li class="nav-item">
                        <button type="submit" class="nav-link btn btn-link" style="border: none; background: none; cursor: pointer;">Cerrar Sesión</button>
                    </li>
                </form>
                @endguest
            </ul>
        </div>
    </div>
</nav>
