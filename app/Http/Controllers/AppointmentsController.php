<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Stylist;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Stylists;

class AppointmentsController extends Controller
{
    /**
     * Muestra la lista de citas del usuario autenticado.
     */
    public function index()
{
    // Cargar citas con relaciones de servicio y estilista
    $appointments = Appointment::with(['service', 'stylist'])
        ->where('user_id', Auth::id())
        ->get();

    return view('appointments.index', compact('appointments'));
}


    /**
     * Muestra el formulario para crear una nueva cita.
     */
    public function create()
{
    // Obtener todos los servicios disponibles
    $services = Service::all();

    // Obtener todos los estilistas disponibles
    $stylists = Stylist::all();

    // Retornar la vista con las variables necesarias
    return view('appointments.create', compact('services', 'stylists'));
}

    /**
     * Guarda una nueva cita en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'stylist_id' => 'required|exists:stylists,id',
            'service_id' => 'required|exists:services,id',
        ]);

        Appointment::create([
            'user_id' => Auth::id(),  // Obtiene el ID del usuario autenticado
            'stylist_id' => $request->stylist_id,
            'service_id' => $request->service_id,
            'date' => $request->date,
        ]);

        return redirect()->route('appointments.index')->with('success', 'Cita creada correctamente.');
    }

    /**
     * Muestra una cita en detalle.
     */
    public function show($id)
    {
        $appointment = Appointment::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('appointments.show', compact('appointment'));
    }

    /**
     * Permite al administrador editar una cita.
     */
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('appointments.edit', compact('appointment'));
    }

    /**
     * Actualiza una cita en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->all());

        return redirect()->route('admin.appointments.index')->with('success', 'Cita actualizada.');
    }

    /**
     * Permite al administrador eliminar una cita.
     */
    public function destroy($id)
    {
        Appointment::findOrFail($id)->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Cita eliminada.');
    }

    public function dashboard()
{
    // Cargar citas con las relaciones necesarias
    $appointments = Appointment::with(['user', 'service', 'stylist'])
        ->latest()
        ->take(10)
        ->get();

    // Cargar datos adicionales
    $appointmentsCount = Appointment::count();
    $stylistsCount = Stylist::count();
    $messagesCount = 0; // Ajusta si tienes un modelo para mensajes.

    // Retornar la vista con las variables necesarias
    return view('admin.dashboard', compact('appointments', 'appointmentsCount', 'stylistsCount', 'messagesCount'));
}

}
