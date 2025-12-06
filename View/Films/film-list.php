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

    <table>
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
            <?php $i = 1; foreach ($rows as $row) : ?>
            <tr>
                <td><?= $i ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>