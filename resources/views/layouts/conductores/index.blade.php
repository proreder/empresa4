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
        <!--data-bs-target="#agregarConductor"-->
        <button class="btn btn-success btn-sm" data-bs-toggle="modal" id="agregarCandidato" data-bs-target="#modalTablaCandidatos"><i class="bi-plus-circle me-2"></i>Añadir conductor</button>
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
                        <td>{{ $conductor->cap == true ? 'Si' : 'No' }}</td>
                        <td>{{ $conductor->tarjeta_tacografo == true ? 'Si' : 'No' }}</td>
                        <td>{{ $conductor->tipo_ADR }}</td>
                        <td>
                            <!-- <a href="" class="btn_edit text-success mx-1 editIcon" id=""data-bs-toggle="modal"  data-bs-target="#editarConductor{{$conductor->nifnie_empleado}}"><i class="bi-pencil-square h4"></i></a>
                            -->
                                <!-- Button trigger modal -->
                                <button type="button" class="btn_editar btn btn-link"  data-bs-toggle="modal" data-bs-target="#editarConductor" data-id="{{$conductor->id}}" data-nifnie_empleado="{{$conductor->nifnie_empleado}}" data-permisos="{{$conductor->permisos}}" data-cap="{{$conductor->cap}}" data-tarjeta_tacografo="{{$conductor->tarjeta_tacografo}}" data-tipo_ADR="{{$conductor->tipo_ADR}}" ><i class="bi-pencil-square h4"></i></button>
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
                        <div class="mb-3 col-7">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control form-control-sm" id="nombre" aria-describedby="nombre" disabled readonly>
                            
                        </div>
                        <div class="mb-3 col-5">
                            <label for="nifnie_empleado" class="form-label">DNI/NIE empleado:</label>
                            <input type="text" class="form-control form-control-sm" id="nifnie_empleado" aria-describedby="nifnie_empleado" disabled readonly>
                            
                        </div>
                    <div class="row mt-5">
                            <div class="col-3">
                                <label for="permisos" class="form-label">Permisos:</label>
                                <select class="form-select mb-3 permisos" aria-label="permisos" id="permisos" name="permisos">
                                                    <option value="C1">C1</option>
                                                    <option value="C1+E">C1+E</option>
                                                    <option value="C">C</option>
                                                    <option value="C+E">C+E</option>
                                </select>
                            </div> 
                            <div class="mb-2 col-4 form-check">
                                        <input type="checkbox" class="form-check-input" id="cap" name="cap">
                                        <label class="form-check-label" for="cap">Permiso CAP</label>
                            </div>
                            <div class="mb-2 col-5 form-check">
                                      <input type="checkbox" class="form-check-input" id="tarjeta_tacografo" name="tarjeta_tacografo">
                                      <label class="form-check-label" for="tarjeta_tacografo">Tarjeta de Tacógrafo</label>
                            </div>
                    </div> 
                    <div class="row col-12">
                            <div class="py-3">
                                <div class="form-group border">
                                    <label for="tipo_ADR">Tipo de permiso ADR:</label>
                                    <select class="form-select mb-3" aria-label="Default select example" id="tipo_ADR" name="tipo_ADR">
                                         <option value="Básico">Básico</option>
                                        <option value="Cisternas">Cisternas</option>
                                        <option value="Explosivos">Explosivos</option>
                                        <option value="Radiactivos">Radiactivos</option>
                                    </select>
                                </div>
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
                    
                            <div class="col-5 mx-auto borde_ccc">
                                    <img id="imagenSeleccionada" src="#" alt="" style="width: 100px;height: 143px;">
                            </div>
                        </div>     
                
                
                        <div class="modal-footer">
                            <div id="spinner"></div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" id="editBtn" class="btn btn-danger">Guardar</button>
                        </div>
                    </form>
                </div> 
            </div>
            </div>
        </div>
                <!-- End edit conductor modal -->

        {{-- Modal  listar empleado candidado a conductor--}}
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

        {{-- Modal  Editar el candidato a conductor seleccionado--}}
        <div class="modal fade" id="editarConductorCandidato" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLabel">Añadir datos del candidato a Conductor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <small class='alert alert-success' id='alerta-success' style='display: none;'></small>
                <small class='alert alert-danger' id='alerta-error' style='display: none;'></small> 
                <div class="modal-body">
                <form id="editConductorForm" method="POST" enctype="multipart/form-data">
                        <div class="mb-3 col-7">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control form-control-sm" id="nombre_candidato" aria-describedby="nombre_candidato" readonly>
                            
                        </div>
                        <div class="mb-3 col-5">
                            <label for="nifnie_empleado" class="form-label">DNI/NIE empleado:</label>
                            <input type="text" class="form-control form-control-sm" id="nifnie_candidato" aria-describedby="nifnie_candidato" readonly>
                            
                        </div>
                    <div class="row mt-5">
                            <div class="col-3">
                                <label for="permisos" class="form-label">Permisos:</label>
                                <select class="form-select mb-3 permisos" aria-label="permisos" id="permisos" name="permisos">
                                                    <option value="C1">C1</option>
                                                    <option value="C1+E">C1+E</option>
                                                    <option value="C">C</option>
                                                    <option value="C+E">C+E</option>
                                </select>
                            </div> 
                            <div class="mb-2 col-4 form-check">
                                        <input type="checkbox" class="form-check-input" id="cap" name="cap">
                                        <label class="form-check-label" for="cap">Permiso CAP</label>
                            </div>
                            <div class="mb-2 col-5 form-check">
                                      <input type="checkbox" class="form-check-input" id="tarjeta_tacografo" name="tarjeta_tacografo">
                                      <label class="form-check-label" for="tarjeta_tacografo">Tarjeta de Tacógrafo</label>
                            </div>
                    </div> 
                    <div class="row col-12">
                            <div class="py-3">
                                <div class="form-group border">
                                    <label for="tipo_ADR">Tipo de permiso ADR:</label>
                                    <select class="form-select mb-3" aria-label="Default select example" id="tipo_ADR" name="tipo_ADR">
                                         <option value="Básico">Básico</option>
                                        <option value="Cisternas">Cisternas</option>
                                        <option value="Explosivos">Explosivos</option>
                                        <option value="Radiactivos">Radiactivos</option>
                                    </select>
                                </div>
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
                    
                            <div class="col-5 mx-auto borde_ccc">
                                    <img id="imagenSeleccionada" src="#" alt="" style="width: 100px;height: 143px;">
                            </div>
                        </div>     
                
                
                        <div class="modal-footer">
                            <div id="spinner"></div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" id="editBtn" class="btn btn-danger">Guardar</button>
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
        //CSRF
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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
            //si se pulsa el boton editar se abre el modal con los datos de fila de la tabla
            $('#tabla_conductores tbody').on( 'click', '.btn_editar', function () {
                var nifnie_empleado = $(this).attr('data-nifnie_empleado');
                var nombre = $(this).closest('tr').find('td:eq(2)').text();
                var permisos = $(this).attr('data-permisos');
               
                var cap = $(this).attr('data-cap');
                var tacografo = $(this).attr('data-tarjeta_tacografo');
                var tipo_ADR = $(this).attr('data-tipo_ADR');

                //mostramos el formulario modal
                $('#editarConductor').modal('show');
                $("#nifnie_empleado").val(nifnie_empleado);
                $('#nombre').val(nombre);
                
                $('#permisos').val(permisos);
                //Verificamos valor de cap
                if(cap==true){
                    $("#cap").prop('checked',true);
                }else{
                    $("#cap").prop('checked',false);
                }
                //Verificamos valor tarjeta tacógrafo
                if(tacografo==true){
                    $("#tarjeta_tacografo").prop('checked',true);
                }else{
                    $("#tarjeta_tacografo").prop('checked',false);
                }
                $("#tipo_ADR").val(tipo_ADR);
                
            });

            //si se pulsa el botón añadir conductor mostramos una tabla de los empleados que tienen
            //el tipo=conductor y no estan en la tabla conductor
            $('#agregarCandidato').on('click', function(){
                console.log('boton pulsado agregar conductores');
                    //mostramos el formulario modal
                $('#modalTablaCandidatos').modal('show');
                $.ajax({
                    type: 'get',
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    url: "{{ route('obtenerCandidatos') }}",
                    success: function(response){
                        //variable para alpacear el contenido del tbody
                        var html="tr";
                        response.forEach(function(candidato){
                            html+="<td>URL:"+"</td>"+"<td>"+candidato.nifnie+"</td>"+"<td>"+candidato.nombre+"</td>"+"<td>"+candidato.apellidos+"</td>"+
                            '<td><button type="button" class="btn_editarCandidato btn btn-link"    data-nifnie="'+candidato.nifnie+'" data-nombre="'+candidato.nombre+'" data-apellidos="'+candidato.apellidos+'"><i class="bi-pencil-square h4"></i></button>';
                            +"</td>";
                        });
                        html+="</tr>";
                        $("#tbody_candidatos").html(html);
                    },
                    error: function(xmr, status, error){
                        console.error(error);
                    }

                })
                    
                
            });

            //si se pulsa el boton editar candidatp se abre el modal con los datos de fila del modal de los candidatos
            $('#tabla_candidatos tbody').on('click','.btn_editarCandidato', function () {
                console.log('agregarCandidato');
                $('#modalTablaCandidatos').modal('hide');
                var nifnie_candidato = $(this).attr('data-nifnie');
                var nombre = $(this).attr('data-nombre');
                var apellidos = $(this).attr('data-apellidos');
                
               
                //mostramos el formulario modal para agregar un conductor candidato
                $('#editarConductorCandidato').modal('show');
                $('#nifnie_candidato').val(nifnie_candidato);
                $('#nombre_candidato').val(nombre+' '+apellidos);
                
                console.log(nifnie_candidato);
                console.log(nombre);
                console.log(apellidos);
                $('')
                //abrimos un modal para mostrar los datos del cadidato a conductor 
                //$('#editarCandidatosConductor').modal('show');
                
            });
         });
                
            
            
            
        
        //Mostramos la imagen seleccionada
        function mostrarImagen(event) {
                    var input = event.target;
                    var reader = new FileReader();
                    
                    reader.onload = function() {
                        var imagen = document.getElementById('imagenSeleccionada');
                        imagen.src = reader.result;
                    }
                    
                    reader.readAsDataURL(input.files[0]);
        };
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
