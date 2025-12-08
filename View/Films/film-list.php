<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film List</title>
    <link rel="stylesheet" href="Components/css-index.css">
</head>
<body>
    <h1>List Film</h1>

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
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; foreach($rows as $row) : ?>
            <tr>
                <td class="ct"><?= $row['ID'] ?></td>
                <td class="ct">
                    <?php if(empty($row['foto'])) : ?>
                        <p><i> (Gambar belum di upload) </i></p>
                    <?php else : ?>
                        <img src="../../assets/img/<?= $row['foto'] ?>">
                    <?php endif ?>
                </td>
                <td class="ct"><?= $row['judul'] ?></td>
                <td width="50%"><?= $row['deskripsi'] ?></td>
                <td class="ct"><?= $row['tahunTerbit'] ?></td>
                <td class="ct"><?= $row['rating'] ?></td>
            </tr>
            <?php $i++; endforeach ?>

            <?php if($jumlahHalaman > 1) :?>
                <tr>
                    <td colspan="6" class="ct">
                        <?php include 'Components/pagination.php';?>
                    </td>
                </tr>
            <?php endif?>
        </tbody>
    </table>
</body>
</html>