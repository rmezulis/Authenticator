<?php

require __DIR__ . '/vendor/autoload.php';

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'HomeController@index');
    $r->addRoute('POST', '/register', 'RegistrationController@store');
    $r->addRoute('POST', '/login', 'AuthorizationController@handle');
    $r->addRoute('GET', '/profile', 'ProfileController@index');
    $r->addRoute('POST', '/profile/edit', 'ProfileController@edit');
    $r->addRoute('GET', '/profile/logout', 'AuthorizationController@logout');
    $r->addRoute('POST', '/profile/attribute', 'ProfileController@storeAttribute');
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo 'PAGE NOT FOUND';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo 'METHOD NOT ALLOWED';
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        [$controller, $method] = explode('@', $handler);
        $controllerPath = '\App\Controllers\\' . $controller;
        echo (new $controllerPath)->{$method}();
        break;
}