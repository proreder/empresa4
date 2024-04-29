@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado de usuarios registrados</h1>
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
                                    <button type="button" class="btn_editar btn btn-link"  data-bs-toggle="modal"  data-bs-config="backdrop:true" data-bs-target="#editarUsuarioModal" data-id="{{$usuario->id}}" data-nombre="{{$usuario->name}}" data-email="{{$usuario->email}}" data-password="{{$usuario->password}}" data-rol="{{$role->name}}"><i class="bi-pencil-square h4"></i></button>
                                    <button type="button"  data-toggle="popover" id="btn_borrar"  class="btn_borrar btn btn-link text-danger" data-id-delele="{{$usuario->id}}"><i class="bi bi-trash h4"></i></button>
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
                                        <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Cerrar</button>
                                        <div id="spinnerVehiculo"></div>
                                        <button type="submit" id="btn_guardarVehiculo" class="btn btn-danger">Actualizar</button>
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
                            <label for="nombre_nuevo" class="form-label">Nombre</label>
                            <input type="text" class="form-control @error('nombre_error') is-invalid @enderror" id="nombre_nuevo" name="nombre_nuevo">
                            <small class='alert text-danger' id='nombre_error_nuevo'></small>
                        </div> 
                        <div class="col-10">
                            <label for="email_nuevo" class="form-label">Email:</label>
                            <input type="text" class="form-control" id="email_nuevo" name="email_nuevo">
                            <small class='alert text-danger' id='email_error_nuevo'></small>
                        </div>
                
                        <div class="col-10">
                            <label for="password_nuevo" class="form-label">Contraseña:</label>
                            <input type="text" class="form-control" id="password_nuevo" name="password_nuevo">
                            <small class='alert text-danger' id='password_error_nuevo'></small>
                        </div> 
                        <div class="col-10">
                            <label for="re_password_nuevo" class="form-label">Repite contraseña:</label>
                            <input type="text" class="form-control" id="re_password_nuevo" name="re_password_nuevo">
                            <small class='alert text-danger' id='re_password_error_nuevo'></small>
                        </div>
                        <div class="form-group ms-2">
                        <label for="rol_nuevo" class="form-label">Tipo de Rol:</label>
                        <select class="form-select mb-3" id="rol_nuevo" name="rol_nuevo">
                            <option value="Administrador">Administrador</option>
                            <option value="Usuario">Usuario</option>
                        </select>
                    </div>
                       
                </div> 
                
                
                <div class="modal-footer">
                        <div class="row row justify-content-between col-12">
                                        <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Cerrar</button>
                                        <div id="spinnerUsuario"></div>
                                        <button type="submit" id="btn_guardarUsuario" class="btn btn-danger">Guardar</button>
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

            //si se pulsa el boton editar se abre el modal con los datos de fila que se ha seleccionado
         $('#tabla_usuarios tbody').on( 'click', '.btn_editar', function () {
                var id_usuario = $(this).attr('data-id');
                var nombre = $(this).attr('data-nombre');
                var email = $(this).attr('data-email');
                var password = $(this).attr('data-password');
                var rol=$(this).attr('data-rol');
                console.log('id:')+id_usuario;

                console.log('nombre:')+nombre;
                console.log('email:')+email;
                console.log('rol:')+rol;
                               
                               
                //rellenamos el formulario modal con los datos de la fila seleccionada
                $('#editarUsuario').modal('show');
                $('#id_usuario_edit').val(id_usuario)
                $("#nombre_edit").val(nombre);
                $('#email_edit').val(email);
                $('#password_edit').val(password);
                          
                
            });

           $('#nuevoUsuarioModal').on('click', function(){
              $('#nuevoUsuarioModal').modal('show');
           });

        });

        //si se pulsa  #btn_guardarUsuario       
        $('#guardarUsuarioForm').submit(function(e){
             e.preventDefault();
            
             //verificamos los estados de los checkbox
            var formData=new FormData(this);

            //enviamos la petición ajax para añadir un nuevo conductor
            $.ajax({
                type: 'POST',
                url: '{{ route("agregarUsuario") }}',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    //desactivamos el botón guardar conductor
                    
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
                        if(!data.msg.cap) data.msg.cap="";
                        if(!data.msg.tarjeta_tacografo) data.msg.tarjeta_tacografo="";
                        if(!data.msg.imagen) data.msg.imagen="";
                        
                        
                        Swal.fire({
                            title: "<h3 style='color:red'>¡¡Errores detectados!!</h3>",
                            html: '<div style="color:red">'+data.msg.cap+"<br>"+data.msg.tarjeta_tacografo+"<br>"+data.msg.imagen+'</div>',
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
        
    </script>
    
@stop