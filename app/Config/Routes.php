<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(false);

$routes->get('/', 'Home::index');
$routes->get('/login', 'auth::index');
$routes->post('/login', 'auth::login');
$routes->get('/logout', 'auth::logout');

$routes->get('/forgot-password', 'auth::forgotPassword');
$routes->post('/forgot-password', 'auth::changePassword');

$routes->get('/register', 'auth::registerView');
$routes->post('/register', 'auth::register');
$routes->presenter('user');
$routes->post('/user/update-password/(:num)', 'User::updatePassword/$1');
$routes->presenter('game');
$routes->presenter('topup');
$routes->presenter('transaction');
