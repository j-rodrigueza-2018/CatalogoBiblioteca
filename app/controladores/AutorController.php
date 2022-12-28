<?php

class AutorController extends Controlador {

    // Atributos de la Clase
    private $repoAutores;

    // Método Constructor de la Clase
    public function __construct() {
        $this->repoAutores = $this->repositorio('RepositorioAutor');
    }

    // Método para establecer la vista de Autores
    public function index() {
        $autores = $this->repoAutores->mostrarAutores();
        $data = [
            'autor' => $autores
        ];
        $this->vista('gestor/listadoAutores', $data);
    }

    // Método para establecer la vista para añadir un autor
    public function nuevoAutor() {
        $this->vista('gestor/nuevoAutor');
    }

    // Método para crear un autor en nuestra base de datos
    public function crearAutor() {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $autor = new Autor(0, trim($_POST['nombre']), trim($_POST['apellidos']), trim($_POST['fechaNacimiento']), trim($_POST['pais']));
        if ($this->repoAutores->crearAutor($autor)) {
            redirect('autorController');
        } else {
            die('No se pudo dar de alta al autor');
        }
    }

    // Método para eliminar autores en nuestra base de datos
    public function eliminarAutores() {
        $data = $_REQUEST['idsArray'];
        $autores = [];
        for ($i = 0; $i < sizeof($data); $i++) {
            $autores[$i] = $this->repoAutores->buscarPorId($data[$i]);
        }
        $this->repoAutores->eliminarAutores($autores);
    }

    // Método para eliminar un autor concreto de la base de datos
    public function eliminarAutor() {
        $autor = $this->repoAutores->buscarPorId($_REQUEST['id']);
        $this->repoAutores->eliminarAutor($autor);
    }

    // Método para establecer la vista para editar un autor
    public function vistaEditarAutor($id) {
        $autor = $this->repoAutores->buscarPorId($id);
        $data = [
            'id' => $autor->getId(),
            'nombre' => $autor->getNombre(),
            'apellidos' => $autor->getApellidos(),
            'fechaNacimiento' => $autor->getFechaNacimiento(),
            'pais' => $autor->getPaisId()
        ];
        $this->vista('gestor/editarAutor', $data);
    }

    // Método para editar los datos de un autor
    public function editarAutor($id) {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $autor = new Autor($id, trim($_POST['nombre']), trim($_POST['apellidos']), trim($_POST['fechaNacimiento']), trim($_POST['pais']));

        if ($this->repoAutores->editarAutor($autor)) {
            redirect('autorController');
        } else {
            die('No se pudo cambiar los datos del autor');
        }
    }

    // Método para buscar los autores por apellido
    public function buscarAutores() {
        $con = $_POST['busqueda'];
        $autores = $this->repoAutores->buscarPorApellidos($con);
        $data = [
            'autor' => $autores
        ];
        $this->vista('gestor/includes/tablaAutores', $data);
    }

}