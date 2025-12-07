<?php
    namespace Controller;
    use Database\Database;

    class FilmController{
        protected $table = 'films', $conn;

        public function __CONSTRUCT(){
            return $this->conn = new Database();
        }

        public function index($request = []){
            $limit = 10;
            
            if(!isset($request['halaman']) || $request['halaman'] <= 0){
                $halamanAktif = 1;
            }else{
                $halamanAktif = $request['halaman'];
            }

            $queryAll = "SELECT * FROM $this->table";
            $rows = $this->conn->query($queryAll);
            $jumlahHalaman = ceil(count($rows)/$limit);

            $index = $halamanAktif * $limit - $limit;
            $queryPagination = "SELECT * FROM $this->table LIMIT $index, $limit";
            $rows = $this->conn->query($queryPagination);
            $result = [];
            foreach($rows as $row){
                $row += ['halamanAktif' => $halamanAktif, 'jumlahHalaman' => $jumlahHalaman];
                $result[] = $row;
            }
            $rows = $result;
            return view('Films/film-list', compact('rows'));
        }


    }