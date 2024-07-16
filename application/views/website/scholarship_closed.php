<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarship Closed</title>
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
        padding: 32px 24px;
        max-width: 500px;
        width: 100%;
    }

    h1 {
        color: #dc2626;
        font-size: 28px;
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
        width: 8rem;
        height: 8rem;
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
    </style>
</head>

<body>
    <div class="container">
        <img class="navbar__logo rounded-circle" src="<?= base_url('assets/images/clc.jpg')?>" alt="" />
        <h1>Scholarship Registration Closed</h1>
        <p>We regret to inform you that the registration for the scholarship program is currently closed. We appreciate
            your interest and encourage you to check back for future opportunities.</p>
        <p>For any inquiries or further assistance, please contact <span
                class="contact-info">cclc_sample@gmail.com</span>.</p>
        <p>Thank you for your understanding and support.</p>
        <div class="py-3">
            <a href="<?= base_url(); ?>" class="back-button">Go Back</a>

        </div>
    </div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            window.location.href = "<?= base_url()?>";
        }, 3000);
    });
</script>

</html>