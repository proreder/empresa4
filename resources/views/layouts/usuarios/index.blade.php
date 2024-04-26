@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado de usuarios registrados</h1>
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
        <!--data-bs-target="#agregarConductor"-->
        <button class="btn btn-success btn-sm" data-bs-toggle="modal" id="agregarUsuario" data-bs-target="#modalTablaUsuarios"><i class="bi-plus-circle me-2"></i>Añadir usuario</button>
        <br><br>
        
        <table id="tabla_conductores" class="table table-striped border">
            <thead class="thead-light">
                <tr>
                    <th width="40px">Nombre</th>
                    <th width="50px">Email</th>
                    <th width="140px">Pasword</th>
                    <th width="40px">Rol</th>
                </tr>

            </thead>
            <tbody>
                @if($usuarios)
                    @foreach ($usuarios as $usuario)
                        <tr>
                            
                            <td>{{ $usuario->name }}</td>
                             <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->password }}</td>
                            <td>
                                @forelse ($usuario->roles as $role)
                                    <span class="badge badge-info"> {{ $role->name }} </span>
                                @empty
                                <span class="badge badge-danger">Sin roles</span>
                                @endforelse
                            </td>
                            <td>Acciones</td>
                            
                            <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn_editar btn btn-link"  data-bs-toggle="modal"  data-bs-config="backdrop:true" data-bs-target="#editarConductorModal" data-id="{{$usuario->id}}" data-nombre="{{$usuario->nombre}}" data-email="{{$usuario->mail}}" data-password="{{$usuario->password}}" ><i class="bi-pencil-square h4"></i></button>
                                    <button type="button"  data-toggle="popover" id="btn_borrar"  class="btn_borrar btn btn-link text-danger" data-id="{{$usuario->id}}"><i class="bi bi-trash h4"></i></button>
                            </td>
                        </tr>
                
                    @endforeach
                @else
                    <td class="flex mx-auto col-12"><h2>No hay datos que mostrar</h2></td>
                @endif
            </tbody>
            <div  id="spinner"></div>
        </table>
    <div width="30%" class="modal fade" id="modalTablaCandidatos" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content" style="width: 600px">
                <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLabel">Empleados a candidactos como conductor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <small class='alert alert-success' id='alerta-success' style='display: none;'></small>
                <small class='alert alert-danger' id='alerta-error' style='display: none;'></small> 
                <div class="modal-body">
                    <table id="tabla_candidatos" class="table table-striped border">
                        <thead class="thead-light">
                            <tr>
                                <th width="40px">Fotografía</th>
                                <th width="50px">NIF/NIE</th>
                                <th width="150px">Nombre</th>
                                <th width="150px">Apellidos</th>
                                <th width="60px">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_candidatos">
                           
                        </tbody>
                    </table>
                </div> 
            </div>
            </div>
        </div>
        <!-- End listar  empleados candidatos a conductor modal -->
</div>

@stop

@section('css')
    <link rel="stylesheet" href="./vendor/adminlte/dist/css/adminlte.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./public/css/sweetalert2.min.css">
    <link rel="stylesheet" href="../public/css/create.css">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/busy-load/dist/app.min.js"></script>
    <script src="./public/build/assets/sweetalert2.all.min.js"></script>
@stop