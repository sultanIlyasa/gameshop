<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(false);

$routes->get('/', 'Home::index');
$routes->get('/login', 'auth::index', ['filter' => 'isLogin']);
$routes->post('/login', 'auth::login', ['filter' => 'isLogin']);
$routes->get('/logout', 'auth::logout');

$routes->get('/forgot-password', 'auth::forgotPassword', ['filter' => 'isLogin']);
$routes->post('/forgot-password', 'auth::changePassword', ['filter' => 'isLogin']);

$routes->post('/checkout/(:segment)', 'Checkout::index/$1', ['filter' => 'auth']);

$routes->get('/register', 'auth::registerView', ['filter' => 'isLogin']);
$routes->post('/register', 'auth::register', ['filter' => 'isLogin']);
$routes->presenter('user', ['filter' => 'isAdmin']);
$routes->post('/user/update-password/(:num)', 'User::updatePassword/$1', ['filter' => 'isAdmin']);
$routes->presenter('game', ['filter' => 'isAdmin']);
$routes->presenter('topup', ['filter' => 'isAdmin']);
$routes->presenter('transaction', ['filter' => 'isAdmin']);
$routes->presenter('profile', ['filter' => 'auth']);
$routes->post('/profile/update-password/(:num)', 'Profile::updatePassword/$1', ['filter' => 'auth']);
$routes->get("/(:segment)", 'Home::show/$1');
