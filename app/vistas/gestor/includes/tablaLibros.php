<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col"></th>
        <th scope="col" class="text-center">Título</th>
        <th scope="col" class="text-center">Autor</th>
        <th scope="col" class="text-center">Categoría</th>
        <th scope="col" class="text-center">Acciones</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $conexion = new Conexion();
    $resultado = $conexion->query("SELECT l.id, l.titulo, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.imagenPortada FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) ORDER BY l.titulo ASC");
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "<tr id='idLibro".$fila['id']."'>";
        echo "<td class='text-center'>";
        echo "<input type='checkbox' name='ids[]' class='deleteCheckbox' value='".$fila['id']."'>";
        echo "</td>";
        echo "<td class='text-center'>".$fila['titulo']."</td>";
        echo "<td class='text-center'>".$fila['autor']."</td>";
        echo "<td class='text-center'>".$fila['categoria']."</td>";
        echo "<td class='text-center'>";
        echo "<button type='button' class='btn btn-danger bi-trash elimLibro' id='".$fila['id']."-".$fila['imagenPortada']."'></button>";
        $location = RUTA_PUBLIC.'/gestor/vistaEditarLibro/'.$fila['id'];
        echo "<button type='button' class='btn btn-primary bi-pencil-square ms-2' onclick='location.href=\"$location\"'></button>";
        echo "</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>