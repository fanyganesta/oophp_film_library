<?php 
    namespace Database;

    class Database {
        protected $hostname = 'localhost', 
                $username = 'root', 
                $password = '', 
                $dbName = 'oophp_film_library', 
                $conn;

        public function __CONSTRUCT(){
            return $this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbName);
        }

        public function createTable($query){
            // $prepQuery = $this->conn->prepare($query){

            // }
        }

        public function query($query, $datas = []){
            $paramTypes = $this->countParam($query);
            $request = explode(' ', $query)[0];

            $prepQuery = $this->conn->prepare($query);
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
            return $this->conn;
        }
    }