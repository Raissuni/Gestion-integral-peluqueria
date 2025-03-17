<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Stylist;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::all(); // Obtener todos los servicios
        $stylists = Stylist::all(); // Obtener todos los estilistas

        return view('home', compact('services', 'stylists'));
    }
}