<?php
include("../todo.class.php");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

$requestType = $_SERVER['REQUEST_METHOD'];

$todo = new Todo();

switch($requestType) {
    case 'GET':
        if (isset($uri[3]) && strlen($uri[3])) {
            http_response_code(200);
            die(json_encode($todo->load($uri[3])));
        } else {
            http_response_code(200);
            die(json_encode($todo->loadAll()));
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
        break;
}

die();