@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Añadir Nuevo Servicio</h2>

    {{-- Mensajes de error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario de creación --}}
    <form action="{{ route('services.store') }}" method="POST">
        @csrf

        {{-- Nombre del servicio --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Servicio</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        {{-- Descripción del servicio --}}
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>

        {{-- Precio del servicio --}}
        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>

        {{-- Botón de envío --}}
        <button type="submit" class="btn btn-primary">Guardar Servicio</button>
        <a href="{{ route('services.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
