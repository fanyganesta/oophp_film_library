<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="Components/css-index.css">

</head>
<body>
    <?php require 'Components/infoFeedback.php'?>
    <h3>User List</h3>
    <a href="<?= href('/film-list')?>">Kembali ke film list</a>
    <br><br>
    <table class="br">
        <?php if(!empty($rows)) : ?>
            <tr>
                <th>No.</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            <?php $i = 1; foreach($rows as $row) : ?>
                <tr>
                    <td class="ct"><?= $i?></td>
                    <td><?= $row['username']?></td>
                    <td><?= $row['email']?></td>
                    <td class="ct"><?= $row['role']?></td>
                    <td class="ct">
                        <a href="<?= href("/user-edit?ID={$row['ID']}")?>">Edit</a>
                        <p class="inline">|</p>
                        <a href="<?= href("/user-hapus?ID={$row['ID']}")?>">Hapus</a>
                    </td>
                </tr>
            <?php $i++; endforeach ?>
            <?php if($jumlahHalaman > 1) : ?>
                <tr>
                    <td colspan="5" class="ct">
                        <?php include 'Components/pagination.php'?>
                    </td>
                </tr>
            <?php endif ?>
        <?php else : ?>
            <tr>
                <th> Data tidak ditemukan </th>
            </tr>
        <?php endif ?>

    </table>
    
</body>
</html>