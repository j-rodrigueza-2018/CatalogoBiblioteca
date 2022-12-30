<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca - Libros Destacados</title>
</head>
<body class="librosDestacados">
    <?php include("includes/header.php"); ?>
    <div class="container">
        <p class="h1 mt-3 mb-3">LIBROS DESTACADOS</p>
        <div class="row justify-content-center">
            <?php include("includes/cuadriculaLibros.php"); ?>
        </div>
    </div>
    <?php include("includes/footer.php"); ?>

    <script>
        let portada = document.getElementById('portada');
        portada.className += " active";

        const libros = document.querySelectorAll('div.card.border-0.col-2');
        for (const libro of libros) {
            libro.classList.remove('catalogo');
            libro.classList.add('librosDestacados');
        }
    </script>
</body>
</html>