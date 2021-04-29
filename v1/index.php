<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
//require __DIR__. '/../config/Database.php';
require __DIR__. '/../Service/AuthService.php';
require __DIR__. '/../Service/CrudService.php';


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
    return $response->withHeader('Content-Type','application/json');

});


$app->post('/register', function(Request $request, Response $response){
    $auth = new AuthService();
    $verify = $auth->verifyParam(array('fullname','username','password'));

    

    if ($verify == true){
        $params = (array)$request->getParsedBody();
        $fullname = $params['fullname'];
        $username = $params['username'];
        $password = $params['password'];

        $register = $auth->register($fullname, $username, $password);
        
        if ($register){
            $data =[
                "message" => "User saved successfully",
            ];
            
        }else{
            $data =[
                "message" => "User failed to save",
            ];
        }
  
    }else{
        $data =[
            "message" => "Missing parameters",
        ];
    }

    $response->getBody()->write(json_encode($data));
            return $response->withHeader('Content-type', 'application/json');;

});

$app->post('/login', function(Request $request, Response $response){
    $auth = new AuthService();
    $verify = $auth->verifyParam(array('username','password'));

    if ($verify == true){
        $params = (array)$request->getParsedBody();
        $username = $params['username'];
        $password = $params['password'];

        $login = $auth->login($username, $password);
        
        if ($login){
            $data =[
                "message" => "User logged in successfully",
            ];
            
        }else{
            $data =[
                "message" => "User failed to login",
            ];
        }
  
    }else{
        $data =[
            "message" => "Missing parameters",
        ];
    }

    $response->getBody()->write(json_encode($data));
            return $response->withHeader('Content-type', 'application/json');;

});


$app->post('/user/add', function(Request $request, Response $response){
    $auth = new AuthService();
    $crud = new CrudService();

    $verify = $auth->verifyParam(array('product_name','user_id', 'price'));

    if ($verify == true){
        $params = (array)$request->getParsedBody();
        $product_name = $params['product_name'];
        $user_id = $params['user_id'];
        $price = $params['price'];

        $saveData = $crud->save($product_name, $user_id, $price);
        
        if ($saveData){
            $data =[
                "message" => "Product data saved successfully",
            ];
            
        }else{
            $data =[
                "message" => "Product data failed to save",
            ];
        }
  
    }else{
        $data =[
            "message" => "Missing parameters",
        ];
    }

    $response->getBody()->write(json_encode($data));
            return $response->withHeader('Content-type', 'application/json');;


});

$app->put('/user/update/{id}', function(Request $request, Response $response, array $args){

    $auth = new AuthService();
    $crud = new CrudService();

    $verify = $auth->verifyParam(array('product_name', 'price'));

    if ($verify == true){
        $params = (array)$request->getParsedBody();
        $product_name = $params['product_name'];
        $id = $args['id'];
        $price = $params['price'];

        $updateData = $crud->update($product_name, $id, $price);
        
        if ($updateData){
            $data =[
                "message" => "Product data updated successfully",
            ];
            
        }else{
            $data =[
                "message" => "Product data failed to updated",
            ];
        }
  
    }else{
        $data =[
            "message" => "Missing parameters",
        ];
    }

    $response->getBody()->write(json_encode($data));
            return $response->withHeader('Content-type', 'application/json');;


});

$app->delete('/user/delete/{id}', function(Request $request, Response $response, array $args){

    $crud = new CrudService();

    $id = $args['id'];

    $updateData = $crud->delete($id);
        
        if ($updateData){
            $data =[
                "message" => "Product data deleted successfully",
            ];
            
        }else{
            $data =[
                "message" => "Product data failed to delete",
            ];
        }
  
    

    $response->getBody()->write(json_encode($data));
            return $response->withHeader('Content-type', 'application/json');;


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


