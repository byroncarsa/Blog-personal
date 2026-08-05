<main class="container">
    <div class="titulo">
        <h1><?php echo $articulo->titulo; ?></h1>
        <a href="index.php">Back</a>
    </div>

    <p class="fecha c-gray"><?php echo fecha($articulo->fecha); ?></p>

    <p class="contenido"><?php echo $articulo->contenido; ?></p>
</main>