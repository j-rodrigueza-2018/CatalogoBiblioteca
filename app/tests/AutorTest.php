<?php

include_once 'app/config/config.php';
include_once 'app/librerias/Conexion.php';
include_once 'app/modelos/Autor.php';
include_once 'app/repositorios/RepositorioAutor.php';

use PHPUnit\Framework\TestCase;

class AutorTest extends TestCase {

    // Atributos de la Clase
    private static ?Autor $autor;
    private static ?RepositorioAutor $repositorioAutor;

    // Establecemos los parámetros por defecto para los métodos en el método 'setUpBeforeClass'
    public static function setUpBeforeClass(): void {
        self::$autor = new Autor(0, 'Juan', 'Rodríguez Alonso', '2000-12-25', 28);
        self::$repositorioAutor = new RepositorioAutor();
    }

    // Eliminamos cualquier dato almacenado durante los tests mediante el método 'tearDownAfterClass'
    public static function tearDownAfterClass(): void {
        self::$autor = null;
        self::$repositorioAutor = null;
    }

    // Comprobamos que funciona el método de crear un autor
    public function testCrearAutor() {
        // Creamos el autor en la base de datos
        self::$repositorioAutor->crearAutor(self::$autor);
        // Obtenemos el autor creado en la base de datos a través de su id
        $autorBD = self::$repositorioAutor->buscarPorId(self::$autor->getId());
        // Comprobamos si el autor original es igual al obtenido en la base de datos
        $this->assertEquals(self::$autor, $autorBD);
    }

    // Comprobamos que funciona el método de editar un autor cambiando el nombre y los apellidos al autor
    public function testEditarAutor() {
        // Cambiamos el nombre y los apellidos del autor
        self::$autor->setNombre('Luis');
        self::$autor->setApellidos('Herrero');
        // Editamos el autor en la base de datos con los nuevos datos
        self::$repositorioAutor->editarAutor(self::$autor);
        // Obtenemos el autor editado en la base de datos a través de su id
        $autorBD = self::$repositorioAutor->buscarPorId(self::$autor->getId());
        $this->assertEquals(self::$autor, $autorBD);
    }

    // Comprobamos que funciona el método de eliminar un autor
    public function testEliminarAutor() {
        // Eliminamos el autor de la base de datos
        self::$repositorioAutor->eliminarAutor(self::$autor);
        // Intentamos obtener el autor eliminado de la base de datos a través de su id
        $autorBD = self::$repositorioAutor->buscarPorId(self::$autor->getId());
        // Comprobamos si el valor obtenido es 'null', ya que si es así, la eliminación se habrá realizado correctamente
        $this->assertNull($autorBD);
    }

}
