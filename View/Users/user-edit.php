<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="Components/css-index.css">
</head>
<body>
    <?php include 'Components/infoFeedback.php';?>
    <h3> Edit User (<?= $row['username']?>)</h3>
    <a href="<?= href('/user-list')?>">Kembali ke list user </a>
    <br><br>

    <form method="POST" action="<?= href('/user-edit')?>">
        <input type="hidden" name="ID" value="<?= $row['ID']?>">
        <input type="hidden" name="oldPassword" value="<?= $row['password']?>">
        <table>
            <tr>
                <td><label for="username">Username</label></td>
                <td>: <input type="text" name="username" id="username" value="<?= $row['username']?>" required> </td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td>: <input type="text" name="email" id="email" value="<?= $row['email']?>" required></td>
            </tr>
            <tr>
                <td><label for="role">Role</label></td>
                <td>: <input type="text" name="role" id="role" value="<?= $row['role']?>" required></td>
            </tr>
            <tr>
                <td><label for="newPassword">New Password</label></td>
                <td>: <input type="password" name="newPassword" id="newPassword"></td>
            </tr>
            <tr>
                <td><label for="confirmPassword">Konfirmasi Password</label></td>
                <td>: <input type="password" name="confirmPassword" id="confirmiPassword"></td>
            </tr>
            <tr>
                <td class="ct" colspan="2">
                    <button type="submit">Perbarui</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>