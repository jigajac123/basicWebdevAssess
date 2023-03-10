<?php
try {
    require_once("todo.controller.php");
    
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $path = explode( '/', $uri);
    $requestType = $_SERVER['REQUEST_METHOD'];
    $body = file_get_contents('php://input');
    $pathCount = count($path);

    $controller = new TodoController();
    
    switch($requestType) {
        case 'GET':
            if ($path[$pathCount - 2] == 'todo.php' && isset($path[$pathCount - 1]) && strlen($path[$pathCount - 1])) {
                $id = $path[$pathCount - 1];
                $todo = $controller->load($id);
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

            $dt = json_decode(file_get_contents('php://input'));
            
            if($dt != null){
               
               $controller->create(new Todo($dt->id, $dt->title, $dt->description, $dt->done));
               http_response_code(201);
            }
            else{
               http_response_code(400);
            }

            break;
        case 'PUT':
            //implement your code here

            $data = json_decode(file_get_contents('php://input'));
            
            if(!empty($data) ){
                
                if(isset($data->id)){
                $controller->update($data->id, new Todo($data->id, $data->title, $data->description, $data->done));
                http_response_code(200);
                }
                else  http_response_code(404);
               
            }
            else{
               http_response_code(400);
            }

            break;
        case 'DELETE':
            //implement your code here

               
            if ($path[$pathCount - 2] == 'todo.php' && isset($path[$pathCount - 1])) {

                $id=$path[$pathCount - 1];
                $controller->delete($id);
                http_response_code(200);
                
              }
              else{
                  http_response_code(404);
              }
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
