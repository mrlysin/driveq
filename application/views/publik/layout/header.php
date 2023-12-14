<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/fonts/circular-std/style.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/libs/css/style.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/fonts/simple-line-icons/css/simple-line-icons.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/charts/chartist-bundle/chartist.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/charts/morris-bundle/morris.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/charts/c3charts/c3.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/fonts/flag-icon-css/flag-icon.min.css') ?>">

    <title><?php echo $title; ?></title>
    <link rel="icon" href="<?php echo base_url('assets/logoinv.png') ?>">

    <script src="<?php echo base_url('assets/vendor/jquery/jquery-3.3.1.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.js') ?>"></script>

    <script src="<?php echo base_url('assets/vendor/parsley/parsley.js') ?>"></script>

    <script src="<?php echo base_url('assets/pdfjs/build/pdf.js') ?>"></script>
</head>

<body>
    <div class="dashboard-main-wrapper">
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="<?php echo base_url('admin') ?>">E-Arsip</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">

                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?php echo base_url('assets/images/avatar-1.jpg') ?>" alt="" class="user-avatar-md rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <?php if (!empty($this->session->userdata('Username'))) { ?>
                                    <a class="dropdown-item" href="<?php echo base_url('admin') ?>"><i class="fas fa-book mr-2"></i>Arsipku</a>
                                    <a class="dropdown-item" href="<?php echo base_url('admin/profile') ?>"><i class="fas fa-user mr-2"></i>Profile</a>
                                    <a class="dropdown-item" href="<?php echo base_url('logout') ?>"><i class="fas fa-power-off mr-2"></i>Logout</a>
                                <?php } else { ?>
                                    <a class="dropdown-item" href="<?php echo base_url('login') ?>"><i class="fas fa-sign-in-alt mr-2"></i>Login</a>
                                <?php } ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="container-fluid">