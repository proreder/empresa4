@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado de conductores</h1>
@stop

@section('content')
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
        <buttom class="btn btn-success btn-sm" data-bs-toggle="modal"  data-bs-target="#agregarConductor"><i class="bi-plus-circle me-2"></i>Añadir conductor</button>
        <br><br>
        <div  id="spinner"></div>
        <table id="tabla_conductores" class="table table-striped border">
            <thead class="thead-light">
                <tr>
                    <th width="40px">Fotografía</th>
                    <th width="50px">NIF/NIE</th>
                    <th width="140px">Nombre</th>
                    <th width="40px">Permisos</th>
                    <th width="30px">CAP</th>
                    <th width="60px">Tacógrafo</th>
                    <th width="40px">Tipo ADR</th>
                    <th width="45px">Acciones</th>

                </tr>

            </thead>
            <tbody>
                @foreach ($conductores as $conductor)
                    <tr>
                        <td>@if ($conductor->empleado->imagen)
                                <img src="../storage/app/{{ $conductor->empleado->imagen }}" alt="imagen conductor" width="40">
                            @endif
                        </td>

                        <td>{{ $conductor->nifnie_empleado }}</td>
                        <td>{{ $conductor->empleado->nombre}} {{$conductor->empleado->apellidos}}</td>
                        <td>{{ $conductor->permisos }}</td>
                        <td>{{ $conductor->cap = true ? 'Si' : 'No' }}</td>
                        <td>{{ $conductor->tarjeta_tacografo = true ? 'Si' : 'No' }}</td>
                        <td>{{ $conductor->tipo_ADR }}</td>
                        <td>
                            <!-- <a href="" class="btn_edit text-success mx-1 editIcon" id=""data-bs-toggle="modal"  data-bs-target="#editarConductor{{$conductor->nifnie_empleado}}"><i class="bi-pencil-square h4"></i></a>
                            -->
                                <!-- Button trigger modal -->
                                <button type="button" class="btn_editar btn btn-link" data-bs-config="backdrop:true" data-bs-target="#editarConductor"><i class="bi-pencil-square h4"></i></button>
                                <button type="button"  data-toggle="popover" id="btn_borrar"  class="btn_borrar btn btn-link text-danger" ><i class="bi bi-trash h4"></i></button>
                        </td>
                    </tr>
               
                @endforeach
            </tbody>
        </table>
        
        <!--End card-->


        {{-- Modal edit --}}
        <div class="modal fade" id="editarConductor" tabindex="-1" aria-labelledby="editarConductorLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title fs-5" id="editarConductorLabel">Editar un conductor</h2>
                        <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-square h-3"></i></button>
                    </div>
                    <form action="{{ route('conductores.update',$conductor->nifnie_empleado)}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                    <div class="modal-body" id="form">
                            <div class="mb-5">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" aria-describedby="emailHelp"  disabled readonly>
                            
                            </div>
                            <div class="col-12 px-3">
                                    <div class="form-group border">
                                        <label for="tarjeta_tacografo">Tarjeta tacógrafo:</label>
                                        <select class="form-select mb-3" aria-label="Default select example" id="tarjeta_tacografo" name="tacografo">
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                            </div>
                            
                            <div class="col-12 px-3">
                                    <div class="form-group border">
                                        <label for="cap">Permiso CAP:</label>
                                        <select class="form-select mb-3" aria-label="Default select example" id="cap" name="cap">
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                            </div>
                            
                                <div class="col-12 px-3">
                                    <div class="form-group border">
                                        <label for="exampleInputEmail1">Tipo ADR:</label>
                                        <select class="form-select mb-3" aria-label="Default select example" id="tipo_ADR" name="tipo_ADR">
                                            <option value="Básico">Básico</option>
                                            <option value="Cisternas">Cisternas</option>
                                            <option value="Explosivos">Explosivos</option>
                                            <option value="Radiactivos">Radiactivos</option>
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="permisos" >Permiso:</label>
                                        <select class="form-select mb-3" aria-label="Default select example" id="permisos" name="permisos">
                                            <option selected>C1</option>
                                            <option value="C1">C1</option>
                                            <option value="C1+E">C1+E</option>
                                            <option value="C">C</option>
                                            <option value="C+E">C+E</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="nifnie_empleado" id="nifnie_empleado">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" id="addBtn" class="btn btn-primary">Guardar cambios</button>
                            </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

    
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../public/css/sweetalert2.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="../public/build/assets/sweetalert2.all.min.js"></script>
    
    
    <script>
        $(document).ready(function() {
             $('#conductores').DataTable({
                responsive: true,
                "language": {
                    "search": "Buscar",
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "info": "Página _PAGE_ de _PAGES_",
                    "zeroRecords": "No hay registros",
                    "infoEmpty": "",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente",
                        "first": "Primero",
                        "last": "último"
                    }
                }
            });
            $('#btnEliminar').on('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¡El borrado no se podrá revertir!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Confirmar borrado!"
                }).then((result) => {
                    this.submit()
                });
            });
            //si se pulsa el boton editat se abre el modal con los datos
            $('#tabla_conductores tbody').on( 'click', '.btn_editar', function () {
                var nifnie_empleado = $(this).closest('tr').find('td:eq(1)').text();
                var nombre = $(this).closest('tr').find('td:eq(2)').text();
                var permisos = $(this).closest('tr').find('td:eq(3)').text();
                var cap = $(this).closest('tr').find('td:eq(4)').text();
                var tacografo = $(this).closest('tr').find('td:eq(5)').text();
                var tipo_ADR = $(this).closest('tr').find('td:eq(6)').text();
                $('#editarConductor').modal('show');
                $("#nifnie_empleado").val("nifnie_empleado");
                $('#nombre').val(nombre);
                $("#permisos option[value='"+permisos+"']").attr("selected",true);
                $("#cap option[value='"+cap+"']").attr("selected",true);
                $("#tarjeta_tacografo option[value='"+tacografo+"']").attr("selected",true);
                $("#tipo_ADR option[value='"+tipo_ADR+"']").attr("selected",true);
                
            });
            
        });
    </script>
    @if (Session::has('success'))
        <script>
            Swal.fire({
                title: "Borrado",
                text: "El conductor se ha borrado corectamente",
                icon: "question"
            });
        </script>
    @endif
@endsection
