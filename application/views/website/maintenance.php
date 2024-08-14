<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Maintenance</title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/clc.png')?>">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet" />

    <style>
    body {
        font-family: Roboto, sans-serif;
        background: linear-gradient(to right, #434875, #b18647);
        color: #333;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        text-align: center;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 48px 24px;
        max-width: 440px;
        width: 100%;
        position: relative;
    }

    h1 {
        color: #434875;
        font-size: 24px;
        margin-top: 20px;
        line-height: 1.4;
    }

    p {
        color: rgba(88, 82, 73, 0.9);
        margin: 20px 0;
        line-height: 1.7;

    }

    .contact-info {
        color: #337ab7;
    }

    img {
        width: 6rem;
        height: 6rem;
        margin-bottom: 8px;
    }

    .back-button {
        margin-top: 24px;
        padding: 10px 32px;
        background: #434875;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: all .8s;
        text-decoration: none;
    }

    .back-button:hover {
        opacity: 0.8
    }

    .cogwheel-img {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 48px;
        height: 48px;
        opacity: 0.6;
    }
    </style>
</head>

<body>
    <div class="container">
        <img class="navbar__logo rounded-circle" src="<?= base_url('assets/images/clc.jpg')?>" alt="" />
        <h1>Our site is under maintenance</h1>
        <p>Our website is currently undergoing some updates to serve you better. We'll be back online shortly. Thank you
            for your understanding and patience!</p>
   
        <img class="cogwheel-img" src="<?= base_url('assets/images/cogwheel.png')?>" alt="">
    </div>
</body>



</html>