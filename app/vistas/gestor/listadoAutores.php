<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor Biblioteca - Listado de Autores</title>
</head>
<body>
    <?php include("includes/header.php"); ?>
    <div class="container">
        <p class="h1 mt-3 mb-3">LISTADO DE AUTORES</p>
        <div class="row">
            <div class="col-3">
                <button type="button" class="btn btn-success bi-plus-square mb-3" onclick="location.href='<?php echo RUTA_PUBLIC; ?>/autores/nuevoAutor'"></button>
                <button type="button" class="btn btn-danger bi-trash mb-3" id="btnBorrarAutores"></button>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-3 mb-sm-3 ms-auto">
                <input type="search" class="form-control" id="cajaBusqueda" placeholder="Buscar por Apellido" aria-label="Buscar">
            </div>
        </div>
        <div class="row">
            <div class="col-12" id="tablaDatosAutores">
                <?php include("includes/tablaAutores.php"); ?>
            </div>
        </div>
    </div>

    <script>
        let autores = document.getElementById('autores');
        autores.className += " active";
    </script>
    <script src="<?php echo RUTA_PUBLIC; ?>/public/js/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="<?php echo RUTA_PUBLIC; ?>/public/js/eliminarAutores.js"></script>
    <script type="text/javascript" src="<?php echo RUTA_PUBLIC; ?>/public/js/buscarAutores.js"></script>
</body>
</html>