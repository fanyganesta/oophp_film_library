<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Film</title>
    <link rel="stylesheet" href="Components/css-index.css">
</head>
<body>
    <h1>Tambah Film Baru</h1>
    <a href="<?= href('/film-list')?>"> Kembali ke list film</a>
    <br><br>

    <form action="<?= href('/film-baru-save')?>" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="judul">Judul :</label></td>
                <td><input type="text" id="judul" name="judul" size="35"></td>
            </tr>
            <tr>
                <td><label for="deskripsi">Deskripsi :</label></td>
                <td><textarea id="deskripsi" name="deskripsi" cols="32" rows="10"></textarea></td>
            </tr>
            <tr>
                <td><label for="tahunTerbit">Tahun Terbit :</label></td>
                <td><input type="text" id="tahunTerbit" name="tahunTerbit"></td>
            </tr>
            <tr>
                <td><label for="rating">Rating :</label></td>
                <td><input type="text" id="rating" name="rating"></td>
            </tr>
            <tr>
                <td><label for="foto">Upload cover :</label></td>
                <td><input type="file" id="foto" name="foto"></td>
            </tr>
            <tr>
                <td colspan="2" class="ct">
                    <button type="submit">Tambah</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>