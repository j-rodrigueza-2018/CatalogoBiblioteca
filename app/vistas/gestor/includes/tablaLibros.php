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
    $resultado = $conexion->query("SELECT l.id, l.titulo, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.imagenPortada, l.enCatalogo, l.destacado FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) ORDER BY l.titulo ASC");
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "<tr id='idLibro".$fila['id']."'>";
        echo "<td class='text-center'>";
        echo "<input type='checkbox' name='ids[]' class='deleteCheckbox' value='".$fila['id']."-".$fila['imagenPortada']."'>";
        echo "</td>";
        echo "<td class='text-center col-5'>".$fila['titulo']."</td>";
        echo "<td class='text-center d-none d-sm-none d-md-none d-lg-none d-xl-table-cell'>".$fila['autor']."</td>";
        echo "<td class='text-center d-none d-sm-none d-md-none d-lg-none d-xl-table-cell'>".$fila['categoria']."</td>";
        echo "<td class='text-center'>";
        echo "<button type='button' class='btn btn-danger bi-trash elimLibro' id='".$fila['id']."-".$fila['imagenPortada']."'></button>";
        $location = RUTA_PUBLIC.'/gestor/vistaEditarLibro/'.$fila['id'];
        echo "<button type='button' class='btn btn-primary bi-pencil-square ms-2' onclick='location.href=\"$location\"'></button>";
        if ($fila['enCatalogo'] == 0) {
            echo "<button type='button' class='btn btn-warning bi-eye-fill text-white ms-2 publicarLibro' name='publicarLibro".$fila['id']."' id='".$fila['id']."'></button>";
            echo "<button type='button' class='btn btn-secondary bi-eye-slash-fill ms-2 ocultarLibro' name='ocultarLibro".$fila['id']."' id='".$fila['id']."' hidden></button>";
        } else {
            echo "<button type='button' class='btn btn-warning bi-eye-fill text-white ms-2 publicarLibro' name='publicarLibro".$fila['id']."' id='".$fila['id']."' hidden></button>";
            echo "<button type='button' class='btn btn-secondary bi-eye-slash-fill ms-2 ocultarLibro' name='ocultarLibro".$fila['id']."' id='".$fila['id']."'></button>";
        }
        if ($fila['destacado'] == 0) {
            echo "<button type='button' class='btn btn-success bi-star-fill ms-2 destacarLibro' name='destacarLibro".$fila['id']."' id='".$fila['id']."'></button>";
            echo "<button type='button' class='btn btn-danger bi-star ms-2 quitarLibro' name='quitarLibro".$fila['id']."' id='".$fila['id']."' hidden></button>";
        } else {
            echo "<button type='button' class='btn btn-success bi-star-fill ms-2 destacarLibro' name='destacarLibro".$fila['id']."' id='".$fila['id']."' hidden></button>";
            echo "<button type='button' class='btn btn-danger bi-star ms-2 quitarLibro' name='quitarLibro".$fila['id']."' id='".$fila['id']."'></button>";
        }
        echo "</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>