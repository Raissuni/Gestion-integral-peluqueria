<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Stylist;
use Illuminate\Support\Facades\Auth;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;

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
     * Guarda una nueva cita en la base de datos y la sincroniza con Google Calendar.
     */
    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'stylist_id' => 'required|exists:stylists,id',
            'date' => 'required|date|after:now',
            'time' => 'required',
        ]);

        try {
            // Combinar fecha y hora
            $dateTime = Carbon::createFromFormat('Y-m-d H:i', $request->date . ' ' . $request->time);

            // Crear la cita
            $appointment = new Appointment();
            $appointment->user_id = Auth::id();
            $appointment->service_id = $request->service_id;
            $appointment->stylist_id = $request->stylist_id;
            $appointment->date = $dateTime;
            //$appointment->status = 'pending';
            $appointment->save();

            // Si se marcó para añadir al calendario de Google
            if ($request->has('add_to_google_calendar')) {
                $user = Auth::user();

                if (!$user || !$user->token) {
                    return redirect()->route('calendar.login')
                        ->with('warning', 'Necesitas conectar tu cuenta de Google Calendar primero.');
                }

                try {
                    $client = new Google_Client();
                    $client->setClientId(env('GOOGLE_CLIENT_ID'));
                    $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
                    $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
                    $client->addScope(Google_Service_Calendar::CALENDAR);
                    $client->setAccessType('offline');

                    $token = json_decode($user->token, true);
                    if (!$token || !isset($token['access_token'])) {
                        throw new \Exception('Token de Google inválido');
                    }

                    $client->setAccessToken($token);

                    if ($client->isAccessTokenExpired() && isset($token['refresh_token'])) {
                        try {
                            $newToken = $client->fetchAccessTokenWithRefreshToken($token['refresh_token']);
                            if (!isset($newToken['access_token'])) {
                                throw new \Exception('No se pudo refrescar el token');
                            }
                            
                            // Mantener el refresh_token si el nuevo no lo incluye
                            if (!isset($newToken['refresh_token']) && isset($token['refresh_token'])) {
                                $newToken['refresh_token'] = $token['refresh_token'];
                            }
                            
                            $user->token = json_encode($newToken);
                            $user->save();
                            $client->setAccessToken($newToken);
                        } catch (\Exception $e) {
                            \Log::error('Error al refrescar token: ' . $e->getMessage());
                            $user->update(['token' => null, 'google_id' => null]);
                            throw new \Exception('Error al refrescar la sesión de Google');
                        }
                    }

                    $service = new Google_Service_Calendar($client);
                    
                    // Cargar las relaciones si no están cargadas
                    $appointment->load(['service', 'stylist']);

                    $event = new Google_Service_Calendar_Event([
                        'summary' => 'Cita de peluquería: ' . $appointment->service->service_name,
                        'location' => 'Tu peluquería',
                        'description' => "Servicio: " . $appointment->service->service_name . 
                                       "\nEstilista: " . $appointment->stylist->stylist_name,
                        'start' => [
                            'dateTime' => $appointment->date->toIso8601String(),
                            'timeZone' => config('app.timezone', 'Europe/Madrid'),
                        ],
                        'end' => [
                            'dateTime' => $appointment->date->copy()->addMinutes(60)->toIso8601String(),
                            'timeZone' => config('app.timezone', 'Europe/Madrid'),
                        ],
                        'attendees' => [
                            ['email' => $user->email]
                        ],
                        'reminders' => [
                            'useDefault' => true
                        ]
                    ]);

                    \Log::info('Creando evento en Google Calendar', [
                        'appointment_id' => $appointment->id,
                        'start' => $event->start->dateTime,
                        'end' => $event->end->dateTime
                    ]);

                    $createdEvent = $service->events->insert('primary', $event);
                    
                    $appointment->google_event_id = $createdEvent->id;
                    $appointment->save();

                    \Log::info('Evento creado en Google Calendar', [
                        'event_id' => $createdEvent->id
                    ]);

                } catch (\Exception $e) {
                    \Log::error('Error al crear evento en Google Calendar: ' . $e->getMessage());
                    return redirect()->route('appointments.index')
                        ->with('warning', 'Cita creada pero hubo un error al añadirla a Google Calendar: ' . $e->getMessage());
                }
            }

            return redirect()->route('appointments.index')
                ->with('success', 'Cita creada correctamente' . 
                    ($request->has('add_to_google_calendar') ? ' y añadida a Google Calendar' : ''));

        } catch (\Exception $e) {
            \Log::error('Error al crear cita: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Error al crear la cita: ' . $e->getMessage()]);
        }
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
     * Actualiza una cita en la base de datos y la sincroniza con Google Calendar.
     */
    public function update(Request $request, Appointment $appointment)
    {
        // Validar los datos de la cita
        $request->validate([
            'date' => 'required|date',
            'stylist_id' => 'required|exists:stylists,id',
            'service_id' => 'required|exists:services,id',
        ]);

        // Actualizar la cita en la base de datos
        $appointment->update($request->all());

        // Si la cita tiene un evento en Google Calendar, actualizar el evento
        if ($appointment->google_event_id) {
            $event = Event::find($appointment->google_event_id);
            $event->startDateTime = Carbon::parse($appointment->date);
            $event->endDateTime = Carbon::parse($appointment->date)->addMinutes(60);  // Duración del servicio
            $event->description = "Servicio: " . $appointment->service->service_name . " con " . $appointment->stylist->stylist_name;
            $event->save();  // Guardar el evento actualizado en Google Calendar
        }

        return redirect()->route('appointments.index')->with('success', 'Cita actualizada correctamente y sincronizada con Google Calendar.');
    }

    /**
     * Permite al administrador eliminar una cita.
     */
public function destroy($id)
{
    $appointment = Appointment::findOrFail($id);

    // Intentar eliminar el evento de Google Calendar si existe
    if ($appointment->google_event_id) {
        try {
            // Configurar cliente de Google
            $client = new \Google_Client();
            $client->setAuthConfig(storage_path('app/google/service-account.json'));
            $client->addScope(\Google_Service_Calendar::CALENDAR);
            
            // Crear instancia del servicio
            $service = new \Google_Service_Calendar($client);
            
            // Eliminar el evento
            $service->events->delete('primary', $appointment->google_event_id);

        } catch (\Exception $e) {
            // Registrar el error pero continuar con la eliminación local
            \Log::error('Error al eliminar evento de Google Calendar: ' . $e->getMessage());
        }
    }

    // Eliminar la cita de la base de datos
    $appointment->delete();

    return redirect()->route('appointments.index')
        ->with('success', 'Cita eliminada correctamente de la base de datos. Si tenía evento en Google Calendar, se intentó borrar.');
}


    /**
     * Dashboard del administrador para mostrar citas y estadísticas.
     */
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

    /**
     * Obtiene los slots de tiempo disponibles para una fecha y estilista específicos
     */
    public function getAvailableSlots(Request $request)
    {
        $request->validate([
            'stylist_id' => 'required|exists:stylists,id',
            'date' => 'required|date',
        ]);

        $date = Carbon::parse($request->date)->format('Y-m-d');

        // Horario de trabajo (de 9:00 a 20:00)
        $startTime = 9;
        $endTime = 20;
        
        // Duración de cada cita en horas
        $appointmentDuration = 1;

        // Obtener las citas existentes para ese día y estilista
        $existingAppointments = Appointment::where('stylist_id', $request->stylist_id)
            ->whereDate('date', $date)
            ->pluck('date')
            ->map(function($date) {
                return Carbon::parse($date)->format('H:i');
            })
            ->toArray();

        // Generar todos los slots posibles
        $availableSlots = [];
        for ($hour = $startTime; $hour < $endTime; $hour++) {
            for ($minutes = 0; $minutes < 60; $minutes += 30) {
                $time = sprintf('%02d:%02d', $hour, $minutes);
                if (!in_array($time, $existingAppointments)) {
                    $availableSlots[] = $time;
                }
            }
        }

        return response()->json(['slots' => $availableSlots]);
    }
}
