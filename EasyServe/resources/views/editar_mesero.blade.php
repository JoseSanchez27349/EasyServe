@extends('plantilla')

@section('contenido')
    <h2>Editar Mesero</h2>

    <!-- Formulario para actualizar un mesero -->
    <form action="{{ route('mesero.actualizar', $mesero->id) }}" method="POST">
    @csrf
    @method('PUT') <!-- Simula el método PUT -->
    
    <div class="form-group">
        <label for="nombre">Nombre del Mesero:</label>
        <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $mesero->nombre }}" required>
    </div>

    <div class="form-group">
        <label for="password">Contraseña (dejar en blanco para no cambiar):</label>
        <input type="password" id="password" name="password" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Actualizar Mesero</button>
</form>
    <br>
    <a href="{{ route('mesero') }}" class="btn btn-secondary">Volver al Listado</a>


@endsection