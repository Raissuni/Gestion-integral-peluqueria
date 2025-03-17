@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Reservar una Cita</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf

        {{-- SELECCIONAR SERVICIO --}}
        <div class="mb-3">
            <label for="service_id" class="form-label">Selecciona un servicio</label>
             <select class="form-control" id="service_id" name="service_id" required>
                <option value="">-- Selecciona un servicio --</option>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}">{{ $service->service_name}}     {{ $service->price}}€</option>
                @endforeach
            </select> 
        </div>

        {{-- SELECCIONAR ESTILISTA --}}
        <div class="mb-3">
            <label for="stylist_id" class="form-label">Selecciona un estilista</label>
             <select class="form-control" id="stylist_id" name="stylist_id" required>
                <option value="">-- Selecciona un estilista --</option>
                @foreach ($stylists as $stylist)
                    <option value="{{ $stylist->id }}">{{ $stylist->stylist_name }}</option>
                @endforeach
            </select> 
        </div>

        {{-- SELECCIONAR FECHA Y HORA --}}
        <div class="mb-3">
            <label for="date" class="form-label">Fecha y Hora</label>
            <input type="datetime-local" class="form-control" id="date" name="date" required>
        </div>

        <button type="submit" class="btn btn-primary">Agendar Cita</button>
    </form>
</div>
@endsection
