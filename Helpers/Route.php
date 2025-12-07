<?php 
    
    // $url = $_GET['url'];
    $url = $_GET['url'] ?? null;
    if(empty($url)){
        return view('home');
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

    function href($href){
        $url = "/oophp_film_library$href";
        return $url;
    }