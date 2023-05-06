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
            <div class="row mb-4">
                <div class="col-2 form-group row">
                        <label class="col-3 col-form-label" for="tipo">
                                    Tipo
                        </label>
                        <div class="col-5">
                            <select id="select" name="selectNifNie" class="form-control">
                                <option value="nif">NIF</option>
                                <option value="nie">NIE</option>
                            
                            </select>
                        </div>
                </div>

                
                    <div class="col-2 form-group row">
                            <label class="col-5 col-form-label" for="nifnie">
                               Documento
                            </label>
                            <div class="col-6">
                                <input type="text" class="form-control" name="nifnie">
                            </div>
                    </div>
                
                
                    <div class="col-3 form-group row">
                        <label class="col-sm-4 col-form-label" for="nss">Número SS: </label>
                        <div class="col-5">
                                <input type="text"class="form-control" name="nss">
                        </div>
                    </div>
                
                
                    <div class="col-4 form-group row" >
                    
                        <label class="col-4 col-form-label" for="fecha_nacimiento">Fecha Nacimiento</label>
                        <div class="col-5">
                            <input type="date" class="form-control" name="fecha_nacimiento">
                        </div>
                    </div>
                

           
            </div>
            <div class="row mb-4">
                <div class="col-3 form-group row">
                                <label  class="col-sm-4 col-form-label" for="nombre" >Nombre: </label>
                                <div class="col-6">
                                    <input class="form-control" type="text" name="nombre">
                                </div>
                            
                 </div>
                <div class="col-3 form-group row" style="border: solid green">
                        <label class="col-sm-4 col-form-label" for="apellidos" >Apellidos: </label>
                        <div class="col-6">
                            <input class="form-control" type="text" name="apellidos">
                        </div>
                
                </div>

                <div class="col-2 form-group row" style="border: solid green">
                        <label class="col-sm-3 col-form-label" for="sexo" >Sexo: </label>
                        <select id="select" name="selectNifNie" class="col-sm-6 form-control">
                                <option value="H">Hombre</option>
                                <option value="M">Mujer</option>
                                <option value="X">X</option>
                            </select>

                
                </div>
            </div>
        
        <div class="row mb-4 col-10">
            <div class="col-3 form-group row">
                     <label  class="col-sm-4 col-form-label" for="tipo_via">Tipo de via: </label>
                     <div class="col-5">
                        <input class="form-control" type="text" name="tipo_via">
                    </div>
            </div>
            <div class="col-3 form-group row">
                     <label  class="col-sm-4 col-form-label" for="nombre_via">Nombre via: </label>
                     <div class="col-7">
                        <input class="form-control" type="text" name="nombre_via">
                    </div>
            </div>
            <div class="col-2 form-group row">
                <label class="col-sm-4 col-form-label" for="numero">Número: </label>
                    <div class="col-2">
                        <input class="form-control" type="text" name="numero">
                    </div>
            </div>
            <div class="col-2 form-group row">
                <label class="col-form-label" for="planta">Planta: </label>
                    <div class="col-1">
                        <input class="form-control" type="text" name="planta">
                    </div>
            </div>
            <div class="col-2 form-group row">
                <label class="col-form-label" for="puerta">Puerta: </label>
                    <div class="col-2">
                        <input class="form-control" type="text" name="puerta">
                    </div>
            </div>
            </div>
        </div> 
        <!--
                    
                       </div>
                
            </div>
            
</div>
        <div class="mb-3">
                <label for="tipo_via">Tipo de via: </label>
                <input type="text" name="tipo_via">
          
                <label for="nombre_via">Nombre via: </label>
                <input type="text" name="nombre_via">
            
                <label for="numero">Número: </label>
                <input type="text" name="numero">
          
                <label for="planta">planta: </label>
                <input type="text" name="planta">
               
        
                <label for="puerta">Puerta: </label>
                <input type="text" name="puerta">
        </div>   
                <label for="municipio">Municipio: </label>
                <input type="text" name="municipio">
            
                <label for="provincia">Provincia: </label>
                <input type="text" name="provincia">
           
                <label for="cp">C.P: </label>
                <input type="text" name="cp">
            
                <label for="telefono_fijo">Teléfono fijo: </label>
                <input type="text" name="telefono_fijo">
          
                <label for="telefono_movil">Teléfono móvil: </label>
                <input type="text" name="teléfono_movil">
                <label for="email">Email: </label>
                <input type="text" name="email">
        
                
                <label for="puesto">Puesto: </label>
                <input type="text" name="puesto">
         
                <label for="tipo_puesto">Puesto trabajo: </label>
                <input type="text" name="tipo_puesto">
           
                <label for="fecha_alta">Fecha Alta: </label>
                <input type="text" name="fecha_alta">
           
        
                <label for="fecha_baja">Fecha Baja: </label>
                <input type="text" name="fecha_baja">
           
                <label for="motivo_baja">Motivo baja: </label>
                <textarea name="textarea" rows="3" cols="50"></textarea>

          
                <label for="foto">Fotografia: </label>
                <input type="file" name="foto">
-->

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