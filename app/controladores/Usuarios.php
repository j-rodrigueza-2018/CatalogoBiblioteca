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

    // Método para establecer la vista de detalle de un libro
    public function vistaDetalleLibro($id) {
        $post = $this->modeloUsuarios->libroPorId($id);
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
        $con = $_POST['busqueda'];
        $resultadoConsulta = $this->modeloUsuarios->buscarLibros($con);
        echo $resultadoConsulta;
    }

    // Método que devuelve un libro dada su categoría
    public function libroCategoria() {
        $con = $_POST['categoria'];
        $resultadoConsulta = $this->modeloUsuarios->libroCategoria($con);
        echo $resultadoConsulta;
    }

}
