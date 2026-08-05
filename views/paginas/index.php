

<main class="container">
    <div class="titulo">
        <h1>Personal blog</h1>
        <a href="/login">Login</a>
    </div>

    <div class="articulos">
        <?php foreach($articulos as $articulo): ?>
            <div class="articulo" id="<?php echo $articulo->id; ?>">
                <a href="articulo?id=<?php echo $articulo->id; ?>">
                    <p><?php echo $articulo->titulo; ?></p>
                </a>

                <p class="c-gray"><?php echo fecha($articulo->fecha); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</main>

