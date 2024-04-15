@extends('adminlte::page')

@section('title', 'Vehículos')

@section('content_header')
<meta name="csrf-token" content="{{ csrf_token() }}">
        
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
    <div class="float-right justify-content-end">
                            
    </div>
    <div class="container-fluid">
 
        <div class="row my-5">
            <div class="col-lg-12">
                
                <div class="card shadow">
                    <div class="card-header row col-12">
                        <h5 class="text-dark col-11">Control de vehículos</h5>
                        <button class="btn btn-success btn-sm " data-bs-toggle="modal"  data-bs-target="#agregarVehiculo"><i class="bi-plus-circle me-2"></i>Añadir vehículo</button>
                    </div>
                    <div class="card-body" id="mostrarTodosVehiculos">
                    <table id="tabla_vehiculos" class="table table-striped border">
                        <thead class="thead-light">
                            <tr>
                                <th width="70px">Matrícula</th>
                                <th width="220px">Número de chasis</th>
                                <th width="60px">Potencia</th>
                                <th width="70px">Tipo</th>
                                <th width="120px">Modelo</th>
                                <th width="100px">Km. Actuales</th>
                                <th width="100px">Km. Revisión</th>
                                <th width="60px">Disponible</th>
                                <th width="60px">Foto</th>
                                <th width="100px">Acciones</th>
                            </tr>

                        </thead>
                        <tbody>
                            @if ($vehiculos)
                                @foreach ($vehiculos as $vehiculo)
                                    <tr>
                                        <td>{{$vehiculo->matricula}}</td>
                                        <td>{{$vehiculo->numero_chasis}}</td>
                                        <td>{{$vehiculo->potencia}}</td>
                                        <td>{{$vehiculo->tipo}}</td>
                                        <td>{{$vehiculo->modelo}}</td>
                                        <td>{{$vehiculo->km_actuales}}</td>
                                        <td>{{$vehiculo->km_revision}}</td>
                                        <td>{{$vehiculo->disponible}}</td>
                                        <td>@if ($vehiculo->imagen)
                                                <img src="../storage/app/{{ $vehiculo->imagen }}" width="60">
                                            @endif
                                        </td>
                                        <!--
                                        <td><img src="data:image/png;base64,
                                            <?php 
                                                   // echo base64_encode($vehiculo->foto); 
                                            ?>"  alt="" width="60"></td>
                                        -->
                                        <td>
                                            <button type="button" class="btn_editar btn btn-link" data-bs-config="backdrop:true" data-bs-target="#editarConductor" data-id_edit="{{$vehiculo->id}}" data-matricula="{{$vehiculo->matricula}}" data-chasis="{{$vehiculo->numero_chasis}}" data-potencia="{{$vehiculo->potencia}}" data-tipo="{{$vehiculo->tipo}}" data-modelo="{{$vehiculo->modelo}}" data-km_actuales="{{$vehiculo->km_actuales}}" data-km_revision="{{$vehiculo->km_revision}}" data-disponible="{{$vehiculo->disponible}}" data-imagen="{{$vehiculo->imagen}}"><i class="bi-pencil-square h4"></i></button>
                                            <button type="button"  data-toggle="popover" id="btn_borrar" data-id="{{$vehiculo->id}}" class="btn_borrar btn btn-link text-danger" ><i class="bi bi-trash h4"></i></button>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            @else 
                                <tr>
                                    <td coolspan="5">No hay datos que mostrar</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                                           

                    </div>
                </div>
            </div>
        </div>
    </div>
       
        
{{-- Modal  Añadir vehículo--}}
<div class="modal fade" id="agregarVehiculo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="exampleModalLabel">Añadir vehículo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
        </div>
        <small class='alert alert-success' id='alerta-success' style='display: none;'></small>
        <small class='alert alert-danger' id='alerta-error' style='display: none;'></small> 
        <div class="modal-body">
          <form id="addVehiculoForm" method="POST" enctype="multipart/form-data">
              <div class="row mt-1 mb-3">
                    <div class="col-3">
                        <label for="matricula" class="form-label">Matrícula:</label>
                        <input type="text" class="form-control @error('matricula_error') is-invalid @enderror" id="matricula" name="matricula">
                        <small class='alert text-danger' id='matricula_error'></small>
                    </div> 
                    <div class="col-9">
                        <label for="num_chasis" class="form-label">Chasis:</label>
                        <input type="text" class="form-control" id="num_chasis" name="num_chasis">
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
            
                    <div class="col-9 mx-auto borde_ccc">
                            <img id="imagenSeleccionada" src="#" alt="" style="width: 300px;height: 175px;">
                    </div>
                </div>     
           
           
                <div class="modal-footer">
                <div class="row row justify-content-between col-12">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <div id="spinnerVehiculo"></div>
                                <button type="submit" id="btn_guardarVehiculo" class="btn btn-danger">Guardar</button>
                </div>
                </div>
             </form>
        </div> 
      </div>
    </div>
</div>
   
{{-- Modal editar vehiculo --}}
<div class="modal fade" id="editarVehiculo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar un vehículo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">
            <form id="editVehiculoForm">
            @csrf
              <input type="hidden" id="id_vehiculo" name="id_vehiculo">
              <div class="row mt-1 mb-3">
                    <div class="col-3">
                        <label for="matricula_edit" class="form-label">Matrícula:</label>
                        <input type="text" class="form-control @error('matricula_error') is-invalid @enderror" id="matricula_edit" name="matricula_edit">
                        <small class='alert text-danger' id='matricula_error'></small>
                    </div> 
                    <div class="col-9">
                        <label for="num_chasis_edit" class="form-label">Chasis:</label>
                        <input type="text" class="form-control" id="num_chasis_edit" name="num_chasis_edit">
                        <small class='alert text-danger' id='num_chasis_error'></small>
                    </div>
               </div> 
               <div class="row mb-3">
                    <div class="col-3">
                        <label for="potencia_edit" class="form-label">Potencia:</label>
                        <input type="text" class="form-control" id="potencia_edit" name="potencia_edit">
                        <small class='alert text-danger' id='potencia_error'></small>
                    </div> 
                    <div class="col-4">
                        <label for="tipo_edit" class="form-label">Tipo:</label>
                        <input type="text" class="form-control" id="tipo_edit" name="tipo_edit">
                        <small class='alert text-danger' id='tipo_error'></small>
                    </div>
                    <div class="col-5">
                        <label for="modelo_edit" class="form-label">Modelo:</label>
                        <input type="text" class="form-control" id="modelo_edit" name="modelo_edit">
                        <small class='alert text-danger' id='modelo_error'></small>
                    </div>
               </div> 
               <div class="row mb-3">
                    <div class="col-3">
                        <label for="km_actuales_edit" class="form-label">Km actuales:</label>
                        <input type="text" class="form-control" id="km_actuales_edit" name="km_actuales_edit">
                        <small class='alert text-danger' id='km_actuales_error'></small>
                    </div> 
                    <div class="col-3">
                        <label for="km_revision_edit" class="form-label">Km revisión:</label>
                        <input type="text" class="form-control" id="km_revision_edit" name="km_revision_edit">
                        <span class='alert text-danger' id='km_revision_error'></span>
                    </div>
                    <div class="form-group ms-2">
                        <label for="disponible_edit">Disponible:</label>
                        <select class="form-select mb-3" id="disponible_edit" name="disponible_edit">
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select>
                    </div>
               </div> 
               <div class="col-12 my-4 border">
            
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
            
                    <div class="col-9 mx-auto borde_ccc">
                            <img id="imagenEditForm" src="" alt="" style="width: 300px;height: 175px;">
                    </div>
                </div>     
           
            </div>
            <div class="modal-footer">
                    <div class="row row justify-content-between col-12">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <div id="spinnerVehiculo"></div>
                                    <button type="submit" id="btn_guardarVehiculo" class="btn btn-danger">Actualizar</button>
                    </div>
            </div>
        </form>
      </div>
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/busy-load/dist/app.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../public/css/create.css">
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/busy-load/dist/app.min.js"></script>
<script src="../public/build/assets/sweetalert2.all.min.js"></script>
<script>
    //CSRF
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    $(document).ready(function(){
        $('#tabla_vehiculos').DataTable({
                responsive: true,
                "language": {
                    "search": "Buscar",
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "info": "Página _PAGE_ de _PAGES_",
                    "zeroRecords": "No hay registros",
                    "infoEmpty": "",
                    "paginate": {
                        "previous": "Anterior  ",
                        "next": "  Siguiente",
                        "first": "Primero",
                        "last": "último"
                    }
                }
            });
        
        //script para BORRAR un conductor si se pulsa el botón de borrado
        $('.btn_borrar').on('click', function(e) {
                console.log('Se ha pulsado borrar');
                var vehiculo_id= $(this).attr('data-id');
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
                        var url= "{{ route('borrarVehiculo','vehiculo_id') }}";
                        url=url.replace('vehiculo_id',vehiculo_id);
                        console.log(url);
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
                                        text: "El vehículo se ha borrado corectamente",
                                        icon: "question"
                                    }).then((result) => {
                                            if(result.isConfirmed){
                                                $("#spinner").hide();
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
        //Se abre una ventana modal para añadir los datos de un nuevo vehiculo
        $('#addVehiculoForm').submit(function(e){
            
            e.preventDefault();
            //let formData=$(this).serialize();
            var formData=new FormData(this);
            $.ajax({
                type: 'POST',
                url: '{{ route("crearVehiculo") }}',
                data: formData,
                dataType: 'JSON',
                contentType: false,
                processData: false,
                beforeSend: function(){
                    //desactivamos el botón añadir vehículos
                    //$('#')('beforeSend');
                    $('#addBtn').prop('disabled', true);
                    $("#spinner").busyLoad("show", {
                        fontawesome: "fa fa-spinner fa-spin fa-3x fa-fw" });
                    },
                complete: function(){
                    //Si se ha comppletado la operación lo activamos
                    $('#addBtn').prop('disabled', false);
                }, 
                success: function(data){
                    console.log('success');
                      if(data.success == true){
                        //cerramos el modal agregarVehiculo si se ha guardado la informacion en la base de datos correctamente
                        $('#agregarVehiculo').hide();
                        printSuccessMsg(data.msg);
                        //location.reload();
                      }else if(data.success == false){
                        printErrorMsg("Error, no se ha pódido guardar el vehículo");
                        console.log(data.msg);
                      }else{
                        console.log('printValidationErrorMsg');
                        printErrorMsg("Error, no se ha pódido guardar el vehículo");
                        printValidationErrorMsg(data.msg);
                      }
                },
            });
            return false;
         });

         //si se pulsa el boton editar se abre el modal con los datos de fila de la tabla
         $('#tabla_vehiculos tbody').on( 'click', '.btn_editar', function () {
                var id_vehiculo = $(this).attr('data-id_edit');
                var matricula = $(this).attr('data-matricula');
                var chasis = $(this).attr('data-chasis');
                var potencia = $(this).attr('data-potencia');
               
                var tipo = $(this).attr('data-tipo');
                var modelo = $(this).attr('data-modelo');
                var km_actuales = $(this).attr('data-km_actuales');
                var km_revision = $(this).attr('data-km_revision');
                var disponible = $(this).attr('data-disponible');
                var url_imagen = $(this).attr('data-imagen');
                               
                //rellenamos el formulario modal con los datos de la fila seleccionada
                $('#editarVehiculo').modal('show');
                $('#id_vehiculo').val(id_vehiculo)
                $("#matricula_edit").val(matricula);
                $('#num_chasis_edit').val(chasis);
                $('#potencia_edit').val(potencia);
                $('#tipo_edit').val(tipo);
                $('#modelo_edit').val(modelo);
                $('#km_actuales_edit').val(km_actuales);
                $('#km_revision_edit').val(km_revision);
                $('#disponible').val(disponible);
            

                console.log('Url: '+url_imagen)
                var url="../storage/app/";
                $('#imagenEditForm').attr('src', url+url_imagen);
                //Verificamos valor de disponible
                if(disponible==true){
                    $("#disponible").prop('checked',true);
                }else{
                    $("#disponible").prop('checked',false);
                }
                
                
            });

            //si se pulsa   el botón Actualizar  enviamos el formulario    
        $('#editVehiculoForm').submit(function(e){
            console.log('pulsado en botón actualizar vehiculo');
             e.preventDefault();
             
             var url="../storage/app/";
                
                var url_imagen=$('#imagenEditForm').attr('src');
               
                $disponible = $(this).attr('disponible_edit');
                var formData=new FormData(this);
                formData.set('imagen',url_imagen);

            //Camniamos los valores del select  a 1 o 0
            if($disponible==="Si"){
                formData.set('disponible_edit',1);
            }else{
                formData.set('disponible_edit',0);
            }
                       
            console.log(formData);
            $.ajax({
                type: 'POST',
                url: '{{ route("updateVehiculo") }}',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    //desactivamos el botón actualizar vehiculo
                    
                    $('#btn_updateVehiculo').prop('disabled', true);
                    $("#spinnerVehiculo").busyLoad("show", {
                        fontawesome: "fa fa-spinner fa-spin fa-3x fa-fw" });
                    },
                complete: function(){
                    
                    //Si se ha completado la operación lo activamos
                    $('#btn_updateVehiculo').prop('disabled', false);
                }, 
                success: function(data){
                    console.log('success updateVehiculo');
                      if(data.success == true){
                        //cerramos el modal agregarCandidato si se ha guardado la informacion en la base de datos correctamente
                        $('#editVehiculoModal').hide();
                        location.reload();
                        printSuccessMsg(data.msg);
                      }else if(data.success == false){
                        console.log('success=false');
                        $("#spinnerVehiculo").hide();
                        printErrorMsg(data.msg);
                      }else{
                        $("#spinnerVehiculo").hide();
                        console.log('printValidationErrorMsg');
                        
                        $('#btn_updateVehiculo').prop('disabled', false);
                        printValidationErrorMsg(data.msg);
                      }
                },
            });
            return false;

           

        }); 
        /*
        $('[data-toggle="popover"]').hover(function(){
                console.log('mouseHover');
            $(this).css("background-color", "yellow");
            }, function(){
            $(this).css("background-color", "red");
        });
        $('[data-toggle="popover"]').popover();
        */
        mostrarVehiculos();
        //funcion para motras los vehiculos de la base de datos
        function mostrarVehiculos(){
            $.ajax({
                type: 'get',
                url: "{{ route('listarVehiculos') }}",
                success: function(response){
                    //$('#mostrarTodosVehiculos').html($html);
                    //console.log('listarVehiculos');
                }
            });
        };
     });
        //Mostramos la imagen seleccionada
        function mostrarImagen(event, id) {
                var input = event.target;
                var reader = new FileReader();
                
                reader.onload = function() {
                var imagen = document.getElementById(id);
                imagen.src = reader.result;
                }
                
                reader.readAsDataURL(input.files[0]);
         };
          //Creamos las tres funciones para craer los mensajes
          function printValidationErrorMsg(msg){
                $.each(msg, function(field_name, error){
                    console.log(field_name, error);
                    $(document).find('#'+field_name+'_error').text(error);
                });
            }
            function printErrorMsg(msg){
                Swal.fire({
                title: "Acción sobre vehículos",
                html: '<h3>'+msg+'</h3>',
                icon: "error",
                showCancelButton: false,
                confirmButtonColor: "#d33",
                confirmButtonText: "Continuar"
              }).then((result) => {
 
                //si wl formulario se envió correctamente de resetra los campos del formulario
                document.getElementById('addVehiculoForm').reset();
                //recargamos la página para actualizar los cambios
                location.reload();
              })
            }
            function printSuccessMsg(msg){
                Swal.fire({
                title: "Acción sobre vehículos",
                html: '<h3>'+msg+'</h3>',
                icon: "success",
                showCancelButton: false,
                confirmButtonColor: "#d33",
                confirmButtonText: "Continuar"
              }).then((result) => {
 
                //si wl formulario se envió correctamente de resetra los campos del formulario
                document.getElementById('addVehiculoForm').reset();
                //recargamos la página para actualizar los cambios
                location.reload();
              })
            }
</script>

@endsection