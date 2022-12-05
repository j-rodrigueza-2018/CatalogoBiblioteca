<?php

class Usuarios extends Controlador {

    // Método Constructor de la Clase
    public function __construct() {

    }

    // Método para establecer la vista principal de la Clase
    public function index() {
        $this->vista('usuarios/index');
    }

    // Método para establecer la vista de Catálogo
    public function catalogo() {
        $this->vista('usuarios/catalogo');
    }

    // Método para establecer la vista de Contacto
    public function contacto() {
        $this->vista('usuarios/contacto');
    }

    // Método para establecer la vista de Condiciones de Uso
    public function condicionesUso() {
        $this->vista('usuarios/condicionesUso');
    }

    // Método para establecer la vista de Detalle de Libro
    public function detallelibro() {
        $this->vista('usuarios/detallelibro');
    }

}
