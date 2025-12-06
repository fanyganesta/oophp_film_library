<?php 
    function View($file, $data = null){
        if($data == null){
            return header("Location: /oophp_film_library/View/{$file}.php");
        }else{
            extract($data);
            
            var_dump($result);die;
        }
    }