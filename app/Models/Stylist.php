<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stylist extends Model
{
    use HasFactory;

    protected $fillable = [
        'stylist_name',
        'description',
    ];

    /**
     * Relación: Un estilista pertenece a un servicio.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Relación: Un estilista puede tener muchas citas.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
