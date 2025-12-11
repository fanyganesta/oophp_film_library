<?php 
    namespace Middleware;

    class AdminMiddleware{
        public static function handling(){
            session_start();
            if($_SESSION['user']['role'] != 'admin'){
                return redirect('/film-list?error=Anda tidak memiliki akses');
            }
            return true;
        }
    }