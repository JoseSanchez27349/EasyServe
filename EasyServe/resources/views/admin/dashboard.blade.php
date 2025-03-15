@extends('plantilla')

@section('contenido')
    <div class="container-fluid">
        <div class="row">
            <!-- Barra lateral -->
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                                Inicio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.meseros') }}">
                                Meseros
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('mesas') }}">
                                Mesas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('notificaciones') }}">
                                Notificaciones
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Contenido principal -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Panel de Administración</h1>
                </div>

                <!-- Mensaje de bienvenida -->
                <div class="alert alert-success" role="alert">
                    Bienvenido, <strong>{{ Auth::user()->name }}</strong>!
                </div>

                <!-- Tarjetas de resumen -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-header">Meseros Registrados</div>
                            <div class="card-body">
                                <h5 class="card-title">10</h5>
                                <p class="card-text">Total de meseros en el sistema.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-header">Mesas Activas</div>
                            <div class="card-body">
                                <h5 class="card-title">15</h5>
                                <p class="card-text">Mesas disponibles para uso.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-header">Notificaciones</div>
                            <div class="card-body">
                                <h5 class="card-title">3</h5>
                                <p class="card-text">Notificaciones pendientes.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sección de acciones rápidas -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h3>Acciones Rápidas</h3>
                        <div class="btn-group" role="group" aria-label="Acciones rápidas">
                            <a href="{{ route('mesero.agregar.form') }}" class="btn btn-secondary">Agregar Mesero</a>
                            <a href="{{ route('mesas') }}" class="btn btn-secondary">Ver Mesas</a>
                            <a href="{{ route('notificaciones') }}" class="btn btn-secondary">Ver Notificaciones</a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection