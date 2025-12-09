<?php 
    function checkRole(){
        $role = $_SESSION['user']['role'];
        
        return $role;
    }