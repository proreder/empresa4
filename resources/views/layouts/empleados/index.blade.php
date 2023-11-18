@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado de empleados</h1>
@stop

@section('content')
    <div class="container-flex">
        
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
        <table id="empleados" class="table table-striped border">
            <thead class="thead-light">
                <tr>
                    <th width="80px">Fotografía</th>
                    <th width="90px">NIF/NIE</th>
                    <th width="100px">Número SS</th>
                    <th width="125px">Nombre</th>
                    <th width="125px">Apellidos</th>
                    <th width="40px">Móvil</th>
                    <th width="40px">Fijo</th>
                    <th width="50px">Tipo Via</th>
                    <th width="160px">Nombre via</th>
                    <th width="140px">Acciones</th>

                </tr>

            </thead>
            <tbody>
                @forelse ($empleados as $empleado)
                    <tr>
                        <td><img src="data:image/png;base64,
                            <?php 
                                 echo base64_encode($empleado->foto); 
                            ?>"  alt="" width="40">
                        </td>
                        <!-- <td></td> -->
                        <td>{{ $empleado->nifnie}}</td>
                        <td>{{ $empleado->nss}}</td>
                        <td>{{ $empleado->nombre}}</td>
                        <td>{{ $empleado->apellidos}}</td>
                        <td>{{ $empleado->telefono_movil }} </td>
                        <td>{{ $empleado->telefono_fijo }} </td>
                        <td>{{ $empleado->tipo_via}}</td>
                        <td>{{ $empleado->nombre_via}}</td>
                        <td>
                            <form action="{{ url('/empleados/'.$empleado->id)}}" method="post">
                                {{method_field('EDIT')}}
                                <a href="{{ url('/empleados/'.$empleado->id.'/edit/')}}" class="btn btn-primary btn-sm py-0">Editar</a> 
                                @csrf
                                {{method_field('DELETE')}}
                                <input type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar" class="btn btn-danger btn-sm py-0">  
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
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#empleados').DataTable({
                responsive : true,
            "language" : {
                "search" :          "Buscar",
                "lengthMenu" :      "Mostrar _MENU_ registros por página",
                "info"  :           "Página _PAGE_ de _PAGES_",
                "zeroRecords" :    "No hay registros",
                "infoEmpty" :     "",
                "paginate" :        {
                                        "previous"  :  "Anterior",
                                        "next":       "Siguiente",
                                        "first":       "Primero",
                                        "last":        "último"
                }   
            }  
            });
        
        });
    </script>
@stop