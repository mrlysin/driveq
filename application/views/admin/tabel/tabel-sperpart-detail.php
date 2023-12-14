<div class="table-responsive-sm">
    <table id="example" class="table table-striped table-bordered first">
        <thead>
            <tr>
                <th class="center">Kode</th>
                <th>Sperpart</th>
                <th>Assembly</th>
                <th>Status</th>
                <th class="right">Jumlah</th>
                <!-- <th></th> -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $detail) { ?>
                <tr>
                    <td class="center"><?php echo $detail->kode ?></td>
                    <td class="left strong"><?php echo $detail->nama ?></td>
                    <td class="left strong"><?php echo $detail->mesin ?></td>
                    <td class="center"><?php echo $detail->credential ?></td>
                    <td class="center"><?php echo $detail->jumlah ?></td>
                    <!-- <td class="center">
                        <a title="Hapus" href="#" id="<?php echo $detail->id ?>" data-toggle="modal" data-target="#deletedetail" class="del badge badge-pill badge-danger"><i class="fas fa-trash"></i></a>
                    </td> -->
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="deletedetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                <center>Apa Anda ingin menghapus sperpart ini?</center>
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
    $(document).ready(function() {
        $('#example').DataTable();
    });

    $(".del").click(function() {
        $("#idDel").val($(this).attr('id'));
    });

    $(".hapus").click(function() {
        $.ajax({
            url: "<?php echo base_url('api/prosses/deletedetailrequest') ?>",
            type: 'POST',
            dataType: 'Json',
            data: {
                'id': $("#idDel").val(),
                'userid': $("#userid").val()
            },
            success: function(data) {
                if (data['Status'] == 'Sukses') {
                    $('.info').html('<div class="alert alert-success" role="alert">' + data['Notif'] + '</div>');
                    setTimeout(function() {
                        $(".detail").load("<?php echo base_url('admin/tabelrequestdetail/') . $id ?>");
                    }, 1500);
                } else {
                    $('.info').html('<div class="alert alert-danger" role="alert">' + data['Notif'] + '</div>');
                }
            }
        });
    });
</script>