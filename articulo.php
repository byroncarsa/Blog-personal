<?php

    //Incluir funciones
    require 'includes/funciones.php';

    //Obtener id de index
    $id = $_GET['id'];
    $id = filter_var($id);

    //Mandar a index si no existe el id
    if(!$id) {
        header('Location: /');
    }

    //Leer el archivo JSON completo
    $jsonString = file_get_contents('json/articulos.json');
    
    //Convertir el texto JSON a un arreglo asociativo de PHP
    $articulos = json_decode($jsonString, true);

    //Listar todo
    foreach($articulos as $tmp){
        if($tmp['id'] == $id){
            $articulo = $tmp;
            break;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Blog</title>

    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<main class="container">

    <div class="titulo">
        <h1><?php echo $articulo['titulo']; ?></h1>
        <a href="index.php">Back</a>
    </div>
    
    <p class="fecha c-gray"><?php echo fecha($articulo['fecha']); ?></p>

    <p class="contenido"><?php echo $articulo['contenido']; ?></p>
</main>

</body>
</html>