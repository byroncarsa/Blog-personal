<?php 
    //Incluir funciones
    require 'includes/funciones.php';

    //Arreglo errores
    $errores = [];

    //Inicializar variables
    $usuario = 'admin';
    $password = '12345';


    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //Completar variables 
        $usuario = s($_POST['usuario']);
        $password = s($_POST['password']);

        $user = 'admin';
        $pass = '12345';

        if(!$usuario){
            $errores[] = 'Debes añadir un usaurio';
        }

        if(!$password){
            $errores[] = 'Debes añadir una contraseña';
        }

        //Verificar que no haya errores
        if(empty($errores)){

            if($usuario === $user && $password === $pass){

                header('Location: /admin.php');

            }else{
                $errores[] = 'El usuario y/o password es incorrecto';
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
        <h1>Login</h1>
        <a href="index.php">Back</a>
    </div>

    <form class="formulario" method="post">

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach ?>

        <div class="entradas">
            <input type="text" placeholder="User Name" name="usuario" value="<?php echo $usuario ?>">
            <input type="password" placeholder="Password" name="password" value="<?php echo $password ?>">
        </div>

        <input type="submit" value="Enter" class="boton">
    </form>



</main>

</body>
</html>