<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <link rel="stylesheet" href="Components/css-index.css">
</head>
<body>
    <?php include "Components/infoFeedback.php"?>
    <h3> Silahkan masukkan data</h3>
    <form method="POST" action="<?= href('/register')?>">
        <table>
            <tr>
                <td><label for="username">Username</label></td>
                <td>: <input type="text" name="username" id="username" required></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td>: <input type="email" name="email" id="email" required></td>
            </tr>
            <tr>
                <td><label for="role">Role</label></td>
                <td>: <input type="text" name="role" id="role" required></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td>: <input type="password" name="password" id="password" required></td>
            </tr>
            <tr>
                <td><label for="confirmPassword">Konfirmasi Password</label></td>
                <td>: <input type="password" name="confirmPassword" id="confirmPassword" required></td>
            </tr>
            <tr>
                <td colspan="2" class="ct">
                    <button type="submit">Daftar</button>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="ct">
                    <p class="inline"> Sudah punya akun? <a href="<?= href('/login')?>">Log in</a></p>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>