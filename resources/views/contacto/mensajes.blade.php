@extends('layouts.app')
@section('title', 'Mensajes Recibidos')
@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">Mensajes Recibidos</h1>
        
        @if ($messages->isEmpty())
            <div class="alert alert-info text-center">
                No hay mensajes en este momento.
            </div> 
         @else
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mensaje</th>
                        <th scope="col">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                     @foreach ($messages as $message)
                        <tr>
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->message }}</td>
                            <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
         @endif 
    </div>
@endsection
