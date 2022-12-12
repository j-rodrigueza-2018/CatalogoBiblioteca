<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col"></th>
        <th scope="col" class="text-center">Título</th>
        <th scope="col" class="text-center d-none d-sm-none d-md-none d-lg-none d-xl-table-cell">Autor</th>
        <th scope="col" class="text-center d-none d-sm-none d-md-none d-lg-none d-xl-table-cell">Categoría</th>
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
        echo "<input type='checkbox' name='ids[]' class='deleteCheckbox' value='".$fila['id']."-".$fila['imagenPortada']."'>";
        echo "</td>";
        echo "<td class='text-center'>".$fila['titulo']."</td>";
        echo "<td class='text-center d-none d-sm-none d-md-none d-lg-none d-xl-table-cell'>".$fila['autor']."</td>";
        echo "<td class='text-center d-none d-sm-none d-md-none d-lg-none d-xl-table-cell'>".$fila['categoria']."</td>";
        echo "<td class='text-lg-center'>";
        echo "<button type='button' class='btn btn-danger bi-trash elimLibro' id='".$fila['id']."-".$fila['imagenPortada']."'></button>";
        $location = RUTA_PUBLIC.'/gestor/vistaEditarLibro/'.$fila['id'];
        echo "<button type='button' class='btn btn-primary bi-pencil-square ms-2' onclick='location.href=\"$location\"'></button>";
        echo "<button type='button' class='btn btn-warning text-white ms-2 publicarLibro' id='".$fila['id']."'>Publicar</button>";
        echo "<button type='button' class='btn btn-secondary ms-2 ocultarLibro' id='".$fila['id']."'>Ocultar</button>";
        echo "<button type='button' class='btn btn-success ms-2 destacarLibro' id='".$fila['id']."'>Destacar</button>";
        echo "<button type='button' class='btn btn-danger ms-2 quitarLibro' id='".$fila['id']."'>Quitar</button>";
        echo "</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>