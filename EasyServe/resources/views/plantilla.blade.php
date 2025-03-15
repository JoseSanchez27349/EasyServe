<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Easy Serve</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        body {
            padding-top: 56px; /* Ajuste para la barra de navegación fija */
        }
        .sidebar {
            position: fixed;
            top: 56px; /* Altura de la barra de navegación */
            bottom: 0;
            left: 0;
            z-index: 1000;
            padding: 20px;
            overflow-x: hidden;
            overflow-y: auto; /* Scroll en la barra lateral */
            background-color: #f8f9fa;
            border-right: 1px solid #eee;
        }
    </style>
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="{{ route('inicio') }}">Easy Serve</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                @auth('web')
                    
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Cerrar Sesión </button>
                        </form>
                    </li>
                @elseauth('mesero')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('menu') }}">Punto de Venta</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('notificaciones') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Notificaciones </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('mesas') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Mesa de ordenes </button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Cerrar Sesión </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    <!-- Contenido dinámico -->
    <div class="container-fluid">
        @yield('contenido')
    </div>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>