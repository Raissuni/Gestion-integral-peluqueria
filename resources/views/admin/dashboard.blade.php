<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white flex flex-col">
            <div class="p-4 text-xl font-bold">Admin Panel</div>
            <nav class="flex-1">
                <ul>
                    <li class="p-3 hover:bg-gray-700"><a href="{{ route('home') }}">Home</a></li>
                    <li class="p-3 hover:bg-gray-700"><a href="{{ route('appointments.index') }}">Citas</a></li>
                    <li class="p-3 hover:bg-gray-700"><a href="{{ route('stylists.index') }}">Estilistas</a></li>
                    <li class="p-3 hover:bg-gray-700"><a href="{{ route('services.index') }}">Servicios</a></li>
                     <li class="p-3 hover:bg-gray-700"><a href="{{ route('admin.mensaje') }}">Mensajes</a></li> 
                    {{-- <li class="p-3 hover:bg-gray-700"><a href="{{ route('contact') }}">Mensajes</a></li> --}}
                </ul>
            </nav>
            <div class="p-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-red-600 p-2 rounded hover:bg-red-700">Cerrar Sesión</button>
                </form>
            </div>
        </aside>

        <!-- Contenido Principal -->
        <main class="flex-1 p-6">
            <header class="mb-6 flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Bienvenido, {{ auth()->user()->name }}</h1>
                    <p class="text-gray-600">Panel de administración</p>
                </div>
                <div class="space-x-2">
                    <a href="{{ route('appointments.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">➕ Crear Cita</a>
                    <a href="{{ route('stylists.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Añadir Estilista 💇🏻‍♂️</a>
                    <a href="{{ route('services.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Añadir Servicio ✂️</a>
                </div>
            </header>

            <!-- Tarjetas de resumen -->
            <div class="grid grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold text-gray-700">Total Citas</h2>
                    <p class="text-2xl font-bold">{{ $appointmentsCount ?? '0' }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold text-gray-700">Estilistas</h2>
                    <p class="text-2xl font-bold">{{ $stylistsCount ?? '0' }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold text-gray-700">Mensajes</h2>
                    <p class="text-2xl font-bold">{{ $messagesCount ?? '0' }}</p>
                </div>
            </div>

            <!-- Últimas Citas -->
            <div class="mt-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Últimas Citas</h2>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-2">Cliente</th>
                                <th class="p-2">Fecha</th>
                                <th class="p-2">Servicio</th>
                                <th class="p-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($appointments as $appointment)
                                <tr class="border-b">
                                    <td class="p-2">{{ $appointment->user->name ?? 'Sin Cliente' }}</td>
                                    <td class="p-2">{{ $appointment->date }}</td>
                                    <td class="p-2">{{ $appointment->service->name ?? 'Sin Servicio' }}</td>
                                    <td class="p-2">
                                        <!-- Botón para eliminar -->
                                        <form method="POST" action="{{ route('appointments.destroy', $appointment->id) }}" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta cita?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-4 text-center">No hay citas recientes</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
            </div>
        </main>
    </div>
</body>
</html>
