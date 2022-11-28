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
        <button type="button" class="btn btn-success mb-3" onclick="location.href='formularioLibros.php'">+</button>
        <button type="button" class="btn btn-danger mb-3"><img src="../../../public/img/papelera-de-reciclaje.png" width="20px" height="20px"></button>
        <table class="table table-bordered col-12">
            <thead>
            <tr>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Apellidos</th>
                <th scope="col" class="text-center">Fecha de Nacimiento</th>
                <th scope="col" class="text-center">País de Origen</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</body>
</html>