<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_name',
        'description',
        'price',
    ];

    /**
     * Relación: Un servicio puede tener muchos estilistas.
     */
    public function stylists()
    {
        return $this->hasMany(Stylist::class);
    }

    /**
     * Relación: Un servicio puede estar asociado con muchas citas.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
