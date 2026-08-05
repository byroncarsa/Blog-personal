<?php

namespace Controllers;
use MVC\Router;
use Model\Articulo;

class PaginasController {

    public static function index( Router $router ) {

        $articulos = Articulo::get(3);

        $router->render('paginas/index', [
            'articulos' => $articulos
        ]);
    }


    public static function articulo(Router $router) {
        $id = validarORedireccionar('/articulos');

        // Obtener los datos de la propiedad
        $articulo = Articulo::find($id);

        $router->render('paginas/articulo', [
            'articulo' => $articulo
        ]);
    }
}