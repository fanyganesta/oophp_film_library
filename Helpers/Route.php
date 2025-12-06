<?php 
    
    $url = $_GET['url'];
    if(empty($url)){
        return View('home');
    }
    
    $routeList = [
        'film-list' => ['FilmController','index']
    ];

    $getRoute = $routeList[$url][0];
    $getMethod = $routeList[$url][1];

    function Route($request, $method){
        $className = 'Controller\\'.$request;
        $controller = new $className();
        $result = $controller->$method();
        return $result;
    }