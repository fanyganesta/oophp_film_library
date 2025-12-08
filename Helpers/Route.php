<?php 
    namespace Helpers;
    class Route {
        public $routes = [];

        public function get($path, $callback){
            return $this->routes['GET'][$path] = $callback;
        } 

        public function post($path, $callback){
            return $this->routes['POST'][$path] = $callback;
        }

        public function dispatch(){
            $url = $_GET['url'] ?? null;
            $url = '/' . trim($url, '/');
            $method = $_SERVER['REQUEST_METHOD'];

            foreach($this->routes[$method] as $path => $callback){
                if($url == $path){
                    return call_user_func($callback);
                }
            }

            echo 'Error 404, Not Found';

        }
    }
