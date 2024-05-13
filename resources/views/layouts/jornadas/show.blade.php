@extends('adminlte::page')

@section('title', 'Jornadas')

@section('content_header')
<meta name="csrf-token" content="{{ csrf_token() }}">
        
@stop

@section('content')

<div class="container-fluid border border-danger">
    <div class="container">
        @if ($empleados)
         @php var_dump($empleados);
          @endphp
            @foreach($empleados as $empleado)
                     <div class="row">
                        <div class="col-3">
                            <div class="col-12 border border-warning">
                                <img src="../storage/app/{{ $empleado->imagen }}" width="150px" alt="imagen conductor"/>
                                <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control" id="tipo_via" name="tipo_via" value="{{$empleado->nombre}} {{$empleado->apellidos}}">
                                </div>

                            </div>

                         </div>

                    </div>
            @endforeach
        @else 
            
             <h2>No hay datos que mostrar</h2>
            
        @endif

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
        //Se abre una ventana modal para añadir los datos de un nuevo vehiculo
        $('#addVehiculoForm').submit(function(e){
            
            e.preventDefault();
            //let formData=$(this).serialize();
            var formData=new FormData(this);
            $.ajax({
                type: 'POST',
                url: '{{ route("crearVehiculo") }}',
                data: formData,
                dataType: 'JSON',
                contentType: false,
                processData: false,
                beforeSend: function(){
                    //desactivamos el botón añadir vehículos
                    //$('#')('beforeSend');
                    $('#addBtn').prop('disabled', true);
                    $("#spinner").busyLoad("show", {
                        fontawesome: "fa fa-spinner fa-spin fa-3x fa-fw" });
                    },
                complete: function(){
                    //Si se ha comppletado la operación lo activamos
                    $('#addBtn').prop('disabled', false);
                }, 
                success: function(data){
                    console.log('success');
                      if(data.success == true){
                        //cerramos el modal agregarVehiculo si se ha guardado la informacion en la base de datos correctamente
                        $('#agregarVehiculo').hide();
                        printSuccessMsg(data.msg);
                        //location.reload();
                      }else if(data.success == false){
                        printErrorMsg("Error, no se ha pódido guardar el vehículo");
                        console.log(data.msg);
                      }else{
                        console.log('printValidationErrorMsg');
                        printErrorMsg("Error, no se ha pódido guardar el vehículo");
                        printValidationErrorMsg(data.msg);
                      }
                },
            });
            return false;
         });

         //Mostramos la imagen seleccionada
        
        function mostrarImagen(event, id, id_update=null) {
                var input = event.target;
                var reader = new FileReader();
                
                reader.onload = function() {
                var imagen = document.getElementById(id);
                imagen.src = reader.result;
                $(id).attr('src', imagen.src);
                if(id_update){
                    console.log('Imagen de update');
                    $(id_update).attr('src', imagen.src);
                }
                console.log('Mostrar imagen id: '+id);
                console.log('img.src: '+imagen.src);
                }
                
                reader.readAsDataURL(input.files[0]);
         };

</script>

@endsection

