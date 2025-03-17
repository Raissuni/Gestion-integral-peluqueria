<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'stylist_id',
        'service_id',
        'date',
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
}
