@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Asignar un Rol</h1>
@stop

@section('content')
    <div class="container">
      
       <!-- <a href="" class="btn btn-success">Alta de usuarios</a> -->
        <br><br>
        <div class="card col-12 col-md-6">
            <div class="card-body">
                <p class="h5">Nombre</p>
                <p class="form-control">
                   <b>{{$usuario->name}}</b> 
                </p>
                <h2>Lita de Roles</h2>
             <form method="POST" id="updateRolesForm">
                @csrf
                
                    @foreach ($usuario->roles as $rol)
                    @endforeach
                            <div class="row d-flex mt-3 justify-content-start">
                                <div class="col-4 col-md-3">
                                <input class="input_rol" type="checkbox" name="rol_admin" id="rol_admin"/>
                                <label  for="rol_name">Admin</label>
                                <br>
                                <input class="input_rol" type="checkbox" name="rol_usuario" id="rol_usuario"/>
                                <label  for="rol_name">Usuario</label>
                                
                                </div>
                            </div>
                           
                    
                
                    <div class="row justify-content-around align-items-center mt-5 border">
                        <button type="submit" id="btn_updateRolesForm" class="btn btn-success col-3">Actualizar</button>
                        <div id="spinnerVehiculo"></div>
                        <a class="col-3 btn btn-danger form-control" style="height: 36px;" href=" {{ route ('cancelar', 'usuarios') }}">Cancelar</a>
                        
                    </div>
            </form>
           
            </div>
        </div> 
        
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="/empresa4/public/css/create.css">
  <link rel="stylesheet" href="/empresa4/public/css/sweetalert2.min.css">
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
    <script src="/empresa4/public/build/assets/sweetalert2.all.min.js"></script>
    <script>
        
           
        $(document).ready(function(){
            var user = @json($usuario);
            
           //obtenemos los roles asignados al usuario logeado
            roles=user.roles;
            rol_usuario=[];
            for (var i=0, len=roles.length; i < len; i++) {
                
                rol_usuario.push(roles[i].name);
            }
            
            if(roles.length>0){
                for(var i=0, len=rol_usuario.length; i<len; i++){
                    if(rol_usuario[i]==="Admin"){
                        $('#rol_admin').prop("checked", true);
                        console.log("admin")
                    }
                    if(rol_usuario[i]==="Usuario"){
                        $('#rol_usuario').prop("checked", true);
                    }
                    
                }
            }

            
            
            //si se pulsa el botón de actualizar roles se envia el formulario
            $('#updateRolesForm').submit(function(e){
            
            e.preventDefault();
            
            //var url="../storage/app/";
               
            //var url_imagen=$('#imagenEditForm').attr('src');
              var formData=new FormData(this);
              console.log(Array.from(formData.entries()));
               
               var formData=new FormData(this);
            //   formData.set('imagen',url_imagen);

           //Camniamos los valores del select  a 1 o 0
           if(formData.get('Admin')==="on"){
               formData.set('admin',1);
               console.log("Administrador");
           }else{
            formData.set('Admin',0);
               console.log("Administrador no");  
           }
           
           //Camniamos los valores del select  a 1 o 0
           if(formData.get('Usuario')==="on"){
               formData.set('Usuario',1);
               console.log("Usuario");
           }else{
               formData.set('Usuario',0);
               console.log("Usuario no")
           }
           console.log(formData);
           $.ajax({
               type: 'POST',
               url: '{{ route("updateUsuario") }}',
               data: formData,
               contentType: false,
               processData: false,
               cache: false,
               dataType: 'json',
               beforeSend: function(){
                   //desactivamos el botón actualizar usuario
                   
                   $('#btn_updateUsuario').prop('disabled', true);
                   $("#spinnerUsuario").busyLoad("show", {
                       fontawesome: "fa fa-spinner fa-spin fa-3x fa-fw" });
                   },
               complete: function(){
                   
                   //Si se ha completado la operación lo activamos
                   $('#btn_updateUsuario').prop('disabled', false);
               }, 
               success: function(data){
                   
                     if(data.success == true){
                       //si se ha guardado la informacion en la base de datos correctamente
                       
                       printSuccessMsg(data.msg);

                       
                     }else if(data.success == false){
                       
                       $("#spinnerUsuario").hide();
                       printErrorMsg(data.msg);
                     }else{
                       $("#spinnerUsuario").hide();
                       
                       
                       $('#btn_updateUsuario').prop('disabled', false);
                       //Se muestran errores de validacion
                       printValidationErrorMsg(data.msg);

                     }
               },
           });
           return false;

        });

       });
    </script>
    
@endsection