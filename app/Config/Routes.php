<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('login', 'AuthController::login');
$routes->post('loginProcess', 'AuthController::loginProcess');
$routes->get('logout', 'AuthController::logout');


$routes->get('/', 'Admin\DashboardController::index');

$routes->get('dashboard', 'Admin\DashboardController::index');
$routes->get('produk', 'Admin\ProdukController::index');

$routes->post('produk/store', 'Admin\ProdukController::store');
$routes->post('produk/ubah', 'Admin\ProdukController::ubah');
$routes->get('produk/delete/(:num)', 'Admin\ProdukController::delete/$1');


// API


$routes->post('login_api', 'API\Login::index');
// $routes->get('daftar_produk', 'API\Register::store', ['filter' => 'auth']);
// $routes->post('tambah_produk', 'API\Register::index');
$routes->group('api', ['namespace' => 'App\Controllers\API', 'filter' => 'auth'], function($routes) {
    $routes->get('products', 'ProductController::index'); 
    $routes->get('products/(:num)', 'ProductController::show/$1');
    $routes->post('products_add', 'ProductController::store');  
    $routes->put('products_update/(:num)', 'ProductController::update/$1');  
    $routes->delete('products_delete/(:num)', 'ProductController::delete/$1'); 
});
