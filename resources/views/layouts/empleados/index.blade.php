@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado de empleados</h1>
@stop

@section('content')
    <div class="container">
        
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
        <a href="{{ url('empleados/create') }}" class="btn btn-success">Alta de Empleado</a>
        <br><br>
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>Fotografía</th>
                    <th>NIF/NIE</th>
                    <th>Número SS</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Tipo Via</th>
                    <th>Nombre via</th>
                    <th>Acciones</th>

                </tr>

            </thead>
            <tbody>
                @forelse ($empleados as $empleado)
                    <tr>
                        <td>
                            <img src="{{ $empleado->foto }}" alt="" width="100">
                        </td>
                        <td>{{ $empleado->nifnie}}</td>
                        <td>{{ $empleado->nss}}</td>
                        <td>{{ $empleado->nombre}}</td>
                        <td>{{ $empleado->apellidos}}</td>
                        <td>{{ $empleado->tipo_via}}</td>
                        <td>{{ $empleado->nombre_via}}</td>
                        <td> Editar | 
                            <form action="{{ url('/empleados/index'.$empleado->nifnie)}}" method="post">
                                @csrf
                                {{method_field('DELETE)')}}
                                <input type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar">  
                            </form>   
                        </td>
                    </tr>
                @empty
                    
                @endforelse
            </tbody>
        </table>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="./vendor/adminlte/dist/css/adminlte.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop