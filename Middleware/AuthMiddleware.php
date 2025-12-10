<?php 
    namespace Middleware;

    class AuthMiddleware{
        public static function handling(){
            session_start();
            if(!isset($_SESSION['user'])){
                return redirect('/login?error=Anda tidak memiliki akses, silahkan login dahulu!');
            }
            return true;
        }
    }