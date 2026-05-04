<?php

$routes->group(
    'dashboard', 
    ['namespace' => 'Modules\Dashboard\Controllers', 
    'filter' => 'authGuard'], function($routes){
        $routes->get('/', 'DashboardController::index');
        $routes->post('getData', 'DashboardController::fetchData');
        $routes->get('getReport', 'DashboardController::getReportBySales');
    }
);