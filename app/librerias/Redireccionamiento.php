<?php

function redirect($pagina) {
    header("location:".RUTA_PUBLIC."/".$pagina);
}