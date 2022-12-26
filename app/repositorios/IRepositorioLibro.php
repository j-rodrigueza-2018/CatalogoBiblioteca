<?php

interface IRepositorioLibro {

    public function crearLibro(Libro $libro);
    public function editarLibro(Libro $libro);
    public function eliminarLibro(Libro $libro);
    public function eliminarLibros($libros);
    public function publicarLibro(Libro $libro);
    public function publicarLibros($libros);
    public function ocultarLibro(Libro $libro);
    public function ocultarLibros($libros);
    public function destacarLibro(Libro $libro);
    public function quitarLibro(Libro $libro);
    public function buscarPorId(int $id);
    public function mostrarLibros();

}