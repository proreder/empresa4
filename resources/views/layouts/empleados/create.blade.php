@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Alta empleado</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>

    @role('super')
        <p>Hola SuperAdministrador</p>
    @endrole
    @role('admin')
        <p>Hola Administrador</p>
    @endrole
    @role('usuario')
        <p>Hola Usuario</p>
    @endrole





    <form class="form-horizontal" action="{{ url('/empleados')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-md-4">
                     <div class="form-group">
                       <label for="nss">NºSS:</label>
                       <div class="col-4 col-md-4 col-lg-4">
                            <input type="text" class="form-control" size="15" id="nss" name="nss" required>
                       </div>
                     </div>
                     <div class="form-group">
                       <label for="nombre">Nombre:</label>
                    
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                       
                     </div>
                     <div class="form-group">
                       <label for="email">Email:</label>
                       <input type="email" class="form-control" id="email" name="email" required>
                     </div>
               </div> 
         
               <div class="col-md-4">
                 <div class="form-group">
                     <label for="select">Tipo documento:</label>
                     <div class="col-3 col-md-3 col-lg-3">
                            <select id="select" name="select" class="form-control">
                                <option value="nif">NIF</option>
                                <option value="nie">NIE</option>
                            </select>
                     </div>
                 </div>
                 <div class="form-group">
                   <label for="telefono">Apellidos:</label>
                   <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                 </div>
                 <div class="form-group">
                     <label for="telefono">Teléfono:</label>
                   <input type="tel" class="form-control" id="telefono" name="telefono" required>
                 </div>
               </div>
         
                 <div class="col-md-4">
                 <div class="form-group">
                     <label for="numero_dni_nie">Número:</label>
                     <div class="col-4 col-md-4 col-lg-4">
                            <input type="text" class="form-control" id="numero_dni_nie" name="numero_dni_nie" required>
                     </div>
                 </div>
                 <div class="form-group">
                     <label for="select">Sexo:</label>
                     <div class="col-3 col-md-3 col-lg-3">
                            <select id="select" name="select" class="form-control">
                                <option value="hombre">Hombre</option>
                                <option value="mujer">Mujer</option>
                                <option value="x">X</option>
                            </select>
                     </div>
                   
                 </div>
                 <div class="form-group">
                   <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                   <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                 </div>
               </div>
         
               <div class="col-md-4">
                 <div class="form-group">
                     <label for="tipo_via">Tipo via:</label>
                   <input type="text" class="form-control" id="tipo_via" name="tipo_via" required>
                 </div>
                 <div class="form-group">
                   <label for="apellidos">Apellidos:</label>
                   <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                 </div>
                 <div class="form-group">
                   <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                   <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                 </div>
               </div>
               <div class="col-md-4">
                 <div class="form-group">
                     <label for="direccion">Dirección:</label>
                     <input type="text" class="form-control" id="direccion" name="direccion" required>
                    
                 </div>
                 <div class="form-group">
                   <label for="telefono">Teléfono:</label>
                   <input type="tel" class="form-control" id="telefono" name="telefono" required>
                 </div>
                 <div class="form-group">
                   <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                   <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                 </div>
               </div>
               <div class="col-md-4">
                 <div class="form-group">
                     <label for="direccion">Dirección:</label>
                     <input type="text" class="form-control" id="direccion" name="direccion" required>
                    
                 </div>
                 <div class="form-group">
                   <label for="telefono">Teléfono:</label>
                   <input type="tel" class="form-control" id="telefono" name="telefono" required>
                 </div>
                 <div class="form-group">
                   <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                   <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                 </div>
               </div>
               <div class="col-md-4">
                     <div class="form-group">
                         <label for="direccion">Dirección:</label>
                         <input type="text" class="form-control" id="direccion" name="direccion" required>
                        
                     </div>
                     <div class="form-group">
                       <label for="telefono">Teléfono:</label>
                       <input type="tel" class="form-control" id="telefono" name="telefono" required>
                     </div>
                     <div class="form-group">
                       <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                       <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                     </div>
               </div>
             </div>

            <input type="submit" value="Enviar">
          
        </div>            
    
    </form>
@stop
@section('css')
    <link rel="stylesheet" href=".public/vendor/adminlte/dist/css/adminlte.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop