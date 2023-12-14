<div class="main-content container-fluid p-0">
    <div class="email-inbox-header border-bottom">
        <div class="row">
            <div class="col-lg-12">
                <div class="email-title">
                    <span class="icon"><i class="fas fa-book"></i></span>
                    <?php if ($this->session->userdata('Level') == 4) {
                        echo '<a href="' . base_url('admin/arsipdesa/' . $this->session->userdata('KodeInstansi')) . '">Arsip Desa</a>';
                    } else {
                        echo '<a href="' . base_url('admin/desa') . '">Arsip Desa</a>';
                    }
                    if (!empty($desa)) {
                        echo ' / <a href="' . base_url('admin/arsipdesa/' . $desa['kode_desa']) . '">' . $desa['nama_desa'] . '</a>';
                    }
                    if (!empty($detail)) {
                        echo ' / ' . $detail['nama'];
                        if ($this->session->userdata('Level') == 4) {
                            echo '<div class="float-right">
                            <a href="' . base_url('admin/tambaharsipdesa/' . encrypt_this($detail['id'])) . '" title="Upload Arsip" class="btn btn-sm btn-success"><i class="fas fa-upload"></i> Upload File</a>
                            </div>';
                        } else {
                            echo '<div class="float-right">
                            <a href="#" title="Tambah" class="btn btn-sm btn-light"><i class="fas fa-th"></i></a>
                            </div>';
                        }
                    } else {
                        echo '<div class="float-right">
                        <a href="#" title="Tambah" class="btn btn-sm btn-light"><i class="fas fa-th"></i></a>
                        </div>';
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>

    <div id="info"></div>

    <div class="email-list">
        <?php foreach ($folder as $folders) { ?>
            <div class="email-list-item">
                <div class="email-list-actions">
                    <i class="fas fa-folder"></i>
                </div>
                <div class="email-list-detail">
                    <a href="<?php echo base_url('admin/arsipdesa/' . $desa['kode_desa'] . '/' . encrypt_this($folders->id)) ?>">
                        <span class="from"><?php echo ucwords(strtolower($folders->nama)); ?></span>
                    </a>
                </div>
            </div>
        <?php } ?>

        <?php if (!empty($file)) { ?>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Nomor</th>
                                    <th>Tanggal</th>
                                    <th>Upload</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($file as $files) { ?>
                                    <tr>
                                        <td><?php echo $files->kode; ?></td>
                                        <td><?php echo $files->nama; ?></td>
                                        <td><?php echo $files->nomor; ?></td>
                                        <td><?php echo $files->tanggal; ?></td>
                                        <td><?php echo $files->datecreated; ?></td>
                                        <td>
                                            <div class="input-group-prepend be-addon">
                                                <button tabindex="-1" type="button" class="btn btn-primary btn-xs">Aksi</button>
                                                <button tabindex="-1" data-toggle="dropdown" type="button" class="btn btn-primary btn-xs dropdown-toggle dropdown-toggle-split">
                                                    <span class="sr-only">Action</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a href="#" onclick="downloadImage('<?php echo base_url('upload/' . $files->nama_file) ?>', '<?php echo $files->nama_file_upload; ?>')" class="dropdown-item text-grey"><span class="fa fa-download"></span> Download</a>
                                                    <a target="_blank" href="<?php echo base_url('admin/viewfile/' . encrypt_this($files->id)) ?>" class="dropdown-item text-grey"><span class="fa fa-eye"></span> Lihat</a>
                                                    <?php if ($this->session->userdata('Level') == 4) { ?>
                                                        <a href="<?php echo base_url('admin/editarsipdesa/' . str_replace(' ', '-', $detail['nama']) . '/' . $this->session->userdata('KodeInstansi') . '/' . encrypt_this($files->id)) ?>" class="dropdown-item text-grey"><span class="fa fa-edit"></span> Edit</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="#" id="<?php echo encrypt_this($files->id); ?>" class="trash dropdown-item text-warning" data-toggle="modal" data-target="#sampah"><span class="far fa-trash-alt"></span> Trash</a>
                                                        <a href="#" id="<?php echo encrypt_this($files->id); ?>" class="hapus dropdown-item text-danger" data-toggle="modal" data-target="#hapus"><span class="fa fa-trash"></span> Hapus</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
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

<script>
    $(".trash").click(function() {
        $("#idtrash").val($(this).attr('id'));
    });

    $(".hapus").click(function() {
        $("#idhapus").val($(this).attr('id'));
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
                        window.location.href = "<?php echo base_url('admin/arsipdesa/' . $this->session->userdata('KodeInstansi') . '/' . encrypt_this($detail['id'])) ?>";
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
                        window.location.href = "<?php echo base_url('admin/arsipdesa/' . $this->session->userdata('KodeInstansi') . '/'  . encrypt_this($detail['id']))
                                                ?>";
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