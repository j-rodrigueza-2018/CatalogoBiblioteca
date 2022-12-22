<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<?php

class Autores extends Controlador {

    // Atributos de la Clase
    private $repoAutores;

    // Método Constructor de la Clase
    public function __construct() {
        $this->repoAutores = $this->repositorio('RepositorioAutor');
    }

    // Método para establecer la vista de Autores
    public function index() {
        $this->vista('gestor/listadoAutores');
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
            redirect('autores');
        } else {
            die('No se pudo dar de alta al autor');
        }
    }

    // Método para eliminar autores en nuestra base de datos
    public function eliminarAutores() {
        $data = $_REQUEST['idsArray'];
        $this->repoAutores->eliminarAutores($data);
    }

    // Método para eliminar un autor concreto de la base de datos
    public function eliminarAutor() {
        $id = $_REQUEST['id'];
        $this->repoAutores->eliminarAutor($id);
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
        $this->vista('autores/editarAutor', $data);
    }

    // Método para editar los datos de un autor
    public function editarAutor($id) {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $autor = new Autor($id, trim($_POST['nombre']), trim($_POST['apellidos']), trim($_POST['fechaNacimiento']), trim($_POST['pais']));

        if ($this->repoAutores->editarAutor($autor)) {
            redirect('autores');
        } else {
            die('No se pudo cambiar los datos del autor');
        }
    }


    // Método para buscar los autores por apellido
    public function buscarAutores() {
        $con = $_POST['busqueda'];
        $resultadoConsulta = $this->repoAutores->autorPorApellidos($con);
        echo $resultadoConsulta;
    }

}