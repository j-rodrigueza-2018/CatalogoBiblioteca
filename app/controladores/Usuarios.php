<?php

class Usuarios extends Controlador {

    // Atributos de la Clase
    private $modeloUsuarios;

    // Método Constructor de la Clase
    public function __construct() {
        $this->modeloUsuarios = $this->modelo('ModeloUsuarios');
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
