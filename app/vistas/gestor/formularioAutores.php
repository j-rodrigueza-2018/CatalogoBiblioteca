<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor Biblioteca - Nuevo Autor</title>
    <link rel="stylesheet" href="../../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../public/css/styles.css">
</head>
<body>
    <?php include("includes/header.php"); ?>
    <div class="container">
        <p class="h1 mt-3 mb-3">NUEVO AUTOR</p>
        <form class="row">
            <div class="col-12 mb-3">
                <label for="nombre" class="form-label subrayado">Nombre:</label>
                <input type="text" class="form-control" id="nombre">
            </div>
            <div class="col-12 mb-3">
                <label for="apellidos" class="form-label subrayado">Apellidos:</label>
                <input type="text" class="form-control" id="apellidos">
            </div>
            <div class="col-12 mb-3">
                <label for="fechaNacimiento" class="form-label subrayado">Fecha de Nacimiento:</label>
                <input type="text" class="form-control" id="fechaNacimiento">
            </div>
            <div class="col-12 mb-3">
                <label for="paisOrigen" class="form-label subrayado">País de Origen:</label>
                <input type="text" class="form-control" id="paisOrigen">
            </div>
            <div class="mb-3 text-center">
                <button type="button" class="btn btn-danger me-4" onclick="location.href='index.php'">Cancelar</button>
                <button type="submit" class="btn btn-success">Confirmar</button>
            </div>
        </form>
    </div>
</body>
</html>