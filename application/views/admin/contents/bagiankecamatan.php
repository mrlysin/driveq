<div class="main-content container-fluid p-0">
    <div class="email-inbox-header border-bottom">
        <div class="row">
            <div class="col-lg-12">
                <div class="email-title">
                    <span class="icon"><i class="fas fa-book"></i></span>
                    <a href="<?php echo base_url('admin/kecamatan') ?>">Arsip Kecamatan</a>
                    <?php
                    if (!empty($detail)) {
                        echo ' / ' . $detail['nama'];
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>

    <div class="email-list">
        <?php foreach ($folder as $folders) { ?>
            <div class="email-list-item">
                <div class="email-list-actions">
                    <i class="fas fa-folder"></i>
                </div>
                <div class="email-list-detail">
                    <a href="<?php echo base_url('admin/arsipkecamatan/' . $this->session->userdata('KodeInstansi') . '/' . str_replace(' ', '-', $detail['nama']) . '/' . encrypt_this($folders->id)) ?>">
                        <span class="from"><?php echo $folders->nama; ?></span>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>