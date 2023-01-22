<?php
require_once("todo.class.php");

class TodoController {
    private const PATH = __DIR__."/todo.json";
    private array $todos = [];

    public function __construct() {
        $content = file_get_contents(self::PATH);
        if ($content === false) {
            throw new Exception(self::PATH . " does not exist");
        }  
        $dataArray = json_decode($content);
        if (!json_last_error()) {
            foreach($dataArray as $data) {
                if (isset($data->id) && isset($data->title))
                $this->todos[] = new Todo($data->id, $data->title, $data->description, $data->done);
            }
        }
    }

    public function loadAll() : array {
        return $this->todos;
    }

    public function load(string $id) : Todo | bool {
        foreach($this->todos as $todo) {
            if ($todo->id == $id) {
                return $todo;
            }
        }
        return false;
    }

    public function create(Todo $data) : bool {
        // implement your code here

        if (!empty($data)){

            array_push($this->todos, $data);
            $data_to_save=$this->todos;
        
            file_put_contents('todo.json', json_encode($data_to_save, JSON_PRETTY_PRINT| JSON_UNESCAPED_UNICODE));
           
        }
           
        return true;
    }

    public function update(string $id, Todo $item) : bool {
        // implement your code here

        if(isset($id) && !empty($item)){

            foreach($this->todos as $field=>$value){

                if($value->id == $id){
                     
                    foreach($item as $key=>$input){
                    
                        if($input != $value){
                            $this->todos[$field] = $item;
                        }
    
                    }
                }
           }

           file_put_contents('todo.json', json_encode($this->todos, JSON_PRETTY_PRINT| JSON_UNESCAPED_UNICODE));
         
        }
        
        return true;
    }

    public function delete(string $id) : bool {
        // implement your code here

        if(isset($id)){
            $num=-1;
             foreach($this->todos as $field=>$value){
                 $num +=1;
                 if($value->id == $id){ 
                     if(isset($num)){
                      unset($this->todos[$num]);
                     }
                     else{
                         return false;
                     }
                    
                 }
            }
 
            file_put_contents('todo.json', json_encode($this->todos, JSON_PRETTY_PRINT| JSON_UNESCAPED_UNICODE));
         }
         
        return true;
    }

    // add any additional functions you need below
}