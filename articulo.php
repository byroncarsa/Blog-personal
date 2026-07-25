<?php

    //Incluir funciones
    require 'includes/funciones.php';

    //Incluir header
    incluirTemplate('header');

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

<main class="container">

    <div class="titulo">
        <h1><?php echo $articulo['titulo']; ?></h1>
        <a href="index.php">Back</a>
    </div>
    
    <p class="fecha c-gray"><?php echo fecha($articulo['fecha']); ?></p>

    <p class="contenido"><?php echo $articulo['contenido']; ?></p>
</main>

<?php 
    //Incluir footer
    incluirTemplate('footer');
?>