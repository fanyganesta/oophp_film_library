<?php 
    require '../../autoload.php';
    use Database\Database;

    $checkFilms = "SELECT * FROM information_schema.tables WHERE table_schema = 'oophp_film_library' AND table_name = 'films'";

    $DB = new Database();
    $result = $DB->query($checkFilms);
    if(empty($result)){
        $query = "CREATE TABLE films (
            ID INT PRIMARY KEY AUTO_INCREMENT,
            judul VARCHAR(100), 
            deskripsi VARCHAR(255),
            tahunTerbit VARCHAR(100),
            rating VARCHAR(100),
            foto VARCHAR(255)
        )";
        $result = $DB->query($query);
        if(!$result){
            echo "<h2 style='color:red'>Gagal membuat table</h2>"; die;
        }
    }
    $query = "INSERT INTO films VALUES
        ('', 'The Shawshank Redemption', 'Dua pria dipenjara membentuk ikatan selama beberapa dekade, menemukan penghiburan dan penebusan melalui tindakan kebaikan bersama.', '1994', '9.3', NULL),
        ('', 'The Godfather', 'Kisah epik keluarga kejahatan Amerika keturunan Italia, berpsat pada Vito Corleone, patriark yang me', '1972', '9.2', NULL),
        ('', 'The Dark Night', 'Batman berpacu dengan waktu untuk menuelamatkan Gotham dari kehancuran yang ditimbulkan oleh teroris', '2008', '9.0', NULL),
        ('', 'Pulp Fiction', 'Kisah-kisah yang saling terkait tentang dua pembunuh bayaran, seorang petinju, istri seorang gangste', '1994', '8.9', NULL),
        ('', 'Forrest Gump', 'Kisah seorang pria polos namin berhati murni yang secara tidak sengaja menyaksikan dan memmengaruhi ', '1994', '8.8', NULL),
        ('', 'Fight Club', 'Seorang pekerja kantoran yang menderita insomnia membentuk klub pertarungan bawah tanah bersama seor', '1999', '8.8', NULL),
        ('', 'Parasite', 'Sebuah keluarga miskin menyususp ke rumah keluarga kaya, tetapi rahasia gelap yang tersembunyi menga', '2019', '8.5', NULL),
        ('', 'Spirited Away', 'Seorang gadis muda pindah ke kota baru dan tersesat di dunia arwah, di mana ia harus bekerja untuk m', '2001', '8.6', NULL),
        ('', 'Interstellar', 'Sekelompok penjelajah melakukan perjalanan melalui lubang cacing untuk mencari planet baru yang dapa', '2014', '8.7', NULL),
        ('', 'Inception', 'Seorang pencuri ulung yang mencuri rahasia perusahaan dari alam bawah sadar seseorang, kini diberi t', '2010', '8.8', NULL)
        ";
    $result = $DB->query($query);
    if($result){
        echo "<h2 style='color:green'>Berhasil tambah data!</h2>"; die;
    }else{
        echo "<h2 style='color:red'>Gagal tambah data!</h2>"; die;
    }