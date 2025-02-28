@extends('plantilla')

@section('contenido')
    <h2>Listado de Meseros</h2>
    
    <!-- Formulario para agregar un nuevo mesero -->
    <form action="{{ route('mesero.agregar') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre del Mesero:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Mesero</button>
    </form>

    <hr>

    <!-- Tabla de meseros -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($meseros as $mesero)
                <tr>
                    <td>{{ $mesero->id }}</td>
                    <td>{{ $mesero->nombre }}</td>
                    <td>
                        <!-- Botón para editar -->
                        <a href="{{ route('mesero.editar', $mesero->id) }}" class="btn btn-warning">Editar</a>

                        <!-- Formulario para eliminar -->
                        <form action="{{ route('mesero.eliminar', $mesero->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
