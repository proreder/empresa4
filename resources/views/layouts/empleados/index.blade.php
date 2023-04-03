@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado de empleados</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>

    @role('super')
        <p>Hola SuperAdministrador</p>
    @endrole
    @role('admin')
        <p>Hola Administrador</p>
    @endrole
    @role('usuario')
        <p>Hola Usuario</p>
    @endrole
@stop

@section('css')
    <link rel="stylesheet" href="./vendor/adminlte/dist/css/adminlte.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop