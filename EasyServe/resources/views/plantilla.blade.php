<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Easy Serve</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="p-3 mb-3 bg-light">
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="{{ route('inicio') }}">Inicio</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('mesas') }}">Mesas</a></li>

            <!-- Enlace al menú (solo para meseros autenticados) -->
            @auth('mesero')
                <li class="nav-item"><a class="nav-link" href="{{ route('menu') }}">Punto de Venta</a></li>
            @endauth

            <li class="nav-item"><a class="nav-link" href="{{ route('notificaciones') }}">Notificaciones</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('mesero') }}">Meseros</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('cuenta') }}">Cuenta</a></li>

            <!-- Enlace de login/logout -->
            @auth('mesero')
                <!-- Si el mesero está autenticado, mostrar opción para cerrar sesión -->
                <li class="nav-item">
                    <form action="{{ route('mesero.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link">Cerrar Sesión</button>
                    </form>
                </li>
            @else
                <!-- Si el mesero no está autenticado, mostrar opción para iniciar sesión -->
                <li class="nav-item"><a class="nav-link" href="{{ route('mesero.login') }}">Iniciar Sesión</a></li>
            @endauth
        </ul>
    </nav>

    <div class="container">
        <!-- Mostrar mensajes de éxito o error -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Contenido dinámico -->
        @yield('contenido')
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>