<?php 
     //Incluir app
    require 'includes/app.php';
    
    //Conexion bd
    $db = conectarDB();

    // Escribir el Query
    $query = "SELECT * FROM articulo";

    // Consultar la BD 
    $articulos = mysqli_query($db, $query);


    // Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id) {

            // Filtrar el array para EXCLUIR el articulo con el id recibido
            $articulosFiltrados = array_filter($articulos, function($articulo) use ($id) {
                return $articulo['id'] !== $id;
            });
            
            // Reindexar el array (array_filter conserva las llaves originales, esto las limpia)
            $articulosFinales = array_values($articulosFiltrados);
            
            // Guardar el nuevo array en el archivo JSON
            $jsonFinal = json_encode($articulosFinales, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            file_put_contents('json/articulos.json', $jsonFinal);
            
            // Redireccionar de vuelta a la lista de usuarios
            header("Location: admin.php?resultado=3");
        }
    }

    //Incluir header
    incluirTemplate('header');

?>

<main class="container">

    <div class="titulo">
        <h1>Personal blog</h1>
        <div class="sesion">
            <a href="new.php"><span>+</span>Add</a>
            <a href="index.php">Logout</a>
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
            <div class="articulo" id="<?php $articulo['id'] ?>">
                <p><?php echo $articulo['titulo']; ?></p>

                <div class="botones">
                    <a href="update.php?id=<?php echo $articulo['id']; ?>" class="c-gray">Edit</a>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $articulo['id']; ?>">
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