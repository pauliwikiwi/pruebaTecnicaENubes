<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/filter_room', 'RoomController::filter_room');
$routes->get('/rooms', 'RoomController::getAllRooms');
$routes->get('/roomsWithoutFilters', 'RoomController::roomsWithoutFilters');
$routes->get('/view_room/(:num)', 'RoomController::getRoomById/$1');

/*Rutas de autenticación*/
$routes->get('/login', 'LoginController::index');
$routes->get('/logout', 'LoginController::logout');
$routes->post('/login/authenticate', 'LoginController::authenticate');
$routes->get('/register', 'RegisterController::index');
$routes->post('/register/save', 'RegisterController::save');
$routes->get('/confirm_email/(:any)', 'RegisterController::confirmarEmail/$1');

$routes->get('/forgot_password', 'ForgotPasswordController::index');
$routes->post('/forgot_password/sendEmail', 'ForgotPasswordController::sendEmail');
$routes->post('/updatePassword', 'ForgotPasswordController::save_new_password');


$routes->group('user', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'ReservationController::index');
    $routes->get('reservation/(:num)', 'ReservationController::getReservationById/$1');
    $routes->get('reservation/edit/(:num)', 'ReservationController::editReservationById/$1');
    $routes->get('reservation/cancel/(:num)', 'ReservationController::cancelReservationById/$1');
    $routes->get('pdf/generate_reservation/(:num)', 'PdfController::generateReservationPDFById/$1');
});