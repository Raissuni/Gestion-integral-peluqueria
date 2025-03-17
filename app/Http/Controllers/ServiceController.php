<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Muestra la lista de servicios.
     */
    public function index()
    {
        $services = Service::all(); // Obtener todos los servicios
        return view('services.index', compact('services'));
    }

    /**
     * Muestra el formulario para crear un nuevo servicio.
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Guarda un nuevo servicio en la base de datos.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255', // Aquí validamos "name" desde el formulario
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
    ]);

    Service::create([
        'service_name' => $request->name, // Asignamos "name" al campo "service_name" de la base de datos
        'description' => $request->description,
        'price' => $request->price,
    ]);

    return redirect()->route('services.create')->with('success', 'Servicio creado correctamente.');
}


    /**
     * Muestra el formulario para editar un servicio.
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('services.edit', compact('service'));
    }

    /**
     * Actualiza un servicio en la base de datos.
     */
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'service_name' => 'required|string|max:255',
        //     'description' => 'nullable|string',
        // ]);

        $service = Service::findOrFail($id);
        $service->update([
            'service_name' => $request->service_name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('services.index')->with('success', 'Servicio actualizado correctamente.');
    }

    /**
     * Elimina un servicio de la base de datos.
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Servicio eliminado correctamente.');
    }
}
