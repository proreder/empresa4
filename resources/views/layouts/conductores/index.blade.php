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
      
       
        
        <a href="{{ url('conductores/create') }}" class="btn btn-success">Alta de conductor</a>
        <br><br>
        
        <table id="conductores" class="table table-striped border">
            <thead class="thead-light">
                <tr>
                    <th width="80px">Fotografía</th>
                    <th width="90px">NIF/NIE</th>
                    <th width="100px">Permisos</th>
                    <th width="125px">CAP</th>
                    <th width="125px">Tarjeta tacógrafo</th>
                    <th width="40px">Tipo ADR</th>
                    <th width="140px">Acciones</th>

                </tr>

            </thead>
            <tbody>
                @forelse ($conductores as $conductor)
                    <tr>
                        <td><img src="data:image/png;base64,
                            <?php 
                                 echo base64_encode($conductor->empleado->foto); 
                            ?>"  alt="" width="40">
                        </td>
                        
                        <td>{{ $conductor->nifnie_empleado}}</td>
                        <td>{{ $conductor->permisos}}</td>
                        <td>{{ ($conductor->cap = true ? 'Si' :  'No')}}</td>
                        <td>{{ $conductor->tarjeta_tacografo = true ? 'Si' : 'No' }}</td>
                        <td>{{ $conductor->tipo_ADR}}</td>
                        <td>
                            <form id="btnEliminar" action="{{url('/conductores/'.$conductor->id)}}" method="post">
                                {{method_field('EDIT')}}
                                <a href="{{url('/conductores/'.$conductor->id.'/edit/')}}" class="btn btn-primary btn-sm py-0">Editar</a> 
                                @csrf
                                {{method_field('DELETE')}}
                             <!--   <input type="submit" onclick="return confirm('¿Quieres borrar?')" id="btnEliminar" value="Borrar" class="btn btn-danger btn-sm py-0"> -->
                                <button type="submit" value="Borrar" class="btn btn-danger btn-sm py-0">Borrar</button> 
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
    <link rel="stylesheet" href=".public/vendor/adminlte/dist/css/adminlte.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../public/css/sweetalert2.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
    <script src="../public/build/assets/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#conductores').DataTable({
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
            $('#btnEliminar').on('submit', function(e){
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
            })
        });
    </script>
    @if(Session::has('success'))
        <script>
            Swal.fire({
                title: "Borrado",
                text: "El conductor se ha borrado corectamente",
                icon: "question"
            });
        </script>
    @endif
@endsection
