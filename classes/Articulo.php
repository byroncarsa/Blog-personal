<?php

namespace App;

class Articulo extends ActiveRecord{

    //Base de datos
    protected static $db;
    protected static $tabla = 'articulos';
    protected static $columnasDB = ['id', 'titulo', 'fecha', 'contenido'];

    public $id;
    public $titulo;
    public $fecha;
    public $contenido;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->fecha = date('Y/m/d');
        $this->contenido = $args['contenido'] ?? '';
    } 

    
    public function validar() {

        if(!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }

        if(!$this->contenido) {
            self::$errores[] = 'El contenido es Obligatorio';
        }

        if( strlen( $this->contenido ) < 5 ) {
            self::$errores[] = 'El contenido es obligatoria y debe tener al menos 5 caracteres';
        }

        return self::$errores;
    }
}