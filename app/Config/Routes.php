<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\LoginController;
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
});

// PDF
$routes->get('/pdf/(:num)', 'PdfController::generatePdf/$1'); 