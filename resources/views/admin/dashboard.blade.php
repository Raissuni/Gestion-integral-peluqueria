<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Toggle sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }
    </script>
</head>
<body class="bg-gray-100 font-sans">

    <!-- Mobile Navbar -->
    <div class="bg-gray-900 text-white flex items-center justify-between p-4 md:hidden">
        <div class="text-xl font-bold">Admin Panel</div>
        <button onclick="toggleSidebar()" class="focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside id="sidebar"
               class="w-64 bg-gray-900 text-white flex flex-col fixed md:relative z-20 inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition duration-200 ease-in-out">
            <div class="p-6 text-2xl font-bold hidden md:block">Admin Panel</div>
            <nav class="flex-1 px-4 space-y-2">
                <a href="{{ route('home') }}" class="block p-3 rounded hover:bg-gray-700">🏠 Inicio</a>
                <a href="{{ route('appointments.index') }}" class="block p-3 rounded hover:bg-gray-700">📅 Citas</a>
                <a href="{{ route('stylists.index') }}" class="block p-3 rounded hover:bg-gray-700">💇 Estilistas</a>
                <a href="{{ route('services.index') }}" class="block p-3 rounded hover:bg-gray-700">✂️ Servicios</a>
                <a href="{{ route('admin.mensaje') }}" class="block p-3 rounded hover:bg-gray-700">📨 Mensajes</a>
                <a href="{{ route('admin.estadisticas') }}" class="block p-3 rounded hover:bg-gray-700">📊 Estadísticas</a>
            </nav>
            <div class="p-4 mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-red-600 p-2 rounded hover:bg-red-700">
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-4 md:p-6 ml-0 md:ml-64 overflow-y-auto">
            <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Bienvenido, {{ auth()->user()->name }}</h1>
                    <p class="text-gray-600">Panel de administración</p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('appointments.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                        ➕ Crear Cita
                    </a>
                    <a href="{{ route('stylists.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm">
                        Añadir Estilista 💇
                    </a>
                    <a href="{{ route('services.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded text-sm">
                        Añadir Servicio ✂️
                    </a>
                </div>
            </header>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-gray-700 font-semibold">Total Citas</h2>
                    <p class="text-2xl font-bold">{{ $appointmentsCount ?? 0 }}</p>
                </div>
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-gray-700 font-semibold">Estilistas</h2>
                    <p class="text-2xl font-bold">{{ $stylistsCount ?? 0 }}</p>
                </div>
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-gray-700 font-semibold">Mensajes</h2>
                    <p class="text-2xl font-bold">{{ $messagesCount ?? 0 }}</p>
                </div>
            </div>

<!-- Sección de citas por estilista -->
<section>
    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-4">Citas por Estilista</h2>

    @foreach($stylists as $stylist)
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">{{ $stylist->stylist_name }}</h3>
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
                        @forelse($stylist->appointments as $appointment)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="p-3">{{ $appointment->user->name ?? 'Sin Cliente' }}</td>
                                <td class="p-3">{{ $appointment->date->format('d/m/Y H:i') }}</td>
                                <td class="p-3">{{ $appointment->service->service_name ?? 'Sin Servicio' }}</td>
                                <td class="p-3">
                                    <form method="POST" action="{{ route('appointments.destroy', $appointment->id) }}"
                                          onsubmit="return confirm('¿Estás seguro de eliminar esta cita?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
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

            <!-- Botón "Ver todas" si hay más de 5 citas -->
            @if($stylist->appointments()->count() > 5)
                <div class="mt-2 text-right">
                    <a href="{{ route('admin.stylist.appointments', $stylist->id) }}" 
                       class="text-blue-600 hover:underline text-sm">
                        Ver todas las citas de {{ $stylist->stylist_name }} →
                    </a>
                </div>
            @endif
        </div>
    @endforeach
</section>


        </main>
    </div>
</body>
</html>
