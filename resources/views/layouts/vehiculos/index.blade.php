@extends('adminlte::page')

@section('title', 'Vehículos')

@section('content_header')
    <h1>Listado de Vehículos</h1>
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

    <div class="container">
        <div class="row my-5">
            <div class="col-lg-12">
                <h2> Tabla vehiculos </h2>
                <div class="card  shadow">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="text-light">Control de vehículos</h3>
                        <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#agregarVehiculo"><i class="bi-plus-circle me-2"></i>Añadir vehículo</button>
                    </div>
                    <div class="card-body" id="mostrarTodosVehiculos">
                        <h2 class="text-center text-secondary my-5">Cargando...</h2>                    

                    </div>
                </div>
            </div>
        </div>
    </div>
       
        
{{-- Modal --}}
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
        mostrarVehiculos();
        //funcion para motras los vehiulos de la base de datos
        function mostrarVehiculos(){
            $.ajax({
                url: '{{ route('vehiculos.index') }}',
                method: 'get',
                success: function(response){
                    $('#mostrarTodosVehiculos').html(response);
                    console.log('ajax');
                }
            });
        }

    });
</script>
@endsection