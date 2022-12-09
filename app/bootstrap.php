<?php

require_once '../app/config/config.php';
require_once '../app/librerias/Redireccionamiento.php';

// Autoload para cargar todos los ficheros que provengan de la carpeta 'librerias'
spl_autoload_register(function ($clase) {
    require_once '../app/librerias/'.$clase.'.php';
});