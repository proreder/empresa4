Vista para crear un nuevo empleado
<br>



    <form action="{{ url('/empleados')}}" method="post" enctype="multipart/form-data">
        @csrf
        <table>
        <tr>
            <td>
                <label for="nifnie">NifNie: </label>
                <input type="text" name="nifnie">
            </td>
            <td>
                <label for="nss">Número SS: </label>
                <input type="text" name="nss">
            </td>
        </tr>
        <tr>
            <td>
                <label for="nombre">Nombre: </label>
                <input type="text" name="nombre">
            </td>
            <td>
                <label for="apellidos">Apellidos: </label>
                <input type="text" name="apellidos">
            </td>
        </tr>
        <tr>
            <td>
                <label for="fecha_nacimiento">Fecha nacimiento:</label>
                <input type="text" name="fecha_nacimiento">
            </td>
            <td>
                <label for="tipo_via">Tipo de via: </label>
                <input type="text" name="tipo_via">
            </td>
        </tr>
        <tr>
            <td>
                <label for="nombre_via">Nombre via: </label>
                <input type="text" name="nombre_via">
            </td>
            <td>
                <label for="numero">Número: </label>
                <input type="text" name="numero">
            </td>
        </tr>
        <tr>
            <td>
                <label for="planta">planta: </label>
                <input type="text" name="planta">
            </td>
            <td>    
        
                <label for="puerta">Puerta: </label>
                <input type="text" name="puerta">
            </td>
        </tr>
        <tr>
            <td>
                <label for="municipio">Municipio: </label>
                <input type="text" name="municipio">
            </td>
            <td>
                <label for="provincia">Provincia: </label>
                <input type="text" name="provincia">
            </td>
        </tr>
        <tr>
            <td>
                <label for="cp">C.P: </label>
                <input type="text" name="cp">
            </td>
            <td>
                <label for="telefono_fijo">Teléfono fijo: </label>
                <input type="text" name="telefono_fijo">
            </td>
        </tr>
        <tr>
            <td>
                <label for="telefono_movil">Teléfono móvil: </label>
                <input type="text" name="teléfono_movil">
            </td>
            <td><br>

                <label for="email">Email: </label>
                <input type="text" name="email">
            </td>
        </tr>
        <tr>
            <td>
                
                <label for="puesto">Puesto: </label>
                <input type="text" name="puesto">
            </td>
            <td>
                <label for="tipo_puesto">Puesto trabajo: </label>
                <input type="text" name="tipo_puesto">
            </td>
        </tr>
        <tr>
            <td>
                <label for="fecha_alta">Fecha Alta: </label>
                <input type="text" name="fecha_alta">
            </td>
            <td>
        
                <label for="fecha_baja">Fecha Baja: </label>
                <input type="text" name="fecha_baja">
            </td>
        </tr>
        <tr>
            <td>
                <label for="motivo_baja">Motivo baja: </label>
                <textarea name="textarea" rows="3" cols="50"></textarea>

            </td>
            
        </tr>
        <tr>
            <td><br>
                <label for="foto">Fotografia: </label>
                <input type="file" name="foto">
            </td>
        </tr>
        <tr>
            <td>
                <br>
                <input type="submit" value="Enviar">
            </td>
        </tr>
    </table>
    
</form>