<?php 
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\ArticuloController;
use Controllers\PaginasController;
use Controllers\LoginController;

$router = new Router();

$router->get('/', [PaginasController::class, 'index']);
$router->get('/articulo', [PaginasController::class, 'articulo']);

$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

$router->get('/articulos', [ArticuloController::class, 'index']);
$router->get('/articulos/crear', [ArticuloController::class, 'crear']);
$router->post('/articulos/crear', [ArticuloController::class, 'crear']);
$router->get('/articulos/actualizar', [ArticuloController::class, 'actualizar']);
$router->post('/articulos/actualizar', [ArticuloController::class, 'actualizar']);
$router->post('/articulos/eliminar', [ArticuloController::class, 'eliminar']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();