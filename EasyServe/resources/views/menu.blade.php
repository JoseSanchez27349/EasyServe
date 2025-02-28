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
        <div class="form-group">
            <label for="mesero_id">Mesero</label>
            <select name="mesero_id" id="mesero_id" class="form-control" required>
                <option value="">Seleccione un mesero</option>
                @foreach($meseros as $mesero)
                    <option value="{{ $mesero->id }}">{{ $mesero->nombre }}</option>
                @endforeach
            </select>
        </div>
        <hr>
        <h4>Pedido</h4>
        <div id="items">
            <div class="form-row align-items-end">
                <div class="col-md-5">
                    <label>Producto</label>
                    <input type="text" name="items[0][nombre]" class="form-control" placeholder="Nombre del platillo" required>
                </div>
                <div class="col-md-3">
                    <label>Cantidad</label>
                    <input type="number" name="items[0][cantidad]" class="form-control" placeholder="Cantidad" min="1" required>
                </div>
                <div class="col-md-3">
                    <label>Precio</label>
                    <input type="number" step="0.01" name="items[0][precio]" class="form-control" placeholder="Precio" required>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary mt-3" id="addItem">Agregar otro item</button>
        <br><br>
        <button type="submit" class="btn btn-primary">Enviar Pedido</button>
    </form>

    <script>
        let itemIndex = 1;
        document.getElementById('addItem').addEventListener('click', function(){
            const container = document.getElementById('items');
            const div = document.createElement('div');
            div.classList.add('form-row', 'align-items-end', 'mt-2');
            div.innerHTML = `
                <div class="col-md-5">
                    <input type="text" name="items[${itemIndex}][nombre]" class="form-control" placeholder="Nombre del platillo" required>
                </div>
                <div class="col-md-3">
                    <input type="number" name="items[${itemIndex}][cantidad]" class="form-control" placeholder="Cantidad" min="1" required>
                </div>
                <div class="col-md-3">
                    <input type="number" step="0.01" name="items[${itemIndex}][precio]" class="form-control" placeholder="Precio" required>
                </div>
            `;
            container.appendChild(div);
            itemIndex++;
        });
    </script>
@endsection



