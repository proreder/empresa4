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
        <div  id="spinner"></div>
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
                            ?>" alt=""
                                width="40">
                        </td>

                        <td>{{ $conductor->nifnie_empleado }}</td>
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
        </table>
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
                        ...
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    
    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'POST',
                url:  '{{ route('conductores.index') }}',
                dataType: 'json',
                //antes de enviar la petición colocamos un spinner
                beforeSend: function(){
                    $('#spinner').html("<div class='cargando'><i class='fa-solid fa-spinner fa-5x'></i></div>");
                },
                //si hay error lo procesamos
                error: function(data){
                    //guardo en una variable el error del tipo que es
                    let errorJSON=JSON.parse(data.responseText);
                    Swal.fire({
                        icon: "error",
                        title: "Error de conexión",
                        text: errorJSON.message,
                         
                    });        
                },
                //si no hay error los mostramos en la tabla
                success: function(data){

                }
            });
            $('#conductores').DataTable({
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
            })
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
