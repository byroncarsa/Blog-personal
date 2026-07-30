<?php 
    //Incluir 
    require '../includes/app.php';
    estaAutenticado();

    use App\Articulo;
    $articulos = Articulo::all();
    
    // Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id) {
            $propiedad = Articulo::find($id);
            $propiedad->eliminar();
        }
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