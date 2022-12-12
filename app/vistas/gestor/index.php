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
                <button type="button" class="btn btn-warning text-white" id="btnPublicar">Publicar</button>
                <button type="button" class="btn btn-secondary" id="btnOcultar">Ocultar</button>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 mb-3">
                <form class="d-flex ms-auto col-lg-8 col-md-12 col-sm-12" role="search">
                    <input class="form-control me-2" type="search" placeholder="Título" aria-label="Buscar">
                    <select id="select1" class="form-select me-2" aria-label="Default select example">
                        <option selected disabled>Autor</option>
                        <option value="1">Autor 1</option>
                        <option value="2">Autor 2</option>
                        <option value="3">Autor 3</option>
                    </select>
                    <select id="select2" class="form-select me-2" aria-label="Default select example">
                        <option selected disabled>Categorías</option>
                        <option value="1">Categoría 1</option>
                        <option value="2">Categoría 2</option>
                        <option value="3">Categoría 3</option>
                    </select>
                    <button class="btn btn-danger" type="submit">Buscar</button>
                </form>
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
</body>
</html>