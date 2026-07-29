<?php 
    //Incluir 
    require '../includes/app.php';
    $auth = estaAutenticado();

    if(!$auth) {
        header('Location: /');
    }

    $articulos = Articulo::all();
    
    // Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // $id = $_POST['id'];
        // $id = filter_var($id, FILTER_VALIDATE_INT);

        // if($id) {
        //     // Eliminar la propiedad
        //     $query = "DELETE FROM articulos WHERE id = {$id}";

        //     $resultado = mysqli_query($db, $query);

        //     if($resultado) {
        //         header('location: /admin?resultado=3');
        //     }
        // }
    }

    //Incluir header
    incluirTemplate('header');
?>

<main class="container">

    <div class="titulo">
        <h1>Personal blog</h1>
        <div class="sesion">
            <a href="admin/articulos/new.php"><span>+</span>Add</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <?php if( intval( $resultado ) === 1): ?>
        <p class="alerta exito">Articulo Creado Correctamente</p>
    <?php elseif( intval( $resultado ) === 2 ): ?>
        <p class="alerta exito">Articulo Actualizado Correctamente</p>
    <?php elseif( intval( $resultado ) === 3 ): ?>
        <p class="alerta exito">Articulo Eliminado Correctamente</p>
    <?php endif; ?>

    <div class="articulos">
        <?php foreach($articulos as $articulo): ?>
            <div class="articulo" id="<?php echo $articulo->id; ?>">
                <p><?php echo $articulo->titulo; ?></p>

                <div class="botones">
                    <a href="admin/articulos/update.php?id=<?php echo $articulo->id; ?>" class="c-gray">Edit</a>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $articulo->id; ?>">
                        <input type="submit" class="delete" value="Delete">
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php 
    //Incluir footer
    incluirTemplate('footer');
?>