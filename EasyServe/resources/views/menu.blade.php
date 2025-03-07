@extends('plantilla')

@section('contenido')
    <h2>Nueva Orden</h2>
    <form action="{{ route('guardarOrden') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="mesa_id">Número de Mesa</label>
            <select name="mesa_id" id="mesa_id" class="form-control" required>
                <option value="">Seleccione una mesa</option>
                @foreach($mesas as $mesa)
                    <option value="{{ $mesa->id }}">{{ $mesa->nombre }}</option>
                @endforeach
            </select>
        </div>

        <hr>
        <h4>Selecciona los productos</h4>

        <!-- Sección de Entradas -->
        <div class="mb-4">
            <h5 class="text-primary"><i class="fas fa-utensils"></i> Entradas</h5>
            <div class="row">
                @foreach ($productos->where('categoria', 'Entradas') as $producto)
                    <div class="col-md-3 mb-3">
                        <button type="button" class="btn btn-outline-primary btn-block btn-lg text-left"
                            onclick="agregarOrden({{ $producto->id }}, '{{ $producto->nombre }}', {{ $producto->precio }})">
                            {{ $producto->nombre }}
                            <span class="badge badge-pill badge-primary float-right">${{ $producto->precio }}</span>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Sección de Snacks -->
        <div class="mb-4">
            <h5 class="text-primary"><i class="fas fa-cookie"></i> Snacks</h5>
            <div class="row">
                @foreach ($productos->where('categoria', 'Snacks') as $producto)
                    <div class="col-md-3 mb-3">
                        <button type="button" class="btn btn-outline-primary btn-block btn-lg text-left"
                            onclick="agregarOrden({{ $producto->id }}, '{{ $producto->nombre }}', {{ $producto->precio }})">
                            {{ $producto->nombre }}
                            <span class="badge badge-pill badge-primary float-right">${{ $producto->precio }}</span>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Sección de Ensaladas -->
        <div class="mb-4">
            <h5 class="text-primary"><i class="fas fa-leaf"></i> Ensaladas</h5>
            <div class="row">
                @foreach ($productos->where('categoria', 'Ensaladas') as $producto)
                    <div class="col-md-3 mb-3">
                        <button type="button" class="btn btn-outline-primary btn-block btn-lg text-left"
                            onclick="agregarOrden({{ $producto->id }}, '{{ $producto->nombre }}', {{ $producto->precio }})">
                            {{ $producto->nombre }}
                            <span class="badge badge-pill badge-primary float-right">${{ $producto->precio }}</span>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Sección de Cortes -->
        <div class="mb-4">
            <h5 class="text-primary"><i class="fas fa-drumstick-bite"></i> Cortes</h5>
            <div class="row">
                @foreach ($productos->where('categoria', 'Cortes') as $producto)
                    <div class="col-md-3 mb-3">
                        <button type="button" class="btn btn-outline-primary btn-block btn-lg text-left"
                            onclick="agregarOrden({{ $producto->id }}, '{{ $producto->nombre }}', {{ $producto->precio }})">
                            {{ $producto->nombre }}
                            <span class="badge badge-pill badge-primary float-right">${{ $producto->precio }}</span>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Sección de Pastas -->
        <div class="mb-4">
            <h5 class="text-primary"><i class="fas fa-pasta"></i> Pastas</h5>
            <div class="row">
                @foreach ($productos->where('categoria', 'Pastas') as $producto)
                    <div class="col-md-3 mb-3">
                        <button type="button" class="btn btn-outline-primary btn-block btn-lg text-left"
                            onclick="agregarOrden({{ $producto->id }}, '{{ $producto->nombre }}', {{ $producto->precio }})">
                            {{ $producto->nombre }}
                            <span class="badge badge-pill badge-primary float-right">${{ $producto->precio }}</span>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Sección de Postres -->
        <div class="mb-4">
            <h5 class="text-primary"><i class="fas fa-ice-cream"></i> Postres</h5>
            <div class="row">
                @foreach ($productos->where('categoria', 'Postres') as $producto)
                    <div class="col-md-3 mb-3">
                        <button type="button" class="btn btn-outline-primary btn-block btn-lg text-left"
                            onclick="agregarOrden({{ $producto->id }}, '{{ $producto->nombre }}', {{ $producto->precio }})">
                            {{ $producto->nombre }}
                            <span class="badge badge-pill badge-primary float-right">${{ $producto->precio }}</span>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Sección de Bebidas -->
        <div class="mb-4">
            <h5 class="text-primary"><i class="fas fa-glass-cheers"></i> Bebidas</h5>
            <div class="row">
                @foreach ($productos->where('categoria', 'Bebidas') as $producto)
                    <div class="col-md-3 mb-3">
                        <button type="button" class="btn btn-outline-primary btn-block btn-lg text-left"
                            onclick="agregarOrden({{ $producto->id }}, '{{ $producto->nombre }}', {{ $producto->precio }})">
                            {{ $producto->nombre }}
                            <span class="badge badge-pill badge-primary float-right">${{ $producto->precio }}</span>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>

        <hr>
        <h4>Pedido</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody id="ordenTabla">
                </tbody>
            </table>
        </div>

        <input type="hidden" name="items" id="itemsInput">

        <button type="submit" class="btn btn-success btn-lg btn-block">
            <i class="fas fa-paper-plane"></i> Enviar Pedido
        </button>
    </form>

    <!-- FontAwesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        .btn-outline-primary {
            transition: all 0.3s ease;
        }
        .btn-outline-primary:hover {
            background-color: #007bff;
            color: white;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .badge {
            font-size: 0.9em;
        }
        h5 {
            margin-bottom: 1rem;
        }
    </style>

    <script>
        let orden = [];

        function agregarOrden(id, nombre, precio) {
            let producto = orden.find(p => p.id === id);
            if (producto) {
                producto.cantidad++;
            } else {
                orden.push({ id, nombre, precio, cantidad: 1 });
            }
            actualizarTabla();
        }

        function eliminarProducto(id) {
            orden = orden.filter(p => p.id !== id);
            actualizarTabla();
        }

        function actualizarTabla() {
            let tabla = document.getElementById('ordenTabla');
            tabla.innerHTML = "";
            orden.forEach(p => {
                tabla.innerHTML += `
                    <tr>
                        <td>${p.nombre}</td>
                        <td>${p.cantidad}</td>
                        <td>$${p.precio.toFixed(2)}</td>
                        <td>$${(p.precio * p.cantidad).toFixed(2)}</td>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="eliminarProducto(${p.id})">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </td>
                    </tr>`;
            });

            // Guardar datos en el input hidden
            document.getElementById('itemsInput').value = JSON.stringify(orden);
        }
    </script>
@endsection