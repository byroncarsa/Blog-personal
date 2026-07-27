<?php 
    //Incluir app
    require 'includes/app.php';

    //Conexion bd
    $db = conectarDB();

    // Escribir el Query
    $query = "SELECT * FROM articulo";

    // Consultar la BD 
    $articulos = mysqli_query($db, $query);

    //Incluir header
    incluirTemplate('header');
?>

<main class="container">
    <div class="titulo">
        <h1>Personal blog</h1>
        <a href="login.php">Login</a>
    </div>

    <div class="articulos">
        <?php foreach($articulos as $articulo): ?>
            <div class="articulo" id="<?php $articulo['id'] ?>">
                <a href="articulo.php?id=<?php echo $articulo['id']; ?>">
                    <p><?php echo $articulo['titulo']; ?></p>
                </a>

                <p class="c-gray"><?php echo fecha($articulo['fecha']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php 
    //Incluir footer
    incluirTemplate('footer');
?>