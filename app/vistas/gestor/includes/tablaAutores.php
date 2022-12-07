<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col" class="text-center">Nombre</th>
            <th scope="col" class="text-center">Apellidos</th>
            <th scope="col" class="text-center">Fecha de Nacimiento</th>
            <th scope="col" class="text-center">País de Origen</th>
            <th scope="col" class="text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $conexion = new Conexion();
        $resultado = $conexion->query("SELECT a.nombre AS nombreAutor, a.apellidos, DATE_FORMAT(a.fechaNacimiento, '%d-%m-%Y') AS fechaNac, p.nombre AS paisOrigen FROM autor a JOIN paisOrigen p ON (a.paisOrigenId = p.id) ORDER BY a.nombre ASC");
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td class='text-center'>".$fila['nombreAutor']."</td>";
            echo "<td class='text-center'>".$fila['apellidos']."</td>";
            echo "<td class='text-center'>".$fila['fechaNac']."</td>";
            echo "<td class='text-center'>".$fila['paisOrigen']."</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>