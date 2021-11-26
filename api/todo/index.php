<?php
try {
    require_once("../todo.controller.php");
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode( '/', $uri);
    $requestType = $_SERVER['REQUEST_METHOD'];
    
    $controller = new TodoController();
    
    switch($requestType) {
        case 'GET':
            if (isset($uri[3]) && strlen($uri[3])) {
                $todo = $controller->load($uri[3]);
                if ($todo) {
                    http_response_code(200);
                    die(json_encode($todo));
                }
                http_response_code(404);
                die();
            } else {
                http_response_code(200);
                die(json_encode($controller->loadAll()));
            }
            break;
        case 'POST':
            //implement your code here
            break;
        case 'PUT':
            //implement your code here
            break;
        case 'DELETE':
            //implement your code here
            break;
        default:
            http_response_code(501);
            die();
            break;
    }
} catch(Throwable $e) {
    error_log($e->getMessage());
    http_response_code(500);
    die();
}
