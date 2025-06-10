<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Stylist;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;

   
use Carbon\Carbon;


class AdminController extends Controller
{
    public function index()
    {
        // Traemos los estilistas con un máximo de 5 citas cada uno
        $stylists = Stylist::with(['appointments' => function ($query) {
            $query->latest()->take(5)->with(['user', 'service']);
        }])->get();

        return view('admin.dashboard', [
            'appointmentsCount' => Appointment::count(),
            'stylistsCount' => Stylist::count(),
            'messagesCount' => ContactMessage::count(),
            'stylists' => $stylists,
        ]);
    }

    public function allAppointmentsByStylist(Request $request, Stylist $stylist)
    {
        // Filtrado de citas
        $appointments = $stylist->appointments()
            ->with(['user', 'service'])
            ->when($request->input('client'), function ($query, $client) {
                $query->whereHas('user', function ($q) use ($client) {
                    $q->where('name', 'like', "%{$client}%");
                });
            })
            ->when($request->input('date'), function ($query, $date) {
                $query->whereDate('date', $date);
            })
            ->latest()
            ->get(); // Usamos get() en lugar de paginate()

        return view('admin.all-appointments', [
            'stylist' => $stylist,
            'appointments' => $appointments,
            'filters' => $request->only(['client', 'date']),
        ]);
    }

    // Nueva función estadisticas


public function estadisticas(Request $request)
{
    $months = $request->get('range', 1); // Por defecto: 1 mes
    $startDate = Carbon::now()->subMonths($months);

    // Clientes más fieles (filtrados por fecha)
    $topClients = User::withCount(['appointments' => function ($query) use ($startDate) {
        $query->where('date', '>=', $startDate);
    }])->orderBy('appointments_count', 'desc')->take(5)->get();

    // Estilistas más demandados
    $topStylists = Stylist::withCount(['appointments' => function ($query) use ($startDate) {
        $query->where('date', '>=', $startDate);
    }])->orderBy('appointments_count', 'desc')->take(5)->get();

    // Servicios más solicitados
    $topServices = Service::withCount(['appointments' => function ($query) use ($startDate) {
        $query->where('date', '>=', $startDate);
    }])->orderBy('appointments_count', 'desc')->take(5)->get();

    // Horas de más afluencia
    $peakHours = Appointment::select(DB::raw('HOUR(date) as hour'), DB::raw('COUNT(*) as count'))
        ->where('date', '>=', $startDate)
        ->groupBy('hour')
        ->orderByDesc('count')
        ->take(5)
        ->get();

    return view('admin.estadisticas', compact('topClients', 'topStylists', 'topServices', 'peakHours'));
}

}
