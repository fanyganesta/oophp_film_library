<?php 
    namespace Helpers;
    class Route {
        public $routes = [];

        public function get($path, $callback, $middleware = []){
            return $this->routes['GET'][$path] = [
                'callback' => $callback,
                'middleware' => $middleware
            ];
        } 

        public function post($path, $callback, $middleware = []){
            return $this->routes['POST'][$path] = [
                'callback' => $callback,
                'middleware' => $middleware
            ];
        }

        public function dispatch(){
            $url = $_GET['url'] ?? null;
            $url = '/' . trim($url, '/');
            $method = $_SERVER['REQUEST_METHOD'];

            foreach($this->routes[$method] as $path => $datas){
                
                if($url == $path){

                    foreach($datas['middleware'] as $mw){
                        $className = 'Middleware\\' . ucfirst($mw).'Middleware';
                        $className::handling();
                    }
                    return call_user_func($datas['callback']);
                }
            }

            echo 'Error 404, Not Found';

        }
    }
