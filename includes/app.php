<?php
require 'funciones.php';
require 'config/database.php';
require 'classes/Articulo.php';

//Conectarnos a la base de datos
$db = conectarDB1();

Articulo::setDB($db);


// $db = conectarDB();

// // Escribir el Query
// $query = "SELECT * FROM articulos";

// // Consultar la BD 
// $articulos = mysqli_query($db, $query);

// foreach($articulos as $tmp){
//     debuguear($tmp);
// }

