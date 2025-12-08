<?php 
    require 'autoload.php';

    use Helpers\Route;
    use Controller\FilmController;
    
    $route = new Route;

    $route->get('/', function(){
        return view('home');
    });

    $route->get('/film-list', [new FilmController, 'index']);
    $route->get('/film-edit', [new FilmController, 'edit']);
    $route->post('/film-edit-save', [new FilmController, 'editSave']);
    $route->get('/film-hapus-data', [new FilmController, 'hapusData']);

    $route->dispatch();
    