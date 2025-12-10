<?php 
    namespace Database;

    class Database {
        protected $hostname = 'localhost', 
                $username = 'root', 
                $password = '', 
                $dbName = 'oophp_film_library',
                $charset = 'utf8mb4';

        private static $conn, $instance = null;

        public function __CONSTRUCT(){

            $dsn = "mysql:host=$this->hostname;dbname=$this->dbName;charset=$this->charset";
            $option = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false,
            ];

            self::$conn = new \PDO($dsn, $this->username, $this->password, $option);
        }

        public function createTable($query){
            
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

        public function run($sql, $param = []){
            $stmt = self::$conn->prepare($sql);
            $stmt->execute($param);
            return $stmt;
        }

        public function getAll($sql, $param = []){
            return $this->run($sql, $param)->fetchAll();
        }

        public function getOne($sql, $param = []){
            return $this->run($sql, $param)->fetch();
        }
    }