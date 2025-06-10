@extends('layouts.app')

@section('title', 'Estadísticas')

@section('content')
<div class="container mx-auto py-10 px-6">
    <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">📊 Estadísticas del Salón</h1>

    <div class="flex justify-end mb-10">
    <form method="GET" action="{{ route('admin.estadisticas') }}" class="bg-white shadow-md rounded-xl px-5 py-4 flex items-center space-x-4">
        <label for="range" class="text-gray-800 font-semibold">Periodo:</label>
        <select name="range" id="range" class="rounded-lg border border-gray-300 text-gray-700 px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-500 transition duration-150 ease-in-out">
            <option value="1" {{ request('range') == '1' ? 'selected' : '' }}>🗓️ Último mes</option>
            <option value="6" {{ request('range') == '6' ? 'selected' : '' }}>📆 Últimos 6 meses</option>
            <option value="12" {{ request('range') == '12' ? 'selected' : '' }}>📅 Último año</option>
        </select>
        <button type="submit" class="btn btn-primary btn-lg">
            🔄 Aplicar
        </button>
    </form>
</div>



    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
        <!-- Clientes más fieles -->
        <div class="bg-white shadow-lg rounded-2xl p-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">👥 Clientes más fieles</h2>
            <ul>
                @foreach($topClients as $client)
                    <li class="flex justify-between py-2 border-b last:border-b-0">
                        <span>{{ $client->name }}</span>
                        <span class="text-gray-500">{{ $client->appointments_count }} citas</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Estilistas más demandados -->
        <div class="bg-white shadow-lg rounded-2xl p-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">💇‍♂️ Estilistas más demandados</h2>
            <ul>
                @foreach($topStylists as $stylist)
                    <li class="flex justify-between py-2 border-b last:border-b-0">
                        <span>{{ $stylist->stylist_name }}</span>
                        <span class="text-gray-500">{{ $stylist->appointments_count }} citas</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8 mt-8">
        <!-- Servicios más solicitados -->
        <div class="bg-white shadow-lg rounded-2xl p-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">💅 Servicios más solicitados</h2>
            <ul>
                @foreach($topServices as $service)
                    <li class="flex justify-between py-2 border-b last:border-b-0">
                        <span>{{ $service->service_name }}</span>
                        <span class="text-gray-500">{{ $service->appointments_count }} citas</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Horas de más afluencia -->
        <div class="bg-white shadow-lg rounded-2xl p-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">🕒 Horas de más afluencia</h2>
            <ul>
                @foreach($peakHours as $hour)
                    <li class="flex justify-between py-2 border-b last:border-b-0">
                        <span>{{ str_pad($hour->hour, 2, '0', STR_PAD_LEFT) }}:00</span>
                        <span class="text-gray-500">{{ $hour->count }} citas</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
