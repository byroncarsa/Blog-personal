<?php 
   //Incluir app
    require 'includes/app.php';

    //Incluir header
    incluirTemplate('header');

    //Leer el archivo JSON completo
    $jsonString = file_get_contents('json/articulos.json');
    
    //Convertir el texto JSON a un arreglo asociativo de PHP
    $articulos = json_decode($jsonString, true);

    //Arreglo errores
    $errores = [];

    //Inicializar variables
    $titulo = '';
    $contenido = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //Completar variables 
        $titulo = $_POST['titulo'];
        $contenido = $_POST['contenido'];

        if(!$titulo){
            $errores[] = 'Debes añadir un titulo';
        }

        if(!$contenido){
            $errores[] = 'Debes añadir un mensaje';
        }

        //Verificar que no haya errores
        if(empty($errores)){

            //Si el archivo estaba vacío, inicializamos un array limpio
            if (!is_array($articulos)) {
                $articulos = [];
            }
            
            //Encontrar el ID más alto
            $idMaximo = 0;
            foreach ($articulos as $item) {
                if (isset($item['id']) && $item['id'] > $idMaximo) {
                    $idMaximo = $item['id'];
                }
            }

            //Crear el nuevo elemento que queremos agregar
            $nuevo_elemento = [
                "id" => $idMaximo + 1,
                "titulo" => $titulo,
                "fecha" => date('Y-m-d'),
                "contenido" => $contenido
            ];

            //Añadir el nuevo elemento al final del array
            $articulos[] = $nuevo_elemento;
            
            //Convertir el array actualizado de vuelta a texto JSON
            // JSON_PRETTY_PRINT sirve para que el archivo quede ordenado y legible
            $json_actualizado = json_encode($articulos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            
            //Guardar el nuevo contenido en el archivo
            file_put_contents('json/articulos.json', $json_actualizado);

            // Redireccionar al usuario.
            header('Location: /admin.php?resultado=1');
        }
    }
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