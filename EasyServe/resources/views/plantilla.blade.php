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
            <li class="nav-item"><a class="nav-link" href="{{ route('menu') }}">Nueva Orden</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('notificaciones') }}">Notificaciones</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('mesero') }}">Meseros</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('cuenta') }}">Cuenta</a></li>
        </ul>
    </nav>
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @yield('contenido')
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

