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
                    
                            <div class="row d-flex mt-3">
                                <div class="col-4">
                                    @php($hayRol=($rol->name))
                                   
                                    @if($rol->name=='Admin')
                                        <input class="input_rol" type="checkbox" name="rol_admin" value="Admin" @if($hayRol) checked @endif />
                                        <label  for="rol_name">Admin</label>                           
                                    @else
                                        <input class="input_rol" type="checkbox" name="rol_admin" value="Admin"/>
                                        <label  for="rol_name">Admin</label>
                                    @endif
                                    <br>
                                    
                                    @if($rol->name=='Usuario')
                                        <input class="input_rol" type="checkbox" name="rol_usuario" value="Usuario" @if($hayRol) checked @endif />
                                        <label  for="rol_name">Usuario</label>
                                    @else
                                        <input class="input_rol" type="checkbox" name="rol_usuario" value="Usuario"/>
                                        <label  for="rol_name">Usuario</label>
                                    @endif
                                </div>
                            </div>
                           
                    @endforeach
                
                    
                    <button type="submit" id="btn_updateRolesForm" class="btn btn-success mt-3">Actualizar</button>
               
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
            $('#empleados').DataTable({
                responsive : true,
            "language" : {
                "search" :          "Buscar",
                "lengthMenu" :      "Mostrar _MENU_ registros por página",
                "info"  :           "Página _PAGE_ de _PAGES_",
                "zeroRecords" :    "No hay registros",
                "infoEmpty" :     "",
                "paginate" :        {
                                        "previous":  "Anterior  ",
                                        "next":       "  Siguiente",
                                        "first":       "Primero",
                                        "last":        "último"
                }   
            }  

            });

            $('#btnEliminar').on('submit', function(e){
                e.preventDefault();
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¡El borrado no se podrá trevertir!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Confirmar borrado!"
                }).then((result) => {
                    this.submit()
                });
            });
            
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
               url: '{{ route("updateVehiculo") }}',
               data: formData,
               contentType: false,
               processData: false,
               cache: false,
               dataType: 'json',
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
                   
                     if(data.success == true){
                       //cerramos el modal agregarCandidato si se ha guardado la informacion en la base de datos correctamente
                       $('#editVehiculoModal').hide();
                       //$('#editVehiculoForm')[0].reset();
                       printSuccessMsg(data.msg);

                       
                     }else if(data.success == false){
                       
                       $("#spinnerVehiculo").hide();
                       printErrorMsg(data.msg);
                     }else{
                       $("#spinnerVehiculo").hide();
                       
                       
                       $('#btn_updateVehiculo').prop('disabled', false);
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