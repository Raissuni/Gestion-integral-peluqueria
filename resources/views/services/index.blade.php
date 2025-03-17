@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Nuestros Servicios</h2>

    {{-- Mensaje de éxito (opcional, por si algún proceso lo redirige aquí con mensaje) --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabla de Servicios --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre del Servicio</th>
                <th>Descripción</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($services as $service)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $service->service_name }}</td>
                    <td>{{ $service->description }}</td>
                    <td>{{ $service->price }}€</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No hay servicios disponibles en este momento.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
