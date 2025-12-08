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

            $queryAll = "SELECT * FROM $this->table";
            $rows = $this->conn->query($queryAll);

            $jumlahHalaman = ceil(count($rows)/$limit);

            $index = $halamanAktif * $limit - $limit;
            if(isset($_GET['cari'])){
                $find = "SELECT * FROM $this->table WHERE judul LIKE ? OR deskripsi LIKE ? OR tahunTerbit LIKE ? OR rating LIKE ?";
                $cari = '%'.$_GET['cari'].'%';

                $allFinds = $this->conn->query($find, [$cari,$cari,$cari,$cari]);
                $queryPagination = $find . " LIMIT $index, $limit";

                $rows = $this->conn->query($queryPagination, [$cari,$cari,$cari,$cari]);
                $jumlahHalaman = ceil(count($allFinds)/$limit);
            }else{
                $queryPagination = "SELECT * FROM $this->table LIMIT $index, $limit";
                $rows = $this->conn->query($queryPagination);
            }

            

            $result = [];
            foreach($rows as $row){
                $row += ['halamanAktif' => $halamanAktif, 'jumlahHalaman' => $jumlahHalaman];
                $result[] = $row;
            }
            $rows = $result;
            return view('Films/film-list', compact('rows', 'jumlahHalaman', 'halamanAktif'));
        }


    }