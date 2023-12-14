<?php
$kapasitas = $this->Log->kapasitas($this->session->userdata('KodeInstansi'));
$maxkapasitas = $this->config->item('Max_size');
if ($kapasitas == 0) {
    $now = '0';
} else {
    $now = $kapasitas / $maxkapasitas * 100 * 10;
}
?>
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

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/datatables/css/dataTables.bootstrap4.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/select2/css/select2.css') ?>">

    <title><?php echo $title; ?></title>
    <link rel="icon" href="<?php echo base_url('assets/logoinv.png') ?>">

    <script src="<?php echo base_url('assets/vendor/jquery/jquery-3.3.1.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.js') ?>"></script>

    <script src="<?php echo base_url('assets/vendor/parsley/parsley.js') ?>"></script>

    <script src="<?php echo base_url('assets/libs/js/clipboard.js') ?>"></script>
</head>
<?php
if (!empty($kode)) {
    $kode = "/" . $kode;
} else {
    $kode = "";
}

if ($this->session->userdata('Level') == 0) {
    $headbg = 'style="background-color: #0d0d0d;"';
    $sidebg = 'sidebar-white';
    $headtl = 'text-white';
} else if ($this->session->userdata('Level') == 1) {
    $headbg = 'style="background-color: #fff;"';
    $sidebg = 'sidebar-dark';
    $headtl = 'text-dark';
} else if ($this->session->userdata('Level') == 2) {
    $headbg = 'style="background-color: #007bff;"';
    $sidebg = 'sidebar-white';
    $headtl = 'text-white';
} else if ($this->session->userdata('Level') == 3) {
    $headbg = 'style="background-color: #dc3545;"';
    $sidebg = 'sidebar-white';
    $headtl = 'text-white';
}
?>

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
                        <li class="nav-item">
                            <div id="custom-search" class="top-search-bar">
                                <input class="form-control" type="text" placeholder="Search..">
                            </div>
                        </li>
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url('assets/images/avatar-1.jpg') ?>" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <a class="dropdown-item" href="<?php echo base_url('admin/profile') ?>"><i class="fas fa-user mr-2"></i>Profile</a>
                                <a class="dropdown-item" href="<?php echo base_url('logout') ?>"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="dashboard-wrapper">
            <div class="dashboard-content">
                <div class="container-fluid">
                    <aside class="page-aside">
                        <div class="aside-content">
                            <div class="aside-header">
                                <button class="navbar-toggle" data-target=".aside-nav" data-toggle="collapse" type="button">
                                    <span class="icon"><i class="fas fa-caret-down"></i></span>
                                </button>
                                <span class="title"><?php echo $this->session->userdata('KodeInstansi') ?> </span>
                                <p class="description"><?php echo ucwords(strtolower($this->session->userdata('Instansi'))) ?></p>
                            </div>
                            <div class="aside-compose">
                                <div class="input-group-prepend be-addon">
                                    <button tabindex="-1" data-toggle="dropdown" type="button" class="btn btn-lg btn-block btn-warning dropdown-toggle dropdown-toggle-split" aria-expanded="false">TAMBAH </button>
                                    <div class="dropdown-menu" x-placement="bottom-start">
                                        <a href="<?php echo site_url('admin/TambahFolder' . $kode) ?>" class="dropdown-item mr-2"><i class="fas fa-folder"></i> Folder</a>
                                        <a href="<?php echo site_url('admin/TambahFile' . $kode) ?>" class="dropdown-item mr-2"><i class="fas fa-file"></i> File</a>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="aside-nav collapse">
                                <ul class="nav">
                                    <li <?php if ($page == 'index') {
                                            echo 'class="active"';
                                        } ?>><a href="<?php echo site_url('admin') ?>"><span class="icon"><i class="fas fa-fw fa-book"></i></span> Arsipku</a></li>
                                    <li <?php if ($page == 'share') {
                                            echo 'class="active"';
                                        } ?>><a href="<?php echo site_url('admin/share') ?>"><span class="icon"><i class="fas fa-fw fa-users"></i></span>Share</a></li>
                                    <li <?php if ($page == 'favorit') {
                                            echo 'class="active"';
                                        } ?>><a href="<?php echo site_url('admin/favorit') ?>"><span class="icon"><i class="fas fa-fw fa-star"></i></span>Favorit</a></li>
                                    <li <?php if ($page == 'sampah') {
                                            echo 'class="active"';
                                        } ?>><a href="<?php echo site_url('admin/sampah') ?>"><span class="icon"><i class="fas fa-fw fa-trash-alt"></i></span>Sampah</a></li>
                                </ul>
                                <span class="title">Arsip Lain</span>
                                <ul class="nav nav-pills">
                                    <?php if ($this->session->userdata('Level') == 4) { ?>
                                        <li <?php if ($page == 'desa') {
                                                echo 'class="active"';
                                            } ?>><a href="<?php echo site_url('admin/arsipdesa/' . $this->session->userdata('KodeInstansi')) ?>"><i class="m-r-10 mdi mdi-label text-secondary"></i> Arsip Desa </a></li>
                                    <?php }
                                    if ($this->session->userdata('Level') == 2) { ?>
                                        <li <?php if ($page == 'desa') {
                                                echo 'class="active"';
                                            } ?>><a href="<?php echo site_url('admin/desa') ?>"><i class="m-r-10 mdi mdi-label text-secondary"></i> Desa </a></li>
                                        <li <?php if ($page == 'kecamatan') {
                                                echo 'class="active"';
                                            } ?>><a href="<?php echo site_url('admin/kecamatan') ?>"><i class="m-r-10 mdi mdi-label text-primary"></i> Kecamatan </a></li>
                                    <?php } ?>
                                </ul>
                                <span class="title">Penyimpanan
                                    <div class="progress mb-1">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo $now ?>%;" aria-valuenow="<?php echo $now ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <?php echo formatSize($kapasitas) ?>
                                    <div class="float-right">10 GB</div>
                                </span>

                            </div>
                        </div>
                    </aside>