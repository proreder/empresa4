@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado de empleados</h1>
@stop

@section('content')
    <div class="container-flex">
      
        
        <!--<p>Welcome to this beautiful admin panel.</p>-->
        <!--Mostramos el ROL de usuario que se ha conectado-->
        @role('super')
            <p>Hola SuperAdministrador</p>
        @endrole
        @role('admin')
            <p>Hola Administrador</p>
        @endrole
        @role('usuario')
            <p>Hola Usuario</p>
        @endrole
        
        <a href="{{ route('agregarEmpleado') }}" class="btn btn-success">Alta de Empleado</a>
        <br><br>
        
        <table id="empleados" class="table table-striped border">
            <thead class="thead-light">
                <tr>
                    <th width="80px">Fotografía</th>
                    <th width="90px">NIF/NIE</th>
                    <th width="100px">Número SS</th>
                    <th width="125px">Nombre</th>
                    <th width="125px">Apellidos</th>
                    <th width="40px">Móvil</th>
                    <th width="40px">Fijo</th>
                    <th width="50px">Tipo Via</th>
                    <th width="160px">Nombre via</th>
                    <th width="140px">Acciones</th>

                </tr>

            </thead>
            <tbody>
                @forelse ($empleados as $empleado)
                    <tr>
                        <td><img src="data:image/png;base64,
                            <?php 
                                 echo base64_encode($empleado->foto); 
                            ?>"  alt="" width="40">
                        </td>
                        <!-- <td></td> -->
                        <td>{{ $empleado->nifnie}}</td>
                        <td>{{ $empleado->nss}}</td>
                        <td>{{ $empleado->nombre}}</td>
                        <td>{{ $empleado->apellidos}}</td>
                        <td>{{ $empleado->telefono_movil }} </td>
                        <td>{{ $empleado->telefono_fijo }} </td>
                        <td>{{ $empleado->tipo_via}}</td>
                        <td>{{ $empleado->nombre_via}}</td>
                        <td>
                            <form id="eliminarForm" action="{{url('/empleados/'.$empleado->id)}}" method="post">
                            @csrf
                                {{method_field('EDIT')}}
                                <a href="{{url('/empleados/'.$empleado->id.'/edit/')}}" class="btn_editar btn btn-link"><i class="bi-pencil-square h4"></i></a> 
                                
                                {{method_field('DELETE')}}
                             <!--   <input type="submit" onclick="return confirm('¿Quieres borrar?')" id="btnEliminar" value="Borrar" class="btn btn-danger btn-sm py-0"> -->
                                <button type="button" value="Borrar" data-id="{{$empleado->id}}" class="btn_borrar btn btn-link text-danger"><i class="bi bi-trash h4"></i></button> 
                            </form>   
                        </td>
                    </tr>
                @empty
                    
                @endforelse
            </tbody>
        </table>
      <!--End card-->
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../public/css/sweetalert2.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/busy-load/dist/app.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
    <script src="../public/build/assets/sweetalert2.all.min.js"></script>
    <script>
        //CSRF
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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
                                        "previous"  :  "Anterior",
                                        "next":       "Siguiente",
                                        "first":       "Primero",
                                        "last":        "último"
                }   
            }  
            });
             //script para BORRAR un conductor si se pulsa el botón de borrado
             $('.btn_borrar').on('click', function(e) {
                var empleado_id= $(this).attr('data-id');
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
                        var url= "{{ route('borrarEmpleado','empleado_id') }}";
                        url=url.replace('empleado_id',empleado_id);
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
                                        text: "El empleado se ha borrado corectamente",
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

            
            /*
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
                    this.submit();
                });
            });
            */
        });
    </script>
    @if(Session::has('success'))
        <script>
           /* Swal.fire({
                title: "Borrado",
                text: "El empleado se ha borrado corectamente",
                icon: "question"
            });
            */
        </script>
        
    @else
        <script>/*
            Swal.fire({
                title: "Borrado",
                text: "El empleado no se ha borrado",
                icon: "error"
            });
            */
        </script>
    @endif
@endsection