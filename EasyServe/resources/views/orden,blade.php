@extends('plantilla')

@section('contenido')
    <h2>Impresión de Pedido - {{ $mesa->nombre }}</h2>
    @if($pedido)
        <p><strong>Mesero:</strong> {{ $pedido->mesero->nombre }}</p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedido->detalles as $detalle)
                    <tr>
                        <td>{{ $detalle->item }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>${{ number_format($detalle->precio,2) }}</td>
                        <td>${{ number_format($detalle->cantidad * $detalle->precio,2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h4>Total: ${{ number_format($pedido->total,2) }}</h4>
    @else
        <p>No se ha registrado ningún pedido para esta mesa.</p>
    @endif
@endsection
