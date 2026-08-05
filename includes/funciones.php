<?php
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');

//Agregar template
function incluirTemplate( string  $nombre) {
    include TEMPLATES_URL . "/{$nombre}.php"; 
}


function estaAutenticado() {
    session_start();

    $auth = $_SESSION['login'] ?? false;

    if(!$auth) {
        header('Location: /');
    }
}


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


// Muestra los mensajes
function mostrarNotificacion($codigo) {
    $mensaje = '';

    switch ($codigo) {
        case 1:
            $mensaje = 'Articulo Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Articulo Actualizado Correctamente';
            break;
        case 3:
            $mensaje = 'Articulo Eliminado Correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}


//Transformar formato fecha
function fecha($fechaJson){
    $fecha = DateTime::createFromFormat('Y-m-d', $fechaJson);
    $fecha = $fecha->format('F j, Y');

    return $fecha;
}


function validarORedireccionar(string $url) {
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header("Location: ${url} " );
    }

    return $id;
}








