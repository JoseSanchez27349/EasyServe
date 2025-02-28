@extends('plantilla')

@section('contenido')
    <h2>Cuentas</h2>

    @if($pedidos->isEmpty())
        <p>No hay mesas ocupadas con pedidos registrados.</p>
    @else
        @foreach($pedidos->groupBy('mesa_id') as $mesaId => $cuentas)
            <h3>Cuenta - Mesa: {{ $cuentas->first()->mesa->nombre ?? 'Sin Mesa' }}</h3>
            <p><strong>Mesero:</strong> {{ $cuentas->first()->mesero->nombre }}</p>

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
                    @php $total = 0; @endphp
                    @foreach($cuentas as $pedido)
                        @foreach($pedido->detalles as $detalle)
                            @php 
                                $subtotal = $detalle->cantidad * $detalle->precio;
                                $total += $subtotal;
                            @endphp
                            <tr>
                                <td>{{ $detalle->item }}</td>
                                <td>{{ $detalle->cantidad }}</td>
                                <td>${{ number_format($detalle->precio,2) }}</td>
                                <td>${{ number_format($subtotal,2) }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
            <h4>Total: ${{ number_format($total,2) }}</h4>

            <!-- Botón para finalizar cuenta -->
            <form action="{{ route('finalizarCuenta', $mesaId) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Finalizar Cuenta</button>
            </form>

            <hr>
        @endforeach
    @endif
@endsection
