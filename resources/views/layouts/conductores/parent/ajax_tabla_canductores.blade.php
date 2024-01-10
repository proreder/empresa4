<table id="conductores" class="table table-striped border">
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
</table>