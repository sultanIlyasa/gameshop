<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(false);

$routes->get('/', 'Home::index');
$routes->get('/login', 'pages::loginForm');
$routes->get('/register', 'pages::registerForm');
$routes->presenter('user');
$routes->post('/user/update-password/(:num)', 'User::updatePassword/$1');
$routes->presenter('game');
$routes->presenter('topup');
$routes->presenter('transaction');
