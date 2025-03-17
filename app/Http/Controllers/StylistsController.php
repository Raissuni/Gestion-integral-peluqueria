<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stylist;
use App\Models\Service;

class StylistsController extends Controller
{
    /**
     * Muestra la lista de estilistas.
     */
    public function index()
    {
        $stylists = Stylist::with('service')->get(); // Obtener estilistas con su servicio asociado
        return view('stylists.index', compact('stylists'));
    }

    /**
     * Muestra el formulario para crear un nuevo estilista.
     */
    public function create()
    {
        $services = Service::all(); // Obtener todos los servicios para el select
        return view('stylists.create', compact('services'));
    }

    /**
     * Guarda un nuevo estilista en la base de datos.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255', // Validamos que el nombre no sea nulo
        'description' => 'required|string',
    ]);

    // Crear el estilista
    $stylist = Stylist::create([
        'stylist_name' => $request->name, // Aquí asignamos el nombre del estilista
        'description' => $request->description,
    ]);

    

    return redirect()->route('stylists.index')->with('success', 'Estilista creado correctamente.');
}

    /**
     * Muestra el formulario para editar un estilista.
     */
    public function edit($id)
    {
        $stylist = Stylist::findOrFail($id);
        return view('stylists.edit', compact('stylist', 'services'));
    }

    /**
     * Actualiza un estilista en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'stylist_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $stylist = Stylist::findOrFail($id);
        $stylist->update([
            'stylist_name' => $request->stylist_name,
            'description' => $request->description,
        ]);

        return redirect()->route('stylists.index')->with('success', 'Estilista actualizado correctamente.');
    }

    /**
     * Elimina un estilista de la base de datos.
     */
    public function destroy($id)
    {
        $stylist = Stylist::findOrFail($id);
        $stylist->delete();

        return redirect()->route('stylists.index')->with('success', 'Estilista eliminado correctamente.');
    }
}
