<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    /**
     * Muestra el formulario de contacto.
     */
    public function index()
    {
        // Recupera todos los mensajes
        $messages = ContactMessage::all(); 

        // Envía los mensajes a la vista
        return view('contacto.mensajes', compact('messages'));

    }
    public function create()
    {
        return view('contacto.contact');

    }

    /**
     * Almacena el mensaje de contacto en la base de datos.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|max:255',
        //     'message' => 'required|string',
        // ]);

        ContactMessage::create($request->all());
        return redirect()->route('home')->with('success', 'Mensaje enviado correctamente.');
    }
}
