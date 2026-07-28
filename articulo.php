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
    
    //Conexion bd
    $db = conectarDB();

    // Escribir el Query
    $query = "SELECT * FROM articulos WHERE id = {$id}";

    // Consultar la BD 
    $resultado = mysqli_query($db, $query);

    if(!$resultado->num_rows) {
        header('Location: /');
    } 
    
    // Consultar la BD 
    $articulo = mysqli_fetch_assoc($resultado);

    //Incluir header
    incluirTemplate('header');
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