<?php
    use Database\Database;
    
    function checkLogin(){

        session_start();
        if(!isset($_SESSION['user']) && isset($_COOKIE['key']) && isset($_COOKIE['token'])){
            $query = "SELECT * FROM users WHERE ID = ?";
            $ID = $_COOKIE['key'];
            $result = Database::getInstance()->query($query, [$ID])[0];
            if(empty($result)){
            return redirect('/login?error=Anda harus login ulang');
        }
        $dbPassword = $result['password'];
        if($dbPassword != $_COOKIE['token']){
            return redirect('/login?error=Anda harus login ulang');
        }
        $_SESSION['user'] = $result;
        return redirect('/film-list?message=Selamat datang kembali!');
        
        }elseif(!isset($_SESSION['user'])){
            return redirect('/login?error=Anda harus login terlebih dahulu');
        }
    }