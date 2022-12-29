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
        <?php foreach ($data['libro'] as $libro): ?>
        <tr id='idLibro<?php echo $libro->id; ?>'>
            <td class='text-center'>
                <input type='checkbox' name='ids[]' class='deleteCheckbox' value='<?php echo $libro->id;?>'>
            </td>
            <td class='text-center col-5'><?php echo $libro->titulo;?></td>
            <td class='text-center d-none d-sm-none d-md-none d-lg-none d-xl-table-cell'><?php echo $libro->autor;?></td>
            <td class='text-center d-none d-sm-none d-md-none d-lg-none d-xl-table-cell'><?php echo $libro->categoria;?></td>
            <td class='text-center'>
                <button type='button' class='btn btn-danger bi-trash elimLibro' id='<?php echo $libro->id;?>'></button>
                <?php
                $location = URL_PROYECTO.'/libroController/vistaEditarLibro/'.$libro->id;
                echo "<button type='button' class='btn btn-primary bi-pencil-square ms-2' onclick='location.href=\"$location\"'></button>";
                if ($libro->estaPublicado == 0) {
                    echo "<button type='button' class='btn btn-warning bi-eye-fill text-white ms-2 publicarLibro' name='publicarLibro".$libro->id."' id='".$libro->id."'></button>";
                    echo "<button type='button' class='btn btn-secondary bi-eye-slash-fill ms-2 ocultarLibro' name='ocultarLibro".$libro->id."' id='".$libro->id."' hidden></button>";
                } else {
                    echo "<button type='button' class='btn btn-warning bi-eye-fill text-white ms-2 publicarLibro' name='publicarLibro".$libro->id."' id='".$libro->id."' hidden></button>";
                    echo "<button type='button' class='btn btn-secondary bi-eye-slash-fill ms-2 ocultarLibro' name='ocultarLibro".$libro->id."' id='".$libro->id."'></button>";
                }
                if ($libro->esDestacado == 0) {
                    echo "<button type='button' class='btn btn-success bi-star-fill ms-2 destacarLibro' name='destacarLibro".$libro->id."' id='".$libro->id."'></button>";
                    echo "<button type='button' class='btn btn-secondary bi-star ms-2 quitarLibro' name='quitarLibro".$libro->id."' id='".$libro->id."' hidden></button>";
                } else {
                    echo "<button type='button' class='btn btn-success bi-star-fill ms-2 destacarLibro' name='destacarLibro".$libro->id."' id='".$libro->id."' hidden></button>";
                    echo "<button type='button' class='btn btn-secondary bi-star ms-2 quitarLibro' name='quitarLibro".$libro->id."' id='".$libro->id."'></button>";
                }
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>