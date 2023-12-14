<div class="main-content container-fluid p-0">
    <div class="email-inbox-header border-bottom">
        <div class="row">
            <div class="col-lg-12">
                <div class="email-title">
                    <span class="icon"><i class="fas fa-book"></i></span>
                    <a href="<?php echo base_url('admin/desa'); ?>">Arsip Desa</a>
                    <div class="float-right">
                        <a href="#" title="View" class="btn btn-sm btn-light"><i class="fas fa-th"></i></a>
                    </div>
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
                    <a href="<?php echo base_url('admin/arsipdesa/' . $folders->kode_desa) ?>">
                        <span class="from"><?php echo ucwords(strtolower($folders->nama_desa)); ?></span>
                    </a>
                </div>
            </div>
        <?php } ?>

    </div>
</div>