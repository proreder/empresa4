@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado de conductores</h1>
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


        <div  id="contenido"></div>
        
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Launch demo modal
        </button>
        <!--End card-->


        {{-- Modal --}}
        <div class="modal fade" id="editarConductor" tabindex="-1" aria-labelledby="editarConductorLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title fs-5" id="editarConductorLabel">Editar un conductor</h2>
                        <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-square h-3"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="card px-2 py-2">
                            <div class="car-body" id="formulario">
                                   
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>
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
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="../public/build/assets/sweetalert2.all.min.js"></script>
    
    
    <script>
        //CSRF
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            let tabla="<h1>Listado de conductores</h1>";
           
    /* let tabla=`<table id="conductores" class="table table-striped border">
        <thead class="thead-light">
            <tr>
                <th width="80px">Fotografía</th>
                <th width="150px">Nombre empleado</th>
                
                <th width="100px">Permisos</th>
                <th width="125px">CAP</th>
                <th width="125px">Tarjeta tacógrafo</th>
                <th width="40px">Tipo ADR</th>
                <th width="140px">Acciones</th>

            </tr>

        </thead>
        <tbody>
            @forelse ($conductorees as $conductor)
                <tr>
                    <td><img src="data:image/png;base64,
                        <?php
                        echo base64_encode($conductor->empleado->foto);
                        ?>" alt=""  width="40">
                    </td>
                    <td>{{ $conductor->empleado->nombre." ".$conductor->empleado->apellidos }}</td>      
                    
                    <td>{{ $conductor->permisos }}</td>
                    <td>{{ $conductor->cap = true ? 'Si' : 'No' }}</td>
                    <td>{{ $conductor->tarjeta_tacografo = true ? 'Si' : 'No' }}</td>
                    <td>{{ $conductor->tipo_ADR }}</td>
                    <td>
                        <form id="btnEliminar" action="{{ url('/conductores/' . $conductor->id) }}" method="post">
                            {{ method_field('EDIT') }}
                            <a href="{{ url('/conductores/' . $conductor->id . '/edit/') }}"
                                class="text-success mx-1 editIcon" data-bs-toggle="modal"
                                data-bs-target="#editarConductor"><i class="bi-pencil-square h4"></i></a>

                            <!-- Button trigger modal -->
                            <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"></button>-->
                            @csrf
                            {{ method_field('DELETE') }}
                            <!--   <input type="submit" onclick="return confirm('¿Quieres borrar?')" id="btnEliminar" value="Borrar" class="btn btn-danger btn-sm py-0"> -->
                            <!--   <button type="submit" value="Borrar" class="text-danger mx-1 delete-Icon"><i class="bi-trash h5"></i></button> -->
                            <a href="{{ url('/conductores/' . $conductor->id . '/delete/') }}"
                                class="text-danger mx-1 delete-Icon"><i class="bi-trash h4"></i></a>
                        </form>
                    </td>
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>`;
*/

let form=`<form>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Nombre:</label>
      <input type="text" class="form-control form-control-sm" id="nombre" aria-describedby="emailHelp" disabled readonly>
      
    </div>
    <div class="form-group mb-3">
        <label for="apellidos" class="form-label">Apellidos:</label>
        <input type="text" class="form-control form-control-sm" id="apellidos" aria-describedby="emailHelp">
        
      </div>
    
        <div class="form-group mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control form-control-sm" id="exampleInputPassword1">
        </div>
    
    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="tarjeta_tacografo" name="tarjeta_tacografo">
      <label class="form-check-label" for="exampleCheck1">Tarjeta de Tacógrafo</label>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="cap" name="cap">
        <label class="form-check-label" for="cap">Permiso CAP</label>
      </div>
    <div class="row col-12 border px-2">
        <div class="col-6 px-0">
            <div class="form-group border">
                <label for="exampleInputEmail1">Tipo ADR:</label>
                <select class="form-select mb-3" aria-label="Default select example" name="tipo_ADR">
                    
                    <option value="1">Básico</option>
                    <option value="2">Cisternas</option>
                    <option value="3">Explosivos</option>
                    <option value="4">Radiactivos</option>
                </select>
                
            </div>
        </div>
        <div class="col-5">
            <div class="form-group mb-3">
                <label for="exampleInputEmail1" >Permiso:</label>
                <select class="form-select mb-3" aria-label="Default select example" name="permiso">
                    <option selected>C1</option>
                    <option value="1">C1</option>
                    <option value="2">C1+E</option>
                    <option value="3">C</option>
                    <option value="4">C+E</option>
                </select>
            </div>
        </div>
    </div>
    
  </form>`;
//$("#formulario").html(form);
/*$('#conductores').DataTable({
responsive: true,
"language": {
"search": "Buscar",
"lengthMenu": "Mostrar _MENU_ registros por página",
"info": "Página _PAGE_ de _PAGES_",
"zeroRecords": "No hay registros",
"infoEmpty": "",
"paginate": {
"previous": "Anterior",
"next": "Siguiente",
"first": "Primero",
"last": "último"
}
}
});
$('#btnEliminar').on('submit', function(e) {
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
this.submit()
});
});
*/
mostrar_conductores();
function mostrar_conductores(){
alert('Hola mostrar_conductores');
$.ajax({
method: 'POST',
url:  'listar',
dataType: 'json',
//data:$('#contenido').serialize(),
//antes de enviar la petición colocamos un spinner
beforeSend: function(){
$('#contenido').html("<div class='cargando'><i class='fa-solid fa-spinner fa-5x'></i></div>");
},
//si hay error lo procesamos
error: function(data){
$('#contenido').html('Error');
//guardo en una variable el error del tipo que es
//const errorJSON=JSON.parse(this.);
Swal.fire({
icon: "error",
title: "Error de conexión",
text: 'errorJSON.message',
footer: "<a href=''>Vuelva a intentarlo</a>"
});        
},
//si no hay error los mostramos en la tabla
success: function(data){

$('#contenido').html(tabla);

alert('tabla');

}
});
}

});


</script>
@if (Session::has('success'))
<script>
Swal.fire({
title: "Borrado",
text: "El conductor se ha borrado corectamente",
icon: "question"
});
</script>
@endif
@endsection

</body>
</html> 
