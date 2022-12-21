<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col" class="text-center">Nombre</th>
            <th scope="col" class="text-center">Apellidos</th>
            <th scope="col" class="text-center d-none d-sm-none d-md-table-cell d-lg-table-cell d-xl-table-cell">Fecha de Nacimiento</th>
            <th scope="col" class="text-center d-none d-sm-none d-md-table-cell d-lg-table-cell d-xl-table-cell">País de Origen</th>
            <th scope="col" class="text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $conexion = new Conexion();
        $resultado = $conexion->query("SELECT a.id, a.nombre AS nombreAutor, a.apellidos, DATE_FORMAT(a.fechaNacimiento, '%d-%m-%Y') AS fechaNac, p.nombre AS pais FROM autor a JOIN pais p ON (a.paisId = p.id) ORDER BY a.nombre ASC");
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<tr id='idAutor".$fila['id']."'>";
            echo "<td class='text-center'>";
            echo "<input type='checkbox' name='ids[]' class='deleteCheckbox' value='".$fila['id']."'>";
            echo "</td>";
            echo "<td class='text-center'>".$fila['nombreAutor']."</td>";
            echo "<td class='text-center'>".$fila['apellidos']."</td>";
            echo "<td class='text-center d-none d-sm-none d-md-table-cell d-lg-table-cell d-xl-table-cell'>".$fila['fechaNac']."</td>";
            echo "<td class='text-center d-none d-sm-none d-md-table-cell d-lg-table-cell d-xl-table-cell'>".$fila['pais']."</td>";
            echo "<td class='text-center'>";
            echo "<button type='button' class='btn btn-danger bi-trash elimAutor' id='".$fila['id']."'></button>";
            $location = RUTA_PUBLIC.'/autores/vistaEditarAutor/'.$fila['id'];
            echo "<button type='button' class='btn btn-primary bi-pencil-square ms-2' onclick='location.href=\"$location\"'></button>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>