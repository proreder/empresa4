@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado de usuarios registrados</h1>
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

    
    <div class="container-flex">
        <!--data-bs-target="#agregarConductor"-->
        <button class="btn btn-success btn-sm" data-bs-toggle="modal" id="agregarUsuario" data-bs-target="#nuevoUsuarioModal"><i class="bi-plus-circle me-2"></i>Añadir usuario</button>
        <br><br>
        
        <table id="tabla_usuarios" class="table table-striped border">
            <thead class="thead-light">
                <tr>
                    <th width="40px">Nombre</th>
                    <th width="50px">Email</th>
                    <th width="100px">Pasword</th>
                    <th width="40px">Rol</th>
                    <th width="70px">Acciones</th>

                </tr>

            </thead>
            <tbody>
                @if($usuarios)
                    @foreach ($usuarios as $usuario)
                        <tr>
                            
                            <td>{{ $usuario->name }}</td>
                             <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->password }}</td>
                            <td>
                                @forelse ($usuario->roles as $role)
                                    <span class="badge badge-info"> {{ $role->name }} </span>
                                @empty
                                <span class="badge badge-danger">Sin roles</span>
                                @endforelse
                            </td>
                                             
                            
                            <td>
                                    <!-- Button trigger modal -->
                                    <!--<button type="button" class="btn_editar btn btn-link"  data-bs-toggle="modal"  data-bs-config="backdrop:true" data-bs-target="#editarUsuarioModal" data-id="{{$usuario->id}}" data-nombre="{{$usuario->name}}" data-email="{{$usuario->email}}" data-password="{{$usuario->password}}" data-rol="{{$role->name}}"><i class="bi-pencil-square h4"></i></button>-->
                                    <a class="btn_editar btn btn-link" href="{{ route('usuarios.edit', $usuario) }}"><i class="bi-pencil-square h4"></i></a>
                                    <button type="button"  data-toggle="popover" id="btn_borrar"  class="btn_borrar btn btn-link text-danger" data-id-delete="{{$usuario->id}}"><i class="bi bi-trash h4"></i></button>
                            </td>
                        </tr>
                
                    @endforeach
                @else
                    <td class="flex mx-auto col-12"><h2>No hay datos que mostrar</h2></td>
                @endif
            </tbody>
            <div  id="spinner"></div>
        </table>
    
        {{-- Modal editar vehiculo --}}
    <div class="modal fade" id="editarUsuarioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar un usuario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form id="editUsuarioForm" method="POST">
                @method('POST')
                @csrf
                <input type="hidden" id="id_usuario" name="id_usuario">
                
                <div class="row mt-4 mb-3 d-flex justify-content-center">
                        <div class="col-10">
                            <label for="nombre_edit" class="form-label">Nombre</label>
                            <input type="text" class="form-control @error('nombre_error') is-invalid @enderror" id="nombre_edit" name="nombre_edit">
                            <small class='alert text-danger' id='nombre_error_edit'></small>
                        </div> 
                        <div class="col-10">
                            <label for="email_edit" class="form-label">Email:</label>
                            <input type="text" class="form-control" id="email_edit" name="email_edit">
                            <small class='alert text-danger' id='email_error_edit'></small>
                        </div>
                
                        <div class="col-10">
                            <label for="password_edit" class="form-label">Contraseña:</label>
                            <input type="text" class="form-control" id="password_edit" name="password_edit">
                            <small class='alert text-danger' id='password_error_edit'></small>
                        </div> 
                        <div class="col-10">
                            <label for="re-password_edit" class="form-label">Repite contraseña:</label>
                            <input type="text" class="form-control" id="re-password_edit" name="re-password_edit">
                            <small class='alert text-danger' id='re-password_error'></small>
                        </div>
                        <div class="form-group ms-2">
                        <label for="rol_edit" class="form-label">Tipo de Rol:</label>
                        <select class="form-select mb-3" id="rol_edit" name="rol_edit">
                            <option value="Administrador">Administrador</option>
                            <option value="Ususario">Usuario</option>
                        </select>
                    </div>
                       
                </div> 
                
                
                <div class="modal-footer">
                        <div class="row row justify-content-between col-12">
                                        <button type="button" class="btn btn-danger"  data-bs-dismiss="modal">Cerrar</button>
                                        <div id="spinnerVehiculo"></div>
                                        <button type="submit" id="btn_guardarVehiculo" class="btn btn-primary">Actualizar</button>
                        </div>
                </div>
            </form>
          </div>
        </div>
      </div>    
    </div>

    {{-- Modal agregar nuevo usuario --}}
    <div class="modal fade" id="nuevoUsuarioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Crear un usuario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form id="nuevoUsuarioForm" method="POST">
                @method('POST')
                @csrf
                
                <div class="row mt-4 mb-3 d-flex justify-content-center">
                        <div class="col-10">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control @error('nombre_error') is-invalid @enderror" id="nombre_nuevo" name="nombre">
                            <small class='alert text-danger' id='nombre_error_nuevo'></small>
                        </div> 
                        <div class="col-10">
                            <label for="email" class="form-label">Email:</label>
                            <input type="text" class="form-control" id="email_nuevo" name="email">
                            <small class='alert text-danger' id='email_error_nuevo'></small>
                        </div>
                
                        <div class="col-10">
                            <label for="password" class="form-label">Contraseña:</label>
                            <input type="password" class="form-control" id="password_nuevo" name="password">
                            <small class='alert text-danger' id='password_error_nuevo'></small>
                        </div> 
                        <div class="col-10">
                            <label for="repite_password" class="form-label">Repite contraseña:</label>
                            <input type="password" class="form-control" id="re_password_nuevo" name="password_confirmation">
                            <small class='alert text-danger' id='re_password_error_nuevo'></small>
                        </div>
                        <div class="form-group ms-2">
                        <h4>Tipo de Rol:</h4>

                        <input type="checkbox"  name="create_rol_admin" id="rol_admin" checked >
                        <label for="rol_admin">Administrador</label>
                        <br>
                        <input type="checkbox"  name="create_rol_usuario" id="rol_usuario" checked>
                        <label  for="rol_usuario">Usuario</label>
                    </div>

                    <small class='alert text-danger' id='error_roles'></small>
                       
                </div> 
                
                
                <div class="modal-footer">
                        <div class="row row justify-content-between col-12">
                                        <button type="button" class="btn btn-danger"  data-bs-dismiss="modal">Cerrar</button>
                                        <div id="spinnerUsuario"></div>
                                        <button type="submit" id="btn_guardarUsuario" class="btn btn-primary">Guardar</button>
                        </div>
                </div>
            </form>
           </div>
        </div>
     </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="./vendor/adminlte/dist/css/adminlte.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./public/css/sweetalert2.min.css">
    <link rel="stylesheet" href="./public/css/create.css">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/busy-load/dist/app.min.js"></script>
    <script src="./public/build/assets/sweetalert2.all.min.js"></script>

    //CSRF
    <script>
        //protección CSRF simple y conveniente para sus aplicaciones basadas en AJAX
        //Laravel genera un "token" de CSRF para cada usuario. Este token se utiliza para verificar que el usuario 
        //autenticado es la persona que realmente hace las solicitudes a la aplicación
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){
            $('#tabla_usuarios').DataTable({
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

          

           $('#nuevoUsuarioModal').on('click', function(){
              $('#nuevoUsuarioModal').modal('show');
           });

        });

        //script para BORRAR un usuario si se pulsa el botón de borrado
        $('.btn_borrar').on('click', function(e) {
                console.log('Se ha pulsado borrar');
                var id_usuario= $(this).attr('data-id-delete');
                console.log('Id usuario: '+id_usuario);
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
                        var url= "{{ route('usuarios.delete','id_usuario') }}";
                        url=url.replace('id_usuario',id_usuario);
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
                                        text: "El usuario se ha borrado corectamente",
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

        //si se pulsa  #btn_guardarUsuario       
        $('#nuevoUsuarioForm').submit(function(e){
             e.preventDefault();
            
             //verificamos los estados de los checkbox
            var formData=new FormData(this);
            
            //array que contendrá los roles marcados
            roles=[];
           //Camniamos los valores del select  a 1 o 0
           if($('#rol_admin').prop('checked')){
               formData.set('rol_admin',1);
               formData.append('roles[0]',1);
           }
           
           //Camniamos los valores del select  a 1 o 0
           if($('#rol_usuario').prop('checked')){
               formData.set('rol_usuario',2);
               formData.append('roles[1]',2);
           }
           //
           console.log(Array.from(formData.entries()));
            //enviamos la petición ajax para añadir un nuevo usuario
            $.ajax({
                type: 'POST',
                url: '{{ route("usuarios.create") }}',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    //desactivamos el botón guardar usuario
                    
                    $('#btn_guardarUsuario').prop('disabled', true);
                    $("#spinnerUsuario").busyLoad("show", {
                        fontawesome: "fa fa-spinner fa-spin fa-3x fa-fw" });
                    },
                complete: function(){
                     //Si se ha completado la operación lo activamos
                    $('#btn_guardarUsuario').prop('disabled', false);
                }, 
                success: function(data){
                    
                      if(data.success == true){
                        //cerramos el modal agregarCandidato si se ha guardado la informacion en la base de datos correctamente
                        $('#nuevoUsuarioModal').hide();
                        
                        printSuccessMsg(data.msg);
                         
                      }else if(data.success == false){
                        $("#spinnerUsuario").hide();
                           printErrorMsg(data.msg);
                      }else{
                        
                        $("#spinnerUsuario").hide();
                        $('#btn_guardarUsuario').prop('disabled', false);
                        if(!data.msg.nombre) data.msg.nombre="";
                        if(!data.msg.email) data.msg.email="";
                        if(!data.msg.password) data.msg.password="";
                        console.log(data.msg);
                        
                        
                        Swal.fire({
                            title: "<h3 style='color:red'>¡¡Errores detectados!!</h3>",
                            html: '<div style="color:red">'+data.msg.nombre+"<br>"+data.msg.email+"<br>"+data.msg.password+"<br>"+data.msg.rol_admin+'</div>',
                            icon: "warning",
                            showCancelButton: false,
                            confirmButtonColor: "#d33",
                            confirmButtonText: "Continuar"
                        });
                        
                        printValidationErrorMsg(data.msg);
                      }
                },
            });
            return false;

           

        }); 

        
       //Creamos las tres funciones para craer los mensajes
       function printValidationErrorMsg(msg){
                texto="";
                $.each(msg, function(field_name, error){
                    //console.log("Field_name: "+field_name, error);
                    texto+=error+"<br>";
                    $(document).find('#'+field_name+'_error').text(error);
                   
                });
                Swal.fire({
                        title: "Acción sobre Usuarios",
                        html: '<h6 style="color:red">'+texto+'</h6>',
                        icon: "error",
                        showCancelButton: false,
                        confirmButtonColor: "#d33",
                        confirmButtonText: "Continuar"
                })
            }
            function printErrorMsg(msg){
                Swal.fire({
                title: "Acción sobre Usuarios",
                html: '<h3>'+msg+'</h3>',
                icon: "error",
                showCancelButton: false,
                confirmButtonColor: "#d33",
                confirmButtonText: "Continuar"
              }).then((result) => {
 
                //si e formulario se envió correctamente de resetra los campos del formulario
                document.getElementById('updateRolesForm').reset();
                //recargamos la página para actualizar los cambios
                location.reload();
              })
            }
            function printSuccessMsg(msg){
                Swal.fire({
                title: "Acción sobre Usuarios",
                html: '<h3>'+msg+'</h3>',
                icon: "success",
                showCancelButton: false,
                confirmButtonColor: "#d33",
                confirmButtonText: "Continuar"
              }).then((result) => {
 
                //si wl formulario se envió correctamente de resetra los campos del formulario
                //document.getElementById('updateRolesForm').reset();
                //recargamos la página para actualizar los cambios
                location.href( "{{ route('usuarios') }}");
              })
            }

           
        
            $('#rol_admin').on('change', function() {
                console.log("pulsado checkbos rol_admin");
                if(($('#rol_admin').prop("checked") == false) && ($('#rol_usuario').prop("checked") == false)){
                   
                    $('#rol_usuario').prop("checked", true);
                 }
            });
            $('#rol_usuario').on('change', function() {
                if(($('#rol_admin').prop("checked") == false) && ($('#rol_usuario').prop("checked") == false)){
                    
                    $('#rol_admin').prop("checked", true);
                 }
            });
        
    </script>
    
@stop