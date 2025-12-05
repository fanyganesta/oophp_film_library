<?php 
    spl_autoload_register(function( $class ){
        $file = str_replace('\\', '/', $class);
        require_once $file . '.php';
    });

    $helpers = [
        'Redirect.php'
    ];

    foreach($helpers as $helper){
        require_once 'Helpers/' . $helper;
    }