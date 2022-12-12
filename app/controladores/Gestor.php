<?php

class Gestor extends Controlador {

    // Atributos de la Clase
    private $modeloGestor;

    // Método Constructor de la Clase
    public function __construct() {
        $this->modeloGestor = $this->modelo('ModeloGestor');
    }

    /* Métodos de las vistas de los Libros */

    // Método para establecer la vista principal de la Clase
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
        $nombreArchivo = $_FILES['imagen']['name'];
        $info = pathinfo($nombreArchivo);
        $extension = $info['extension'];
        $nombreImagen = trim($_POST['titulo']).'_'.rand(00000, 99999);
        move_uploaded_file($archivo, RUTA_IMG.'/public/imagenesPortada/'.$nombreImagen.'.'.$extension);
        $ruta = $nombreImagen.'.'.$extension;

        $data = [
            'titulo' => trim($_POST['titulo']),
            'autor' => trim($_POST['autor']),
            'categoria' => trim($_POST['categoria']),
            'sinopsis' => trim($_POST['sinopsis']),
            'imagenPortada' => trim($ruta)
        ];

        if ($this->modeloGestor->crearNuevoLibro($data)) {
            redirect('gestor');
        } else {
            die('No se pudo guardar el libro');
        }
    }

    // Método para eliminar autores en nuestra base de datos
    public function eliminarLibros() {
        $data = $_REQUEST['idsArray'];
        if ($this->modeloGestor->eliminarLibros($data)) {
            redirect('gestor');
        } else {
            die('No se pudo eliminar los libros');
        }
    }

    // Método para eliminar un autor concreto de la base de datos
    public function eliminarLibro() {
        $id = $_REQUEST['datos'][0];
        $imagen = $_REQUEST['datos'][1];
        if ($this->modeloGestor->eliminarLibro($id, $imagen)) {
            redirect('gestor');
        } else {
            die('No se pudo eliminar el libro');
        }
    }

    // Método para establecer la vista para editar un libro
    public function vistaEditarLibro($id) {
        $post = $this->modeloGestor->libroPorId($id);
        $data = [
            'id' => $id,
            'titulo' => $post->titulo,
            'autor' => $post->autorId,
            'categoria' => $post->categoriaId,
            'sinopsis' => $post->sinopsis,
            'imagenPortada' => $post->imagenPortada
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
            $nombreImagen = trim($_POST['titulo']).'_'.rand(00000, 99999);
            move_uploaded_file($archivo, RUTA_IMG.'/public/imagenesPortada/'.$nombreImagen.'.'.$extension);
            $ruta = $nombreImagen.'.'.$extension;
        }

        $data = [
            'id' => $id,
            'titulo' => trim($_POST['titulo']),
            'autor' => trim($_POST['autor']),
            'categoria' => trim($_POST['categoria']),
            'sinopsis' => trim($_POST['sinopsis']),
            'imagenPortada' => trim($ruta)
        ];

        if ($this->modeloGestor->actualizarLibro($data)) {
            redirect('gestor');
        } else {
            die('No se pudo cambiar los datos del libro');
        }
    }

    // Método para publicar libros en el catálogo
    public function publicarLibros() {
        $data = $_REQUEST['idsArray'];
        if ($this->modeloGestor->publicarLibros($data)) {
            redirect('gestor');
        } else {
            die('No se pudieron publicar los libros en el catálogo');
        }
    }

    // Método para publicar un libro concreto en el catálogo
    public function publicarLibro() {
        $id = $_REQUEST['datos'];
        if ($this->modeloGestor->publicarLibro($id)) {
            redirect('gestor');
        } else {
            die('No se pudo publicar el libro en el catálogo');
        }
    }

    // Método para ocultar libros en el catálogo
    public function ocultarLibros() {
        $data = $_REQUEST['idsArray'];
        if ($this->modeloGestor->ocultarLibros($data)) {
            redirect('gestor');
        } else {
            die('No se pudieron ocultar los libros en el catálogo');
        }
    }

    // Método para ocultar un libro concreto en el catálogo
    public function ocultarLibro() {
        $id = $_REQUEST['datos'];
        if ($this->modeloGestor->ocultarLibro($id)) {
            redirect('gestor');
        } else {
            die('No se pudo ocultar el libro en el catálogo');
        }
    }

    // Método para destacar un libro concreto en el catálogo
    public function destacarLibro() {
        $id = $_REQUEST['datos'];
        if ($this->modeloGestor->destacarLibro($id)) {
            redirect('gestor');
        } else {
            die('No se pudo destacar el libro en el catálogo');
        }
    }

    // Método para quitar de los libros destacados a un libro concreto en el catálogo
    public function quitarLibro() {
        $id = $_REQUEST['datos'];
        if ($this->modeloGestor->quitarLibro($id)) {
            redirect('gestor');
        } else {
            die('No se pudo quitar el libro de la sección de destacados del catálogo');
        }
    }

    /* ------------------------------------ */

    /* Métodos de las vistas de los Autores */

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
            redirect('gestor/listadoAutores');
        } else {
            die('No se pudo dar de alta al autor');
        }
    }

    // Método para eliminar autores en nuestra base de datos
    public function eliminarAutores() {
        $data = $_REQUEST['idsArray'];
        if ($this->modeloGestor->eliminarAutores($data)) {
            $this->vista('gestor/listadoAutores');
        } else {
            die('No se pudo eliminar a los autores');
        }
    }

    // Método para eliminar un autor concreto de la base de datos
    public function eliminarAutor() {
        $id = $_REQUEST['id'];
        if ($this->modeloGestor->eliminarAutor($id)) {
            $this->vista('gestor/listadoAutores');
        } else {
            die('No se pudo eliminar al autor');
        }
    }

    // Método para establecer la vista para editar un autor
    public function vistaEditarAutor($id) {
        $post = $this->modeloGestor->autorPorId($id);
        $data = [
            'id' => $id,
            'nombre' => $post->nombre,
            'apellidos' => $post->apellidos,
            'fechaNacimiento' => $post->fechaNacimiento,
            'paisOrigen' => $post->paisOrigenId
        ];
        $this->vista('gestor/editarAutor', $data);
    }

    // Método para editar los datos de un autor
    public function editarAutor($id) {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data= [
            'id' => $id,
            'nombre' => trim($_POST['nombre']),
            'apellidos' => trim($_POST['apellidos']),
            'fechaNacimiento' => trim($_POST['fechaNacimiento']),
            'paisOrigen' => trim($_POST['paisOrigen'])
        ];

        if ($this->modeloGestor->actualizarAutor($data)) {
            redirect('gestor/listadoAutores');
        } else {
            die('No se pudo cambiar los datos del autor');
        }
    }

    // Método para mostrar los autores por apellido
    public function buscarAutores() {
        $con = $_POST['busqueda'];
        $resultadoConsulta = $this->modeloGestor->autorPorApellidos($con);
        echo $resultadoConsulta;
    }

    /* ------------------------------------ */

}