<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', function(){
    return redirect()->to('/login');
});

$routes->group('api/v1/mobile', function($routes){
    $routes->post('login', 'Api\V1\AuthController::login');
    $routes->post('refresh', 'Api\V1\AuthController::refresh');
    $routes->post('logout', 'Api\V1\AuthController::logout', ['filter' => 'jwt']);
    $routes->get('reports', 'Api\V1\ReportController::reports', ['filter' => 'jwt']);
});

$pathModules = APPPATH.'Modules/';
if(is_dir($pathModules)){
    $modules = scandir($pathModules);
    foreach($modules as $module){

        if($module === '.' || $module === '..') continue;


        $routesPath = $pathModules . $module . '/Config/Routes.php';
        if(file_exists($routesPath)){
            require $routesPath;
        }
    }
}
