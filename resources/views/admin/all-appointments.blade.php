@extends('layouts.app')

@section('title', 'Citas de ' . $stylist->stylist_name)

@section('content')
    <div class="container py-4">
        <h1 class="text-center mb-4">Citas de {{ $stylist->stylist_name }}</h1>

        <!-- Filtro de búsqueda -->
        <form method="GET" action="{{ route('admin.stylist.appointments', $stylist->id) }}" class="mb-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <input type="text" name="client" value="{{ request('client') }}" placeholder="Buscar por cliente..."
                    class="p-2 border border-gray-300 rounded">

                <input type="date" name="date" value="{{ request('date') }}" class="p-2 border border-gray-300 rounded">

                <button type="submit" class="btn btn-primary">
                    Filtrar
                </button>
            </div>
        </form>

        <!-- Tabla de citas -->
        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="min-w-full table-auto text-sm">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="p-3 text-left">Cliente</th>
                        <th class="p-3 text-left">Fecha</th>
                        <th class="p-3 text-left">Servicio</th>
                        <th class="p-3 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $appointment)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-3">{{ $appointment->user->name ?? 'Sin Cliente' }}</td>
                            <td class="p-3">{{ $appointment->date->format('d/m/Y H:i') }}</td>
                            <td class="p-3">{{ $appointment->service->service_name ?? 'Sin Servicio' }}</td>
                            <td class="p-3">
                                <form method="POST" action="{{ route('appointments.destroy', $appointment->id) }}"
                                    onsubmit="return confirm('¿Estás seguro de eliminar esta cita?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">
                                        Eliminar
                                    </button>

                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500">No hay citas para este estilista</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Botón para regresar -->
        <div class="mt-4">
            <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline text-sm">
                ← Volver al panel de administración
            </a>
        </div>
    </div>
@endsection