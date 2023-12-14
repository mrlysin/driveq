<div class="main-content container-fluid p-0">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h3 class="mb-2"><i class="fas fa-star text-warning"></i> Favorit</h3>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo base_url('admin') ?>" class="breadcrumb-link">E - Arsip</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Favorit</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="main-content container-fluid p-0">
                    <div class="email-list">
                        <?php foreach ($folder as $folders) { ?>
                            <div class="email-list-item">
                                <div class="email-list-actions">
                                    <?php if ($folders->status == 2) { ?>
                                        <a class="text-warning removefavoritfolder" title="Remove Favorit" href="#" id="<?php echo encrypt_this($folders->id); ?>">
                                            <span><i class="fas fa-star"></i></span>
                                        </a>
                                    <?php } else { ?>
                                        <a class="addfavoritfolder" title="Add Favorit" href="#" id="<?php echo encrypt_this($folders->id); ?>">
                                            <span><i class="fas fa-star"></i></span>
                                        </a>
                                    <?php } ?>
                                </div>
                                <div class="email-list-actions">
                                    <div class="dropdown ml-auto">
                                        <a class="toolbar" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="mdi mdi-dots-vertical"></i> </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink" x-placement="top-end" style="position: absolute; transform: translate3d(-160px, -102px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item" href="<?php echo base_url('admin/folder/' . encrypt_this($folders->id)) ?>"><i class="fa fa-eye"></i> Lihat</a>
                                            <a class="rename dropdown-item" name="<?php echo $folders->nama; ?>" id="<?php echo encrypt_this($folders->id); ?>" data-toggle="modal" data-target="#renamefolder" href="#"><i class="fa fa-pencil-alt"></i> Rename</a>
                                            <?php if ($folders->id_share == 0) { ?>
                                                <a class="sharefolder dropdown-item" id="<?php echo encrypt_this($folders->id); ?>" data-toggle="modal" data-target="#sharefolder" href="#"><i class="fa fa-users"></i> Share</a>
                                            <?php } else { ?>
                                                <a class="unsharefolder dropdown-item" id="<?php echo encrypt_this($folders->id); ?>" data-toggle="modal" data-target="#unsharefolder" href="#"><i class="fa fa-users"></i> UnShare</a>
                                            <?php } ?>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-warning trashf" data-toggle="modal" data-target="#sampahfolder" id="<?php echo encrypt_this($folders->id); ?>" href="#"><i class="fa fa-trash-alt"></i> Trash</a>
                                            <a class="dropdown-item text-danger hapusf" data-toggle="modal" data-target="#hapusfolder" id="<?php echo encrypt_this($folders->id); ?>" href="#"><i class="fa fa-trash"></i> Hapus</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="email-list-detail">
                                    <span class="date float-right">
                                        <?php if ($folders->id_share >= 1) { ?>
                                            <a href="#">
                                                <span><i class="fas fa-users"></i></span>
                                            </a>
                                        <?php } ?>
                                        <?php echo Tgl_Indo(date('Y-m-d', strtotime($folders->datecreated))) ?>
                                    </span>
                                    <a href="<?php echo base_url('admin/folder/' . encrypt_this($folders->id)) ?>">
                                        <span class="from"><i class="fas fa-folder"></i> <?php echo $folders->nama; ?></span>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>