<?php 
    function view($file, $data = null){
        if($data == null){
            ob_start();
            include 'View/home.php';
            echo ob_get_clean();
            exit;
        }else{
            extract($data);
            
            var_dump($result);die;
        }
    }