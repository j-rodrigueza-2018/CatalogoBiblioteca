<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor Biblioteca - Listado de Autores</title>
    <link rel="stylesheet" href="../../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../public/css/styles.css">
</head>
<body>
    <?php include("includes/header.php"); ?>
    <div class="container">
        <p class="h1 mt-3 mb-3">LISTADO DE AUTORES</p>
        <div class="row">
            <div class="col-3">
                <button type="button" class="btn btn-success mb-3" onclick="location.href='formularioAutores.php'">+</button>
                <button type="button" class="btn btn-danger mb-3"><img src="../../../public/img/papelera-de-reciclaje.png" width="15px" height="20px"></button>
            </div>
            <div class="col-9">
                <form class="d-flex ms-auto col-lg-6 col-md-6 col-sm-6" role="search">
                    <input class="form-control me-2" type="search" placeholder="Buscar por Apellido" aria-label="Buscar">
                    <button class="btn btn-danger" type="submit">Buscar</button>
                </form>
            </div>
        </div>
        <table class="table table-bordered col-12">
            <thead>
            <tr>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Apellidos</th>
                <th scope="col" class="text-center">Fecha de Nacimiento</th>
                <th scope="col" class="text-center">País de Origen</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</body>
</html>