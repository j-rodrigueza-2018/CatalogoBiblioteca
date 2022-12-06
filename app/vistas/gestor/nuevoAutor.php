<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor Biblioteca - Nuevo Autor</title>
</head>
<body>
    <?php include("includes/header.php"); ?>
    <div class="container">
        <p class="h1 mt-3 mb-3">NUEVO AUTOR</p>
        <form class="row" action="<?php echo RUTA_PUBLIC ?>/gestor/crearAutor" method="post" autocomplete="off">
            <div class="col-12 mb-3">
                <label for="nombre" class="form-label subrayado">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del Autor" autofocus>
            </div>
            <div class="col-12 mb-3">
                <label for="apellidos" class="form-label subrayado">Apellidos:</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos del Autor">
            </div>
            <div class="col-12 mb-3">
                <label for="fechaNacimiento" class="form-label subrayado">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento">
            </div>
            <div class="col-12 mb-3">
                <label for="paisOrigen" class="form-label subrayado">País de Origen:</label>
                <!--<input type="text" class="form-control" id="paisOrigen">-->
                <select class="form-select" id="paisOrigen" name="paisOrigen" data-show-subtext="true" data-live-search="true">
                    <?php
                    $conexion = new Conexion();
                    $resultado = $conexion->query("SELECT * FROM paisOrigen ORDER BY nombre ASC");
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "<option value=".$fila['id'].">".$fila['nombre']."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3 text-center">
                <button type="button" class="btn btn-danger me-4" onclick="location.href='<?php echo RUTA_PUBLIC; ?>/gestor/listadoAutores'">Cancelar</button>
                <button type="submit" class="btn btn-success">Confirmar</button>
            </div>
        </form>
    </div>

    <script>
        let autores = document.getElementById('autores');
        autores.className += " active";
    </script>
</body>
</html>