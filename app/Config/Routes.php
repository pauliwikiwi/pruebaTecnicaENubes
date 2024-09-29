<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/filter_room', 'RoomController::filter_room');
$routes->get('/rooms', 'RoomController::getAllRooms');

/*Rutas de autenticación*/
$routes->get('login', 'LoginController::index');
$routes->post('login/authenticate', 'LoginController::authenticate');
$routes->get('register', 'RegisterController::index');
$routes->post('register/save', 'RegisterController::save');
$routes->get('forgot_password', 'ForgotPasswordController::index');
$routes->post('forgot_password/sendEmail', 'ForgotPasswordController::sendEmail');
