<div class="influence-profile">
    <div class="container-fluid dashboard-content ">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h3 class="mb-2">Users</h3>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo base_url('admin') ?>" class="breadcrumb-link">
                                        Dashboard
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Users</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="<?php echo base_url('admin/tambahuser') ?>" class="simpan btn btn-primary btn-xs">
                    <i class="fas fa-plus"></i> Tambah User
                </a>
                <br/><br/>
            </div>
            <div class="col-12">
                <div id="info"></div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered first">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Level</th>
                                        <th>Aktif</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $users) { ?>
                                        <tr>
                                            <td><?php echo $users->nama ?></td>
                                            <td><?php echo $users->username ?></td>
                                            <td><?php echo $users->levelname ?></td>
                                            <td><?php echo $users->aktif ?></td>
                                            <td>
                                                <a title="Edit" href="<?php echo base_url('admin/edituser/').$users->id ?>" class="badge badge-pill badge-success"><i class="fas fa-pencil-alt"></i></a>

                                                <a title="Hapus" href="#" id="<?php echo $users->id ?>" data-toggle="modal" data-target="#exampleModal" class="del badge badge-pill badge-danger"><i class="fas fa-trash"></i></a>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                <center>Apa Anda ingin menghapus user ini?</center>
                <input type="hidden" id="idDel">
                <input type="hidden" value="<?php echo $this->session->userdata('IdUser') ?>" id="userid">
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-light btn-xs" data-dismiss="modal">Tidak</a>
                <a href="#" class="hapus btn btn-danger btn-xs" data-dismiss="modal">Ya</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(".del").click(function() {
        $("#idDel").val($(this).attr('id'));
    });

    $(".hapus").click(function() {
        $.ajax({
            url: "<?= base_url('api/prosses/deleteuser') ?>",
            type: 'POST',
            dataType: 'Json',
            data: {
                "id": $('#idDel').val(),
                "userid": $('#userid').val()
            },
            success: function (data) {
                if(data['Status']=='Sukses'){
                    $('#info').html('<div class="alert alert-success" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                    setTimeout(function(){
                        window.location.href = "<?php echo base_url('admin/users') ?>";
                    },1500);
                } else {
                    $('#info').html('<div class="alert alert-danger" role="alert">' + data['Notif'] + '</div>');
                    $(window).scrollTop(0);
                    $(".loading").hide();
                    $(".simpan").show();
                }
            }
        });
    });
</script>

