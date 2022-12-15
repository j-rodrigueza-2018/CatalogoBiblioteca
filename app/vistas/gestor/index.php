<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestor Biblioteca - Listado de Libros</title>
    </head>
<body>
    <?php include("includes/header.php"); ?>
    <div class="container">
        <p class="h1 mt-3 mb-3">LISTADO DE LIBROS</p>
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
                <button type="button" class="btn btn-success bi-plus-square" onclick="location.href='<?php echo RUTA_PUBLIC; ?>/gestor/vistaNuevoLibro'"></button>
                <button type="button" class="btn btn-danger bi-trash" id="btnBorrarLibros"></button>
                <button type="button" class="btn btn-warning bi-eye-fill text-white" id="btnPublicar"></button>
                <button type="button" class="btn btn-secondary bi-eye-slash-fill" id="btnOcultar"></button>
            </div>
            <div class="col-xxl-8 col-xl-8 col-lg-12 col-md-12 col-sm-12 d-xxl-flex d-xl-flex">
                <input class="form-control me-xxl-2 me-xl-2 mb-xl-3 mb-lg-3 mb-md-3 mb-sm-3 mb-3" placeholder="Título" id="buscaTituloGestor" name="buscaTituloGestor">
                <select id="selectAutorGestor" name="selectAutorGestor" class="form-select me-xxl-2 me-xl-2 mb-xl-3 mb-lg-3 mb-md-3 mb-sm-3 mb-3">
                    <option selected disabled>Autor</option>
                    <?php
                    $conexion = new Conexion();
                    $resultado = $conexion->query("SELECT id, CONCAT(nombre, ' ', apellidos) AS nombreAutor FROM autor ORDER BY nombre ASC");
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "<option value='".$fila['nombreAutor']."'>".$fila['nombreAutor']."</option>";
                    }
                    ?>
                </select>
                <select id="selectCategoriaGestor" name="selectCategoriaGestor" class="form-select me-xxl-2 me-xl-2 mb-xl-3 mb-lg-3 mb-md-3 mb-sm-3 mb-3" aria-label="Default select example">
                    <option selected disabled>Categorías</option>
                    <?php
                    $conexion = new Conexion();
                    $resultado = $conexion->query("SELECT id, nombre FROM categoria ORDER BY nombre ASC");
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
                    }
                    ?>
                </select>
                <button class="btn btn-danger mb-xl-3 mb-lg-3 mb-md-3 mb-sm-3 mb-3" id="buscarLibroGestor" name="buscarLibroGestor">Buscar</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12" id="tablaDatosLibros">
                <?php include("includes/tablaLibros.php"); ?>
            </div>
        </div>
    </div>

    <script>
        let libros = document.getElementById('libros');
        libros.className += " active";
    </script>
    <script src="<?php echo RUTA_PUBLIC; ?>/public/js/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="<?php echo RUTA_PUBLIC; ?>/public/js/eliminarLibros.js"></script>
    <script type="text/javascript" src="<?php echo RUTA_PUBLIC; ?>/public/js/publicarEnCatalogo.js"></script>
    <script type="text/javascript" src="<?php echo RUTA_PUBLIC; ?>/public/js/ocultarDelCatalogo.js"></script>
    <script type="text/javascript" src="<?php echo RUTA_PUBLIC; ?>/public/js/destacarLibro.js"></script>
    <script type="text/javascript" src="<?php echo RUTA_PUBLIC; ?>/public/js/quitarLibroDeDestacados.js"></script>
    <script type="text/javascript" src="<?php echo RUTA_PUBLIC; ?>/public/js/buscarLibros.js"></script>
</body>
</html>