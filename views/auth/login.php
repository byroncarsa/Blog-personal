<main class="container">
    <div class="titulo">
        <h1>Login</h1>
        <a href="index.php">Back</a>
    </div>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach ?>

    <form class="formulario" method="post" novalidate>
        <div class="entradas">
            <input type="text" placeholder="User Name" name="nombre">
            <input type="password" placeholder="Password" name="password">
        </div>

        <input type="submit" value="Enter" class="boton">
    </form>
</main>