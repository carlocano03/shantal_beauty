<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-light" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>CLCC | Student Portal</title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/images/clc.png');?>" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/boxicons.css');?>" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- Core CSS -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
    /* For WebKit browsers */
    ::-webkit-scrollbar {
        width: 12px;
        /* Width of the scrollbar */
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        /* Background of the scrollbar track */
    }

    ::-webkit-scrollbar-thumb {
        background: #888;
        /* Color of the scrollbar thumb */
        border-radius: 10px;
        /* Rounded corners */
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #555;
        /* Color of the scrollbar thumb when hovered */
    }

    /* For Firefox */
    html {
        scrollbar-width: thin;
        /* 'auto' or 'thin' */
        scrollbar-color: #888 #f1f1f1;
        /* thumb color, track color */
    }

    /* CSS Reset */
    /*
	1. Use a more-intuitive box-sizing model.
  */
    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }

    /*
	  2. Remove default margin
	*/
    * {
        margin: 0;
    }

    /*
	  Typographic tweaks!
	  3. Add accessible line-height
	  4. Improve text rendering
	*/
    body {
        line-height: 1.5;
        -webkit-font-smoothing: antialiased;
    }

    /*
	  5. Improve media defaults
	*/
    img,
    picture,
    video,
    canvas,
    svg {
        display: block;
        max-width: 100%;
    }

    /*
	  6. Remove built-in form typography styles
	*/
    input,
    button,
    textarea,
    select {
        font: inherit;
    }

    /*
	  7. Avoid text overflows
	*/
    p,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        overflow-wrap: break-word;
    }

    p {
        margin: 0;
    }

    /*
	  8. Create a root stacking context
	*/

    #root,
    #__next {
        isolation: isolate;
    }

    ul {
        list-style-type: none;
    }

    li {
        cursor: pointer;
    }

    /* Font */
    .roboto-light {
        font-family: "Roboto", sans-serif;
        font-weight: 300;
        font-style: normal;
    }

    .roboto-regular {
        font-family: "Roboto", sans-serif;
        font-weight: 400;
        font-style: normal;
    }

    .roboto-medium {
        font-family: "Roboto", sans-serif;
        font-weight: 500;
        font-style: normal;
    }

    .roboto-bold {
        font-family: "Roboto", sans-serif;
        font-weight: 700;
        font-style: normal;
    }

    .roboto-black {
        font-family: "Roboto", sans-serif;
        font-weight: 900;
        font-style: normal;
    }

    body {
        font-family: "Roboto", sans-serif;
        background: #F5F5F9;
    }


    .bg-primary {
        background: linear-gradient(to right, #434875, #b18647) !important;
    }

    .text-title {
        color: #3a352d;
    }

    .text-paragraph {
        color: #585249;
    }


    .bg-light {
        background-color: #f9f8f6;
    }

    .overview-card {
        background: #ffffff;
        border-radius: 8px;
        padding: 1.25rem;
        color: #434875;
        box-shadow: 0 9px 20px rgba(46, 35, 94, .07);
    }

    @media (max-width: 574px) {
        .overview-card {
            padding: 1.25rem 1rem;

        }
    }

    .table__title {
        font-size: 20px;
        font-weight: 500;
        color: #434875;

    }

    .button-outline {
        border: 1px solid #4caf50;
        border-radius: 0.5rem;
        padding: 8px 16px;
        font-size: 14px;
        color: #4caf50;
        background-color: transparent;
        font-weight: bold;
        transition: all 0.3s;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    }

    .button-outline:hover {
        opacity: 0.8;
        transform: translateY(2px);
        box-shadow: rgba(99, 99, 99, 0.1) 0px 2px 8px 0px;

    }

    .table__search-input {
        border: 1px solid #cfd0d6;
        border-radius: .375rem;
        padding: 8px 16px;
        font-size: 14px;
    }

    .table__search-input:focus-visible {
        outline: 1px solid #434875;

    }

    .table__thead__item {
        background: #d9edf7 !important;
        padding: 10px 0;
        color: red;
    }

    .eye-icon {
        cursor: pointer;
        font-size: 15px;
    }

    .dropdown-item {
        display: block;
        width: 100%;
        padding: 8px 20px;
        clear: both;
        font-weight: 400;
        color: #3b4056;
        text-align: inherit;
        white-space: nowrap;
        background-color: rgba(0, 0, 0, 0);
        border: 0;
        border-radius: 8px;
        border: none;
    }

    .dropdown-toggle::after {
        display: inline-block;
        margin-left: .255em;
        vertical-align: .255em;
        content: "";
        opacity: 0;
        border-top: .3em solid;
        border-right: .3em solid transparent;
        border-bottom: 0;
        border-left: .3em solid transparent;
    }

    .btn-check:checked+.btn,
    .btn.active,
    .btn.show,
    .btn:first-child:active,
    :not(.btn-check)+.btn:active {
        color: var(--bs-btn-active-color);
        background-color: var(--bs-btn-active-bg);
        border-color: white;
    }

    .table__btn-next {
        border: none;
        font-size: 14px;
        padding: 8px 24px;
        border-radius: 8px;
        transition: all 0.4s ease-in-out;

    }

    .table__btn-previous {
        border: none;
        font-size: 14px;
        padding: 8px 24px;
        border-radius: 8px;
        transition: all 0.4s ease-in-out;

    }



    .table__btn-next:hover,
    .table__btn-previous:hover {
        background-color: #434875;
        color: #ffffff;
    }

    .table__count-no {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #434875;
        width: 32px;
        height: 32px;
        font-size: 15px;
        font-weight: bold;
        color: #ffffff;
        border-radius: 10px;

    }

    .table__showing-text {
        font-size: 14px;
        opacity: 0.4;
    }


    @media (max-width: 574px) {

        .table__btn-previous,
        .table__btn-next {
            font-size: 12px;
            padding: 6px 18px;
        }

        .table__count-no {
            width: 28px;
            height: 28px;
            font-size: 12px;
        }

        .table__showing-text {
            font-size: 12px;
        }

        .btn__download {
            font-size: 12px;
        }

        .table__search-input {
            padding: 6px 12px;
            font-size: 14px;
        }

    }

    .modal__label {
        font-size: 14px;
        opacity: 0.6;
    }

    .modal__data {
        color: #3b4056;
        font-size: 14px;

    }

    .modal-title {
        color: #434875;
    }

    .modal__btn--view {
        background-color: #434875;
        color: #ffffff;
        border: none;
        font-size: 14px;
        padding: 8px 20px;
        border-radius: 6px;
        transition: all 0.4s ease-in-out;


    }

    .modal__btn--close {
        background-color: #F5F5F7;
        color: #434875;
        border: none;
        font-size: 14px;
        padding: 8px 20px;
        border-radius: 6px;
        transition: all 0.4s ease-in-out;


    }

    .modal__btn--view:hover {
        opacity: 0.8;

    }
    </style>


</head>

<body>
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container flex-grow-1 py-5 container-p-y">
            <div class="overview-card">
                <div class="pb-4 pt-2 border-bottom d-flex align-items-center gap-2">
                    <img src="<?php echo base_url('assets/images/student_dashboard/document.png'); ?>" alt=""
                        style="width:36px" />
                    <h1 class="table__title mb-0">Student Record Management</h1>
                </div>
                <div class="mt-4 mb-1 d-flex align-items-center justify-content-between pb-4 ">
                    <button class="button-outline btn__download"><i class="fa-solid fa-download"></i> Download
                        Excel</button>
                    <input class="table__search-input" placeholder="Search Student" type="text">
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" style="padding:18px 10px; color: #3b4056;
    background-color: #f5f5f7; font-size:12px; text-transform:uppercase; font-weight:500">#</th>
                            <th scope="col" style="padding:18px 10px; color: #3b4056;
    background-color: #f5f5f7; font-size:12px; text-transform:uppercase; font-weight:500">Student</th>
                            <th scope="col" class="d-md-none d-table-cell" style="padding:18px 10px; color: #3b4056;
    background-color: #f5f5f7; font-size:12px; text-transform:uppercase; font-weight:500"></th>
                            <th scope="col" class="d-none d-md-table-cell" style="padding:18px 10px; color: #3b4056;
    background-color: #f5f5f7; font-size:12px; text-transform:uppercase; font-weight:500">School</th>
                            <th scope="col" class="text-center d-none d-lg-table-cell" style="padding:18px 10px; color: #3b4056;
    background-color: #f5f5f7; font-size:12px; text-transform:uppercase; font-weight:500">Birthday</th>

                            <th scope="col" class="text-center d-none d-lg-table-cell" style="padding:18px 10px; color: #3b4056;
    background-color: #f5f5f7; font-size:12px; text-transform:uppercase; font-weight:500">Civil Status</th>

                            <th scope="col" class="text-center d-none d-lg-table-cell" style="padding:18px 10px; color: #3b4056;
    background-color: #f5f5f7; font-size:12px; text-transform:uppercase; font-weight:500">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" class="fw-normal"
                                style="color:#3b4056;font-size:12px;padding:14px 10px;vertical-align: middle;">
                                SCM2407-00001</th>
                            <td
                                style="color:#3b4056;font-size:12px;padding:14px 10px;vertical-align: middle;vertical-align: middle;">
                                <div class="d-flex gap-3 align-items-center ">
                                    <img src="<?php echo base_url('assets/images/avatar.png'); ?>" alt=""
                                        style="width:32px" />
                                    <div>
                                        <div class="fw-bold" style="color:#3b4056">Jake Castor</div>
                                        <div style="color:#3b4056">jakecastor@gmail.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="d-md-none d-table-cell"
                                style="color:#3b4056;font-size:14px;padding:14px 10px;vertical-align: middle;"><i
                                    data-bs-toggle="modal" data-bs-target="#viewTableDetail"
                                    class="fa-solid fa-circle-plus"></i></td>

                            <td class="d-none d-md-table-cell"
                                style="color:#3b4056;font-size:12px;padding:14px 10px;vertical-align: middle;"> Nueva
                                Ecija University Of Science And Technology</td>

                            <td class="text-center d-none d-lg-table-cell"
                                style="color:#3b4056;font-size:12px;padding:14px 10px;vertical-align: middle;">January
                                3, 1994 </td>
                            <td class="text-center d-none d-lg-table-cell"
                                style="color:#3b4056;font-size:12px;padding:14px 10px;vertical-align: middle;">Single
                            </td>
                            <td class="text-center d-none d-lg-table-cell"
                                style="color:#3b4056;font-size:14px;padding:14px 10px;vertical-align: middle; position:relative;">
                                <div>
                                    <span class="eye-icon"> <i class="fa-solid fa-eye"></i></span>
                                    <button
                                        class="btn btn-sm border-none btn-icon btn-text-secondary  dropdown-toggle show"
                                        data-bs-toggle="dropdown" aria-expanded="true"><i
                                            class="fa-solid fa-ellipsis-vertical"
                                            style="font-size:15px;transform:translateY(-0.8px);"></i></button>

                                    <div class="dropdown-menu dropdown-menu-end m-0 show"
                                        style="position: absolute; inset: auto 0px 0px auto; margin: 0px; transform: translate(-41px, -690px); border:none;box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; border-radius:12px"
                                        data-popper-placement="top-end">
                                        <a href="app-user-view-account.html" class="dropdown-item"><i
                                                class="ri-eye-line me-2"></i><span><i class="fa-regular fa-eye me-2"
                                                    style="font-size:14px;"></i>View</span></a><a href="javascript:;"
                                            class="dropdown-item"><i
                                                class="ri-edit-box-line me-2"></i><span>Edit</span></a><a
                                            href="javascript:;" class="dropdown-item delete-record"><i
                                                class="ri-delete-bin-7-line me-2"></i><span>Delete</span></a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    </tbody>

                </table>
                <div class="py-2 d-flex align-items-center justify-content-between">
                    <div class="table__showing-text"> Showing 1 to 10 of 20 entries</div>
                    <div class="d-flex align-items-center gap-md-3 gap-2">
                        <button class="table__btn-previous">Previous</button>
                        <div class="table__count-no">1</div>
                        <button class="table__btn-next">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('/components/custom_table_modal.php');?>
</body>

</html>