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
        <buttom class="btn btn-success btn-sm" data-bs-toggle="modal"  data-bs-target="#agregarConductor"><i class="bi-plus-circle me-2"></i>Añadir conductor</buttom>
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
                                <button type="button" class="btn_editar btn btn-link" data-bs-config="backdrop:true" data-bs-toggle="modal" data-bs-target="#editarConductor" data-id="{{$conductor->id}}"><i class="bi-pencil-square h4"></i></button>
                                <button type="button"  data-toggle="popover" id="btn_borrar"  class="btn_borrar btn btn-link text-danger" data-id="{{$conductor->id}}"><i class="bi bi-trash h4"></i></button>
                        </td>
                    </tr>
               
                @endforeach
            </tbody>
        </table>
        
        <!--End card-->

        {{-- Modal  Editar conductor--}}
        <div class="modal fade" id="editarConductor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLabel">Editar Conductor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <small class='alert alert-success' id='alerta-success' style='display: none;'></small>
                <small class='alert alert-danger' id='alerta-error' style='display: none;'></small> 
                <div class="modal-body">
                <form id="editConductorForm" method="POST" enctype="multipart/form-data">
                    <div class="row mt-1 mb-3">
                            <div class="col-10">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control @error('nombre_error') is-invalid @enderror" id="nombre" name="nombre">
                                <small class='alert text-danger' id='matricula_error'></small>
                            </div> 
                            <div class="col-9">
                                <label for="num_chasis" class="form-label">Chasis:</label>
                                <input type="text" class="form-control @error('matricula_error') is-invalid @enderror" id="num_chasis" name="num_chasis">
                                <small class='alert text-danger' id='num_chasis_error'></small>
                            </div>
                    </div> 
                    <div class="row mb-3">
                            <div class="col-3">
                                <label for="potencia" class="form-label">Potencia:</label>
                                <input type="text" class="form-control" id="potencia" name="potencia">
                                <small class='alert text-danger' id='potencia_error'></small>
                            </div> 
                            <div class="col-4">
                                <label for="tipo" class="form-label">Tipo:</label>
                                <input type="text" class="form-control" id="tipo" name="tipo">
                                <small class='alert text-danger' id='tipo_error'></small>
                            </div>
                            <div class="col-5">
                                <label for="modelo" class="form-label">Modelo:</label>
                                <input type="text" class="form-control" id="modelo" name="modelo">
                                <small class='alert text-danger' id='modelo_error'></small>
                            </div>
                    </div> 
                    <div class="row mb-3">
                            <div class="col-3">
                                <label for="km_actuales" class="form-label">Km actuales:</label>
                                <input type="text" class="form-control" id="km_actuales" name="km_actuales">
                                <small class='alert text-danger' id='km_actuales_error'></small>
                            </div> 
                            <div class="col-3">
                                <label for="km_revision" class="form-label">Km revisión:</label>
                                <input type="text" class="form-control" id="km_revision" name="km_revision">
                                <span class='alert text-danger' id='km_revision_error'></span>
                            </div>
                            <div class="form-group ms-2">
                                <label>Disponible:</label>
                                <select class="form-select mb-3" id="disponible" name="disponible">
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                    </div> 
                    <div class="col-12 my-4 border">
                    
                            <div class="form_group">
                                <label for="imagen">Selecciona una imagen:</label>
                                <input class="form-control col-12 borde_ccc @error('imagen') is-invalid @enderror" type="file" name="imagen" id="imagen" accept="image/*" value="{{old('imagen')}}" onchange="mostrarImagen(event)">
                                <small class="text-danger">El tamaño del archivo no puede superor los 65535 Bytes</small>
                                @error('imagen')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                                @enderror
                                <br><br>
                            </div>
                    
                            <div class="col-9 mx-auto borde_ccc">
                                    <img id="imagenSeleccionada" src="#" alt="" style="width: 300px;height: 175px;">
                            </div>
                        </div>     
                
                
                        <div class="modal-footer">
                            <input type="text" id="spinner">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" id="editBtn" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div> 
            </div>
            </div>
        </div>
        <!-- End edit conductor modal -->
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
    <script src="https://cdn.jsdelivr.net/npm/busy-load/dist/app.min.js"></script>
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
            
            $('.btn_borrar').on('click', function(e) {
                var conductor_id= $(this).attr('data-id');
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
                    if(result.isConfirmed){
                        var url= "{{ route('borrarConductor','conductor_id') }}";
                        url=url.replace('conductor_id',conductor_id);
                        $.ajax({
                            type: 'GET',
                            url: url,
                            contentType: false,
                            processData: false,
                            beforeSend: function(){
                                //desactivamos el botón añadir vehículos
                                //$('#')('beforeSend');
                                $('.btn_borrar').prop('disabled', true);
                                $("#spinner").busyLoad("show", {
                                    fontawesome: "fa fa-spinner fa-spin fa-3x fa-fw" });
                                },
                            complete: function(){
                                //Si se ha comppletado la operación lo activamos
                                $('.btn_borrar').prop('disabled', false);
                            }, 
                            success: function(data){
                                console.log('success');
                                if(data.success == true){
                                    Swal.fire({
                                        title: "Borrado",
                                        text: "El conductor se ha borrado corectamente",
                                        icon: "question"
                                    }).then((result) => {
                                            if(result.isConfirmed){
                                                location.reload();    
                                            }
                                    });
                                    
                                    
                                }else if(data.success == false){
                                    Swal.fire({
                                        title: "Borrado",
                                        text: data.msg,
                                        icon: "question"
                                    });
                                    
                                }
                            },
                        });    
                    }
                    
                });
            });
            //si se pulsa el boton editar se abre el modal con los datos
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
