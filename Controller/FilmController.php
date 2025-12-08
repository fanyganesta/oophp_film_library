<?php
    namespace Controller;
    use Database\Database;

    class FilmController{
        protected $table = 'films', $conn;

        public function __CONSTRUCT(){
            return $this->conn = new Database();
        }

        public function index(){
            $request = $_GET;
            $limit = 10;
            
            if(!isset($request['halaman']) || $request['halaman'] <= 0){
                $halamanAktif = 1;
            }else{
                $halamanAktif = $request['halaman'];
            }


            $find = "SELECT * FROM $this->table WHERE judul LIKE ? OR deskripsi LIKE ? OR tahunTerbit LIKE ? OR rating LIKE ?";

            $cari = isset($_GET['cari']) ? '%'.$_GET['cari'].'%' : '%%';
            $index = $halamanAktif * $limit - $limit;

            
            $allFinds = $this->conn->query($find, [$cari,$cari,$cari,$cari]);
            $queryPagination = $find . " LIMIT $index, $limit";

            $rows = $this->conn->query($queryPagination, [$cari,$cari,$cari,$cari]);
            $jumlahHalaman = ceil(count($allFinds)/$limit);
    
            return view('Films/film-list', compact('rows', 'jumlahHalaman', 'halamanAktif'));
        }


    }