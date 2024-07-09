<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\LoginController;
use App\Controllers\PdfController;
use App\Controllers\UserController;

/**
 * @var RouteCollection $routes
 */

$routes->get('/login', 'LoginController::index');
$routes->get('/logout', 'LoginController::logout');
$routes->post('/autentificar', 'LoginController::autentificar');



$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('users', 'UserController::showUsers');
    $routes->get('user-by-rut/(:segment)', 'UserController::showUserByRut/$1');
    $routes->get('permisos/(:segment)', 'LoginController::permisos/$1');
    $routes->get('/cambioClave', 'LoginController::cambioClave');
    $routes->post('/actualizacionClave', 'LoginController::actualizacionClave');
    $routes->get('/pdf/(:num)', 'PdfController::generatePdf/$1');
    //muestra la informacion de las solicitudes realizadas por /feriadoLegal
    $routes->get('solicitudes', 'FormularioController::showSolicitud');
    $routes->get('/obtenerSfl/(:num)', 'FormularioController::obtenerSfl/$1');

    $routes->get('/feriadoLegal', 'FormularioController::enviarInformacionSfl');

    //Formularios
    $routes->get('/formulario_F40201', 'FormularioController::formulario_F40201');
    $routes->get('/formulario_F40202', 'FormularioController::formulario_F40202');
    $routes->get('/formulario_F40203', 'FormularioController::formulario_F40203');
    $routes->get('/formulario_F40204_F40205', 'FormularioController::formulario_F40204_F40205');
    $routes->get('/formulario_F40206', 'FormularioController::formulario_F40206');
    $routes->get('/formulario_F40207', 'FormularioController::formulario_F40207');

    $routes->post('/editarSolicitud/(:num)', 'FormularioController::editarSolicitud/$1');
    $routes->post('/solicitar', 'FormularioController::solicitar');

    //muestra la informacion de la bbdd de diasFuncionario
    $routes->get('/getAll', 'DiasFuncionariosController::getAll');
    $routes->get('/getdias/(:num)', 'DiasFuncionariosController::getDiasByRut/$1');
});
