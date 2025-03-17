@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4 text-center">Conoce a Nuestros Estilistas</h2>
        <p class="text-muted text-center mb-4">Descubre a los profesionales que se encargan de brindarte la mejor experiencia.</p>

        {{-- Tabla de estilistas --}}
        <table class="table table-bordered shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Nombre del Estilista</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($stylists as $stylist)
                    <tr>
                        <td class="fw-bold">{{ $stylist->stylist_name }}</td>
                        <td>{{ $stylist->description }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center text-muted">No hay estilistas disponibles por el momento.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="text-center mt-4">
            <a href="{{ route('services.index') }}" class="btn btn-primary">Ver Nuestros Servicios</a>
        </div>
    </div>
@endsection
