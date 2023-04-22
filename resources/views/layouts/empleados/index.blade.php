@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado de empleados</h1>
@stop

@section('content')
    <div class="container">
        <a href="{{ url('empleados/create') }}">Alta de Empleado</a>
        <!--<p>Welcome to this beautiful admin panel.</p>-->
        <!--Mostramos el ROL de usuario que se ha conectado-->
        @role('super')
            <p>Hola SuperAdministrador</p>
        @endrole
        @role('admin')
            <p>Hola Administrador</p>
        @endrole
        @role('usuario')
            <p>Hola Usuario</p>
        @endrole
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="./vendor/adminlte/dist/css/adminlte.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop