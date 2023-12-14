<div class="main-content container-fluid p-0">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h3 class="mb-2"><i class="fas fa-trash-alt"></i> Trash</h3>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo base_url('admin') ?>" class="breadcrumb-link">E - Arsip</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Trash</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div id="info"></div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="email-list">
                    <?php foreach ($trashfolder as $folders) { ?>
                        <div class="email-list-item">
                            <div class="email-list-actions">
                                <div class="dropdown ml-auto">
                                    <a class="toolbar" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="mdi mdi-dots-vertical"></i> </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink" x-placement="top-end" style="position: absolute; transform: translate3d(-160px, -102px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item text-success restoref" id="<?php echo encrypt_this($folders->id); ?>" data-toggle="modal" data-target="#restorefolder" href="#"><i class="fa fa-reply"></i> Restore</a>
                                        <a class="dropdown-item text-danger hapusf" id="<?php echo encrypt_this($folders->id); ?>" data-toggle="modal" data-target="#hapusfolder" href="#"><i class="fa fa-trash"></i> Hapus</a>
                                    </div>
                                </div>
                            </div>
                            <div class="email-list-detail">
                                <span class="date float-right"><?php echo Tgl_Indo(date('Y-m-d', strtotime($folders->datecreated))) ?></span>
                                <span class="from"><i class="fas fa-folder"></i> <?php echo $folders->nama; ?></span>
                            </div>
                        </div>
                    <?php } ?>
                    <?php foreach ($trashfile as $files) {
                        if ($files->kategori == 0) {
                    ?>
                            <div class="email-list-item">
                                <div class="email-list-actions">
                                    <div class="dropdown ml-auto">
                                        <a class="toolbar" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="mdi mdi-dots-vertical"></i> </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink" x-placement="top-end" style="position: absolute; transform: translate3d(-160px, -102px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item text-success restore" data-toggle="modal" data-target="#restoresampah" id="<?php echo encrypt_this($files->id); ?>" href="#"><i class="fa fa-reply"></i> Restore</a>
                                            <a class="dropdown-item text-danger hapus" data-toggle="modal" data-target="#hapus" id="<?php echo encrypt_this($files->id); ?>" href="#"><i class="fa fa-trash"></i> Hapus</a>
                                        </div>
                                    </div>

                                </div>
                                <div class="email-list-detail">
                                    <span class="date float-right"><?php echo Tgl_Indo(date('Y-m-d', strtotime($files->datecreated))) ?></span>
                                    <span class="from"><?php echo tipefile($files->tipe_file) . ' ' . $files->nama_file_upload; ?></span>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="email-list-item">
                                <div class="email-list-actions">
                                    <div class="dropdown ml-auto">
                                        <a class="toolbar" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="mdi mdi-dots-vertical"></i> </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink" x-placement="top-end" style="position: absolute; transform: translate3d(-160px, -102px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item text-success restore" data-toggle="modal" data-target="#restoresampah" id="<?php echo encrypt_this($files->id); ?>" href="#"><i class="fa fa-reply"></i> Restore</a>
                                            <a class="dropdown-item text-danger hapus" data-toggle="modal" data-target="#hapus" id="<?php echo encrypt_this($files->id); ?>" href="#"><i class="fa fa-trash"></i> Hapus</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="email-list-detail"><span class="date float-right"><?php echo Tgl_Indo(date('Y-m-d', strtotime($files->datecreated))) ?></span>
                                    <span class="from"><?php echo $files->kode; ?></span>
                                    <p class="msg"><?php echo tipefile($files->tipe_file) . ' ' . $files->nomor . ' - ' . $files->nama; ?></p>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="restoresampah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formrestorefile">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Restore File</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </a>
                </div>
                <div class="modal-body">
                    <p class="text-center">Apa anda yakin ingin restore file ini?</p>
                    <input type="hidden" id="idrestorefile" name="idrestorefile">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('IdUser')) ?>" name="userid">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('Level')) ?>" name="userlevel">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('KodeInstansi')) ?>" name="kodeinstansi">
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-light btn-xs" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-success btn-xs">Ya, Restore File</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formhapusfile">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus File</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </a>
                </div>
                <div class="modal-body">
                    <p class="text-center">Apa anda yakin ingin menghapus file ini? anda <b>tidak bisa mengembalikan file</b> yang sudah dihapus.</p>
                    <input type="hidden" value="" id="idhapus" name="idhapus">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('IdUser')) ?>" name="userid">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('Level')) ?>" name="userlevel">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('KodeInstansi')) ?>" name="kodeinstansi">
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-light btn-xs" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-danger btn-xs">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="restorefolder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formrestorefolder">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Restore Folder</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </a>
                </div>
                <div class="modal-body">
                    <p class="text-center">Apa anda yakin ingin restore folder ini?</p>
                    <input type="hidden" id="idrestoref" name="idrestoref">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('IdUser')) ?>" name="userid">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('Level')) ?>" name="userlevel">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('KodeInstansi')) ?>" name="kodeinstansi">
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-light btn-xs" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-success btn-xs">Ya, Restore File</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="hapusfolder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formhapusfolder">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Folder</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </a>
                </div>
                <div class="modal-body">
                    <p class="text-center">Apa anda yakin ingin menghapus folder ini? anda <b>tidak bisa mengembalikan folder</b> yang sudah dihapus.</p>
                    <input type="hidden" value="" id="iddeletefolder" name="iddeletefolder">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('IdUser')) ?>" name="userid">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('Level')) ?>" name="userlevel">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('KodeInstansi')) ?>" name="kodeinstansi">
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-light btn-xs" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-danger btn-xs">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(".restore").click(function() {
        $("#idrestorefile").val($(this).attr('id'));
    });

    $(".hapus").click(function() {
        $("#idhapus").val($(this).attr('id'));
    });

    $(".restoref").click(function() {
        $("#idrestoref").val($(this).attr('id'));
    });

    $(".hapusf").click(function() {
        $("#iddeletefolder").val($(this).attr('id'));
    });

    $("#formrestorefile").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: "<?php echo base_url('api/prosses/restorefile') ?>",
            type: 'POST',
            dataType: 'Json',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function(xhr) {
                $("#restoresampah").modal('hide');
            },
            success: function(data) {
                if (data['Status'] == 'Sukses') {
                    $('#info').html('<div class="alert alert-success" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                    setTimeout(function() {
                        window.location.href = "<?php echo base_url('admin/sampah') ?>";
                    }, 1500);
                } else {
                    $('#info').html('<div class="alert alert-danger" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                }
            }
        });
    });

    $("#formhapusfile").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: "<?php echo base_url('api/prosses/deletefile') ?>",
            type: 'POST',
            dataType: 'Json',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function(xhr) {
                $("#hapus").modal('hide');
            },
            success: function(data) {
                if (data['Status'] == 'Sukses') {
                    $('#info').html('<div class="alert alert-success" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                    setTimeout(function() {
                        window.location.href = "<?php echo base_url('admin/sampah'); ?>";
                    }, 1500);
                } else {
                    $('#info').html('<div class="alert alert-danger" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                }
            }
        });
    });


    $("#formrestorefolder").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: "<?php echo base_url('api/prosses/restorefolder') ?>",
            type: 'POST',
            dataType: 'Json',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function(xhr) {
                $("#restorefolder").modal('hide');
            },
            success: function(data) {
                if (data['Status'] == 'Sukses') {
                    $("#restoresampah").modal('hide');
                    $('#info').html('<div class="alert alert-success" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                    setTimeout(function() {
                        window.location.href = "<?php echo base_url('admin/sampah') ?>";
                    }, 1500);
                } else {
                    $('#info').html('<div class="alert alert-danger" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                }
            }
        });
    });

    $("#formhapusfolder").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: "<?php echo base_url('api/prosses/deletefolder') ?>",
            type: 'POST',
            dataType: 'Json',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function(xhr) {
                $("#hapusfolder").modal('hide');
            },
            success: function(data) {
                if (data['Status'] == 'Sukses') {
                    $('#info').html('<div class="alert alert-success" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                    setTimeout(function() {
                        window.location.href = "<?php echo base_url('admin/sampah'); ?>";
                    }, 1500);
                } else {
                    $('#info').html('<div class="alert alert-danger" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                }
            }
        });
    });
</script>