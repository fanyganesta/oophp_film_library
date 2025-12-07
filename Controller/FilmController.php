<?php
    namespace Controller;
    use Database\Database;

    class FilmController{
        protected $table = 'films', $conn;

        public function __CONSTRUCT(){
            return $this->conn = new Database();
        }

        public function index(){
            $query = "SELECT * FROM $this->table";
            $rows = $this->conn->query($query);
            return view('Films/film-list', compact('rows'));
        }


    }