<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo NOMBRE_APP; ?></title>
    <link rel="stylesheet" href="<?php echo RUTA_PUBLIC; ?>/public/css/bootstrap.min.css">
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
                    <a id="portada" class="nav-link" aria-current="page" href="<?php echo RUTA_PUBLIC; ?>/usuarios">PORTADA</a>
                </li>
                <li class="nav-item">
                    <a id="catalogo" class="nav-link" href="<?php echo RUTA_PUBLIC; ?>/usuarios/catalogo">CATÁLOGO</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="categorias" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">CATEGORÍAS</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Categoría 1</a></li>
                        <li><a class="dropdown-item" href="#">Categoría 2</a></li>
                        <li><a class="dropdown-item" href="#">Categoría 3</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
