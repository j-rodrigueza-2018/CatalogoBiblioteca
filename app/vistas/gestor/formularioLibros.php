<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Libros</title>
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <?php include("includes/header.php"); ?>
    <div class="container">
        <p class="h1">Formulario Libros</p>
        <form class="row">
            <div class="col-12 mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" class="form-control" id="titulo">
            </div>
            <div class="col-12 mb-3">
                <label for="autor" class="form-label">Autor:</label>
                <input type="text" class="form-control" id="autor">
            </div>
            <div class="col-12 mb-3">
                <label for="categoria" class="form-label">Categoría:</label>
                <input type="text" class="form-control" id="categoria">
            </div>
            <div class="col-12 mb-3">
                <label for="sinopsis" class="form-label">Sinopsis:</label>
                <textarea id="sinopsis" class="form-control" rows="4"></textarea>
            </div>
            <div class="col-12 mb-3">
                <label for="imagenPortada" class="form-label">Imagen de Portada:</label>
                <input accept="image/png, image/jpeg, image/jpg" type="file" class="form-control" id="imagenPortada">
            </div>
            <div class="mb-3 text-center">
                <button type="button" class="btn btn-danger me-4">Cancelar</button>
                <button type="submit" class="btn btn-success">Confirmar</button>
            </div>
        </form>
    </div>
</body>
</html>