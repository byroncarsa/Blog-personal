<?php
    //Incluir 
    require '../../includes/app.php';
    estaAutenticado();

    //Recibir id
    $id = $_GET['id'];
    $id = filter_var($id);

    if(!$id) {
        header('Location: /admin');
    }

    use App\Articulo;
    $articulo = Articulo::find($id);

    $errores = Articulo::getErrores();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $args = $_POST;

        $articulo->sincronizar($args);

        $errores = $articulo->validar();

        if(empty($errores)) {
            $articulo->guardar();
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
            <input type="text" placeholder="Article Title" name="titulo" value="<?php echo s($articulo->titulo); ?>">
            <input type="text" placeholder="Publishing Date" name="date" value="<?php echo s($articulo->fecha); ?>" disabled>
            <textarea name="contenido" placeholder="Content"><?php echo s($articulo->contenido); ?></textarea>
        </div>

        <input type="submit" value="Update" class="boton">
    </form>

</main>

<?php 
    //Incluir footer
    incluirTemplate('footer');
?>