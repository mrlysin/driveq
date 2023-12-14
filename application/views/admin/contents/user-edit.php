<div class="influence-profile">
    <div class="container-fluid dashboard-content ">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h3 class="mb-2">Edit User</h3>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo base_url('admin') ?>" class="breadcrumb-link">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="<?php echo base_url('admin/users') ?>" class="breadcrumb-link">Users</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div id="info"></div>
                <div class="alert alert-info" role="alert">
                    <b>Info!</b> Kosongkan password jika tidak ingin mengganti.
                </div>
                <div class="card">
                    <div class="card-body">
                        <form id="formedit">
                            <div class="row">
                                <div class="col-12 p-4">
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control form-control-lg" value="<?php echo $data['nama'] ?>" name="nama" placeholder="">
                                        <input type="hidden" value="<?php echo $data['id'] ?>" name="id">
                                        <input type="hidden" value="<?php echo $this->session->userdata('IdUser') ?>" name="userid">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Username</label>
                                        <input type="text" class="form-control form-control-lg" value="<?php echo $data['username'] ?>" name="username" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="subject">Password</label>
                                        <input type="password" class="form-control form-control-lg" name="password" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="subject">Level</label>
                                        <select class="form-control form-control-lg" name="level">
                                            <?php foreach ($level as $level) { ?>
                                                <option <?php if($data['level']==$level->id){ echo "selected"; } ?> value="<?php echo $level->id ?>"><?php echo $level->nama ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>                  
                                    <button type="submit" class="simpan btn btn-primary float-right">Simpan</button>
                                    <span style="display: none;" class="loading dashboard-spinner spinner-primary spinner-xs float-right"></span>
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
  $("form#formedit").submit(function(e) {
    $(".loading").show();
    $(".simpan").hide();
    e.preventDefault();    
    var formData = new FormData($(this)[0]);
    $.ajax({
        url: "<?php echo base_url('api/prosses/edituser') ?>",
        type: 'POST',
        dataType: 'Json',
        data: formData,
        contentType: false,
        processData: false,
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