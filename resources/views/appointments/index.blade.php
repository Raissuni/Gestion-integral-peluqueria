@extends('layouts.app')
@section('title', 'Citas')
@section('content')
    <div class="container py-4">
        <h1 class="text-center mb-4">Tus Citas</h1>

        @if($appointments->isEmpty())
            <div class="alert alert-info text-center" role="alert">
                No tienes citas programadas. <a href="{{ route('appointments.create') }}" class="alert-link">Reserva una ahora</a>.
            </div>
        @else
            <div class="row">
                @foreach($appointments as $appointment)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm mb-4">
                            <div class="card-body">
                                <h5 class="card-title text-primary">{{ $appointment->service->name }}</h5>
                                <p class="card-text">
                                    <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y H:i') }}<br>
                                    <strong>Estilista:</strong> {{ $appointment->stylist->name }}
                                </p>
                                <div class="d-flex justify-content-between">
                                    
                                    <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres cancelar esta cita?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Cancelar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
