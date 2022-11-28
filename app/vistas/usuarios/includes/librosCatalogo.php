<?php

for ($i = 1; $i <= 10; $i++) {
    echo "
        <div class='card border-0 col-2 catalogo' style='width: 15rem;'>
            <a href='detalleLibro.php' class='text-center text-black text-decoration-none'>
                <img src='../../../public/imagenesPortada/libro1.jpg' class='card-img-top' alt='...'>
                <div class='card-body'>
                    <h5 class='card-title'>Título del Libro $i</h5>
                </div>
            </a>
        </div>
    ";
}