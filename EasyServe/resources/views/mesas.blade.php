@extends('plantilla')

@section('contenido')
    <h2>Listado de Mesas</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mesa</th>
                <th>Mesero</th>
                <th>Status</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mesas as $m)
                <tr>
                    <td>{{ $m->nombre }}</td>
                    <td>{{ $m->mesero ? $m->mesero->nombre : 'Sin asignar' }}</td>
                    <td>{{ ucfirst($m->status) }}</td>
                    <td>
                        <!-- Los botones pueden dirigir a otras funcionalidades según se requiera -->
                        <a href="{{ route('menu') }}" class="btn btn-primary btn-sm">Orden</a>
                        <a href="{{ route('cuenta') }}" class="btn btn-success btn-sm">Cuenta</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

