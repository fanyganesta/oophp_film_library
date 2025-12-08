<?php
    function redirect($url){
        $url = trim($url, '/');
        header("Location: /oophp_film_library/$url");
        exit;
    }