<?php
    namespace Controller;
    use Database\Database;

    class FilmController{
        protected $table = 'films', $conn;

        public function __CONSTRUCT(){
            return $this->conn = Database::getInstance();
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
            
            $allFinds = $this->conn->getAll($find, [$cari,$cari,$cari,$cari]);
            $queryPagination = $find . " LIMIT $index, $limit";

            $rows = $this->conn->getAll($queryPagination, [$cari,$cari,$cari,$cari]);
            $jumlahHalaman = ceil(count($allFinds)/$limit);
    
            return view('Films/film-list', compact('rows', 'jumlahHalaman', 'halamanAktif'));
        }

        public function edit(){
            $ID = $_GET['ID'];
            $query = "SELECT * FROM films WHERE ID = ?";
            $row = $this->conn->getOne($query, [$ID]);
            return view('Films/film-edit', compact('row'));
        }

        public function editSave(){
            $datas = $_POST;
            $ID = $datas['ID'];
            $judul = $datas['judul'];
            $deskripsi = $datas['deskripsi'];
            $tahunTerbit = $datas['tahunTerbit'];
            $rating = $datas['rating'];
            if($_FILES['foto']['error'] == 4){
                $foto = $datas['oldImg'];
            }else{
                $foto = $this->conn->fileProcessing($_FILES['foto']);
            }

            if(empty($foto)){
                $foto = null;
            }

            $query = "UPDATE films SET judul = ?, deskripsi = ?, tahunTerbit = ?, rating = ?, foto = ? WHERE ID = ?";
            $result = $this->conn->run($query, [$judul, $deskripsi, $tahunTerbit, $rating, $foto, $ID]);

            if($result){
                return redirect('/film-list?message=Berhasil update data');
            }else{
                return redirect('/film-list?error=Gagal merubah data');
            }
        }


        public function hapusData(){
            $ID = $_GET['ID'];
            $query = "DELETE FROM films WHERE ID = ?";
            $result = $this->conn->run($query, [$ID]);
            if($result){
                return redirect('/film-list?message=Data berhasil dihapus');
            }else{
                return redirect('/film-list?Gagal hapus data');
            }
        }


        public function tambahData(){
            return view('Films/tambah-film');
        }

        public function saveData(){
            $judul = $_POST['judul'];
            $deskripsi = $_POST['deskripsi'];
            $tahunTerbit = $_POST['tahunTerbit'];
            $rating = $_POST['rating'];
            $foto = $this->conn->fileProcessing($_FILES['foto']);

            $query = "INSERT INTO $this->table (judul, deskripsi, tahunTerbit, rating, foto) VALUES ( ?, ?, ?, ?, ?)";
            $result = $this->conn->run($query, [$judul, $deskripsi, $tahunTerbit, $rating, $foto]); 
            if($result){
                return redirect('/film-list?message=Data berhasil ditambah');
            }else{
                return redirect('/film-list?error=Gagal menambah data');
            }
        }


        public function getLogin(){
            return view('login');
        }

        public function login(){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $rememberme = $_POST['rememberme'] ?? null;

            $query = "SELECT * FROM users WHERE username = ?";
            $result = $this->conn->getOne($query, [$username]);
            if(empty($result)){
                return redirect('/login?error=Username atau Password salah');
            }
            $dbPassword = $result['password'];
            $verify = password_verify($password, $dbPassword);
            if(!$verify){
                return redirect('/login?error=Username atau Password salah');
            }
            session_start();
            $_SESSION['user'] = $result;

            if(!empty($rememberme)){
                setcookie('key', $result['ID'], time()+3600);
                setcookie('token', $dbPassword, time()+3600);
            }

            return redirect('/film-list?message=Anda berhasil login');
        }

    }