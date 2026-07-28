<?php 
   //Incluir app
    require 'includes/app.php';

    $auth = estaAutenticado();

    if(!$auth) {
        header('Location: /');
    }

    $db = conectarDB();

    //Arreglo errores
    $errores = [];

    //Inicializar variables
    $titulo = '';
    $contenido = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //Completar variables 
        $titulo = $_POST['titulo'];
        $fecha = date('Y-m-d');
        $contenido = $_POST['contenido'];

        if(!$titulo){
            $errores[] = 'Debes añadir un titulo';
        }

        if(!$contenido){
            $errores[] = 'Debes añadir un mensaje';
        }

        if(empty($errores)) {
              // Insertar en la base de datos
            $query = " INSERT INTO articulo (titulo, fecha, contenido ) VALUES ( '$titulo', '$fecha', '$contenido' ) ";
                
            $resultado = mysqli_query($db, $query);

            if($resultado) {
                // Redireccionar al usuario.
                header('Location: /admin.php?resultado=1');
            }
        }
    }

    //Incluir header
    incluirTemplate('header');
?>

<main class="container">
    <div class="titulo">
        <h1>New Article</h1>
        <a href="admin.php">Back</a>
    </div>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="post">

        <div class="entradas">
            <input type="text" placeholder="Article Title" name="titulo" value="<?php echo $titulo; ?>">
            <input type="text" placeholder="Publishing Date" disabled>
            <textarea name="contenido" placeholder="Content"><?php echo $contenido; ?></textarea>
        </div>

        <input type="submit" value="Publish" class="boton">
    </form>
</main>

<?php 
    //Incluir footer
    incluirTemplate('footer');
?>