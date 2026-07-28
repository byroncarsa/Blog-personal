<?php
//Constantes
define('TEMPLATES_URL', __DIR__ . '/../templates');

//Debuguear
function debuguear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit();
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

//Transformar formato fecha
function fecha($fechaJson){
    $fecha = DateTime::createFromFormat('Y-m-d', $fechaJson);
    $fecha = $fecha->format('F j, Y');

    return $fecha;
}

//Agregar template
function incluirTemplate( string  $nombre) {
    include TEMPLATES_URL . "/{$nombre}.php"; 
}

//Esta autenticado
function estaAutenticado() : bool {
    session_start();

    $auth = $_SESSION['login'];
    if($auth) {
        return true;
    }
    return false;
}