<?php

$rutaPublic = URL_PROYECTO;

foreach ($data['libro'] as $libro):
    $idLibro = $libro->idLibro;
    $imagen = $libro->imagenPortada;
    $titulo = $libro->titulo;
    echo "
        <div class='card border-0 col-2 catalogo' style='width: 15rem;'>
            <a href='$rutaPublic/bibliotecaController/detalleLibro/$idLibro' class='text-center text-black text-decoration-none'>
                <img src='$rutaPublic/public/imagenesPortada/$imagen' class='card-img-top'>
                <div class='card-body'>
                    <h5 class='card-title'>$titulo</h5>
                </div>
            </a>
        </div>
    ";
endforeach;