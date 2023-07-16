@extends('adminlte::page')

@section('title', 'Dashboard')

@section('sidebar')
<p>Alta empleados</p>
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



    <form class="form-horizontal" action="{{ url('/empleados')}}" method="post" enctype="multipart/form-data">
        @csrf
          
        <div class="row">
        
          <div class="col-md-2 border">
               <div class="form-group">
                   <div class="col-8 col-md-6 col-lg-7">
                         <label for="nss">NSS:</label>
                                   <input type="text" class="form-control" id="nss" name="nss" required>
                   </div>
              
               </div>
               <div class="form-group">
                      <div class="col-12">
                          <label for="nombre">Nombre:</label>
                      
                         <input type="text" class="form-control" id="nombre" name="nombre" required>
                      </div>
               </div>
               <div class="form-group">
                   <div class="col-8 col-md-7">
                      <label for="email">Email:</label>
                   
                      <input type="email" class="form-control" id="email" name="email" required>
                   </div>
               </div>
         </div> 
  
         <div class="col-md-4 border">
           <div class="form-group">
                <div class="col-6 col-md-5 col-lg-4">
                      <label for="select">Tipo documento:</label>
               
                      <select id="select" name="select" class="form-control">
                          <option value="nif">NIF</option>
                          <option value="nie">NIE</option>
                      </select>
               </div>
           </div>
           <div class="form-group">
                <div class="col-8 col-md-6 col-lg-6">
                      <label for="apellidos">Apellidos:</label>
               
                      <input type="text" class="form-control" id="apellidos" name="apellidos" required>
               </div>
           </div>
           <div class="form-row pad_left">
               <div class="col-4 col-md-4 col-lg-3">
                      <label for="telefono_fijo">Teléfono fijo:</label>
                      <input type="text" class="form-control" id="telefono_fijo" name="telefono_fijo" required>
               </div>
               <div class="col-4 col-md-4 col-lg-3 margin_left ">
                      <label for="telefono_movil">Móvil:</label>
                      <input type="text" class="form-control" id="telefono_movil" name="telefono_movil" required>
               </div>
           </div>
         </div>
   
           <div class="col-md-4 border border-danger">
               <div class="form-group">
                   <div class="col-4 col-md-4 col-lg-4">
                          <label for="numero_dni_nie">Número:</label>
                   
                          <input type="text" class="form-control" id="numero_dni_nie" name="numero_dni_nie" required>
                   </div>
               </div>
               <div class="form-group">
                   <div class="col-6 col-md-4 col-lg-4">
                          <label for="select">Sexo:</label>
                   
                          <select id="select" name="select" class="form-control">
                              <option value="hombre">Hombre</option>
                              <option value="mujer">Mujer</option>
                              <option value="x">X</option>
                          </select>
                   </div>

               </div>
               <div class="form-group">
                    <div class="col-8 col-md-6 col-lg-5">
                          <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                   
                          <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                   </div>
               </div>
         </div>
<!--Datos de dirección-->
         <div class="col-md-12">
           <div class="form-row pad_left col-md-10">
               <div class="col-2 col-md-2 col-lg-1">
                      <label for="tipo_via">Tipo via:</label>
                      <input type="text" class="form-control" id="tipo_via" name="tipo_via" required>
               </div>
               <div class="col-4 col-md-3 col-lg-2 margin_left">
                      <label for="nombre_via">Nombre via:</label>
                      <input type="text" class="form-control" id="nombre_via" name="nombre_via" required>
               </div>
               <div class="col-3 col-md-2 col-lg-1 margin_left">
                   <label for="planta">Planta:</label>
                   <input type="text" class="form-control" id="planta" name="planta" required>

               </div>
               <div class="col-2 col-md-2 col-lg-1 margin_left">
                 <label for="puerta">Puerta:</label>
                 <input type="text" class="form-control" id="puerta" name="puerta" required>
               </div>
                <div class="col-3 col-md-3 col-lg-2 margin_left">
                         <label for="municipio">Municipio:</label>
                         <input type="text" class="form-control" id="municipio" name="municipio" required>
                  
               </div>
               <div class="col-2 col-md-2 col-lg-1 margin_left">
                 <label for="cp">CP:</label>
                 <input type="text" class="form-control" id="cp" name="cp" required>
               </div>
               <div class="col-3 col-md-3 col-lg-2 margin_left">
                         <label for="provincia">Provincia:</label>
                         <input type="text" class="form-control" id="provincia" name="provincia" required>
                  
               </div>
             </div>
</div>
<!--Datos de dirección-->
          
         <div class="col-md-2 top25">
           <div class="col-12 col-md-12 col-lg-12 pad_left ">
               <label for="puesto">Puesto:</label>
               <input type="text" class="form-control" id="puesto" name="puesto" required>
              
           </div>
             <div class="form_group col-12 col-md-12 col-lg-12 pad_left top10">
               <label for="tipo">Tipo:</label>
               <input type="text" class="form-control" id="tipo" name="tipo" required>
              
           </div>
           <div class="form_group col-9 col-md-9 col-lg-9 pad_left top10">
             <label for="fecha_alta">Fecha de Alta:</label>
             <input type="date" class="form-control" id="fecha_alta" name="fecha_alta" required>
           </div>
           
         </div>
         <div class="col-md-3 top25">
           
           <div class="form_group col-9 col-md-9 col-lg-12">
             <label for="situacio_laboral">Estado laboral:</label>
             <input type="text" class="form-control" id="situacio_laboral" name="Estado laboral" required>
           </div>
             <div class="form_group col-9 col-md-9 col-lg-6 top10">
             <label for="fecha_nacimiento">Fecha de Baja:</label>
             <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
           </div>
           <div>
             <textarea class="col-12 col-md-12 col-lg-11 top20 margin_left_15" name="motivo_baja" rows="3"   placeholder="Motivo de la baja"></textarea>
           </div>
         </div>
          <div class="col-md-3 top25">
                 <div class="col-md-7">
                       <label for="imagen">Selecciona una imagen:</label>
                      <input class="borde_ccc" type="file" name="imagen" id="imagen" accept="image/*" required onchange="mostrarImagen(event)">
                          <br><br>
                 </div>
                  <div class="col-md-4 borde_ccc margin_left_25">
                      <img id="imagenSeleccionada" src="#" alt="" style="width: 100px;height: 156px;">
                  </div>
          </div>
      </div>
      
     
  <button type="submit" class="btn btn-primary">Enviar</button>            
    
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