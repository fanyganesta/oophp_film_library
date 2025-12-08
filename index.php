<?php 
    require 'autoload.php';

    use Helpers\Route;
    use Controller\FilmController;
    
    $route = new Route;

    $route->get('/', function(){
        return view('home');
    });
    $route->get('/film-list', [new FilmController, 'index']);

    $route->dispatch();
    