<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="To have a growing Church that demonstrate True Christian Community And To Lead People into Life Changing Relationship with Jesus Christ.">
    <meta property="og:title" content="Change Life Christian Church" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://changelifechristianchurch.org/" />
    <title><?= $title?></title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/clc.png')?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/home.css'); ?>">
    <link href="https://pbutcher.uk/flipdown/css/flipdown/flipdown.css" rel="stylesheet" />
    <script src="<?= base_url('assets/vendor/libs/jquery/jquery.js');?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/js/registration.js')?>"></script>
    <!--   CSRF Token   -->
    <script src="<?php echo base_url('assets/js/csrf_generator.js'); ?>"></script>
    <script>
    var csrf_token_name = "<?php echo $this->security->get_csrf_token_name(); ?>";
    var csrf_token_value = "<?php echo $this->security->get_csrf_hash(); ?>";
    var baseURL = "<?= base_url();?>";
    </script>
    <?php
        // Load specified header library
        if (isset($header_contents)) {
            foreach ($header_contents as $header_cont) :
            echo $header_cont . "\n";
            endforeach;
        }
    ?>
</head>

<body>