<?php

class Gestor extends Controlador {

    // Método Constructor de la Clase
    public function __construct() {

    }

    // Método para establecer la vista principal de la Clase
    public function index() {
        $this->vista('gestor/index');
    }

    // Método para establecer la vista del formulario de Libros
    public function formularioLibros() {
        $this->vista('gestor/formularioLibros');
    }

    // Método para establecer la vista de Autores
    public function listadoAutores() {
        $this->vista('gestor/listadoAutores');
    }

    // Método para establecer la vista del formulario de Autores
    public function formularioAutores() {
        $this->vista('gestor/formularioAutores');
    }

}