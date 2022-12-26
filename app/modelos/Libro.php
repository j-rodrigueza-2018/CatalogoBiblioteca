<?php

class Libro {

    // Atributos de la Clase
    private int $id;
    private string $titulo;
    private int $autorId;
    private int $categoriaId;
    private string $sinopsis;
    private string $imagenPortada;
    private int $estaPublicado;
    private int $esDestacado;

    // Método Constructor de la Clase
    public function __construct($id, $titulo, $autorId, $categoriaId, $sinopsis, $imagenPortada) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->autorId = $autorId;
        $this->categoriaId = $categoriaId;
        $this->sinopsis = $sinopsis;
        $this->imagenPortada = $imagenPortada;
    }

    // Métodos 'get' y 'set' de la Clase
    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getTitulo(): string {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): void {
        $this->titulo = $titulo;
    }

    public function getAutorId(): int {
        return $this->autorId;
    }

    public function setAutorId(int $autorId): void {
        $this->autorId = $autorId;
    }

    public function getCategoriaId(): int {
        return $this->categoriaId;
    }

    public function setCategoriaId(int $categoriaId): void {
        $this->categoriaId = $categoriaId;
    }

    public function getSinopsis(): string {
        return $this->sinopsis;
    }

    public function setSinopsis(string $sinopsis): void {
        $this->sinopsis = $sinopsis;
    }

    public function getImagenPortada(): string {
        return $this->imagenPortada;
    }

    public function setImagenPortada(string $imagenPortada): void {
        $this->imagenPortada = $imagenPortada;
    }

    public function getEstaPublicado(): int {
        return $this->estaPublicado;
    }

    public function setEstaPublicado(int $estaPublicado): void {
        $this->estaPublicado = $estaPublicado;
    }

    public function getEsDestacado(): int {
        return $this->esDestacado;
    }

    public function setEsDestacado(int $esDestacado): void {
        $this->esDestacado = $esDestacado;
    }

}