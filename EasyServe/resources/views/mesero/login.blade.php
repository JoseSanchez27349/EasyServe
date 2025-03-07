@extends('plantilla')

@section('contenido')
    <div class="login-container">
        <h2>Iniciar Sesión</h2>

        <!-- Mostrar errores de validación -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario de login -->
        <form method="POST" action="{{ route('mesero.login.submit') }}">
            @csrf <!-- Token CSRF para seguridad -->
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" name="id" id="id" class="form-control" placeholder="Ingresa tu ID" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Ingresa tu contraseña" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Ingresar</button>
        </form>
    </div>
@endsection