@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado de conductores</h1>
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
        
        <a href="{{ url('conductores/create') }}" class="btn btn-success">Alta de conductor</a>
        <br><br>
        
        <table id="conductores" class="table table-striped border">
            <thead class="thead-light">
                <tr>
                    <th width="80px">Fotografía</th>
                    <th width="90px">NIF/NIE</th>
                    <th width="100px">Permisos</th>
                    <th width="125px">CAP</th>
                    <th width="125px">Tarjeta tacógrafo</th>
                    <th width="40px">Tipo ADR</th>
                    <th width="140px">Acciones</th>

                </tr>

            </thead>
            <tbody>
                @forelse ($conductores as $conductor)
                    <tr>
                        <td><img src="data:image/png;base64,
                            <?php 
                                 echo base64_encode($conductor->foto); 
                            ?>"  alt="" width="40">
                        </td>
                        <!-- <td></td> -->
                        <td>{{ $conductor->nifnie_empleado}}</td>
                        <td>{{ $conductor->permisos}}</td>
                        <td>{{ $conductor->cap}}</td>
                        <td>{{ $conductor->tarjeta_tacografo}}</td>
                        <td>
                            <form id="btnEliminar" action="{{url('/conductores/'.$conductor->id)}}" method="post">
                                {{method_field('EDIT')}}
                                <a href="{{url('/conductores/'.$conductor->id.'/edit/')}}" class="btn btn-primary btn-sm py-0">Editar</a> 
                                @csrf
                                {{method_field('DELETE')}}
                             <!--   <input type="submit" onclick="return confirm('¿Quieres borrar?')" id="btnEliminar" value="Borrar" class="btn btn-danger btn-sm py-0"> -->
                                <button type="submit" value="Borrar" class="btn btn-danger btn-sm py-0">Borrar</button> 
                            </form>   
                        </td>
                    </tr>
                @empty
                    
                @endforelse
            </tbody>
        </table>
      <!--End card-->
    </div>
@stop

@section('css')
    <link rel="stylesheet" href=".public/vendor/adminlte/dist/css/adminlte.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop