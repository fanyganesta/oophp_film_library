<?php 
    require '../../autoload.php';
    use Database\Database;

    $checkTable = "SELECT * FROM information_schema.tables WHERE table_name = 'users' AND table_schema = 'oophp_film_library'";

    $DB = new Database();

        $result = $DB->query($checkTable);
        if(empty($result)){
            $tableUser = "CREATE TABLE users (
            ID INT PRIMARY KEY AUTO_INCREMENT,
            username VARCHAR(100) UNIQUE,
            email VARCHAR(100),
            password VARCHAR(255)
            )";
            $result = $DB->query($tableUser);
        }
        
        $password = password_hash('123', PASSWORD_DEFAULT);
        $dataUsers = "INSERT INTO users VALUES
        ('', 'admin2', 'admin2@gmail.com', '$password'),
        ('', 'guest2', 'guest2@gmail.com', '$password')
        ";
        
        $result = $DB->query($dataUsers);
        if($result){
            echo "<h1 style='color:green'>Berhasil generate users</h1>";
        }else{
            echo "<h1 style='color:red'> Gagal karena kesalahan database</h1>";
        }