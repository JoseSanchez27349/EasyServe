@extends('plantilla')

@section('contenido')
    <h2>Listado de Meseros</h2>

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
        <a href="{{ route('mesero.agregar') }}" class="btn btn-success">Agregar Mesero</a>
                    <br>
                    <br>
            @foreach($meseros as $mesero)
                <tr>
                    <td>{{ $mesero->id }}</td>
                    <td>{{ $mesero->nombre }}</td>
                    <!-- Botón para editar -->
                   
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