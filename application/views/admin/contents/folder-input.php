<div class="main-content container-fluid p-0">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h3 class="mb-2">Tambah Folder</h3>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo base_url('admin') ?>" class="breadcrumb-link">E - Arsip</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Tambah Folder</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div id="info"></div>
                <div class="card influencer-profile-data">
                    <div class="card-body">
                        <form id="formedit" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-12 p-4">
                                    <div class="form-group">
                                        <label for="name">Nama Folder</label>
                                        <input type="text" class="form-control form-control-lg" name="nama" required>
                                        <div class="invalid-feedback">
                                            Nama folder harus diisi.
                                        </div>
                                        <input type="hidden" value="<?php echo $kode ?>" name="parent">
                                        <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('IdUser')) ?>" name="userid">
                                        <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('Level')) ?>" name="level">
                                        <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('KodeInstansi')) ?>" name="kodeinstansi">
                                    </div>
                                    <button type="submit" class="simpan btn btn-primary">Simpan</button>
                                    <span style="display: none;" class="loading dashboard-spinner spinner-primary spinner-xs"></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#formedit").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: "<?php echo base_url('api/prosses/tambahfolder') ?>",
            type: 'POST',
            dataType: 'Json',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('.loading').show();
                $('.simpan').hide();
            },
            success: function(data) {
                if (data['Status'] == 'Sukses') {
                    $('#info').html('<div class="alert alert-success" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                    setTimeout(function() {
                        window.location.href = "<?php
                                                if ($kode == null) {
                                                    echo base_url('admin');
                                                } else {
                                                    echo base_url('admin/folder/' . $kode);
                                                }
                                                ?>";
                    }, 1500);
                } else {
                    $('#info').html('<div class="alert alert-danger" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                    $('.loading').hide();
                    $('.simpan').show();
                }
            }
        });
    });
</script>