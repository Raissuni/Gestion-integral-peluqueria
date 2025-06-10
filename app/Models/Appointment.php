<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'stylist_id', 'user_id', 'service_id', 'google_event_id'];

    protected $casts = [
        'date' => 'datetime',
    ];

    /**
     * Relación: Una cita pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: Una cita pertenece a un estilista.
     */
    public function stylist()
    {
        return $this->belongsTo(Stylist::class);
    }

    /**
     * Relación: Una cita pertenece a un servicio.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Verifica si la cita tiene un evento en Google Calendar.
     */
    public function hasGoogleEvent()
    {
        return !is_null($this->google_event_id);
    }
}
