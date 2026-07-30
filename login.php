<?php 
    //Incluir 
    require 'includes/app.php';
    use App\Admin;

    $errores = Admin::getErrores();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $admin = new Admin($_POST['admin']);
        $errores = $admin->validar();

        //Verificar que no haya errores
        if(empty($errores)){

            //Revisar si el usuario existe
            $resultado = $admin->existeUsuario(); 


            //asignar el resultado del arrelgo de resultado
            [$existe, $resultado] = $resultado;

            if( $existe ) {
                // Usuario existe, verificar su password
                $resultado = $admin->verificarPassword($resultado);
                
                $auth = $resultado;

                // Verificar si el password es correcto o no
                if($auth) {
                    return header('Location: /admin');
                } else {
                    $errores = $resultado[1];
                }
            } else {
                $errores = $resultado;
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

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach ?>

    <form class="formulario" method="post" novalidate>
        <div class="entradas">
            <input type="text" placeholder="User Name" name="admin[nombre]">
            <input type="password" placeholder="Password" name="admin[password]">
        </div>

        <input type="submit" value="Enter" class="boton">
    </form>
</main>

<?php 
    //Incluir footer
    incluirTemplate('footer');
?>