@extends('adminlte::page')

@section('title', 'Editar empleado')

@section('sidebar')

@stop
@section('content_header')
    <h4>Editar empleado</h4>
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



    <form class="form-horizontal" action="{{ url('/empleados')}}" method="post" enctype="multipart/form-data">
       @method('PUT')
        @csrf

        <div class="container-fluid">
          <div class="row border border-danger">
            
              <div class="col-4 col-md-3 col-lg-3 col-xl-2 border">
                  <div class="form-group">
                    <label for="nss">NSS.:</label>
                    <input type="text" class="form-control" id="nss" name="nss" value="{{$empleado->nss}}">
                  </div>        
              </div> 
              <div class="col-2 col-md-2 col-lg-2 col-xl-1">
                <div class="form-group">
                    <label for="select">Tipo:</label>
            
                    <select id="select" name="select" class="form-control">
                        <option value="NIF">{{$empleado->tipo_doc}}</option>
                        <option value="NIE">{{$empleado->tipo_doc}}</option>
                    </select>
                </div>
              </div>
              <div class="col-3 col-md-2 col-lg-2 col-xl-2">
                <div class="form-group">
                    <label for="numero_dni_nie">Número:</label>
                    <input type="text" class="form-control" id="numero_dni_nie" name="numero_dni_nie" value="{{$empleado->nifnie}}">
                </div>
              </div>

                <div class="col-3 col-md-2 col-lg-2 col-xl-2">
                  <div class="form-group">
                    <label for="select">Sexo:</label>
                    <select id="select" name="select" class="form-control">
                        <option value="Hombre">{{$empleado->sexo}}</option>
                        <option value="Mujer">{{$empleado->sexo}}</option>
                        <option value="X">{{$empleado->sexo}}</option>
                    </select>
                  </div>
                </div>

                <div class="col-5 col-md-3 col-lg-5 col-xl-2">
                  <div class="form-group">
                      <label for="fecha_nacimiento">Nacimiento:</label>
                      <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{$empleado->fecha_nacimiento}}">
                  </div>
                </div>

               <!-- <div class="col-2 col-md-2 col-lg-2 col-xl-2"></div> -->

              <div class="col-12 col-md-5 col-xl-4">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{$empleado->nombre}}">
                </div>
              </div>
              
              <div class="col-12 col-md-5 col-xl-4">  
                <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{$empleado->apellidos}}">
                </div>
            </div>
            
            

            <div class="col-xl-4"></div>


           <div class="col-8 col-md-2 col-lg-2 col-xl-1">
                <div class="form-group">
                  <label for="tipo_via">Tipo via:</label>
                  <input type="text" class="form-control" id="tipo_via" name="tipo_via" value="{{$empleado->tipo_via}}">
                </div>
           </div>

           

           <div class="col-9 col-md-5 col-lg-4">
              <div class="form-group">
                  <label for="nombre_via">Nombre via:</label>
                  <input type="text" class="form-control" id="nombre_via" name="nombre_via" value="{{$empleado->nombre_via}}">
              </div>
           </div>
           <div class="col-2 col-xl-1">
            <div class="form-group">
              <label for="numero">Número:</label>
              <input type="text" class="form-control" id="numero" name="numero" value="{{$empleado->numero}}">
            </div>
          </div>

          <div class="col-3 col-md-3 col-lg-1">
            <div class="form-group">
                <label for="planta">Planta:</label>
                <input type="text" class="form-control" id="planta" name="planta" value="{{$empleado->planta}}">
            </div>
         </div>

          <div class="col-3 col-md-2 col-lg-1">
            <div class="form-group">
              <label for="puerta">Puerta:</label>
              <input type="text" class="form-control" id="puerta" name="puerta" value="{{$empleado->puerta}}">
            </div>
          </div>

           <div class="col-11 col-md-5 col-lg-4">
              <div class="form-group">
                <label for="municipio">Municipio:</label>
                <input type="text" class="form-control" id="municipio" name="municipio" value="{{$empleado->municipio}}">
              </div>
           </div>

           <div class="col-3 col-md-2 col-lg-2 col-xl-1">
            <div class="form-group">
              <label for="cp">CP:</label>
              <input type="text" class="form-control" id="cp" name="cp" value="{{$empleado->cp}}">
            </div>
          </div>

           <div class="col-11 col-md-5 col-lg-4 col-xl-4">
              <div class="form-group">
                <label for="provincia">Provincia:</label>
                <input type="text" class="form-control" id="provincia" name="provincia" value="{{$empleado->provincia}}">
              </div>
           </div>

        
          <div class="col-3 col-md-2">
            <div class="form-group">
               <label for="fijo">Telefono:</label>
               <input type="text" class="form-control" id="fijo" name="fijo" value="{{$empleado->telefono_fijo}}">
            </div>
          </div>

          <div class="col-3 col-md-2">
            <div class="form-group">
                <label for="telefono_movil">Móvil:</label>
                <input type="text" class="form-control" id="telefono_movil" name="telefono_movil" value="{{$empleado->telefono_movil}}">
            </div>
          </div>
          <div class="col-1 col-md-1 col-lg-2 col-xl-2 col-xxl-2"></div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="puesto">Puesto:</label>
              <input type="text" class="form-control" id="puesto" name="puesto" value="{{$empleado->puesto}}">
            </div>
          </div>

          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="tipo">Tipo:</label>
              <input type="text" class="form-control" id="tipo" name="tipo" value="{{$empleado->tipo}}">
            </div>
          </div>

          <div class="col-12 col-md-5">
            <div class="form_group">
                <label for="situacio_laboral">Estado laboral:</label>
                <input type="text" class="form-control" id="situacion_laboral" name="Estadon laboral" value="{{$empleado->situacion_laboral}}">
            </div>
          </div>

          <div class="col-6 col-md-3 col-lg-3 col-xl-2">
            <div class="form_group">
              <label for="fecha_alta">Fecha de Alta:</label>
              <input type="date" class="form-control" id="fecha_alta" name="fecha_alta" value="{{$empleado->fecha_alta}}">
            </div>
          </div>

          <div class="col-6 col-md-3 col-lg-3 col-xl-2">
              <div class="form_group">
                  <label for="fecha_nacimiento">Fecha de Baja:</label>
                  <input type="date" class="form-control" id="fecha_baja" name="fecha_baja" value="{{$empleado->fecha_baja}}">
              </div>
          </div>

          <div class="col-12 col-md-7">
            <div class="form_group">
                <label for="comentarios">Comentarios:</label>
                <textarea class="col-12" name="motivo_baja" rows="2"   placeholder="{{$empleado->comentarios}}" value="{{$empleado->comentarios}}"></textarea>
          
            </div>
          </div>

          

          <div class="col-12 col-md-6 my-4 border border-danger">
            
                <div class="form_group">
                    <label for="imagen">Selecciona una imagen:</label>
                    <input class="col-12 borde_ccc" type="file" name="imagen" id="imagen" accept="image/*" required onchange="mostrarImagen(event)">
                      <br><br>
                </div>
            
             <div class="col-2 mx-auto borde_ccc">
                            <img id="imagenSeleccionada" src="data:image/png;base64,
                            <?php 
                                 echo base64_encode($empleado->foto); 
                            ?>"  alt="" style="width: 100px;height: 156px;"> 
                 <!--<img id="imagenSeleccionada" src="#" alt="" style="width: 100px;height: 156px;">-->
             </div>
          </div>
           
      </div> 

      <div class="container my-5">
          <div class="row  col-12 border border-primary ">
            
                  <div class="mx-auto col-6 col-md-4 col-lg-4 col-xl-2 border border-danger ">
                    
                    <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                  </div>
                  
                  <div class="mx-auto col-6 col-md-4 col-lg-3 col-xl-2 pl-4">
                  
                    <button type="submit" class="btn btn-danger">Cancelar</button>
                  </div>
            </div> 
           
        </div>  
    </form>
   
@stop
@section('css')
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
    
    <script> console.log('Hi!'); </script>
    <script>
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