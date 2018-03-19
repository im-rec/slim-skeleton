<?php

use Dopesong\Slim\Error\Whoops as WhoopsError;

// DIC configuration
$container = $app->getContainer();

// // Inject Service Provider ke DI Container
// $container->register(new \Bootstrap\Provider\PDO_berrybenka());
// $container->register(new \Bootstrap\Provider\PDO_wms());
$container->register(new \Bootstrap\Provider\PDO_onedeca());
$container->register(new \Bootstrap\Provider\Redis_cache());

// Set DI Cache ke library custom redis
$container['cache'] = function ($c) {
    return new Lib\RedisLib($c);
};

// Infrastructure error handle
$container['errorHandler'] = function ($c) {
    $env = getenv("APP_ENV");
    if ($env != "production") {
        return new WhoopsError($c->get('settings')['displayErrorDetails']);
    } else {
        return function ($request, $response) use ($c) {
            return $c->get('response')->withStatus(500)
                ->withHeader('Content-Type', 'application/json')
                ->write(json_encode(['status'=>false, 'messages'=>'Whoops, looks like something went wrong.']));
        };
    }
};

// Spesific PHP Error Handler
$container['phpErrorHandler'] = function ($c) {
    $env = getenv("APP_ENV");
    if ($env != "production") {
        return new WhoopsError($c->get('settings')['displayErrorDetails']);
    } else {
        return function ($request, $response) use ($c) {
            return $c->get('response')->withStatus(500)
                ->withHeader('Content-Type', 'application/json')
                ->write(json_encode(['status'=>false, 'messages'=>'Whoops, looks like something went wrong.']));
        };
    }
};

//Override the default Not Found Handler
$container['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        $_SESSION["last_url"] = $_SERVER["REQUEST_METHOD"] . " - " . $_SERVER["REQUEST_URI"];
        
        return $c->get('response')->withStatus(404)
                ->withHeader('Content-Type', 'application/json')
                ->write(json_encode(['status'=>false, 'message'=>'Error, Page not found.']));
    };
};

//Override the default Not Found Handler
$container['notAllowedHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        $_SESSION["last_url"] = $_SERVER["REQUEST_METHOD"] . " - " . $_SERVER["REQUEST_URI"];

        return $c->get('response')->withStatus(405)
                ->withHeader('Content-Type', 'application/json')
                ->write(json_encode(['status'=>false, 'message'=>'Method Not Allowed.']));
    };
};

$container['validator'] = function ($c) {
    return new \Bootstrap\Validator\Validator();
};
