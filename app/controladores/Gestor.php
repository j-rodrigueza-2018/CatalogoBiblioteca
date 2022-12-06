<?php

class Gestor extends Controlador {

    // Atributos de la Clase
    private $modeloGestor;

    // Método Constructor de la Clase
    public function __construct() {
        $this->modeloGestor = $this->modelo('ModeloGestor');
    }

    // Método para establecer la vista principal de la Clase
    public function index() {
        $this->vista('gestor/index');
    }

    // Método para establecer la vista para añadir un libro
    public function nuevoLibro() {
        $this->vista('gestor/nuevoLibro');
    }

    // Método para establecer la vista para editar un libro
    public function editarLibro() {
        $this->vista('gestor/editarLibro');
    }

    // Método para establecer la vista de Autores
    public function listadoAutores() {
        $this->vista('gestor/listadoAutores');
    }

    // Método para establecer la vista para añadir un autor
    public function nuevoAutor() {
        $this->vista('gestor/nuevoAutor');
    }

    // Método para crear un autor en nuestra base de datos
    public function crearAutor() {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
            'nombre' => trim($_POST['nombre']),
            'apellidos' => trim($_POST['apellidos']),
            'fechaNacimiento' => trim($_POST['fechaNacimiento']),
            'paisOrigen' => trim($_POST['paisOrigen'])
        ];

        if ($this->modeloGestor->crearNuevoAutor($data)) {
            $this->vista('gestor/listadoAutores');
        } else {
            die('No se pudo dar de alta al autor');
        }
    }

    // Método para establecer la vista para editar un autor
    public function editarAutor() {
        $this->vista('gestor/editarAutor');
    }

}