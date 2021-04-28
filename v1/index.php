<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__. '/../config/db.php';


$app = AppFactory::create();

$app->setBasePath("/SlimApi/v1");
// Add error middleware
//$app->addErrorMiddleware(true, true, true);


$app->get('/', function(Request $request, Response $response){

    $message = [
        "message" => "Thank God you're here! We've been waiting for you!",
        "data" => true
    ];

    $response->getBody()->write(json_encode($message));
    return $response;

});


$app->get('/register', function(Request $request, Response $response){

    $response->getBody()->write("Hello, World");
    return $response;

});

$app->post('/login', function(Request $request, Response $response){

    $response->getBody()->write("Hello, World");
    return $response;

});

$app->post('/user/add', function(Request $request, Response $response){

    $response->getBody()->write("Hello, World");
    return $response;

});

$app->put('/user/update', function(Request $request, Response $response){

    $response->getBody()->write("Hello, World");
    return $response;

});

$app->delete('/user/delete', function(Request $request, Response $response){

    $response->getBody()->write("Hello, World");
    return $response;

});

$app->get('/users', function(Request $request, Response $response){

    $response->getBody()->write("Hello, World");
    return $response;

});

$app->post('/password/reset', function(Request $request, Response $response){

    $response->getBody()->write("Hello, World");
    return $response;

});

$app->run();


