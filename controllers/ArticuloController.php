<?php 

namespace Controllers;

use MVC\Router;
use Model\Articulo;

class ArticuloController {

    public static function index(Router $router) {
        $articulos = Articulo::all();

        // Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('articulos/index', [
            'articulos' => $articulos,
            'resultado' => $resultado
        ]);
    }


    public static function crear(Router $router) {

        $articulo = new Articulo;
        $errores = Articulo::getErrores();


         // Ejecutar el código después de que el usuario envia el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //Crear nueva instancia
            $articulo = new Articulo($_POST);

            //Validar
            $errores = $articulo->validar();

            if(empty($errores)) {
                // Guarda en la base de datos
                $resultado = $articulo->guardar();

                if($resultado) {
                    header('location: /articulos');
                }
            }
        }

        $router->render('articulos/crear', [
            'errores' => $errores,
            'articulo' => $articulo,
        ]);
    }



    public static function actualizar(Router $router) {

        $id = validarORedireccionar('/articulos');

        // Obtener los datos de la propiedad
        $articulo = Articulo::find($id);

        // Arreglo con mensajes de errores
        $errores = Articulo::getErrores();

        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Asignar los atributos
            $args = $_POST;

            $articulo->sincronizar($args);

            // Validación
            $errores = $articulo->validar();

            if(empty($errores)) {
                // Guarda en la base de datos
                $resultado = $articulo->guardar();

                if($resultado) {
                    header('location: /articulos');
                }
            }
        }

        $router->render('articulos/actualizar', [
            'articulo' => $articulo,
            'errores' => $errores
        ]);
    }

    public static function eliminar(Router $router) {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Leer el id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            // peticiones validas
            if($id) {
                // encontrar y eliminar la propiedad
                $articulo = Articulo::find($id);
                $resultado = $articulo->eliminar();

                // Redireccionar
                if($resultado) {
                    header('location: /articulos');
                }
            }
        }
    }
}