@extends('adminlte::page')

@section('title', 'Jornadas')

@section('content_header')
<meta name="csrf-token" content="{{ csrf_token() }}">
        
@stop

@section('content')

<div class="container-fluid border border-danger">
    <div class="container">
        @if ($empleados )
         
            
                     <div class="row col-12 border">
                        <div class="col-4 col-md-6 col-lg-3 border">
                            <div class="row col-12 col-md-6 mt-4 d-flex mx-auto justify-content-center ">
                            
                                <p class="h4 mt-2 col-12">Conductor</p>
                            
                                @if($empleados->imagen)
                                    <img src="/empresa4/storage/app/{{ $empleados->imagen }}" width="170px" alt="imagen conductor"/>
                                @else
                                      <img src="../storage/app/public/imagenes/anonimo.png" width="170px" alt="imagen anonima"/>
                                @endif
                                
                                    
                                    <input type="text" id="tipo_via" name="tipo_via" value="{{$empleados->nombre}} {{$empleados->apellidos}}">
                                

                            </div>

                         </div>
                         <div class="col-6 col-md-6 col-lg-4 border">
                            <div class="row mx-1 mt-4 col-12  d-flex mx-auto justify-content-center">
                           
                                <p class="h4 mb-1">Vehículo utilizado</p>
                           
                            
                                @if($array_jornada['vehiculo'])
                                    <img src="/empresa4/storage/app/{{ $array_jornada['vehiculo']['imagen'] }}" width="200px" height="150px" alt="imagen conductor"/>
                                @else
                                      <img src="../storage/app/public/imagenes/anonimo.png" width="150px" alt="imagen anonima"/>
                                @endif
                                
                                    <input type="text" id="datos_vehiculo" name="datos_vehiculo" value="{{$array_jornada['vehiculo']['matricula']}} {{$array_jornada['vehiculo']['modelo']}}">
                                </div>

                            </div>
                        

                         
                         <div class="col-6 col-md-6 col-lg-4 mt-4 mx-2 border">
                            <div class="col-12">
                            <p class="h4 col-10"><b>Datos de la jornada</b></p>
                           
                            @if($array_jornada)
                                <table>
                                    <tr>
                                        <th class="colspan 2 h5"><b>Día: {{$array_jornada['dia']}}</b></th>
                                    </tr>
                                    <tr>
                                         <th width="200px" >Trabajos</th>
                                        <th>Tiempos</th>
                                    </tr>
                                    <tr>
                                        <td><span>Hora de inicio</span> <td><span><b>{{$array_jornada['inicio']}}</b></span></td>
                                    </tr>
                                    <tr>
                                        <td><span>Hora final</span> <td><span><b>{{$array_jornada['fin']}}</b></span></td>
                                    </tr>
                                   
                                    <tr>
                                        <td><span>Tiempo Conducción</span> <td><span><b>{{$array_jornada['tiempos']['Conduccion']}}</b></span></td>
                                    </tr>
                                    <tr>
                                        <td><span>Tiempo Disponilidad</span> <td><span><b>{{$array_jornada['tiempos']['Disponibilidad']}}</b></span></td>
                                    </tr>
                                    <tr>
                                        <td><span>Otros Trabajos</span> <td><span><b>{{$array_jornada['tiempos']['Otros trabajos']}}</b></span></td>
                                    </tr>
                                    <tr>
                                        <td><span>Tiempo Descanso</span> <td><span><b>{{$array_jornada['tiempos']['Descanso']}}</b></span></td>
                                    </tr>
                                    <tr>
                                        <td><span>Tiempo empleado</span> <td><span><b>{{$array_jornada['tiempos']['total']}}</b></span></td>
                                    </tr>
                                   
                                </table>
                            @else
                                <div class="h5"><b>No hay datos</b></div>
                            @endif
                         </div>
                         </div>
                         <div class="col-12 mt-3 d-flex mx-auto justify-content-center" ">
                            <h3>Recorrido con los datos del GPS</h3>
                        </div>
                         <div class="row col-11 mt-1 mx-2 border border-dark" id="map">
                         
                           <!--   <img class="wh-auto mx-3 mt-3 border border-dark boder-3"  src="/empresa4/storage/app/public/imagenes/maps.png"  alt="imagen anonima"/> -->

                        </div>
                        <div class="col-12 mt-3 d-flex mx-auto justify-content-center" ">
                        <button type="button" class="btn btn-secondary" onclick="history.back()">Cancelar</button>
                        </div>
                    </div>
                  

                   
           
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
    <link rel="stylesheet" href="/empresa4/public/css/create.css">
    <link rel="stylesheet" href="/empresa4/public/css/leaflet.css" />

@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/busy-load/dist/app.min.js"></script>
<script src="/empresa4/public/build/assets/sweetalert2.all.min.js"></script>
<script src="/empresa4/public/js/leaflet.js"></script>
<script>
    //CSRF
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    $(document).ready(function(){
       // Obtiene los datos de marcadores desde Blade
       var markers = @json($array_jornada['gps']);

            // Inicializa el mapa y establece la vista inicial
            var map = L.map('map').setView([51.505, -0.09], 13);

            // Añade una capa de mapa base (OpenStreetMap en este caso)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Añade los marcadores al mapa
            markers.forEach(function(marker) {
                L.marker([marker.lat, marker.lon]).addTo(map)
                    .bindPopup(marker.popup)
                    .openPopup();
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

