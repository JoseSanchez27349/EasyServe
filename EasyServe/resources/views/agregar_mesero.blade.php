@extends('plantilla')

@section('contenido')
    <h2>Agregar Nuevo Mesero</h2>

    <!-- Formulario para agregar un nuevo mesero -->
    <form action="{{ route('mesero.agregar') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre del Mesero:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password">Contraseña: ("8 caracteres")</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Agregar Mesero</button>
    </form>

    <!-- Enlace para volver al listado de meseros -->
    <hr>
    <a href="{{ route('mesero') }}" class="btn btn-secondary">Volver al Listado</a>
@endsection