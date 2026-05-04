<?php

// $routes->get('/login', '\Modules\Authentication\Controllers\AuthController::index');
$routes->group('login', ['namespace' => 'Modules\Authentication\Controllers'], function($routes){
    $routes->get('/', 'AuthController::index');
    $routes->post('process', 'AuthController::process');
});
$routes->get('/logout', '\Modules\Authentication\Controllers\AuthController::logout');