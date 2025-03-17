@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Añadir Nuevo Estilista</h2>

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
        <form action="{{ route('stylists.store') }}" method="POST">
            @csrf

            {{-- Nombre del estilista --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nombre del Estilista</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Ingresa el nombre del estilista"
                    required>
            </div>
            
            {{-- Descripción del estilista --}}
            <div class="mb-3">
                <label for="description" class="form-label">Descripción del Estilista</label>
                <textarea class="form-control" id="description" name="description" rows="3"
                    placeholder="Escribe una breve descripción del estilista" required></textarea>
            </div>

            {{-- Botón de envío --}}
            <button type="submit" class="btn btn-primary">Guardar Estilista</button>
            <a href="{{ route('stylists.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection