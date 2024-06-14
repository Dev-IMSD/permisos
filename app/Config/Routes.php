<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/login', 'LoginController::index');
$routes->post('/autentificar', 'LoginController::autentificar');
$routes->get('/cambioClave', 'LoginController::cambioClave');
$routes->post('/actualizacionClave', 'LoginController::actualizacionClave');

$routes->get('/permisos/(:segment)', 'LoginController::permisos/$1'); 