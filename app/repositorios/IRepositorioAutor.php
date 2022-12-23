<?php

interface IRepositorioAutor {

    public function crearAutor(Autor $autor);
    public function editarAutor(Autor $autor);
    public function eliminarAutor(Autor $autor);
    public function eliminarAutores($autores);
    public function buscarPorId($id);
    public function mostrarAutores();

}