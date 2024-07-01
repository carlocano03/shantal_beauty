<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-light" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Change Life Christian</title>

    <meta name="description" content="" />


    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/images/clc.png');?>" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/boxicons.css');?>" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/css/core.css');?>" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/css/theme-default.css');?>"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= base_url('assets/css/custom-style.css');?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/jquery.toast.css');?>" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css');?>" />

    <link rel="stylesheet" href="<?= base_url('assets/vendor/libs/apex-charts/apex-charts.css');?>" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="<?= base_url('assets/vendor/js/helpers.js');?>"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?= base_url('assets/js/config.js');?>"></script>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?= base_url('assets/vendor/libs/jquery/jquery.js');?>"></script>
    <script src="<?= base_url('assets/vendor/libs/popper/popper.js');?>"></script>
    <script src="<?= base_url('assets/vendor/js/bootstrap.js');?>"></script>
    <script src="<?= base_url('assets/js/jquery.toast.js');?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
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

    <?php
  	$this->load->view('admin_portal/partial/_sidebar');
    $this->load->view('admin_portal/partial/_navbar');
?>