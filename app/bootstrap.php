<?php

require_once '../app/config/config.php';

// Autoload para cargar todos los ficheros que provengan de la carpeta 'librerias'
spl_autoload_register(function ($clase) {
    require_once '../app/librerias/'.$clase.'.php';
});