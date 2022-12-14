<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca - Detalles del Libro</title>
    <link rel="stylesheet" href="<?php echo RUTA_PUBLIC; ?>/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo RUTA_PUBLIC; ?>/public/css/styles.css">
</head>
<body class="detalleLibro">
    <?php include("includes/header.php"); ?>
    <div class="container">
        <p class="h1 mt-3 mb-3">DETALLES DEL LIBRO</p>
        <form action="<?php echo RUTA_PUBLIC ?>/usuarios/detalleLibro/<?php echo $data['id']; ?>" method="get">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-12 mb-3">
                    <img src="<?php echo RUTA_PUBLIC; ?>/public/imagenesPortada/<?php echo $data['imagenPortada']; ?>" class="col-12 pe-2" width="200px">
                </div>
                <div class="col-lg-10 col-md-8 col-sm-12">
                    <p class="h5 col-12" id="titulo" name="titulo"><span class="subrayado">Título:</span> <?php echo $data['titulo']; ?></p>
                    <p class="h5 col-12" id="autor" name="autor"><a class="text-black text-decoration-none" data-bs-toggle="modal" data-bs-target="#infoAutor"><span class="subrayado">Autor:</span> <?php echo $data['autor']; ?></a></p>
                    <p class="h5 col-12" id="categoria" name="categoria"><span class="subrayado">Categoría:</span> <?php echo $data['categoria']; ?></p>
                    <p class="h5 col-12" id="sinopsis" name="sinopsis"><span class="subrayado">Sinopsis:</span> <?php echo $data['sinopsis']; ?></p>
                </div>
            </div>

            <div class="modal fade" id="infoAutor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Información del Autor</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php
                                $conexion = new Conexion();
                                $resultado = $conexion->query("SELECT a.nombre AS nombreAutor, a.apellidos, DATE_FORMAT(a.fechaNacimiento, '%d-%m-%Y') AS fechaNac, p.nombre AS paises FROM autor a JOIN paises p ON (a.paisId = p.id) WHERE a.id='".$data['autorId']."'");
                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                    echo "<p class='h6'><span class='subrayado'>Nombre:</span> ".$fila['nombreAutor']."</p>";
                                    echo "<p class='h6'><span class='subrayado'>Apellidos:</span> ".$fila['apellidos']."</p>";
                                    echo "<p class='h6'><span class='subrayado'>Fecha de Nacimiento:</span> ".$fila['fechaNac']."</p>";
                                    echo "<p class='h6'><span class='subrayado'>País de Origen:</span> ".$fila['paises']."</p>";
                                }
                            ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>
    <?php include("includes/footer.php"); ?>
</body>
</html>