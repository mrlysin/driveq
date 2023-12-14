<div class="table-responsive">
  <table id="tabel" class="table table-striped table-bordered first">
    <thead>
      <tr>
        <th>Mesin</th>
        <th>Total Assembly</th>
        <th>Total Sub Assembly</th>
        <th>Total Sparepart</th>
        <th>Stok Sperpart</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data as $sperpart) { ?>
        <tr>
          <td><?php echo $sperpart->nama . ' - V.' . $sperpart->versi ?></td>
          <td><?php echo $sperpart->jumlah_assembly ?></td>
          <td><?php echo $sperpart->jumlah_subassembly ?></td>
          <td><?php echo $sperpart->jumlah_sperpart ?></td>
          <td><?php if ($sperpart->stok_sperpart >= $sperpart->jumlah_sperpart) {
                echo $sperpart->stok_sperpart;
              } else {
                echo '<div class="text-danger">' . $sperpart->stok_sperpart . '</div>';
              } ?></td>
          <!-- <td><?php // echo $sperpart->nama 
                    ?></td> -->
          <td>
            <?php if ($sperpart->aktif == 'Aktif') {
              echo '<div>' . $sperpart->aktif . '</div>';
            } else {
              echo '<div class="text-warning">' . $sperpart->aktif . '</div>';
            } ?>
          </td>
          <td>
            <a title="Setting" href="<?php echo base_url('admin/pilihsperpartset/' . $sperpart->id) ?>" class="editmesin badge badge-pill badge-success"><i class="fas fa-tasks"></i></a>
            <a title="Hapus" href="#" id="<?php echo $sperpart->id ?>" data-toggle="modal" data-target="#deletemesin" class="del badge badge-pill badge-danger"><i class="fas fa-trash"></i></a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<div class="modal fade" id="deletemesin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
      <div class="modal-body">
        <center>Apa Anda ingin menghapus mesin ini?</center>
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
    $(function() {
      $('#tabel').DataTable()
    });
  });

  $(".del").click(function() {
    $("#idDel").val($(this).attr('id'));
  });

  $(".hapus").click(function() {
    $.ajax({
      url: "<?php echo base_url('api/prosses/deletemesinset') ?>",
      type: 'POST',
      dataType: 'Json',
      data: {
        'id': $("#idDel").val(),
        'userid': $("#userid").val()
      },
      success: function(data) {
        if (data['Status'] == 'Sukses') {
          $('#info').html('<div class="alert alert-success" role="alert">' + data['Notif'] + '</div>');
          $(window).scrollTop(0);
          setTimeout(function() {
            window.location.href = "<?php echo base_url('admin/mesinset') ?>";
          }, 1500);
        } else {
          $('#info').html('<div class="alert alert-danger" role="alert">' + data['Notif'] + '</div>');
          $(window).scrollTop(0);
        }
      }
    });
  });
</script>