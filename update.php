<?php

    //Incluir funciones
    require 'includes/funciones.php';

    //Recibir id
    $id = $_GET['id'];

    $id = filter_var($id);

    //Si no hay id enviar al index
    if(!$id) {
        header('Location: admin.php');
    }

    //Leer el archivo JSON completo
    $jsonString = file_get_contents('json/articulos.json');
    
    //Convertir el texto JSON a un arreglo asociativo de PHP
    $articulos = json_decode($jsonString, true);

    //Listar todo
    foreach($articulos as $tmp){
        if($tmp['id'] == $id){
            $articulo = $tmp;
            break;
        }
    }

    //Errores
    $errores = [];

    //Crear variables
    $titulo = $articulo['titulo'];
    $contenido = $articulo['contenido'];

    // Arreglo con mensajes de errores
    $errores = [];


    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $encontrado = false;

        $titulo = $_POST['titulo'];
        $contenido = $_POST['contenido'];

        if(!$titulo){
            $errores[] = 'Debe agregar un titulo';
        }

        if(!$contenido){
            $errores[] = 'Debe agregar un contenido';
        }


        if(empty($errores)) {
            //Modificar el elemento
            foreach($articulos as &$datos){
                if($datos['id'] == $id){
                    $datos['titulo'] = $titulo;
                    $datos['fecha'] = date('Y-m-d');
                    $datos['contenido'] = $contenido;
                    $encontrado = true;
                    break;
                }
            }

            //Guardar los cambios
            if($encontrado){
                $jsonFinal = json_encode($articulos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                file_put_contents("json/articulos.json", $jsonFinal);
                // Redireccionar al usuario.
                header('Location: /admin.php?resultado=2');
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Blog</title>

    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<main class="container">
    <div class="titulo">
        <h1>Update Article</h1>
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
            <input type="text" placeholder="Publishing Date" name="date" value="<?php echo $articulo['fecha']; ?>" disabled>
            <textarea name="contenido" placeholder="Content"><?php echo $contenido; ?></textarea>
        </div>

        <input type="submit" value="Update" class="boton">
    </form>

</main>

</body>
</html>