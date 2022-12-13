<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca - Catálogo</title>
    <link rel="stylesheet" href="<?php echo RUTA_PUBLIC; ?>/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo RUTA_PUBLIC; ?>/public/css/styles.css">
</head>
<body class="catalogo">
    <?php include("includes/header.php"); ?>
    <div class="container">
        <p class="h1 mt-3 mb-3">CATÁLOGO</p>
        <div class="row">
            <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3 d-xxl-flex">
                <input class="form-control me-xxl-2 mb-xl-3 mb-lg-3 mb-md-3 mb-sm-3 mb-3" placeholder="Título" id="buscaTituloCatalogo" name="buscaTituloCatalogo">
                <select id="selectAutorCatalogo" name="selectAutorCatalogo" class="form-select me-xxl-2 mb-xl-3 mb-lg-3 mb-md-3 mb-sm-3 mb-3">
                    <option selected disabled>Autor</option>
                    <?php
                        $conexion = new Conexion();
                        $resultado = $conexion->query("SELECT id, CONCAT(nombre, ' ', apellidos) AS nombreAutor FROM autor ORDER BY nombre ASC");
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo "<option value='".$fila['nombreAutor']."'>".$fila['nombreAutor']."</option>";
                        }
                    ?>
                </select>
                <select id="selectCategoriaCatalogo" name="selectCategoriaCatalogo" class="form-select me-xxl-2 mb-xl-3 mb-lg-3 mb-md-3 mb-sm-3 mb-3" aria-label="Default select example">
                    <option selected disabled>Categorías</option>
                    <?php
                        $conexion = new Conexion();
                        $resultado = $conexion->query("SELECT id, nombre FROM categoria ORDER BY nombre ASC");
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
                        }
                    ?>
                </select>
                <button class="btn btn-danger mb-xl-3 mb-lg-3 mb-md-3 mb-sm-3 mb-3" id="buscarLibroCatalogo" name="buscarLibroCatalogo">Buscar</button>
            </div>
        </div>
        <div class="row justify-content-center" id="librosCatalogo" name="librosCatalogo">
            <?php include("includes/librosCatalogo.php"); ?>
        </div>
    </div>
    <?php include("includes/footer.php"); ?>

    <script>
        let catalogo = document.getElementById('catalogo');
        catalogo.className += " active";
    </script>
    <script src="<?php echo RUTA_PUBLIC; ?>/public/js/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="<?php echo RUTA_PUBLIC; ?>/public/js/buscarLibros.js"></script>
    <script type="text/javascript" src="<?php echo RUTA_PUBLIC; ?>/public/js/libroPorCategoria.js"></script>
</body>
</html>