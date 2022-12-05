<?php

class Usuarios extends Controlador {

    // Método Constructor de la Clase
    public function __construct() {

    }

    // Método para establecer la vista principal de la Clase
    public function index() {
        $this->vista('usuarios/index');
    }

}
