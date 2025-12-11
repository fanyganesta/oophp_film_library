<?php 
    namespace Controller;
    use Database\Database;

    class UserController{
        
        public function __CONSTRUCT(){
            $this->conn = Database::getInstance();
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

        public function logout(){
            session_start();
            $_SESSION['user'] = '';
            session_destroy();
            setcookie('key', '', time()-3600);
            setcookie('token', '', time()-3600);

            return redirect('/login?message=Anda berhasil keluar!');
        }

        public function getRegister(){
            return view('register');
        }

        public function register(){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $role = $_POST['role'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];

            if($password != $confirmPassword){
                return redirect('/register?error=Password dan Konfirmasi Password tidak sama');
            }

            $password = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (username, email, role, password) VALUES (?,?,?,?)";
            $param = [$username, $email, $role, $password];
            $result = $this->conn->run($query,$param);
            if($result){
                return redirect('/login?message=Akun berhasil terdaftar, silahkan login');
            }else{
                return redirect('/register?error=Akun gagal terdaftar, hubungi admin');
            }
        }

        public function getList(){
            $limit = 2;

            if(!isset($_GET['halaman']) || $_GET['halaman'] < 1){
                $halamanAktif = 1;
            }else{
                $halamanAktif = $_GET['halaman'];
            }

            $queryAll = "SELECT * FROM users WHERE username LIKE ? OR email LIKE ?";
            $cari = (isset($_GET['cari'])) ? '%'.$_GET['cari'].'%' : '%%';
            $datas = [$cari, $cari];

            $allData = $this->conn->getAll($queryAll, $datas);

            $index = $halamanAktif * $limit - $limit;
            $query = $queryAll . " LIMIT $index, $limit";
            $rows = $this->conn->getAll($query, $datas);
            $jumlahHalaman = ceil(count($allData)/$limit);
            return view('Users/user-list', compact('rows', 'jumlahHalaman', 'halamanAktif'));
        }
    }