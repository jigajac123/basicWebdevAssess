<?php

class Todo {
    private const PATH = __DIR__."/todo.json";
    private $todos = [];

    public function __construct() {
        $content = file_get_contents(self::PATH);       
        $data = json_decode($content);
        if (!json_last_error()) {
            $this->todos = $data;
        }
    }

    public function loadAll() : array {
        return $this->todos;
    }

    public function load(string $id) : stdClass {
        // implement your code here
        return $this->todos[0];
    }

    public function update(string $id, $data) : stdClass {
        // implement your code here
        return new stdClass();
    }

    public function delete(string $id) : bool {
        // implement your code here
        return true;
    }
}