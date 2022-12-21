<?php

class Autor {

    // Atributos de la Clase
    private int $id;
    private string $nombre;
    private string $apellidos;
    private string $fechaNacimiento;
    private int $paisId;

    // Método Constructor de la Clase
    public function __construct(int $id, string $nombre, string $apellidos, string $fechaNacimiento, int $paisId) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->paisId = $paisId;
    }

    // Métodos 'get' y 'set' de la Clase
    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function getApellidos(): string {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): void {
        $this->apellidos = $apellidos;
    }

    public function getNombreCompleto(): string {
        if (isset($this->nombre) && isset($this->apellidos)) {
            return $this->getNombre().' '.$this->getApellidos();
        } else {
            return '';
        }
    }

    public function getFechaNacimiento(): string {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(string $fechaNacimiento): void {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function getPaisId(): int {
        return $this->paisId;
    }

    public function setPaisId(int $paisId): void {
        $this->paisId = $paisId;
    }

}