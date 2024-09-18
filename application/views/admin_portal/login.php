<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/admin-login.css'); ?>">
</head>

<body>
    <div class="login-form">
        <div class="icon-container">
            <img class="navbar__logo" src="<?php echo base_url('assets/images/home/shantal-logo.png'); ?>"
                alt="Shantal Beauty">
        </div>
        <h1>Admin Login</h1>
        <form id="adminLoginForm" class="needs-validation" novalidate>
            <div class="mb-3">
                <input type="text" class="form-control" id="username" placeholder="Username" required>
                <div class="invalid-feedback">Please enter your username.</div>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" id="password" placeholder="Password" required>
                <div class="invalid-feedback">Please enter your password.</div>
            </div>
            <button type="button" class="btn btn-black sign-in__btn">Sign In</button>
            <p class="form-text">Forgot your password? <a href="#" class="btn-link">Click here</a></p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById('adminLoginForm');
        const submitButton = document.querySelector('.sign-in__btn');

        submitButton.addEventListener('click', function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        }, false);
    });
    </script>
</body>

</html>
