<?php 
    namespace Database;

    class Database {
        protected $hostname = 'localhost', 
                $username = 'root', 
                $password = '', 
                $dbName = 'oophp_film_library';

        private static $conn, $instance = null;

        public function __CONSTRUCT(){
            self::$conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbName);
        }

        public function createTable($query){
            // $prepQuery = $this->conn->prepare($query){

            // }
        }

        public function query($query, $datas = []){
            $paramTypes = $this->countParam($query);
            $request = explode(' ', $query)[0];

            $prepQuery = self::$conn->prepare($query);
            if(!$prepQuery){
                echo "<p style='color:red'>Gagal menyiapkan query</p>"; die;
            }elseif($paramTypes != 0){
                $prepQuery->bind_param($paramTypes, ...$datas);
            }
            $result = $prepQuery->execute();
            if($request == 'SELECT'){
                $rows = $prepQuery->get_result();
                $result = [];
                while($row = $rows->fetch_assoc()){
                    $result[] = $row;
                }
            }
            return $result;
        }

        private function countParam($query){
            $count = substr_count($query, '?');
            if($count == 0){
                return 0;
            }
            $paramType = '';
            for($i = 0; $i < $count; $i++){
                $paramType .= 's';
            }
            return $paramType;
        }

        public function getConn(){
            return self::$conn;
        }

        public function fileProcessing($request){
            $rawName = $request['name'];
            $size = $request['size'];
            $exploade = explode('.', $rawName);
            $extention = end($exploade);
            $namaFile = uniqid($exploade[0]) . '.' .$extention;
            $tmpName = $request['tmp_name'];
            if(strtolower($extention) != 'webp'){
                return redirect('/film-list?error=Gambar tidak diperbolehkan!');
            }elseif($size >= 100000){
                return redirect('/film-list?error=Ukuran terlalu besar!');
            }
            move_uploaded_file($tmpName, __DIR__ . '/../Components/img/'.$namaFile);
            return $namaFile;
        }

        public static function getInstance(){
            if(self::$instance == null){
                self::$instance = new Database();
            }
            return self::$instance;
        }
    }