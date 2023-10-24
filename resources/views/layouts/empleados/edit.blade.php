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
        @csrf

        <div class="container-fluid">
          <div class="row border border-danger">
            
              <div class="col-4 col-md-3 col-lg-3 col-xl-2 border">
                  <div class="form-group">
                    <label for="nss">NSS.:</label>
                    <input type="text" class="form-control" id="nss" name="nss">
                  </div>        
              </div> 
              <div class="col-2 col-md-2 col-lg-1 col-xl-1">
                <div class="form-group">
                    <label for="select">Tipo:</label>
            
                    <select id="select" name="select" class="form-control">
                        <option value="nif">NIF</option>
                        <option value="nie">NIE</option>
                    </select>
                </div>
              </div>
              <div class="col-3 col-md-2 col-lg-2 col-xl-1">
                <div class="form-group">
                    <label for="numero_dni_nie">Número:</label>
                    <input type="text" class="form-control" id="numero_dni_nie" name="numero_dni_nie">
                </div>
              </div>

                <div class="col-3 col-md-2 col-lg-2 col-xl-1">
                  <div class="form-group">
                    <label for="select">Sexo:</label>
                    <select id="select" name="select" class="form-control">
                        <option value="hombre">Hombre</option>
                        <option value="mujer">Mujer</option>
                        <option value="x">X</option>
                    </select>
                  </div>
                </div>

                <div class="col-2 col-md-2 col-lg-2 col-xl-7"></div>

              <div class="col-12 col-md-6 col-lg-5 col-xl-4">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre">
                </div>
              </div>
              
              <div class="col-12 col-md-6 col-lg-5 col-xl-4">  
                <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos">
                </div>
            </div>
            
            <div class="col-5 col-md-3 col-lg-5 col-xl-2">
                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
                </div>
            </div>

            <div class="col-7 col-md-9 col-lg-2 col-xl-2"></div>


           <div class="col-8 col-md-5">
                <div class="form-group">
                  <label for="tipo_via">Tipo via:</label>
                  <input type="text" class="form-control" id="tipo_via" name="tipo_via">
                </div>
           </div>

           <div class="col-7 col-md-7"></div>

           <div class="col-10 col-md-5">
              <div class="form-group">
                  <label for="nombre_via">Nombre via:</label>
                  <input type="text" class="form-control" id="nombre_via" name="nombre_via">
              </div>
           </div>

           <div class="col-11 col-md-7">
              <div class="form-group">
                <label for="municipio">Municipio:</label>
                <input type="text" class="form-control" id="municipio" name="municipio">
              </div>
           </div>

           <div class="col-3 col-md-2">
            <div class="form-group">
              <label for="cp">CP:</label>
              <input type="text" class="form-control" id="cp" name="cp">
            </div>
          </div>

           <div class="col-11 col-md-7">
              <div class="form-group">
                <label for="provincia">Provincia:</label>
                <input type="text" class="form-control" id="provincia" name="provincia">
              </div>
           </div>

        
  
         <div class="col-4 col-md-2">
            <div class="form-group">
                <label for="planta">Planta:</label>
                <input type="text" class="form-control" id="planta" name="planta">
            </div>
         </div>

          <div class="col-4 col-md-2">
            <div class="form-group">
              <label for="puerta">Puerta:</label>
              <input type="text" class="form-control" id="puerta" name="puerta">
            </div>
          </div>

          <div class="col-6 col-md-2">
            <div class="form-group">
               <label for="fijo">Telefono:</label>
               <input type="text" class="form-control" id="fijo" name="fijo">
            </div>
          </div>

          <div class="col-6 col-md-2">
            <div class="form-group">
                <label for="telefono_movil">Móvil:</label>
                <input type="text" class="form-control" id="telefono_movil" name="telefono_movil">
            </div>
          </div>

          <div class="col-12">
            <div class="form-group">
              <label for="puesto">Puesto:</label>
              <input type="text" class="form-control" id="puesto" name="puesto">
            </div>
          </div>

          <div class="col-12">
            <div class="form-group">
              <label for="tipo">Tipo:</label>
              <input type="text" class="form-control" id="tipo" name="tipo">
            </div>
          </div>

          <div class="col-12">
            <div class="form_group">
                <label for="situacio_laboral">Estado laboral:</label>
                <input type="text" class="form-control" id="situacio_laboral" name="Estado laboral">
            </div>
          </div>

          <div class="col-12">
            <div class="form_group">
                <label for="comentarios">Comentarios:</label>
                <textarea class="col-12" name="motivo_baja" rows="3"   placeholder="Motivo de la baja"></textarea>
          
            </div>
          </div>

          <div class="col-6 col-md-3 col-lg-3 col-xl-2">
            <div class="form_group">
              <label for="fecha_alta">Fecha de Alta:</label>
              <input type="date" class="form-control" id="fecha_alta" name="fecha_alta">
            </div>
          </div>

          <div class="col-6 col-md-3 col-lg-3 col-xl-2">
              <div class="form_group">
                  <label for="fecha_nacimiento">Fecha de Baja:</label>
                  <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
              </div>
          </div>

          <div class="col-12 my-4 border border-danger">
            
                <div class="form_group">
                    <label for="imagen">Selecciona una imagen:</label>
                    <input class="col-12 borde_ccc" type="file" name="imagen" id="imagen" accept="image/*" onchange="mostrarImagen(event)">
                      <br><br>
                </div>
            
             <div class="col-4 mx-auto borde_ccc">
                 <img id="imagenSeleccionada" src="#" alt="" style="width: 100px;height: 156px;">
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
    <link rel="stylesheet" href="../public/vendor/adminlte/dist/css/adminlte.css">
    <link rel="stylesheet" href="../public/css/create.css">
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