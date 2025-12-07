<?php 

    $url = $_GET['url'] ?? null;
    if(empty($url) && $_SERVER['REQUEST_URI'] == '/oophp_film_library/'){
        return view('home');
    }elseif(!empty($_GET)){
        $datas = $_GET;
    }elseif(!empty($_POST)){
        $datas = $_POST;
    }
    
    $routeList = [
        'film-list' => ['FilmController','index']
    ];

    $getRoute = $routeList[$url][0] ?? null;
    $getMethod = $routeList[$url][1] ?? null;

    function Route($request, $method){
        global $datas;
        $className = 'Controller\\'.$request;
        $controller = new $className();
        $result = $controller->$method($datas);
        return $result;
    }

    function href($href){
        $url = "/oophp_film_library$href";
        return $url;
    }