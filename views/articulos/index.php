<main class="container">

    <div class="titulo">
        <h1>Personal blog</h1>
        <div class="sesion">
            <a href="/articulos/crear"><span>+</span>Add</a>
            <a href="/logout">Logout</a>
        </div>
    </div>

    <?php 
        $mensaje = mostrarNotificacion( intval( $resultado) );
        if($mensaje) { ?>
            <p class="alerta exito"><?php echo s($mensaje); ?></p>
        <?php } 
    ?>

    <div class="articulos">
        <?php foreach($articulos as $articulo): ?>
            <div class="articulo" id="<?php echo $articulo->id; ?>">
                <p><?php echo $articulo->titulo; ?></p>

                <div class="botones">
                    <a href="articulos/actualizar?id=<?php echo $articulo->id; ?>" class="c-gray">Edit</a>

                    <form method="POST" action="articulos/eliminar">
                        <input type="hidden" name="id" value="<?php echo $articulo->id; ?>">
                        <input type="submit" class="delete" value="Delete">
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>