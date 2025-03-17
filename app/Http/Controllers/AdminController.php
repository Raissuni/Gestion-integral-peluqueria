<?php


namespace App\Http\Controllers;

use App\Models\ContactMessage;

class AdminController extends Controller
{
    public function index()
{
    return view('admin.dashboard', [
        'appointmentsCount' => \App\Models\Appointment::count(),
        'stylistsCount' => \App\Models\Stylist::count(),
        'messagesCount' => \App\Models\ContactMessage::count(),
        'appointments' => \App\Models\Appointment::latest()->take(5)->get(),
    ]);
}
}

