@extends('plantilla')

@section('contenido')
    <h2>Editar Mesero</h2>

    <form action="{{ route('mesero.actualizar', $mesero->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre del Mesero:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $mesero->nombre }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Mesero</button>
    </form>
@endsection
