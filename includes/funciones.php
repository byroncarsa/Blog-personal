<?php
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