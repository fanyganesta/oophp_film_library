<?php 
    require 'autoload.php';

    use Helpers\Route;
    use Controller\FilmController;
    use Controller\UserController;
    
    $route = new Route;

    $route->get('/', function(){
        return view('home');
    });

    $route->get('/film-list', [new FilmController, 'index'], ['auth']);
    $route->get('/film-edit', [new FilmController, 'edit']);
    $route->post('/film-edit-save', [new FilmController, 'editSave']);
    $route->get('/film-hapus-data', [new FilmController, 'hapusData']);
    $route->get('/tambah-film', [new FilmController, 'tambahData']);
    $route->POST('/film-baru-save', [new FilmController, 'saveData']);

    $route->get('/login', [new UserController, 'getLogin']);
    $route->post('/login', [new UserController, 'login']);
    $route->get('/logout', [new UserController, 'logout']);
    $route->get('/register', [new UserController, 'getRegister']);
    $route->post('/register', [new UserController, 'register']);
    $route->get('/user-list', [new UserController, 'getList']);
    $route->get('/user-edit', [new UserController, 'getEdit']);
    $route->get('/user-hapus', [new UserController, 'delete']);
    
    $route->dispatch();
    