<?php

function conectarDB() : mysqli{
    $db = mysqli_connect('localhost', 'root', '', 'blog');

    if(!$db){
        echo 'Error no se pudo conectar';
        exit;
    }

    return $db;
}

function conectarDB1() : mysqli {
    $db = new mysqli('localhost', 'root', '', 'blog');

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    } 

    return $db;
    
}