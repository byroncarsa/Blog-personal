<?php 

    //Incluir app
    require 'includes/app.php';

    $db = conectarDB();

    //Arreglo errores
    $errores = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //Completar variables 
        $nombre = mysqli_real_escape_string($db,  $_POST['nombre'] );
        $password = mysqli_real_escape_string($db,  $_POST['password']);

        if(!$nombre){
            $errores[] = 'Debes añadir un nombre de usuario';
        }

        if(!$password){
            $errores[] = 'Debes añadir una contraseña';
        }

        //Verificar que no haya errores
        if(empty($errores)){

            // Revisar si el usuario existe.
            $query = "SELECT * FROM usuario WHERE nombre = '{$nombre}' ";
            $resultado = mysqli_query($db, $query);

            if( $resultado->num_rows ) {
                 // Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);

                // Verificar si el password es correcto o no
                $auth = password_verify($password, $usuario['password']);

                if($auth) {
                    // El usuario esta autenticado
                    session_start();

                    // Llenar el arreglo de la sesión
                    $_SESSION['usuario'] = $usuario['nombre'];
                    $_SESSION['login'] = true;
     
                    header('Location: /admin.php');
                }else {
                    $errores[] = 'El password es incorrecto';
                }
            }else {
                $errores[] = "El Usuario no existe";
            }
        }
    }

    //Incluir header
    incluirTemplate('header');
?>

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
            <input type="text" placeholder="User Name" name="nombre">
            <input type="password" placeholder="Password" name="password">
        </div>

        <input type="submit" value="Enter" class="boton">
    </form>



</main>

<?php 
    //Incluir footer
    incluirTemplate('footer');
?>