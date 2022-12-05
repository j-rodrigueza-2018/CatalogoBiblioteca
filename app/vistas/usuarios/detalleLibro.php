<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca - Detalles del Libro</title>
    <link rel="stylesheet" href="<?php echo RUTA_PUBLIC; ?>/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo RUTA_PUBLIC; ?>/public/css/styles.css">
</head>
<body class="detalleLibro">
    <?php include("includes/header.php"); ?>
    <div class="container">
        <p class="h1 mt-3 mb-3">DETALLES DEL LIBRO</p>
        <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-12 mb-3">
                <img src="<?php echo RUTA_PUBLIC; ?>/public/imagenesPortada/libro1.jpg" class="col-12 pe-2" width="200px">
            </div>
            <div class="col-lg-10 col-md-8 col-sm-12">
                <p class="h5 col-12"><span class="subrayado">Título:</span> Título del Libro</p>
                <p class="h5 col-12"><a class="text-black text-decoration-none" data-bs-toggle="modal" data-bs-target="#infoAutor"><span class="subrayado">Autor:</span> Autor del Libro</a></p>
                <p class="h5 col-12"><span class="subrayado">Categoría:</span> Categoría del Libro</p>
                <p class="h5 col-12"><span class="subrayado">Sinopsis:</span> Sinopsis del Libro</p>
            </div>
        </div>

        <div class="modal fade" id="infoAutor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Información del Autor</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="h6"><span class="subrayado">Nombre:</span> Nombre del autor.</p>
                        <p class="h6"><span class="subrayado">Apellidos:</span> Apellidos del autor.</p>
                        <p class="h6"><span class="subrayado">Fecha de Nacimiento:</span> Fecha de nacimiento del autor.</p>
                        <p class="h6"><span class="subrayado">País de Origen:</span> País de origen del autor.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php include("includes/footer.php"); ?>
</body>
</html>