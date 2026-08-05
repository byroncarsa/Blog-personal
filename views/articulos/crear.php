<main class="container">
    <div class="titulo">
        <h1>New Article</h1>
        <a href="/articulos">Back</a>
    </div>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="post">

        <div class="entradas">
            <input type="text" placeholder="Article Title" name="titulo" value="<?php echo s($articulo->titulo); ?>">
            <input type="text" placeholder="Publishing Date" disabled>
            <textarea name="contenido" placeholder="Content"><?php echo s($articulo->contenido); ?></textarea>
        </div>

        <input type="submit" value="Publish" class="boton">
    </form>
</main>