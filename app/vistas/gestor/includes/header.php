<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo RUTA_PUBLIC; ?>/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo RUTA_PUBLIC; ?>/public/css/styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <img class="navbar-brand" src="<?php echo RUTA_PUBLIC; ?>/public/img/biblioteca.png" width="150px">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a id="libros" class="nav-link" aria-current="page" href="<?php echo RUTA_PUBLIC; ?>/gestor">LIBROS</a>
                </li>
                <li class="nav-item">
                    <a id="autores" class="nav-link" href="<?php echo RUTA_PUBLIC; ?>/gestor/listadoAutores">AUTORES</a>
                </li>
            </ul>
        </div>
    </nav>

    <script src="<?php echo RUTA_PUBLIC; ?>/public/js/bootstrap.bundle.min.js"></script>
</body>
</html>