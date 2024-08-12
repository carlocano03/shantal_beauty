<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Credentials</title>
</head>
<body>
    <p>Dear <?= $name_to ?>,</p>
    <br>

    <p>Welcome to Change Life Christian Church!</p>
    <br>
    <p>We received a request to reset your password for your account at Change Life Christian Church.</p>
    <br>
    <p><b>Account Credentials:</b></p>
    <p><b>Login URL: </b> <?= $login_url;?></p>
    <p><b>Username: </b> <?= $username;?></p>
    <p><b>Password: </b> <?= $password;?></p>

    <p>Please note that for security reasons, we recommend changing your password upon your first login. </p>
    <br>
    <p>We look forward to your active participation and engagement.</p>
    <hr>
    <p>Thank You.</p>
    <b>Change Life Christian Church</b><br>
    <p>*** This is a system-generated message. <b>DO NOT REPLY TO THIS EMAIL. ***</b></p>
</body>
</html>