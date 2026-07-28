<?php
    //Incluir 
    require '../../includes/app.php';
    $auth = estaAutenticado();

    if(!$auth) {
        header('Location: /');
    }

    //Recibir id
    $id = $_GET['id'];
    $id = filter_var($id);

    if(!$id) {
        header('Location: /admin');
    }

    $db = conectarDB();

    // Obtener los datos de la propiedad
    $consulta = "SELECT * FROM articulos WHERE id = {$id}";
    $resultado = mysqli_query($db, $consulta);
    $articulo = mysqli_fetch_assoc($resultado);

    //Errores
    $errores = [];

    //Crear variables
    $titulo = $articulo['titulo'];
    $contenido = $articulo['contenido'];


    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $titulo = mysqli_real_escape_string( $db,  $_POST['titulo'] );
        $fecha = date('Y-m-d');
        $contenido = mysqli_real_escape_string( $db,  $_POST['contenido'] );

        if(!$titulo){
            $errores[] = 'Debe agregar un titulo';
        }

        if(!$contenido){
            $errores[] = 'Debe agregar un contenido';
        }


        if(empty($errores)) {
            // Insertar en la base de datos
            $query = " UPDATE articulos SET titulo = '{$titulo}', fecha = '{$fecha}', contenido = '{$contenido}' WHERE id = {$id} ";

            $resultado = mysqli_query($db, $query);

            if($resultado) {
                // Redireccionar al usuario.
                header('Location: /admin?resultado=2');
            }
        }
    }

    //Incluir header
    incluirTemplate('header');
?>

<main class="container">
    <div class="titulo">
        <h1>Update Article</h1>
        <a href="/admin">Back</a>
    </div>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="post">
        <div class="entradas">
            <input type="text" placeholder="Article Title" name="titulo" value="<?php echo $titulo; ?>">
            <input type="text" placeholder="Publishing Date" name="date" value="<?php echo $articulo['fecha']; ?>" disabled>
            <textarea name="contenido" placeholder="Content"><?php echo $contenido; ?></textarea>
        </div>

        <input type="submit" value="Update" class="boton">
    </form>

</main>

<?php 
    //Incluir footer
    incluirTemplate('footer');
?>