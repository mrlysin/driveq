<div class="table-responsive">

  <table id="tabeldetail" class="table table-striped table-bordered first">
    <thead>
      <tr>
        <th>Foto</th>
        <th>Kode</th>
        <th>Nama</th>
        <!-- <th>Mesin</th> -->
        <th>Assembly</th>
        <th>Sub Assembly</th>
        <th>Default Stok</th>
        <th>Stok</th>
        <th></th>
      </tr>
    </thead>
    <tbody>

      <?php foreach ($data as $sperpart) { ?>
        <tr>
          <td><img height="100px" src="<?php echo $sperpart->foto ?>"></td>
          <td><?php echo $sperpart->kode ?></td>
          <td><?php echo $sperpart->nama ?></td>
          <!-- <td><?php echo $sperpart->mesin ?></td> -->
          <td><?php echo $sperpart->assembly ?></td>
          <td><?php echo $sperpart->subassembly ?></td>
          <td><?php echo $sperpart->defaultstok ?></td>
          <td><?php echo $sperpart->stok ?></td>

          <td>
            <!-- <button title="Edit" st="<?php echo $sperpart->stok ?>" type="button" mesin="<?php echo $sperpart->mesinset_id; ?>" id="<?php echo $sperpart->id; ?>" class="ubah btn btn-success btn-xs btn-flat" data-toggle="modal" data-target="#modal-edit">
              <i class="fa fa-edit"></i>
            </button> -->
            <button title="Edit" st="<?php echo $sperpart->defaultstok ?>" type="button" mesin="<?php echo $sperpart->id; ?>" id="<?php echo $sperpart->id; ?>" class="edit btn btn-success btn-xs btn-flat" data-toggle="modal" data-target="#modal-tambah">
              <i class="fa fa-edit"></i>
            </button>
            <button title="Hapus" st="<?php echo $sperpart->stok ?>" type="button" mesin="<?php echo $sperpart->mesinset_id; ?>" id="<?php echo $sperpart->id; ?>" class="ubah btn btn-danger btn-xs btn-flat" data-toggle="modal" data-target="#modal-hapus">
              <i class="fa fa-trash"></i>
            </button>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<div class="modal fade" id="modal-hapus">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Sparepart from setting</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="ubahsperpart">
        <div class="modal-body">
          <div class="form-group">
            <label>Yakin ingin menghapus part ini?</label>
            <!-- <label>Jumlah</label> -->
            <input type="hidden" name="mesinset" id="mesinset" value="<?php echo $id; ?>">
            <input type="hidden" name="mesinsetdetail" id="mesinsetdetail_id">
            <!-- <input type="number" name="jumlah" id="jumlah" required class="form-control form-control-lg" id="jumlah"> -->
            <input type="hidden" name="userid" id="userid" value="<?php echo $this->session->userdata('IdUser') ?>">
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="tmb btn btn-info">Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $(function() {
      $('#tabeldetail').DataTable()
    });
  });
</script>

<script>
  $('#ubahsperpart').parsley();
  $(".ubah").click(function() {
    var row = $(this).closest("tr");
    $('#mesinsetdetail_id').val($(this).attr('id'));
    $('#mesinset_id').val($(this).attr('mesin'));
  });

  $("form#ubahsperpart").submit(function(e) {
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    $.ajax({
      url: "<?php echo base_url('api/prosses/hapusdetailmesinset') ?>",
      type: 'POST',
      dataType: 'Json',
      data: formData,
      contentType: false,
      processData: false,
      success: function(data) {
        if (data['Status'] == 'Sukses') {
          $('#modal-hapus').modal('toggle');
          $("#ubahsperpart")[0].reset();
          $(".infoafter").fadeTo(2000, 500).slideUp(500, function() {
            $(".infoafter").slideUp(500);
          });
          $('.infoafter').html('<div class="alert alert-success" role="alert">' + data['Notif'] + '</div>');
          setTimeout(function() {
            $(".detail").load("<?php echo base_url('admin/tabelmesinsetdetail/') ?>" + $('#mesinset').val());
            $(".tabelsperpart").load("<?php echo base_url('admin/sperpartsetbymesin/') ?>" + $('#mesinset').val() + "/" + $('#mesinset').val());

          }, 1000);
        } else {
          $(".infoafter").fadeTo(2000, 500).slideUp(500, function() {
            $(".infoafter").slideUp(500);
          });
          $('.infoafter').html('<div class="alert alert-danger" role="alert">' + data['Notif'] + '</div>');
        }
      }
    });
  });
</script>