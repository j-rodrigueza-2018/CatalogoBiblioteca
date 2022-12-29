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
        <?php foreach ($data['autor'] as $autor):?>
        <tr id='idAutor<?php echo $autor->id;?>'>
            <td class='text-center'>
                <input type='checkbox' name='ids[]' class='deleteCheckbox' value='<?php echo $autor->id;?>'>
            </td>
            <td class='text-center'><?php echo $autor->nombreAutor;?></td>
            <td class='text-center'><?php echo $autor->apellidos;?></td>
            <td class='text-center d-none d-sm-none d-md-table-cell d-lg-table-cell d-xl-table-cell'><?php echo $autor->fechaNac;?></td>
            <td class='text-center d-none d-sm-none d-md-table-cell d-lg-table-cell d-xl-table-cell'><?php echo $autor->pais;?></td>
            <td class='text-center'>
                <button type='button' class='btn btn-danger bi-trash elimAutor' id='<?php echo $autor->id;?>'></button>
                <?php
                $location = URL_PROYECTO.'/autorController/vistaEditarAutor/'.$autor->id;
                echo "<button type='button' class='btn btn-primary bi-pencil-square ms-2' onclick='location.href=\"$location\"'></button>";
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>