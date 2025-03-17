@extends('layouts.app')
@section('title', 'Contacto')
@section('content')
    <h1>Contacto</h1>
    <form action="/contact" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Tu Nombre" required>
        <input type="email" name="email" placeholder="Tu Email" required>
        <textarea name="message" placeholder="Tu Mensaje" required></textarea>
        <button type="submit">Enviar</button>
    </form>
@endsection