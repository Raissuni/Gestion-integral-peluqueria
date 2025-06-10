@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Reservar una Cita</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
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

        {{-- SELECCIONAR FECHA --}}
        <div class="mb-3">
            <label for="date" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="date" name="date" required min="{{ date('Y-m-d') }}">
        </div>

        {{-- SELECCIONAR HORA --}}
        <div class="mb-3">
            <label for="time" class="form-label">Hora Disponible</label>
            <select class="form-control" id="time" name="time" required>
                <option value="">-- Primero selecciona fecha y estilista --</option>
            </select>
        </div>

        {{-- Google Calendar Integration --}}
        <div class="form-group mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="add_to_google_calendar" id="add_to_google_calendar" checked>
                <label class="form-check-label" for="add_to_google_calendar">
                    Añadir cita a Google Calendar
                </label>
            </div>
            @if(Auth::user()->token)
                <small class="text-success">✓ Conectado a Google Calendar</small>
            @else
                <small class="text-warning">⚠ No conectado a Google Calendar</small>
                <a href="{{ route('calendar.login') }}" class="btn btn-sm btn-outline-primary ms-2">
                    <i class="fas fa-calendar-alt"></i> Conectar con Google Calendar
                </a>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-calendar-check"></i> Agendar Cita
        </button>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stylistSelect = document.getElementById('stylist_id');
    const dateInput = document.getElementById('date');
    const timeSelect = document.getElementById('time');

    async function updateAvailableSlots() {
        const stylistId = stylistSelect.value;
        const date = dateInput.value;

        if (!stylistId || !date) {
            timeSelect.disabled = true;
            timeSelect.innerHTML = '<option value="">-- Primero selecciona fecha y estilista --</option>';
            return;
        }

        try {
            timeSelect.disabled = true;
            timeSelect.innerHTML = '<option value="">Cargando horarios disponibles...</option>';

            const response = await fetch(`/appointments/available-slots?stylist_id=${stylistId}&date=${date}`);
            if (!response.ok) {
                throw new Error('Error al cargar horarios');
            }

            const data = await response.json();
            timeSelect.innerHTML = '';

            if (data.slots && data.slots.length > 0) {
                data.slots.forEach(slot => {
                    const option = document.createElement('option');
                    option.value = slot;
                    option.textContent = slot;
                    timeSelect.appendChild(option);
                });
                timeSelect.disabled = false;
            } else {
                timeSelect.innerHTML = '<option value="">No hay horarios disponibles</option>';
                timeSelect.disabled = true;
            }
        } catch (error) {
            console.error('Error:', error);
            timeSelect.innerHTML = '<option value="">Error al cargar horarios</option>';
            timeSelect.disabled = true;
        }
    }

    stylistSelect.addEventListener('change', updateAvailableSlots);
    dateInput.addEventListener('change', updateAvailableSlots);
});
</script>
@endpush

@endsection
