<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="Components/css-index.css">
</head>
<body>
    <?php include "Components/infoFeedback.php"?>
    <h1> Selamat Datang. Silahkan login dahulu!</h1>
    <form method="POST" action="<?= href('/login')?>">
        <table>
            <tr>
                <td><label for="username">Username</label></td>
                <td>: <input type="text" name="username" id="username"></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td>: <input type="password" name="password" id="password"></td>
            </tr>
            <tr>
                <td class="ct" colspan="2">
                    <input type="checkbox" name="rememberme" id="rememberme">
                    <label for="rememberme"> Remember Me</label>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="ct">
                    <button type="submit">Login</button>
                </td>
            </tr>
            <tr>
                <td class="ct" colspan="2">
                    <p class="inline">Belum punya akun? 
                    <a href="<?= href('/register')?>"> Daftar disini</p>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>