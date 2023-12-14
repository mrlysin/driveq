<div class="main-content container-fluid p-0">
    <div class="email-inbox-header border-bottom">
        <div class="row">
            <div class="col-lg-12">
                <div class="email-title">
                    <span class="icon"><i class="fas fa-folder-open"></i></span>
                    <?php if (!empty($detail)) {
                        echo $detail['nama'];
                    } ?>
                    <div class="float-right">
                        <a href="#" title="View" class="btn btn-sm btn-light"><i class="fas fa-th"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="info"></div>

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
                            <a href="#" data-container="body" data-html="true" data-trigger="focus" data-toggle="popover" data-placement="left" data-content="<div class='input-group mb-3'>
                <div class='input-group-append'>
                  <input class='form-control' type='text' value='<?php echo base_url('share/folder/' . encrypt_this($folders->id)) ?>' id='copy<?php echo encrypt_this($folders->id) ?>'>
                  <button class='copyButton btn btn-primary' id='copyButtonId' data-id='@item.Type' data-clipboard-action='copy' data-clipboard-target='input#copy<?php echo encrypt_this($folders->id) ?>'><i class='fa fa-copy'></i></button>
                </div>
              </div>" data-original-title="" title="Copy link">
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

        <?php foreach ($file as $files) { ?>
            <div class="email-list-item">
                <div class="email-list-actions">
                    <?php if ($files->status == 2) { ?>
                        <a class="text-warning removefavoritfile" title="Remove Favorit" href="#" id="<?php echo encrypt_this($files->id); ?>">
                            <span><i class="fas fa-star"></i></span>
                        </a>
                    <?php } else { ?>
                        <a class="addfavoritfile" title="Add Favorit" href="#" id="<?php echo encrypt_this($files->id); ?>">
                            <span><i class="fas fa-star"></i></span>
                        </a>
                    <?php } ?>
                </div>
                <div class="email-list-actions">
                    <div class="dropdown ml-auto">
                        <a class="toolbar" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="mdi mdi-dots-vertical"></i> </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink" x-placement="top-end" style="position: absolute; transform: translate3d(-160px, -102px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="dropdown-item" href="#" onclick="downloadImage('<?php echo base_url('upload/' . $files->nama_file) ?>', '<?php echo $files->nama_file_upload; ?>')"><i class="fa fa-download"></i> Download</a>
                            <a class="dropdown-item" target="_blank" href="<?php echo base_url('admin/Viewfile/' . encrypt_this($files->id)); ?>"><i class="fa fa-eye"></i> Lihat</a>
                            <?php if ($files->id_share == 0) { ?>
                                <a class="sharefile dropdown-item" id="<?php echo encrypt_this($files->id); ?>" data-toggle="modal" data-target="#sharefile" href="#"><i class="fa fa-users"></i> Share</a>
                            <?php } else { ?>
                                <a class="unsharefile dropdown-item" id="<?php echo encrypt_this($files->id); ?>" data-toggle="modal" data-target="#unsharefile" href="#"><i class="fa fa-users"></i> UnShare</a>
                            <?php } ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-warning trash" data-toggle="modal" data-target="#sampah" id="<?php echo encrypt_this($files->id); ?>" href="#"><i class="fa fa-trash-alt"></i> Trash</a>
                            <a class="dropdown-item text-danger hapus" data-toggle="modal" data-target="#hapus" id="<?php echo encrypt_this($files->id); ?>" href="#"><i class="fa fa-trash"></i> Hapus</a>
                        </div>
                    </div>
                </div>
                <div class="email-list-detail">
                    <span class="date float-right">
                        <?php if ($files->id_share >= 1) { ?>
                            <a href="#" data-container="body" data-html="true" data-trigger="focus" data-toggle="popover" data-placement="left" data-content="<div class='input-group mb-3'>
                <div class='input-group-append'>
                  <input class='form-control' type='text' value='<?php echo base_url('share/file/' . encrypt_this($files->id)) ?>' id='copy<?php echo encrypt_this($files->id) ?>'>
                  <button class='copyButton btn btn-primary' id='copyButtonId' data-id='@item.Type' data-clipboard-action='copy' data-clipboard-target='input#copy<?php echo encrypt_this($files->id) ?>'><i class='fa fa-copy'></i></button>
                </div>
              </div>" data-original-title="" title="Copy link">
                                <span><i class="fas fa-users"></i></span>
                            </a>
                        <?php } ?>
                        <?php echo Tgl_Indo(date('Y-m-d', strtotime($files->datecreated))); ?>
                    </span>
                    <a target="_blank" href="<?php echo base_url('admin/Viewfile/' . encrypt_this($files->id)); ?>">
                        <span class="from"><?php echo tipefile($files->tipe_file) . ' ' . $files->nama_file_upload; ?></span>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>


<div class="modal fade" id="sampah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formtrash">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Trash File</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </a>
                </div>
                <div class="modal-body">
                    <p class="text-center">Apa anda yakin ingin memasukan file ini ke Trash? anda <b>bisa mengembalikan file</b> ini jika masih diperlukan.</p>
                    <input type="hidden" value="" id="idtrash" name="idtrash">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('IdUser')) ?>" name="userid">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('Level')) ?>" name="userlevel">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('KodeInstansi')) ?>" name="kodeinstansi">
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-light btn-xs" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-warning btn-xs">Ya, Masukkan Trash</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formhapus">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus File</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </a>
                </div>
                <div class="modal-body">
                    <p class="text-center">Apa anda yakin ingin menghapus file ini? anda <b>tidak bisa mengembalikan file</b> yang sudah dihapus.</p>
                    <input type="hidden" id="idhapus" name="idhapus">
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

<div class="modal fade" id="renamefolder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formrename" class="needs-validation" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rename Folder</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </a>
                </div>
                <div class="modal-body">
                    <label for="name">Nama Folder</label>
                    <input type="text" class="form-control form-control-lg" id="renamename" name="nama" required>
                    <div class="invalid-feedback">
                        Nama folder harus diisi.
                    </div>
                    <input type="hidden" value="" id="idrename" name="id">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('IdUser')) ?>" name="userid">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('Level')) ?>" name="userlevel">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('KodeInstansi')) ?>" name="kodeinstansi">
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-light btn-xs" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-primary btn-xs">Rename</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="sampahfolder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="trashfolder">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Trash Folder</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </a>
                </div>
                <div class="modal-body">
                    <p class="text-center">Apa anda yakin ingin memasukan Folder ini ke Trash? anda <b>bisa mengembalikan Folder</b> ini jika masih diperlukan.</p>
                    <input type="hidden" value="" id="idtrashfolder" name="idtrashfolder">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('IdUser')) ?>" name="userid">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('Level')) ?>" name="userlevel">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('KodeInstansi')) ?>" name="kodeinstansi">
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-light btn-xs" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-warning btn-xs">Ya, Masukkan Trash</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="hapusfolder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="deletefolder">
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

<div class="modal fade" id="sharefolder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="shfolder">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Share Folder</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </a>
                </div>
                <div class="modal-body">
                    <p class="text-center">Apa anda yakin ingin share folder ini? Folder, sub Folder dan file yang didalamnya akan ikut ke share.</p>
                    <input type="hidden" value="" id="idsharefolder" name="idsharefolder">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('IdUser')) ?>" name="userid">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('Level')) ?>" name="userlevel">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('KodeInstansi')) ?>" name="kodeinstansi">
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-light btn-xs" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-success btn-xs">Ya, share</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="unsharefolder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="unshfolder">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">UnShare Folder</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </a>
                </div>
                <div class="modal-body">
                    <p class="text-center">Apa anda yakin ingin unshare folder ini? Folder, sub Folder dan file yang didalamnya akan ikut ke unshare.</p>
                    <input type="hidden" value="" id="idunsharefolder" name="idunsharefolder">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('IdUser')) ?>" name="userid">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('Level')) ?>" name="userlevel">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('KodeInstansi')) ?>" name="kodeinstansi">
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-light btn-xs" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-secondary btn-xs">Ya, unshare</button>
                </div>
            </form>
        </div>
    </div>
</div>




<div class="modal fade" id="sharefile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="shfile">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Share File</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </a>
                </div>
                <div class="modal-body">
                    <p class="text-center">Apa anda yakin ingin share file ini?</p>
                    <input type="hidden" value="" id="idsharefile" name="idsharefile">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('IdUser')) ?>" name="userid">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('Level')) ?>" name="userlevel">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('KodeInstansi')) ?>" name="kodeinstansi">
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-light btn-xs" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-success btn-xs">Ya, share</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="unsharefile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="unshfile">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">UnShare File</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </a>
                </div>
                <div class="modal-body">
                    <p class="text-center">Apa anda yakin ingin unshare file ini?</p>
                    <input type="hidden" value="" id="idunsharefile" name="idunsharefile">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('IdUser')) ?>" name="userid">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('Level')) ?>" name="userlevel">
                    <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('KodeInstansi')) ?>" name="kodeinstansi">
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-light btn-xs" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-secondary btn-xs">Ya, unshare</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(".trash").click(function() {
        $("#idtrash").val($(this).attr('id'));
    });

    $(".hapus").click(function() {
        $("#idhapus").val($(this).attr('id'));
    });

    $(".rename").click(function() {
        $("#idrename").val($(this).attr('id'));
        $("#renamename").val($(this).attr('name'));
    });

    $(".trashf").click(function() {
        $("#idtrashfolder").val($(this).attr('id'));
    });

    $(".hapusf").click(function() {
        $("#iddeletefolder").val($(this).attr('id'));
    });

    $(".sharefolder").click(function() {
        $("#idsharefolder").val($(this).attr('id'));
    });

    $(".unsharefolder").click(function() {
        $("#idunsharefolder").val($(this).attr('id'));
    });

    $(".sharefile").click(function() {
        $("#idsharefile").val($(this).attr('id'));
    });

    $(".unsharefile").click(function() {
        $("#idunsharefile").val($(this).attr('id'));
    });

    $(".addfavoritfolder").click(function() {
        $.ajax({
            url: "<?= base_url('api/prosses/addfavoritfolder') ?>",
            type: 'POST',
            dataType: 'Json',
            data: {
                "id": $(this).attr('id'),
            },
            success: function(data) {
                if (data['Status'] == 'Sukses') {
                    $('#info').html('<div class="alert alert-success" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                    setTimeout(function() {
                        window.location.href = "<?php echo base_url('admin/folder/' . $kode) ?>";
                    }, 1500);
                } else {
                    $('#info').html('<div class="alert alert-danger" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                }
            }
        });
    });

    $(".removefavoritfolder").click(function() {
        $.ajax({
            url: "<?= base_url('api/prosses/removefavoritfolder') ?>",
            type: 'POST',
            dataType: 'Json',
            data: {
                "id": $(this).attr('id'),
            },
            success: function(data) {
                if (data['Status'] == 'Sukses') {
                    $('#info').html('<div class="alert alert-success" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                    setTimeout(function() {
                        window.location.href = "<?php echo base_url('admin/folder/' . $kode) ?>";
                    }, 1500);
                } else {
                    $('#info').html('<div class="alert alert-danger" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                }
            }
        });
    });

    $(".addfavoritfile").click(function() {
        $.ajax({
            url: "<?= base_url('api/prosses/addfavoritfile') ?>",
            type: 'POST',
            dataType: 'Json',
            data: {
                "id": $(this).attr('id'),
            },
            success: function(data) {
                if (data['Status'] == 'Sukses') {
                    $('#info').html('<div class="alert alert-success" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                    setTimeout(function() {
                        window.location.href = "<?php echo base_url('admin/folder/' . $kode) ?>";
                    }, 1500);
                } else {
                    $('#info').html('<div class="alert alert-danger" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                }
            }
        });
    });

    $(".removefavoritfile").click(function() {
        $.ajax({
            url: "<?= base_url('api/prosses/removefavoritfile') ?>",
            type: 'POST',
            dataType: 'Json',
            data: {
                "id": $(this).attr('id'),
            },
            success: function(data) {
                if (data['Status'] == 'Sukses') {
                    $('#info').html('<div class="alert alert-success" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                    setTimeout(function() {
                        window.location.href = "<?php echo base_url('admin/folder/' . $kode) ?>";
                    }, 1500);
                } else {
                    $('#info').html('<div class="alert alert-danger" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                }
            }
        });
    });

    $("#formtrash").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: "<?php echo base_url('api/prosses/trashfile') ?>",
            type: 'POST',
            dataType: 'Json',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function(xhr) {
                $("#sampah").modal('hide');
            },
            success: function(data) {
                if (data['Status'] == 'Sukses') {
                    $('#info').html('<div class="alert alert-success" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                    setTimeout(function() {
                        window.location.href = "<?php echo base_url('admin/folder/' . $kode) ?>";
                    }, 1500);
                } else {
                    $('#info').html('<div class="alert alert-danger" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                }
            }
        });
    });

    $("#formhapus").on("submit", function(e) {
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
                        window.location.href = "<?php echo base_url('admin/folder/' . $kode); ?>";
                    }, 1500);
                } else {
                    $('#info').html('<div class="alert alert-danger" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                }
            }
        });
    });

    $("#formrename").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: "<?php echo base_url('api/prosses/renamefolder') ?>",
            type: 'POST',
            dataType: 'Json',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function(xhr) {
                $("#renamefolder").modal('hide');
            },
            success: function(data) {
                if (data['Status'] == 'Sukses') {
                    $('#info').html('<div class="alert alert-success" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                    setTimeout(function() {
                        window.location.href = "<?php echo base_url('admin/folder/' . $kode) ?>";
                    }, 1500);
                } else {
                    $('#info').html('<div class="alert alert-danger" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                }
            }
        });
    });

    $("#trashfolder").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: "<?php echo base_url('api/prosses/trashfolder') ?>",
            type: 'POST',
            dataType: 'Json',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function(xhr) {
                $("#sampahfolder").modal('hide');
            },
            success: function(data) {
                if (data['Status'] == 'Sukses') {
                    $('#info').html('<div class="alert alert-success" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                    setTimeout(function() {
                        window.location.href = "<?php echo base_url('admin/folder/' . $kode) ?>";
                    }, 1500);
                } else {
                    $('#info').html('<div class="alert alert-danger" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                }
            }
        });
    });

    $("#deletefolder").on("submit", function(e) {
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
                        window.location.href = "<?php echo base_url('admin/folder/' . $kode) ?>";
                    }, 1500);
                } else {
                    $('#info').html('<div class="alert alert-danger" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                }
            }
        });
    });

    $("#shfolder").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: "<?php echo base_url('api/prosses/sharefolder') ?>",
            type: 'POST',
            dataType: 'Json',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function(xhr) {
                $("#sharefolder").modal('hide');
            },
            success: function(data) {
                if (data['Status'] == 'Sukses') {
                    $('#info').html('<div class="alert alert-success" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                    setTimeout(function() {
                        window.location.href = "<?php echo base_url('admin/folder/' . $kode) ?>";
                    }, 1500);
                } else {
                    $('#info').html('<div class="alert alert-danger" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                }
            }
        });
    });

    $("#unshfolder").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: "<?php echo base_url('api/prosses/unsharefolder') ?>",
            type: 'POST',
            dataType: 'Json',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function(xhr) {
                $("#unsharefolder").modal('hide');
            },
            success: function(data) {
                if (data['Status'] == 'Sukses') {
                    $('#info').html('<div class="alert alert-success" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                    setTimeout(function() {
                        window.location.href = "<?php echo base_url('admin/folder/' . $kode) ?>";
                    }, 1500);
                } else {
                    $('#info').html('<div class="alert alert-danger" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                }
            }
        });
    });



    $("#shfile").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: "<?php echo base_url('api/prosses/sharefile') ?>",
            type: 'POST',
            dataType: 'Json',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function(xhr) {
                $("#sharefile").modal('hide');
            },
            success: function(data) {
                if (data['Status'] == 'Sukses') {
                    $('#info').html('<div class="alert alert-success" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                    setTimeout(function() {
                        window.location.href = "<?php echo base_url('admin/folder/' . $kode) ?>";
                    }, 1500);
                } else {
                    $('#info').html('<div class="alert alert-danger" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                }
            }
        });
    });

    $("#unshfile").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: "<?php echo base_url('api/prosses/unsharefile') ?>",
            type: 'POST',
            dataType: 'Json',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function(xhr) {
                $("#unsharefile").modal('hide');
            },
            success: function(data) {
                if (data['Status'] == 'Sukses') {
                    $('#info').html('<div class="alert alert-success" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                    setTimeout(function() {
                        window.location.href = "<?php echo base_url('admin/folder/' . $kode) ?>";
                    }, 1500);
                } else {
                    $('#info').html('<div class="alert alert-danger" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                }
            }
        });
    });


    function downloadImage(url, name) {
        fetch(url)
            .then(resp => resp.blob())
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.style.display = 'none';
                a.href = url;
                // the filename you want
                a.download = name;
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
            })
            .catch(() => alert('An error sorry'));
    }
</script>