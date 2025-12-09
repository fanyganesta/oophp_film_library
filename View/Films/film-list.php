<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film List</title>
    <link rel="stylesheet" href="Components/css-index.css">
</head>
<body>
    <?php require __DIR__ . "/../../Components/infoFeedback.php"?>
    <?php checkLogin();?>

    <h1>List Film</h1>

    <?php if(checkRole() == 'admin') : ?>
        <a href="<?= href('/tambah-film')?>">Tambah film</a>
        <p class="inline">|</p>
    <?php endif ?>
    <a href="<?= href('/logout')?>">Keluar</a>
    <br><br>

    <form action="<?php href('/film-list') ?>" method="GET">
        <label for="cari">Cari Film:</label>
        <input type="text" name="cari" id="cari" value="<?= $_GET['cari'] ?? null ?>">
        <button type="submit">Cari</button>
    </form>

    <br>


    <table class="br">
        <thead>
            <tr>
                <th>No.</th>
                <th>Foto</th>
                <th>Judul Film</th>
                <th>Deskripsi</th>
                <th>Tahun Terbit</th>
                <th>Rating</th>
                <?php if(checkRole() == 'admin') : ?>
                    <th>Action</th>
                <?php endif ?>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; foreach($rows as $row) : ?>
            <tr>
                <td class="ct"><?= $i ?></td>
                <td class="ct">
                    <?php if(empty($row['foto'])) : ?>
                        <p><i> (Gambar belum di upload) </i></p>
                    <?php else : ?>
                        <img src="Components/img/<?= $row['foto'] ?>" width="150px">
                    <?php endif ?>
                </td>
                <td class="ct"><?= $row['judul'] ?></td>
                <td width="40%"><?= $row['deskripsi'] ?></td>
                <td class="ct"><?= $row['tahunTerbit'] ?></td>
                <td class="ct"><?= $row['rating'] ?></td>
                <?php if(checkRole() == 'admin') : ?>
                    <td class="ct">
                        <a href="<?= href('/film-edit?ID='.$row['ID'])?>">Edit</a>
                        <p class="inline">|</p>
                        <a href="<?= href('/film-hapus-data?ID='.$row['ID'])?>" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</a>
                    </td>
                <?php endif ?>
            </tr>
            <?php $i++; endforeach ?>

            <?php if($jumlahHalaman > 1) :?>
                <tr>
                    <td colspan="7" class="ct">
                        <?php include 'Components/pagination.php';?>
                    </td>
                </tr>
            <?php endif?>
        </tbody>
    </table>
</body>
</html>