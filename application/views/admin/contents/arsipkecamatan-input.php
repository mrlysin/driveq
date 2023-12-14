<div class="main-content container-fluid p-0">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h3 class="mb-2">Upload Arsip</h3>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo base_url('admin') ?>" class="breadcrumb-link">E - Arsip</a>
                                </li>
                                <li class="breadcrumb-item">Upload Arsip</li>
                                <li class="breadcrumb-item active" aria-current="page"><b><?php echo $detail['nama'] ?></b></li>
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
                                        <label for="nama">Nama Dokumen</label>
                                        <input type="text" class="form-control form-control-lg" name="nama" required>
                                        <div class="invalid-feedback">
                                            Nama dokumen kosong.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nomor">Nomor Dokumen</label>
                                        <input type="text" class="form-control form-control-lg" name="nomor" required>
                                        <div class="invalid-feedback">
                                            Nomor dokumen kosong.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Tanggal Dokumen</label>
                                        <input type="date" class="form-control form-control-lg" name="tanggal" required>
                                        <div class="invalid-feedback">
                                            Tanggal kosong.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">File</label>
                                        <input type="file" class="form-control form-control-lg" name="file" required>
                                        <div class="invalid-feedback">
                                            File kosong.
                                        </div>
                                        <input type="hidden" value="<?php echo encrypt_this('3') ?>" name="kategori">
                                        <input type="hidden" value="<?php echo encrypt_this($detail['id']) ?>" name="kode">
                                        <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('IdUser')) ?>" name="userid">
                                        <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('Level')) ?>" name="level">
                                        <input type="hidden" value="<?php echo encrypt_this($this->session->userdata('KodeInstansi')) ?>" name="kodeinstansi">
                                    </div>
                                    <button type="submit" class="simpan btn btn-primary">Upload</button>
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
            url: "<?php echo base_url('api/prosses/tambahfile') ?>",
            type: 'POST',
            dataType: 'Json',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data['Status'] == 'Sukses') {
                    $('#info').html('<div class="alert alert-success" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                    setTimeout(function() {
                        window.location.href = "<?php echo base_url('admin/arsipkecamatan/' . $this->session->userdata('KodeInstansi') . '/' . $bagian . '/' . encrypt_this($detail['id'])) ?>";
                    }, 1500);
                } else {
                    $('#info').html('<div class="alert alert-danger" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                }
            }
        });
    });
</script>