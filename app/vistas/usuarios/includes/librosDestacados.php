<?php

$conexion = new Conexion();
$rutaPublic = RUTA_PUBLIC;

$consulta = $conexion->query("SELECT id AS idLibro, titulo, imagenPortada FROM libro WHERE enCatalogo=1 AND destacado=1 ORDER BY titulo");
while ($fila = mysqli_fetch_assoc($consulta)) {
    $idLibro = $fila['idLibro'];
    $imagen = $fila['imagenPortada'];
    $titulo = $fila['titulo'];
    echo "
        <div class='card border-0 col-2 catalogo' style='width: 15rem;'>
            <a href='$rutaPublic/usuarios/vistaDetalleLibro/$idLibro' class='text-center text-black text-decoration-none'>
                <img src='$rutaPublic/public/imagenesPortada/$imagen' class='card-img-top'>
                <div class='card-body'>
                    <h5 class='card-title'>$titulo</h5>
                </div>
            </a>
        </div>
    ";
}