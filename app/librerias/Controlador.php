<?php

class Controlador {

    // Función para cargar los modelos
    public function modelo($modelo) {
        require_once '../app/modelos/'.$modelo.'.php';
        return new $modelo();
    }

    // Función para cargar las vistas
    public function vista($url, $data = []) {
        if (file_exists('../app/vistas/'.$url.'.php')) {
            require_once '../app/vistas/'.$url.'.php';
        } else {
            die('Esta vista NO existe');
        }
    }

}