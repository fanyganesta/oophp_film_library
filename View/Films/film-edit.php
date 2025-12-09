<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit data film</title>
    <link rel="stylesheet" href="Components/css-index.css">
</head>
<body>
    <?php checkLogin() ?>
    <h1>Edit film, <?= $row['judul']?></h1>
    <a href="<?= href('/film-list')?>">Kembali ke list film</a>
    <br>
    <br>
    <form action="<?= href('/film-edit-save') ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" value="<?= $row['ID'] ?>" name="ID">
        <input type="hidden" value="<?= $row['foto'] ?>" name="oldImg">
        <table>
            <tr>
                <td class="ct" colspan="2">
                    <?php if(empty($row['foto'])) : ?>
                        <p class="inline" style="margin-left: -20px"> (Foto belum diupload) </p>
                    <?php else : ?>
                        <img src="Components/img/<?= $row['foto'] ?>" width="150px" style="margin-left= -20px">
                    <?php endif ?>
                </td>
            </tr>
            <tr>
                <td> <label for="judul">Judul :</label></td>
                <td><input type="text" id="judul" name="judul" size="35" value="<?= $row['judul']?>" required></td>
            </tr>
            <tr>
                <td><label for="deskripsi">Deskripsi :</label></td>
                <td><textarea name="deskripsi" id="deskripsi" cols="32" rows="10" required><?= $row['deskripsi']?></textarea></td>
            </tr>
            <tr>
                <td><label for="tahunTerbit">Tahun Terbit :</label></td>
                <td><input type="text" id="tahunTerbit" name="tahunTerbit" value="<?= $row['tahunTerbit']?>" required></td>
            </tr>
            <tr>
                <td><label for="rating">Rating :</label></td>
                <td><input type="text" id="rating" name="rating" size="35" value="<?= $row['rating']?>" required></td>
            </tr>
            <tr>
                <td><label for="foto">Upload Cover :</label></td>
                <td><input type="file" name="foto" id="foto"></td>
            </tr>
            <tr>
                <td class="ct" colspan="2">
                    <button type="submit">Update</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>