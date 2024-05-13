@extends('adminlte::page')

@section('title', 'Jornadas')

@section('content_header')
<meta name="csrf-token" content="{{ csrf_token() }}">
        
@stop

@section('content')
   
    <div class="float-right justify-content-end">
                            
    </div>
    <div class="container-fluid">
 
        <div class="row my-5">
            <div class="col-lg-12">
                
                <div class="card shadow">
                    <div class="card-header row col-12">
                        <h5 class="text-dark col-11">Control de Jornadas</h5>
                        <button class="btn btn-success btn-sm " data-bs-toggle="modal"  data-bs-target="#agregarJornada"><i class="bi-plus-circle me-2"></i>Añadir vehículo</button>
                    </div>
                    <div class="card-body" id="mostrarJornadas">
                    <table id="tabla_jornadas" class="table table-striped border">
                        <thead class="thead-light">
                            <tr>
                                <th width="60px">Inicio</th>
                                <th width="60px">Final</th>
                                <th width="60px">Registrada</th>
                                <th width="40px">DNI-NIE</th>
                                <th width="20px">Horas</th>
                                <th width="40px">Estado</th>
                                <th width="60px">Acciones</th>
                               
                            </tr>

                        </thead>
                        <tbody>
                            @if ($jornadas)
                                @foreach ($jornadas as $jornada)
                                    <tr>
                                        <td>{{date('d-m-y H:m', strtotime($jornada->inicio_jornada))}}</td>
                                        <td>{{$jornada->fin_jornada}}</td>
                                        <td>{{date('d-m-y', strtotime($jornada->fecha_registro))}}</td>
                                        <td>{{$jornada->realizaJornada->nifnie_conductor}}</td>
                                        

                                        @php
                                            $datetime1 = new DateTime($jornada->inicio_jornada); // start time
                                            $datetime2 = new DateTime($jornada->fin_jornada); // end time
                                            $interval = $datetime1->diff($datetime2);
                                        @endphp
                                        <td>@php echo($interval->format('%H:%i')) @endphp</td>
                                        <td>{{$jornada->ultimoRegistro->estado}}</td>
                                        </td>
                                        
                                        <td>
                                        <form id="btn_ver" action="" method="get">
                                            @csrf
                                            <a type="button" class="btn_ver btn btn-link"  href="{{ url('/jornadas/show/'.$jornada->id) }}"  name="{{ $jornada->id }}"><i class="bi bi-eye-fill h4"></i></a>
                                            <button type="button"  data-toggle="popover" id="btn_borrar" data-id="{{$jornada->id}}" class="btn_borrar btn btn-link text-danger" ><i class="bi bi-trash h4"></i></button>
                                        </form>    
                                        </td>
                                    </tr>
                                @endforeach
                            @else 
                                <tr>
                                    <td coolspan="5">No hay datos que mostrar</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                                           

                    </div>
                </div>
            </div>
        </div>
    </div>
       
        

   

</div>

@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/busy-load/dist/app.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./public/css/create.css">
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/busy-load/dist/app.min.js"></script>
<script src="./public/build/assets/sweetalert2.all.min.js"></script>
<script>
    //CSRF
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    $(document).ready(function(){
        $('#tabla_jornadas').DataTable({
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
        
        //script para BORRAR un conductor si se pulsa el botón de borrado
        $('.btn_borrar').on('click', function(e) {
                console.log('Se ha pulsado borrar');
                var vehiculo_id= $(this).attr('data-id');
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
                        var url= "{{ route('borrarVehiculo','vehiculo_id') }}";
                        url=url.replace('vehiculo_id',vehiculo_id);
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
                                        text: "El vehículo se ha borrado corectamente",
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
        
        
          
         

          //Creamos las tres funciones para craer los mensajes
          function printValidationErrorMsg(msg){
                texto="";
                $.each(msg, function(field_name, error){
                    console.log("Field_name: "+field_name, error);
                    texto+=error+"<br>";
                    $(document).find('#'+field_name+'_error').text(error);
                   
                });
                Swal.fire({
                        title: "Acción sobre vehículos",
                        html: '<h6 style="color:red">'+texto+'</h6>',
                        icon: "error",
                        showCancelButton: false,
                        confirmButtonColor: "#d33",
                        confirmButtonText: "Continuar"
                })
            }
            function printErrorMsg(msg){
                Swal.fire({
                title: "Acción sobre vehículos",
                html: '<h3>'+msg+'</h3>',
                icon: "error",
                showCancelButton: false,
                confirmButtonColor: "#d33",
                confirmButtonText: "Continuar"
              }).then((result) => {
 
                //si e formulario se envió correctamente de resetra los campos del formulario
                document.getElementById('addVehiculoForm').reset();
                //recargamos la página para actualizar los cambios
                location.reload();
              })
            }
            function printSuccessMsg(msg){
                Swal.fire({
                title: "Acción sobre vehículos",
                html: '<h3>'+msg+'</h3>',
                icon: "success",
                showCancelButton: false,
                confirmButtonColor: "#d33",
                confirmButtonText: "Continuar"
              }).then((result) => {
 
                //si wl formulario se envió correctamente de resetra los campos del formulario
                document.getElementById('addVehiculoForm').reset();
                //recargamos la página para actualizar los cambios
                location.reload();
              })
            }
</script>

@endsection