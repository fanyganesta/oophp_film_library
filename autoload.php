<?php 
    spl_autoload_register(function( $class ){
        $file = str_replace('\\', '/', $class);
        require_once $file . '.php';
    });

    $helpers = [
        'Redirect.php',
        'View.php',
        'Route.php',
        'Link.php',
        'CekLogin.php'
    ];

    foreach($helpers as $helper){
        require_once 'Helpers/' . $helper;
    }