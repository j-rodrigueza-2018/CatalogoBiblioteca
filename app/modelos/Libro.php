<?php

class Libro {

    // Atributos de la Clase
    private int $id;
    private string $titulo;
    private int $autorId;
    private int $categoriaId;
    private string $sinopsis;
    private string $imagenPortada;
    private bool $estaPublicado;
    private bool $esDestacado;

    // Método Constructor de la Clase
    public function __construct($id, $titulo, $autorId, $categoriaId, $sinopsis, $imagenPortada, $estaPublicado, $esDestacado) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->autorId = $autorId;
        $this->categoriaId = $categoriaId;
        $this->sinopsis = $sinopsis;
        $this->imagenPortada = $imagenPortada;
        $this->estaPublicado = $estaPublicado;
        $this->esDestacado = $esDestacado;
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

    public function getEstaPublicado(): bool {
        return $this->estaPublicado;
    }

    public function setEstaPublicado(bool $estaPublicado): void {
        $this->estaPublicado = $estaPublicado;
    }

    public function getEsDestacado(): bool {
        return $this->esDestacado;
    }

    public function setEsDestacado(bool $esDestacado): void {
        $this->esDestacado = $esDestacado;
    }

}