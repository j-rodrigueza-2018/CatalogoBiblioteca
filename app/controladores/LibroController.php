<?php

class LibroController extends Controlador {

    // Atributos de la Clase
    private $repoLibros;

    // Método Constructor de la Clase
    public function __construct() {
        $this->repoLibros = $this->repositorio('RepositorioLibro');
    }

    // Método para establecer la vista principal del Gestor de libros
    public function index() {
        $libros = $this->repoLibros->getLibros();
        $data = [
            'libro' => $libros
        ];
        $this->vista('gestor/index', $data);
    }

    // Método para establecer la vista para añadir un libro
    public function nuevoLibro() {
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

        $libro = new Libro(0, trim($_POST['titulo']), trim($_POST['autor']), trim($_POST['categoria']), trim($_POST['sinopsis']), trim($ruta));

        if ($this->repoLibros->crearLibro($libro)) {
            redirect('libroController');
        } else {
            die('No se pudo guardar el libro');
        }
    }

    // Método para eliminar libros en nuestra base de datos
    public function eliminarLibros() {
        $data = $_REQUEST['idsArray'];
        $libros = [];
        for ($i = 0; $i < sizeof($data); $i++) {
            $libros[$i] = $this->repoLibros->buscarPorId($data[$i]);
        }
        $this->repoLibros->eliminarLibros($libros);
    }

    // Método para eliminar un libro concreto de la base de datos
    public function eliminarLibro() {
        $libro = $this->repoLibros->buscarPorId($_REQUEST['datos']);
        $this->repoLibros->eliminarLibro($libro);
    }

    // Método para establecer la vista para editar un libro
    public function vistaEditarLibro($id) {
        $libro = $this->repoLibros->buscarPorId($id);
        $data = [
            'id' => $libro->getId(),
            'titulo' => $libro->getTitulo(),
            'autor' => $libro->getAutorId(),
            'categoria' => $libro->getCategoriaId(),
            'sinopsis' => $libro->getSinopsis(),
            'imagenPortada' => $libro->getImagenPortada()
        ];
        $this->vista('gestor/editarLibro', $data);
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

        $libro = new Libro($id, trim($_POST['titulo']), trim($_POST['autor']), trim($_POST['categoria']), trim($_POST['sinopsis']), trim($ruta));

        if ($this->repoLibros->editarLibro($libro)) {
            redirect('libroController');
        } else {
            die('No se pudo cambiar los datos del libro');
        }
    }

    // Método para publicar libros en el catálogo
    public function publicarLibros() {
        $data = $_REQUEST['idsArray'];
        $libros = [];
        for ($i = 0; $i < sizeof($data); $i++) {
            $libros[$i] = $this->repoLibros->buscarPorId($data[$i]);
        }
        $this->repoLibros->publicarLibros($libros);
    }

    // Método para publicar un libro concreto en el catálogo
    public function publicarLibro() {
        $libro = $this->repoLibros->buscarPorId($_REQUEST['datos']);
        $this->repoLibros->publicarLibro($libro);
    }

    // Método para ocultar libros en el catálogo
    public function ocultarLibros() {
        $data = $_REQUEST['idsArray'];
        $libros = [];
        for ($i = 0; $i < sizeof($data); $i++) {
            $libros[$i] = $this->repoLibros->buscarPorId($data[$i]);
        }
        $this->repoLibros->ocultarLibros($libros);
    }

    // Método para ocultar un libro concreto en el catálogo
    public function ocultarLibro() {
        $libro = $this->repoLibros->buscarPorId($_REQUEST['datos']);
        $this->repoLibros->ocultarLibro($libro);
    }

    // Método para destacar un libro concreto en el catálogo
    public function destacarLibro() {
        $libro = $this->repoLibros->buscarPorId($_REQUEST['datos']);
        $this->repoLibros->destacarLibro($libro);
    }

    // Método para quitar de los libros destacados a un libro concreto en el catálogo
    public function quitarLibro() {
        $libro = $this->repoLibros->buscarPorId($_REQUEST['datos']);
        $this->repoLibros->quitarLibro($libro);
    }

    // Método para buscar los libros
    public function buscarLibros() {
        $consulta = $_POST['busqueda'];
        $libros = $this->repoLibros->buscarLibros($consulta);
        $data = [
            'libro' => $libros
        ];
        $this->vista('gestor/includes/tablaLibros', $data);
    }

}