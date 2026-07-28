<?php

class Articulo{

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

}