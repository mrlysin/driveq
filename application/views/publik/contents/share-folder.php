<div class="container-fluid p-0">
    <div class="email-inbox-header border-bottom">
        <div class="row">
            <div class="col-lg-12">
                <div class="email-title">
                    <span class="icon"><i class="fas fa-folder-open"></i></span>
                    <?php if (!empty($detail)) {
                        echo $detail['nama'];
                    } ?>
                    <div class="float-right">
                        <a href="<?php echo base_url('share/download/' . $kode) ?>" title="Download" class="btn btn-sm btn-primary">
                            <i class="fas fa-download"></i> DOWNLOAD
                        </a>
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
                    <div class="dropdown ml-auto">
                        <a class="toolbar" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="mdi mdi-dots-vertical"></i> </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink" x-placement="top-end" style="position: absolute; transform: translate3d(-160px, -102px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="dropdown-item" href="<?php echo base_url('share/download/' . $kode) ?>"><i class="fa fa-download"></i> Download</a>
                            <a class="dropdown-item" href="<?php echo base_url('share/folder/' . encrypt_this($folders->id)) ?>"><i class="fa fa-eye"></i> Lihat</a>
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
                    <a href="<?php echo base_url('share/folder/' . encrypt_this($folders->id)) ?>">
                        <span class="from"><i class="fas fa-folder"></i> <?php echo $folders->nama; ?></span>
                    </a>
                </div>
            </div>
        <?php } ?>

        <?php foreach ($file as $files) { ?>
            <div class="email-list-item">
                <div class="email-list-actions">
                    <div class="dropdown ml-auto">
                        <a class="toolbar" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="mdi mdi-dots-vertical"></i> </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink" x-placement="top-end" style="position: absolute; transform: translate3d(-160px, -102px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="dropdown-item" href="#" onclick="downloadImage('<?php echo base_url('upload/' . $files->nama_file) ?>', '<?php echo $files->nama_file_upload; ?>')"><i class="fa fa-download"></i> Download</a>
                            <a class="dropdown-item" target="_blank" href="<?php echo base_url('share/Viewfile/' . encrypt_this($files->id)); ?>"><i class="fa fa-eye"></i> Lihat</a>
                        </div>
                    </div>
                </div>
                <div class="email-list-detail">
                    <span class="date float-right">
                        <?php if ($files->id_share >= 1) { ?>
                            <a href="#">
                                <span><i class="fas fa-users"></i></span>
                            </a>
                        <?php } ?>
                        <?php echo Tgl_Indo(date('Y-m-d', strtotime($files->datecreated))); ?>
                    </span>
                    <a target="_blank" href="<?php echo base_url('share/Viewfile/' . encrypt_this($files->id)); ?>">
                        <span class="from"><?php echo tipefile($files->tipe_file) . ' ' . $files->nama_file_upload; ?></span>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<script>
    function downloadImage(url, name) {
        fetch(url)
            .then(resp => resp.blob())
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.style.display = 'none';
                a.href = url;
                a.download = name;
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
            })
            .catch(() => alert('An error sorry'));
    }
</script>