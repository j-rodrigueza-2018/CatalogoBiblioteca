<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor Biblioteca - Nuevo Libro</title>
</head>
<body>
    <?php include("includes/header.php"); ?>
    <div class="container">
        <p class="h1 mt-3 mb-3">NUEVO LIBRO</p>
        <form class="row" action="<?php echo URL_PROYECTO ?>/libroController/crearLibro" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="col-12 mb-3">
                <label for="titulo" class="form-label subrayado">Título:</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título del Libro" autofocus required>
            </div>
            <div class="col-12 mb-3">
                <label for="autor" class="form-label subrayado">Autor:</label>
                <select class="form-select" id="autor" name="autor" data-show-subtext="true" data-live-search="true" required>
                    <option selected disabled>Autor</option>
                    <?php
                    $conexion = new Conexion(new mysqli(HOST, USER, PASS, NAME));
                    $resultado = $conexion->query("SELECT * FROM autor ORDER BY nombre ASC");
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "<option value=" . $fila['id'] . ">" . $fila['nombre'] . ' ' . $fila['apellidos'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-12 mb-3">
                <label for="categoria" class="form-label subrayado">Categoría:</label>
                <select class="form-select" id="categoria" name="categoria" data-show-subtext="true" data-live-search="true" required>
                    <option selected disabled>Categoría</option>
                    <?php
                    $conexion = new Conexion(new mysqli(HOST, USER, PASS, NAME));
                    $resultado = $conexion->query("SELECT * FROM categoria ORDER BY nombre ASC");
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "<option value=" . $fila['id'] . ">" . $fila['nombre'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-12 mb-3">
                <label for="sinopsis" class="form-label subrayado">Sinopsis:</label>
                <textarea class="form-control" rows="4" id="sinopsis" name="sinopsis" placeholder="Sinopsis del Libro" required></textarea>
            </div>
            <div class="col-12 mb-3">
                <label for="imagenPortada" class="form-label subrayado">Imagen de Portada:</label>
                <input accept="image/png, image/jpeg, image/jpg" type="file" class="form-control" id="imagen" name="imagen">
            </div>
            <div class="mb-3 text-center">
                <button type="button" class="btn btn-danger me-4"
                        onclick="location.href='<?php echo URL_PROYECTO; ?>/libroController'">Cancelar
                </button>
                <button type="submit" class="btn btn-success">Confirmar</button>
            </div>
        </form>
    </div>

    <script>
        let libros = document.getElementById('libros');
        libros.className += " active";
    </script>
</body>
</html>