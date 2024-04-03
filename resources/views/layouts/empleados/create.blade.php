@extends('adminlte::page')

@section('title', 'Alta de empleado')

@section('sidebar')

@stop
@section('content_header')
    <h4>Alta empleado</h4>
@stop

@section('content')
    <!--
    @role('super')
        <p>Hola SuperAdministrador</p>
    @endrole
    @role('admin')
        <p>Hola Administrador</p>
    @endrole
    @role('usuario')
        <p>Hola Usuario</p>
    @endrole

    -->



    <form class="form-horizontal" id="agregarEmpleadoForm" method="post" enctype="multipart/form-data">
        @csrf

        <div class="container-fluid">
          <div class="row border border-danger">
            
              <div class="col-4 col-md-3 col-lg-3 col-xl-2 border">
                  <div class="form-group">
                    <label for="nss">NSS.:</label><span class="text-danger">*</span>
                    <input type="text" class="form-control @error('nss') is-invalid @enderror" id="nss" name="nss" value="{{old('nss')}}">
                    @error('nss')
                      <small class='text-danger'>{{$message}}</small>
                    @enderror
                  </div>        
              </div> 
              <div class="col-2 col-md-2 col-lg-2 col-xl-1">
                <div class="form-group">
                    <label for="select">Tipo:</label>
            
                    <select id="select" name="select" class="form-control">
                        <option value="nif">NIF</option>
                        <option value="nie">NIE</option>
                    </select>
                </div>
              </div>
              <div class="col-3 col-md-2 col-lg-2 col-xl-2">
                <div class="form-group">
                    <label for="nifnie">Número:</label>
                    <input type="text" class="form-control @error('nifnie') is-invalid  @enderror" id="nifnie" name="nifnie" value="{{old('nifnie')}}">
                    @error('nifnie')
                      <small class="text-danger">
                        {{$message}}
                      </small>
                    @enderror
                </div>
              </div>

                <div class="col-3 col-md-2 col-lg-2 col-xl-2">
                  <div class="form-group">
                    <label for="select">Sexo:</label>
                    <select id="select" name="select" class="form-control">
                        <option value="hombre">Hombre</option>
                        <option value="mujer">Mujer</option>
                        <option value="x">X</option>
                    </select>
                  </div>
                </div>

              <!--  <div class="col-2 col-md-2 col-lg-2 col-xl-7"></div> -->

                
            <div class="col-5 col-md-3 col-lg-3 col-xl-2">
                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                    <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" id="fecha_nacimiento" name="fecha_nacimiento" value="{{old('fecha_nacimiento')}}">
                    @error('fecha_nacimiento')
                       <small class="text-danger">
                            {{$message}}
                       </small>
                    @enderror
                </div>
            </div>


              <div class="col-12 col-md-5 col-xl-4">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{old('nombre')}}">
                    @error('nombre')
                      <small class="text-danger">
                        {{$message}}
                      </small>
                    @enderror
                </div>
              </div>
              
              <div class="col-12 col-md-5 col-xl-4">  
                <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" class="form-control @error('apellidos') is-invalid @enderror" id="apellidos" name="apellidos" value="{{old('apellidos')}}">
                    @error('apellidos')
                      <small class="text-danger">
                          {{$message}}
                      </small>
                    @enderror
                </div>
            </div>
            
            <div class="col-xl-4"></div>


           <div class="col-8 col-md-2 col-lg-2 col-xl-1">
                <div class="form-group">
                  <label for="tipo_via">Tipo via:</label>
                  <input type="text" class="form-control @error('tipo_via') is-invalid @enderror" id="tipo_via" name="tipo_via" value="{{old('tipo_via')}}">
                  @error('tipo_via')
                    <small class="text-danger">
                      {{$message}}
                    </small>
                  @enderror
                </div>
           </div>

           <div class="col-9 col-md-5 col-lg-4">
              <div class="form-group">
                  <label for="nombre_via">Nombre via:</label>
                  <input type="text" class="form-control @error('nombre_via') is-invalid @enderror" id="nombre_via" name="nombre_via" value="{{old('nombre_via')}}">
                  @error('nombre_via')
                  <small class="text-danger">
                    {{$message}}
                  </small>
                  @enderror
              </div>
           </div>
           <div class="col-2 col-lg-1 col-xl-1 mr-3">
            <div class="form-group">
              <label for="numero">Número:</label>
              <input type="text" class="form-control @error('numero') is-invalid @enderror" id="numero" name="numero" value="{{old('numero')}}">
              @error('numero')
                  <small class="text-danger">
                    {{$message}}
                  </small>
              @enderror
            </div>
          </div>

          <div class="col-3 col-md-3 col-lg-1">
            <div class="form-group">
                <label for="planta">Planta:</label>
                <input type="text" class="form-control" id="planta" name="planta">
            </div>
         </div>

          <div class="col-3 col-md-2 col-lg-1">
            <div class="form-group">
              <label for="puerta">Puerta:</label>
              <input type="text" class="form-control" id="puerta" name="puerta">
            </div>
          </div>

           <div class="col-11 col-md-5 col-lg-5">
              <div class="form-group">
                <label for="municipio">Municipio:</label>
                <input type="text" class="form-control @error('municipio') is-invalid @enderror" id="municipio" name="municipio" value="{{old('municipio')}}">
                @error('municipio')
                  <small class="text-danger">
                    {{$message}}
                  </small>
                @enderror
              </div>
           </div>

           <div class="col-3 col-md-2 col-lg-2 col-xl-1">
            <div class="form-group">
              <label for="cp">CP:</label>
              <input type="text" class="form-control @error('cp') is-invalid @enderror" id="cp" name="cp" value="{{old('cp')}}">
              @error('cp')
                  <small class="text-danger">
                    {{$message}}
                  </small>
              @enderror
            </div>
          </div>

           <div class="col-11 col-md-5 col-lg-5 col-xl-5">
              <div class="form-group">
                <label for="provincia">Provincia:</label>
                <input type="text" class="form-control @error('provincia') is-invalid @enderror" id="provincia" name="provincia" value="{{old('provincia')}}">
                @error('provincia')
                  <small class="text-danger">
                    {{$message}}
                  </small>
                @enderror
              </div>
           </div>

          <div class="col-3 col-md-2">
            <div class="form-group">
               <label for="telefono">Telefono:</label>
               <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{old('telefono')}}">
               @error('telefono')
                  <small class="text-danger">
                    {{$message}}
                  </small>
               @enderror
            </div>
          </div>

          <div class="col-3 col-md-2">
            <div class="form-group">
                <label for="telefono_movil">Móvil:</label>
                <input type="text" class="form-control @error('telefono_movil') is-invalid @enderror" id="telefono_movil" name="telefono_movil" value="{{old('telefono_movil')}}">
                @error('telefono_movil')
                  <small class="text-danger">
                      {{$message}}
                  </small>
                @enderror
            </div>
          </div>

          <div class="col-1 col-md-1 col-lg-6 col-xl-6 col-xxl-2"></div>

          <div class="col-12 col-md-6 col-lg-4">
            <div class="form-group">
              <label for="puesto">Puesto:</label>
              <input type="text" class="form-control @error('puesto') is-invalid @enderror" id="puesto" name="puesto" value="{{old('puesto')}}">
              @error('puesto')
                <small class="text-danger">
                  {{$message}}
                </small>
              @enderror
            </div>
          </div>

          <div class="col-12 col-md-6 col-lg-4">
            <div class="form-group">
              <label for="tipo">Tipo:</label>
              <input type="text" class="form-control @error('tipo') is-invalid @enderror" id="tipo" name="tipo" value="{{old('tipo')}}">
              @error('tipo')
                <small class="text-danger">
                  {{$message}}
                </small>
              @enderror
            </div>
          </div>

          <div class="col-12 col-md-5 col-lg-4">
            <div class="form_group">
                <label for="situacion_laboral">Estado laboral:</label>
                <input type="text" class="form-control @error('situacion_laboral') is-invalid @enderror" id="situacion_laboral" name="situacion_laboral" value="{{old('situacion_laboral')}}">
                @error('situacion_laboral')
                  <small class="text-danger">
                      {{$message}}
                  </small>
                @enderror
            </div>
          </div>

          <div class="col-6 col-md-3 col-lg-3 col-xl-2">
            <div class="form_group">
              <label for="fecha_alta">Fecha de Alta:</label>
              <input type="date" class="form-control @error('fecha_alta') is-invalid @enderror"  id="fecha_alta" name="fecha_alta" value="{{old('fecha_alta')}}">
              @error('fecha_alta')
                <small class="text-danger">
                  {{$message}}
                </small>
              @enderror
            </div>
          </div>

          <div class="col-6 col-md-3 col-lg-3 col-xl-2">
              <div class="form_group">
                  <label for="fecha_baja">Fecha de Baja:</label>
                  <input type="date" class="form-control @error('fecha_baja') is-invalid @enderror" id="fecha_baja" name="fecha_baja" value="{{old('fecha_baja')}}">
                  @error('fecha_baja')
                    <small class="text-danger">
                      {{$message}}
                    </small>
                  @enderror
              </div>
          </div> 

          <div class="col-12 col-md-7">
            <div class="form_group">
                <label for="comentarios">Comentarios:</label>
                <textarea class="col-12 @error('comentarios') is-invalid @enderror" name="comentarios" rows="2" value="{{old('comentarios')}}"  placeholder="Motivo de la baja"></textarea>
                @error('comentarios')
                    <small class="text-danger">
                      {{$message}}
                    </small>
                  @enderror
            </div>
          </div>

          
          <div class="col-12  col-md-6 my-4 border">
            
                <div class="form_group">
                    <label for="imagen">Selecciona una imagen:</label>
                    <input class="col-12 borde_ccc @error('imagen') is-invalid @enderror" type="file" name="imagen" id="imagen" accept="image/*" value="{{old('imagen')}}" onchange="mostrarImagen(event)">
                    @error('imagen')
                      <small class="text-danger">
                      {{$message}}
                      </small>
                    @enderror
                    <br><br>
                  </div>
            
             <div class="col-2 mx-auto borde_ccc">
                 <img id="imagenSeleccionada" src="#" alt="" style="width: 100px;height: 156px;">
             </div>
          </div>
           
      </div> 

      <div class="container my-5">
          <div class="row justify-content-between col-12">
               <button= type="button" class="btn btn-secondary">Cerrar</button=>
                <div id="spinnerConductor"></div>
                <button type="submit" id="AddBtn" class="btn btn-danger">Guardad</button>
          </div>
            
        </div>  
    </form>
   
@stop
@section('css')
    <link rel="stylesheet" href="../public/vendor/adminlte/dist/css/adminlte.css">
    <link rel="stylesheet" href="../public/css/create.css">
@stop

@section('js')
    
    <script>
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
        $('#agregarEmpleadosForm').submit(function(e){
            
            e.preventDefault();
            //let formData=$(this).serialize();
            var formData=new FormData(this);
            $.ajax({
                type: 'POST',
                url: '{{ route("crearEmpleado") }}',
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

      function mostrarImagen(event) {
        var input = event.target;
        var reader = new FileReader();
        
        reader.onload = function() {
          var imagen = document.getElementById('imagenSeleccionada');
          imagen.src = reader.result;
        }
        
        reader.readAsDataURL(input.files[0]);
      }
    </script>
    
@stop