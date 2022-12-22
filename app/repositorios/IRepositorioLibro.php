<?php

interface IRepositorioLibro {

    public function crearLibro(Libro $libro);
    public function editarLibro(Libro $libro);
    public function eliminarLibro($id, $imagen);
    public function eliminarLibros($libros);
    public function publicarLibro($id);
    public function publicarLibros($libros);
    public function ocultarLibro($id);
    public function ocultarLibros($libros);
    public function destacarLibro($id);
    public function quitarLibro($id);
    public function buscarPorId(int $id);

}