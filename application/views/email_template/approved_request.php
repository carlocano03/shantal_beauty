<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approved Request</title>
</head>
<body>
    <p>Dear <?= $name_to ?>,</p>
    <br>

    <p>We are pleased to inform you that your request for a scholarship has been approved.</p>
    <br>
    <p><b>Login Details:</b></p>
    <p>To access the <b>School Unity Portal,</b> please log in to our system using the following credentials:</p>
    <p><b>Login URL: </b> <?= $login_url;?></p>
    <p><b>Username: </b> <?= $username;?></p>
    <p><b>Password: </b> <?= $password;?></p>

    <p>We believe in your potential and are excited to support your educational journey. If you have any questions or need further information, please don't hesitate to contact us at [Contact Information].</p>
    <br>
    <p>Once again, congratulations! We look forward to your continued success.</p>
    <hr>
    <p>Thank You.</p>
    <b>Change Life Christian Church</b><br>
    <p>*** This is a system-generated message. <b>DO NOT REPLY TO THIS EMAIL. ***</b></p>
</body>
</html>
