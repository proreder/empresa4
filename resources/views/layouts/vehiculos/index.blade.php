@extends('adminlte::page')

@section('title', 'Vehículos')

@section('content_header')
        
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
                    <table id="tabla_conductores" class="table table-striped border">
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
                                <th width="80px">Acciones</th>
                            </tr>

                        </thead>
                        <tbody>
                            @if (count($vehiculos) >0)
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
                                            <button type="button" class="btn_editar btn btn-link" data-bs-config="backdrop:true" data-bs-target="#editarConductor"><i class="bi-pencil-square h4"></i></button>
                                            <button type="button"  data-toggle="popover" id="btn_borrar"  class="btn_borrar btn btn-link text-danger" ><i class="bi bi-trash h4"></i></button>
                                            
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
                        <h2 class="text-center text-secondary my-5">Cargando...</h2>                    

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
                    <button type="submit" id="addBtn" class="btn btn-primary">Guardar</button>
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
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">
            <form id="editarVehiculoForm">
                
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/busy-load/dist/app.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/busy-load/dist/app.min.js"></script>
<script>
    //CSRF
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    $(document).ready(function(){
        $('#addVehiculoForm').submit(function(e){
            
            e.preventDefault();
            //let formData=$(this).serialize();
            var formData=new FormData(this);
            $.ajax({
                type: 'POST',
                url: '{{ route("crearVehiculo") }}',
                data: formData,
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
                        location.reload();
                        printSuccessMsg(data.msg);
                      }else if(data.success == false){
                        console.log('success=false');
                        printErrorMsg(data.msg);
                      }else{
                        console.log('printValidationErrorMsg');
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
                    console.log('listarVehiculos');
                }
            });
        };
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
          //Creamos las tres funciones para craer los mensajes
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
                document.getElementById('addVehiculoForm').reset();
            }
</script>
@endsection