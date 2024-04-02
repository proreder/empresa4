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
                        <td>@if ($conductor->imagen)
                                <img src="../storage/app/{{ $conductor->imagen }}" alt="imagen conductor" width="40">
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
                                <button type="button" class="btn_editar btn btn-link"  data-bs-toggle="modal" data-bs-target="#editarConductorModal" data-id="{{$conductor->id}}" data-nifnie_empleado="{{$conductor->nifnie_empleado}}" data-permisos="{{$conductor->permisos}}" data-cap="{{$conductor->cap}}" data-tarjeta_tacografo="{{$conductor->tarjeta_tacografo}}" data-tipo_ADR="{{$conductor->tipo_ADR}}" data-imagen="../storage/app/{{ $conductor->imagen }}"><i class="bi-pencil-square h4"></i></button>
                                <button type="button"  data-toggle="popover" id="btn_borrar"  class="btn_borrar btn btn-link text-danger" data-id="{{$conductor->id}}"><i class="bi bi-trash h4"></i></button>
                        </td>
                    </tr>
               
                @endforeach
            </tbody>
        </table>
        
        <!--End card-->

        {{-- Modal  Editar conductor--}}
        <div class="modal fade" id="editarConductorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    @csrf
                        <input type="hidden" id="id_conductor" name="id_conductor">
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
                                        <input type="checkbox" class="form-check-input" data-cap="cap" id="cap" name="cap" >
                                        <label class="form-check-label" for="cap">Permiso CAP</label>
                            </div>
                            <div class="mb-2 col-5 form-check">
                                      <input type="checkbox" class="form-check-input" data-tarjeta_tacografo="tarjeta_tacografo" id="tarjeta_tacografo" name="tarjeta_tacografo">
                                      <label class="form-check-label" for="tarjeta_tacografo">Tarjeta de tacógrafo</label>
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
                    <div class="col-12 my-2 border">
                    
                            <div class="form_group">
                                
                                <div class="file-select col-5 d-flex col-5 mx-auto" id="src-file1" >
                                    <input class="form-control col-12 borde_ccc @error('imagen') is-invalid @enderror" type="file" name="imagen" data-imagen-edit="imagen" id="imagen" accept="image/*" value="{{old('imagen')}}" onchange="mostrarImagen(event, 'imagenEditForm')">
                                </div>
                                @error('imagen')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                                @enderror
                                <br><br>
                            </div>
                    
                            <div class="col-4 mx-auto borde_ccc">
                                    <img id="imagenEditForm" src="#" name="imagenEditForm" alt="" style="width: 100px;height: 143px;">
                            </div>
                        </div>     
                
                
                        <div class="modal-footer">
                            <div class="row justify-content-between col-12">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <div id="spinnerConductor"></div>
                                    <button type="submit" id="btn_updateConductor" class="btn btn-danger">Actualizar</button>
                                </div>
                            </div>
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
                
                <form id="guardarCandidatoForm" enctype="multipart/form-data">
                @csrf
                        <div class="mb-3 col-7">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control form-control-sm" id="nombre_candidato" aria-describedby="nombre_candidato" readonly>
                            
                        </div>
                        <div class="mb-3 col-5">
                            <label for="nifnie_candidato" class="form-label">DNI/NIE empleado:</label>
                            <input type="text" class="form-control form-control-sm" id="nifnie_candidato" name="nifnie_candidato" aria-describedby="nifnie_candidato" readonly>
                            
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
                                <div class="file-select col-5 d-flex col-5 mx-auto" id="src-file1" >
                                    <input class="form-control col-12 borde_ccc @error('imagen') is-invalid @enderror" type="file" name="imagen" id="imagen" accept="image/*" value="{{old('imagen')}}" onchange="mostrarImagen(event,'imagenCandidato')">
                                </div>
                                @error('imagen')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                                @enderror
                                <br><br>
                            </div>
                    
                            <div class="col-4 mx-auto borde_ccc">
                                    <img id="imagenCandidato" src="#" alt="" style="width: 100px;height: 143px;">
                            </div>
                        </div>     
                
                
                        <div class="modal-footer">
                            
                            <div class="row row justify-content-between col-12">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <div id="spinnerCandidato"></div>
                                <button type="submit" id="btn_guardarCandidato" class="btn btn-danger">Guardar</button>
                            </div>
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
            //script para BORRAR un conductor si se pulsa el botón de borrado
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
                var id_conductor = $(this).attr('data-id');
                var url_imagen = $(this).attr('data-imagen');
                console.log('Tamaño imagen:'+url_imagen.length);
                
                //mostramos el formulario modal
                $('#editarConductor').modal('show');
                $("#nifnie_empleado").val(nifnie_empleado);
                $('#nombre').val(nombre);
                $('#permisos').val(permisos);
                $('#id_conductor').val(id_conductor);
                $('#imagenEditForm').attr('src', url_imagen);
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
                        var html="";
                        var url="../storage/app";
                        response.forEach(function(candidato){
                            if(candidato.imagen===null) candidato.imagen='\\public\\imagenes\\anonimo.png';
                            html+="<tr>";
                            html+='<td><img width="30" src="'+url.concat("/",candidato.imagen)+'"></td><td>'+candidato.nifnie+'</td>"'                          
                            +"<td>"+candidato.nombre+"</td>"+"<td>"+candidato.apellidos+"</td>"+
                            '<td><button type="button" class="btn_editarCandidato btn btn-link" data-nifnie="'+candidato.nifnie+'" data-nombre="'+candidato.nombre+'" data-apellidos="'+candidato.apellidos+'"  data-imagen="'+url.concat("/",candidato.imagen)+'"><i class="bi-pencil-square h4"></i></button>';
                            +"</td>";
                            html+="</tr>";
                            console.log('imagen:'+candidato.imagen);
                        });
                        
                        $("#tbody_candidatos").html(html);
                    },
                    error: function(xmr, status, error){
                        console.error(error);
                    }

                })
                
                
            });

            //si se pulsa el boton editar candidato se abre el modal con los datos de fila del modal de los candidatos
            $('#tabla_candidatos tbody').on('click','.btn_editarCandidato', function () {
                console.log('agregarCandidato');
                $('#modalTablaCandidatos').modal('hide');
                var nifnie_candidato = $(this).attr('data-nifnie');
                var nombre = $(this).attr('data-nombre');
                var apellidos = $(this).attr('data-apellidos');
                var imagenCandidato=$(this).attr('data-imagen');
                console.log('imagen candidato: '+imagenCandidato);
                //mostramos el formulario modal para agregar un conductor candidato
                $('#editarConductorCandidato').modal('show');
                $('#nifnie_candidato').val(nifnie_candidato);
                $('#nombre_candidato').val(nombre+' '+apellidos);
                $('#imagenCandidato').attr('src', imagenCandidato);
                
                //abrimos un modal para mostrar los datos del cadidato a conductor 
                //$('#editarCandidatosConductor').modal('show');
                
            });
         

         //si se pulsa  #btn_guardarCandidato       
         $('#guardarCandidatoForm').submit(function(e){
             e.preventDefault();
            //let formData=$(this).serialize();
            var formData=new FormData(this);
            
            $.ajax({
                type: 'POST',
                url: '{{ route("agregarConductor") }}',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    //desactivamos el botón guardar conductor
                    
                    $('#btn_guardarCandidato').prop('disabled', true);
                    $("#spinnerCandidato").busyLoad("show", {
                        fontawesome: "fa fa-spinner fa-spin fa-3x fa-fw" });
                    },
                complete: function(){
                    console.log('complete:');
                    //Si se ha completado la operación lo activamos
                    $('#btn_guardarCandidato').prop('disabled', false);
                }, 
                success: function(data){
                    console.log('success');
                      if(data.success == true){
                        //cerramos el modal agregarCandidato si se ha guardado la informacion en la base de datos correctamente
                        $('#editarConductorCandidato').hide();
                        location.reload();
                        printSuccessMsg(data.msg);
                        Swal.fire({
                            title: "<h3 style='color:red'>¡¡Errores detectados!!</h3>",
                            text: 'Conductor actualizado correctamente',
                            icon: "warning",
                            showCancelButton: false,
                            confirmButtonColor: "#d33",
                            confirmButtonText: "Continuar"
                        });
                      }else if(data.success == false){
                        console.log('success=false');

                        printErrorMsg(data.msg);
                      }else{
                        console.log('printValidationErrorMsg');
                        $('#btn_guardarCandidato').prop('disabled', false);
                        if(!data.msg.cap) data.msg.cap="";
                        if(!data.msg.tarjeta_tacografo) data.msg.tarjeta_tacografo="";
                        if(!data.msg.imagen) data.msg.imagen="";
                        //console.log('tamaño: '+Object.keys(data.msg.imagen).length);
                        
                        Swal.fire({
                            title: "<h3 style='color:red'>¡¡Errores detectados!!</h3>",
                            html: '<div style="color:red">'+data.msg.cap+"<br>"+data.msg.tarjeta_tacografo+"<br>"+data.msg.imagen+'</div>',
                            icon: "warning",
                            showCancelButton: false,
                            confirmButtonColor: "#d33",
                            confirmButtonText: "Continuar"
                        });
                        
                        printValidationErrorMsg(data.msg);
                      }
                },
            });
            return false;

           

        }); 
        
        //si se pulsa  #updateConductor el botón Actualizar      
        $('#editConductorForm').submit(function(e){
             e.preventDefault();
            //let formData=$(this).serialize();
            $valor_cap=$('#cap').is(':checked');
            $valor_tarjeta_tacografo=$('#tarjeta_tacografo').is(':checked');
            console.log('valor_CAP'+$valor_cap);
            console.log('valor tarjeta Tacografo'+$valor_tarjeta_tacografo);
            
            var formData=new FormData(this);

            //Camniamos los valores del checkbox cap a 1 o 0
            if($valor_cap){
                formData.set('cap',1);
            }else{
                formData.set('cap',0);
            }
            //Camniamos los valores del checkbox tarjeta de tacógrafo a 1 o 0
            if($valor_cap){
                formData.set('tarjeta_tacografo',1);
            }else{
                formData.set('tarjeta_tacografo',0);
            }
            
            
            $.ajax({
                type: 'POST',
                url: '{{ route("updateConductor") }}',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    //desactivamos el botón actualizar conductor
                    
                    $('#btn_updateConductor').prop('disabled', true);
                    $("#spinnerConductor").busyLoad("show", {
                        fontawesome: "fa fa-spinner fa-spin fa-3x fa-fw" });
                    },
                complete: function(){
                    console.log('complete:');
                    //Si se ha completado la operación lo activamos
                    $('#btn_updateConductor').prop('disabled', false);
                }, 
                success: function(data){
                    console.log('success');
                      if(data.success == true){
                        //cerramos el modal agregarCandidato si se ha guardado la informacion en la base de datos correctamente
                        $('#editarConductorModal').hide();
                        location.reload();
                        printSuccessMsg(data.msg);
                      }else if(data.success == false){
                        console.log('success=false');
                        $("#spinnerConductor").hide();
                        printErrorMsg(data.msg);
                      }else{
                        $("#spinnerConductor").hide();
                        console.log('printValidationErrorMsg');
                        if(!data.msg.cap) data.msg.cap="";
                        if(!data.msg.tarjeta_tacografo) data.msg.tarjeta_tacografo="";
                        if(!data.msg.imagen) data.msg.imagen="";
                        //console.log('tamaño: '+Object.keys(data.msg.imagen).length);
                        Swal.fire({
                            title: "<h3 style='color:red'>¡¡Errores detectados!!</h3>",
                            html: '<div style="color:red">'+data.msg.cap+"<br>"+data.msg.tarjeta_tacografo+"<br>"+data.msg.imagen+'</div>',
                            icon: "warning",
                            showCancelButton: false,
                            confirmButtonColor: "#d33",
                            confirmButtonText: "Continuar"
                        });
                        $('#btn_updateConductor').prop('disabled', false);
                        printValidationErrorMsg(data.msg);
                      }
                },
            });
            return false;

           

        }); 
            
    });      
        
        //Mostramos la imagen seleccionada
        function mostrarImagen(event, id) {
            console.log('se muestra imagen');
                    var input = event.target;
                    var reader = new FileReader();
                    
                    reader.onload = function() {
                        var imagen = document.getElementById(id);
                        imagen.src = reader.result;
                    }
                    
                    reader.readAsDataURL(input.files[0]);
        };
         //Creamos las tres funciones para los tres tipos de mensajes
         function printValidationErrorMsg(msg){
                $.each(msg, function(field_name, error){
                    console.log(field_name, error);
                    $(document).find('#'+field_name+'_error').text(error);
                });
            }
            function printErrorMsg(msg){
                console.log(msg);
                $('#alerta-error').html('');
                $('#alerta-error').css('display','block');
                $('#alerta-error').append(''+msg+'');
            }
            function printSuccessMsg(msg){
                console.log(msg);
                $('#alerta-success').html('');
                $('#alerta-success').css('display','block');
                $('#alerta-success').append(''+msg+'');
                //si wl formulario se envió correctamente de resetra los campos del formulario
                //document.getElementById('addVehiculoForm').reset();
            }
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
