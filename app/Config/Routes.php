<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
<<<<<<< Updated upstream
$routes->get('/login', 'page::loginForm');
$routes->get('/register', 'page::registerForm');
=======
$routes->resource('user');
$routes->post('/user/(:num)', 'User::updatePassword/$1');
$routes->resource('game');
$routes->resource('topup');
$routes->resource('transaction');
>>>>>>> Stashed changes
