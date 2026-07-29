<?php
    //Incluir 
    require 'includes/app.php';

    //Obtener id de index
    $id = $_GET['id'];
    $id = filter_var($id);

    //Mandar a index si no existe el id
    if(!$id) {
        header('Location: /');
    }

    $articulo1 = Articulo::find($id);

    //Incluir header
    incluirTemplate('header');
?>

<main class="container">
    <div class="titulo">
        <h1><?php echo $articulo1->titulo; ?></h1>
        <a href="index.php">Back</a>
    </div>
    
    <p class="fecha c-gray"><?php echo fecha($articulo1->fecha); ?></p>

    <p class="contenido"><?php echo $articulo1->contenido; ?></p>
</main>

<?php 
    //Incluir footer
    incluirTemplate('footer');
?>