<?php
    function redirect($file, $query = []){
        if(empty($query)){
            header("Location: /oophp_film_library/{$file}.php");
            exit;
        }else{
            header("Location: /oophp_film_library/{$file}.php".'?'.$query);
            exit;
        }
    }