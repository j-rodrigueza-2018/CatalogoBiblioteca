<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<?php

class Libros extends Controlador {

    // Atributos de la Clase
    private $repoLibros;

    // Método Constructor de la Clase
    public function __construct() {
        $this->repoLibros = $this->repositorio('RepositorioLibro');
    }

    // Método para establecer la vista principal del Gestor
    public function index() {
        $this->vista('gestor/index');
    }

    // Método para establecer la vista para añadir un libro
    public function vistaNuevoLibro() {
        $this->vista('gestor/nuevoLibro');
    }

    // Método para crear un libro en nuestra base de datos
    public function crearLibro() {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $archivo = $_FILES['imagen']['tmp_name'];
        if ($archivo == '') {
            $tmpName = RUTA_IMG.'/public/img/libro1.jpg';
            $nombreImagen = preg_replace("/[^a-zA-Z0-9\_\-]+/", "", strtr($_POST['titulo'], " ", "_")).'_'.rand(00000, 99999);
            copy($tmpName, RUTA_IMG.'/public/imagenesPortada/'.$nombreImagen.'.jpg');
            $ruta = $nombreImagen.'.jpg';
        } else {
            $nombreArchivo = $_FILES['imagen']['name'];
            $info = pathinfo($nombreArchivo);
            $extension = $info['extension'];
            $nombreImagen = preg_replace("/[^a-zA-Z0-9\_\-]+/", "", strtr($_POST['titulo'], " ", "_")).'_'.rand(00000, 99999);
            move_uploaded_file($archivo, RUTA_IMG.'/public/imagenesPortada/'.$nombreImagen.'.'.$extension);
            $ruta = $nombreImagen.'.'.$extension;
        }

        $libro = new Libro(0, trim($_POST['titulo']), trim($_POST['autor']), trim($_POST['categoria']), trim($_POST['sinopsis']), trim($ruta), false, false);

        if ($this->repoLibros->crearLibro($libro)) {
            redirect('libros');
        } else {
            die('No se pudo guardar el libro');
        }
    }

    // Método para eliminar autores en nuestra base de datos
    public function eliminarLibros() {
        $data = $_REQUEST['idsArray'];
        if ($this->repoLibros->eliminarLibros($data)) {
            redirect('libros');
        } else {
            die('No se pudo eliminar los libros');
        }
    }

    // Método para eliminar un autor concreto de la base de datos
    public function eliminarLibro() {
        $id = $_REQUEST['datos'][0];
        $imagen = $_REQUEST['datos'][1];
        if ($this->repoLibros->eliminarLibro($id, $imagen)) {
            redirect('libros');
        } else {
            die('No se pudo eliminar el libro');
        }
    }

    // Método para establecer la vista para editar un libro
    public function vistaEditarLibro($id) {
        $libro = $this->repoLibros->buscarPorId($id);
        $this->vista('gestor/editarLibro', $libro);
    }

    // Método para editar los datos de un libro
    public function editarLibro($id) {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $archivo = $_FILES['imagen']['tmp_name'];
        if ($archivo == '') {
            $ruta = $_POST['ruta'];
        } else {
            $imgEliminar = $_POST['ruta'];
            $borrarImg = RUTA_IMG.'/public/imagenesPortada/'.$imgEliminar;
            unlink($borrarImg);
            $nombreArchivo = $_FILES['imagen']['name'];
            $info = pathinfo($nombreArchivo);
            $extension = $info['extension'];
            $nombreImagen = preg_replace("/[^a-zA-Z0-9\_\-]+/", "", strtr($_POST['titulo'], " ", "_")).'_'.rand(00000, 99999);
            move_uploaded_file($archivo, RUTA_IMG.'/public/imagenesPortada/'.$nombreImagen.'.'.$extension);
            $ruta = $nombreImagen.'.'.$extension;
        }

        $libro = new Libro($id, trim($_POST['titulo']), trim($_POST['autor']), trim($_POST['categoria']), trim($_POST['sinopsis']), trim($ruta), false, false);

        if ($this->repoLibros->editarLibro($libro)) {
            redirect('gestor');
        } else {
            die('No se pudo cambiar los datos del libro');
        }
    }

    // Método para publicar libros en el catálogo
    public function publicarLibros() {
        $data = $_REQUEST['idsArray'];
        if ($this->repoLibros->publicarLibros($data)) {
            redirect('libros');
        } else {
            die('No se pudieron publicar los libros en el catálogo');
        }
    }

    // Método para publicar un libro concreto en el catálogo
    public function publicarLibro() {
        $id = $_REQUEST['datos'];
        if ($this->repoLibros->publicarLibro($id)) {
            redirect('libros');
        } else {
            die('No se pudo publicar el libro en el catálogo');
        }
    }

    // Método para ocultar libros en el catálogo
    public function ocultarLibros() {
        $data = $_REQUEST['idsArray'];
        if ($this->repoLibros->ocultarLibros($data)) {
            redirect('libros');
        } else {
            die('No se pudieron ocultar los libros en el catálogo');
        }
    }

    // Método para ocultar un libro concreto en el catálogo
    public function ocultarLibro() {
        $id = $_REQUEST['datos'];
        if ($this->repoLibros->ocultarLibro($id)) {
            redirect('libros');
        } else {
            die('No se pudo ocultar el libro en el catálogo');
        }
    }

    // Método para destacar un libro concreto en el catálogo
    public function destacarLibro() {
        $id = $_REQUEST['datos'];
        if ($this->repoLibros->destacarLibro($id)) {
            redirect('libros');
        } else {
            die('No se pudo destacar el libro en el catálogo');
        }
    }

    // Método para quitar de los libros destacados a un libro concreto en el catálogo
    public function quitarLibro() {
        $id = $_REQUEST['datos'];
        if ($this->repoLibros->quitarLibro($id)) {
            redirect('libros');
        } else {
            die('No se pudo quitar el libro de la sección de destacados del catálogo');
        }
    }


    // Método para buscar los libros
    public function buscarLibros() {
        $con = $_POST['busqueda'];
        $resultadoConsulta = $this->repoLibros->buscarLibros($con);
        echo $resultadoConsulta;
    }

}