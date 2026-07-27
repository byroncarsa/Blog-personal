<?php 
   

    //Arreglo errores
    $errores = [];

    //Inicializar variables
    $usuario = 'admin';
    $password = '12345';


    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //Completar variables 
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

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

     //Incluir app
    require 'includes/app.php';

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
            <input type="text" placeholder="User Name" name="usuario" value="<?php echo $usuario ?>">
            <input type="password" placeholder="Password" name="password" value="<?php echo $password ?>">
        </div>

        <input type="submit" value="Enter" class="boton">
    </form>



</main>

<?php 
    //Incluir footer
    incluirTemplate('footer');
?>