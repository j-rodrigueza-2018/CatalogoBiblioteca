<?php

class BibliotecaController extends Controlador {

    // Atributos de la Clase
    private $repoLibros;
    private $repoBiblioteca;

    // Método Constructor de la Clase
    public function __construct() {
        $this->repoLibros = $this->repositorio('RepositorioLibro');
        $this->repoBiblioteca = $this->repositorio('RepositorioBiblioteca');
    }

    // Método para establecer la vista principal con los libros destacados
    public function index() {
        $libros = $this->repoBiblioteca->getLibrosDestacados();
        $data = [
            'libro' => $libros
        ];
        $this->vista('usuarios/index', $data);
    }

    // Método para establecer la vista de Catálogo
    public function catalogo() {
        $libros = $this->repoBiblioteca->getLibrosPublicados();
        $data = [
            'libro' => $libros
        ];
        $this->vista('usuarios/catalogo', $data);
    }

    // Método para establecer la vista de Contacto
    public function contacto() {
        $this->vista('usuarios/contacto');
    }

    // Método para establecer la vista de Condiciones de Uso
    public function condicionesUso() {
        $this->vista('usuarios/condicionesUso');
    }

    // Método para establecer la vista de detalle de un libro
    public function detalleLibro($id) {
        $libro = $this->repoLibros->buscarPorId($id);
        $post = $this->repoBiblioteca->getDetallesLibro($libro);
        $data = [
            'id' => $id,
            'titulo' => $post->titulo,
            'autorId' => $post->autorId,
            'autor' => $post->autor,
            'categoria' => $post->categoria,
            'sinopsis' => $post->sinopsis,
            'imagenPortada' => $post->imagenPortada
        ];
        $this->vista('usuarios/detalleLibro', $data);
    }

    // Método para buscar los libros en el catálogo
    public function buscarLibros() {
        $consulta = $_POST['busqueda'];
        $libros = $this->repoBiblioteca->buscarLibros($consulta);
        $data = [
            'libro' => $libros
        ];
        $this->vista('usuarios/includes/cuadriculaLibros', $data);
    }

    // Método que devuelve un libro dada su categoría
    public function libroCategoria() {
        $consulta = $_POST['categoria'];
        $libros = $this->repoBiblioteca->buscarLibroPorCategoria($consulta);
        $data = [
            'libro' => $libros
        ];
        $this->vista('usuarios/includes/cuadriculaLibros', $data);
    }

}
