<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca - Libros Destacados</title>
    <link rel="stylesheet" href="../../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../public/css/styles.css">
</head>
<body class="librosDestacados">
    <?php include("includes/header.php"); ?>
    <div class="container">
        <p class="h1 mt-3 mb-3">LIBROS DESTACADOS</p>
        <div class="row justify-content-center">
            <?php include("includes/librosDestacados.php"); ?>
        </div>
    </div>
    <?php include("includes/footer.php"); ?>
</body>
</html>