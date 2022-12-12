<?php

$conexion = new Conexion();
$rutaPublic = RUTA_PUBLIC;

$consulta = $conexion->query("SELECT c.*, l.titulo, l.imagenPortada FROM catalogo c JOIN libro l ON (c.libroId = l.id) WHERE c.destacado = 1 ORDER BY l.titulo");
while ($fila = mysqli_fetch_assoc($consulta)) {
    $imagen = $fila['imagenPortada'];
    $titulo = $fila['titulo'];
    echo "
        <div class='card border-0 col-2 catalogo' style='width: 15rem;'>
            <a href='$rutaPublic/usuarios/detalleLibro' class='text-center text-black text-decoration-none'>
                <img src='$rutaPublic/public/imagenesPortada/$imagen' class='card-img-top'>
                <div class='card-body'>
                    <h5 class='card-title'>$titulo</h5>
                </div>
            </a>
        </div>
    ";
}