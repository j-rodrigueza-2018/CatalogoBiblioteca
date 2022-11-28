<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca - Detalles del Libro</title>
    <link rel="stylesheet" href="../../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../public/css/styles.css">
</head>
<body class="detalleLibro">
    <?php include("includes/header.php"); ?>
    <div class="container">
        <p class="h1 mt-3 mb-3">DETALLES DEL LIBRO</p>
        <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-12 mb-3">
                <img src="../../../public/imagenesPortada/libro1.jpg" class="col-12 pe-2" width="200px">
            </div>
            <div class="col-lg-10 col-md-8 col-sm-12">
                <p class="h5 col-12"><span class="subrayado">Título:</span> Título del Libro</p>
                <p class="h5 col-12"><span class="subrayado">Autor:</span> Autor del Libro</p>
                <p class="h5 col-12"><span class="subrayado">Categoría:</span> Categoría del Libro</p>
                <p class="h5 col-12"><span class="subrayado">Sinopsis:</span> Sinopsis del Libro</p>
            </div>
        </div>
    </div>
    <?php include("includes/footer.php"); ?>
</body>
</html>