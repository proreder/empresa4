@extends('adminlte::page')

@section('title', 'Vehículos')

@section('content_header')
        
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
    <div class="float-right justify-content-end"></div>
                            
    </div>
    <div class="container-fluid">
 
        <div class="row my-5">
            <div class="col-lg-12">
                
                <div class="card  shadow">
                    <div class="card-header row col-12">
                        <h5 class="text-dark col-11">Control de vehículos</h5>
                        <button class="btn btn-success btn-sm " data-bs-toggle="modal"  data-bs-target="#agregarVehiculo"><i class="bi-plus-circle me-2"></i>Añadir vehículo</button>
                        
                        
                    </div>
                    <div class="card-body" id="mostrarTodosVehiculos">
                    <table id="tabla_conductores" class="table table-striped border">
                        <thead class="thead-light">
                            <tr>
                                <th width="70px">Matrícula</th>
                                <th width="220px">Número de chasis</th>
                                <th width="60px">Potencia</th>
                                <th width="70px">Tipo</th>
                                <th width="120px">Modelo</th>
                                <th width="100px">Km. Actuales</th>
                                <th width="100px">Km. Revisión</th>
                                <th width="60px">Disponible</th>
                                <th width="60px">Foto</th>
                                <th width="80px">Acciones</th>
                            </tr>

                        </thead>
                        <tbody>
                            @if (count($vehiculos) >0)
                                @foreach ($vehiculos as $vehiculo)
                                    <tr>
                                        <td>{{$vehiculo->matricula}}</td>
                                        <td>{{$vehiculo->numero_chasis}}</td>
                                        <td>{{$vehiculo->potencia}}</td>
                                        <td>{{$vehiculo->tipo}}</td>
                                        <td>{{$vehiculo->modelo}}</td>
                                        <td>{{$vehiculo->km_actuales}}</td>
                                        <td>{{$vehiculo->km_revision}}</td>
                                        <td>{{$vehiculo->disponible}}</td>
                                        <td><img src="data:image/png;base64,
                                            <?php 
                                                    echo base64_encode($vehiculo->foto); 
                                            ?>"  alt="" width="60"></td>
                                        <td>
                                            <button type="button" class="btn_editar btn btn-link" data-bs-config="backdrop:true" data-bs-target="#editarConductor"><i class="bi-pencil-square h4"></i></button>
                                            <button type="button"  data-toggle="popover" class="btn_borrar btn btn-link text-danger" ><i class="bi bi-trash h4"></i></button>
                                            
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
                        <h2 class="text-center text-secondary my-5">Cargando...</h2>                    

                    </div>
                </div>
            </div>
        </div>
    </div>
       
        
{{-- Modal  Editar--}}
<div class="modal fade" id="agregarVehiculo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Formulario de vehiculos
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
   

@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<script>
    //CSRF
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    $(document).ready(function(){
        $html=``;
        $('[data-toggle="popover"]').popover();
        mostrarVehiculos();
        //funcion para motras los vehiulos de la base de datos
        function mostrarVehiculos(){
            $.ajax({
                type: 'get',
                url: "{{ route('index') }}",
                success: function(response){
                    //$('#mostrarTodosVehiculos').html($html);
                    console.log('ajax');
                }
            });
        };
        
        
        

    });
</script>
@endsection