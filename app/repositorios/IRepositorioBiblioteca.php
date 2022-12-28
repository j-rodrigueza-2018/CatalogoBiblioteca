<?php

interface IRepositorioBiblioteca {

    public function getLibrosDestacados();
    public function getLibrosPublicados();
    public function getDetallesLibro(Libro $libro);
    public function buscarLibros($texto);
    public function buscarLibroPorCategoria($texto);

}