<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col"></th>
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
        $resultado = $conexion->query("SELECT a.id, a.nombre AS nombreAutor, a.apellidos, DATE_FORMAT(a.fechaNacimiento, '%d-%m-%Y') AS fechaNac, p.nombre AS paisOrigen FROM autor a JOIN paisOrigen p ON (a.paisOrigenId = p.id) ORDER BY a.nombre ASC");
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<tr id='id".$fila['id']."'>";
            echo "<td class='text-center'>";
            echo "<input type='checkbox' name='ids[]' class='deleteCheckbox' value='".$fila['id']."'>";
            echo "</td>";
            echo "<td class='text-center'>".$fila['nombreAutor']."</td>";
            echo "<td class='text-center'>".$fila['apellidos']."</td>";
            echo "<td class='text-center'>".$fila['fechaNac']."</td>";
            echo "<td class='text-center'>".$fila['paisOrigen']."</td>";
            echo "<td class='text-center'>";
            echo "<button type='button' class='btn btn-danger elimAutor' id='".$fila['id']."'><img src='".RUTA_PUBLIC."/public/img/papelera-de-reciclaje.png' width='15px' height='20px'></button>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>