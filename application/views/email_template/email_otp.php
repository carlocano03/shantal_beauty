<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
</head>
<body>
    Dear <?= $name_to ?>,<br>
    We have received a request to verify your email address. Please use the following OTP to complete the verification process:<br><br>
    <b>OTP:</b> <?= $otp_no ?><br>

    <hr>
    Thank You.<br>
    <b>Change Life Christian Church</b><br><br>
    *** This is a system-generated message. <b>DO NOT REPLY TO THIS EMAIL. ***</b>
</body>
</html>
