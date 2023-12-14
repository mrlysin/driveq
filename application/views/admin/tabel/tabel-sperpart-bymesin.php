<div class="table-responsive">
  <table id="tabel" class="table table-striped table-bordered first">
    <thead>
      <tr>
        <th>Foto</th>
        <th>Kode</th>
        <th>Nama</th>
        <th>Mesin</th>
        <th>Assembly</th>
        <th>Sub Assembly</th>
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
          <td><?php echo $sperpart->mesin ?></td>
          <td><?php echo $sperpart->assembly ?></td>
          <td><?php echo $sperpart->subassembly ?></td>
          <td><?php echo $sperpart->stok ?></td>
          <td>
            <button title="Tambah" st="<?php echo $sperpart->stok ?>" type="button" mesin="<?php echo $sperpart->mesin_id; ?>" id="<?php echo $sperpart->id; ?>" class="tambah btn btn-info btn-xs btn-flat" data-toggle="modal" data-target="#modal-tambah">
              <i class="fa fa-plus"></i>
            </button>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah ke Request</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="tambahsperpart">
        <div class="modal-body">
          <div class="form-group">
            <label>Jumlah</label>
            <input type="hidden" name="request" id="req_id" value="<?php echo $req_id; ?>">
            <input type="hidden" name="sperpart" id="sperpart">
            <input type="hidden" name="mesin" id="mesin_id">
            <input type="number" name="jumlah" id="jumlah" required class="form-control form-control-lg" id="jumlah">
            <input type="hidden" name="userid" id="userid" value="<?php echo $this->session->userdata('IdUser') ?>">
          </div>
          <div class="form-group">
            <label class="custom-control custom-radio custom-control-inline">
              <input type="radio" required value="1" id="urgent" name="urgent" class="custom-control-input"><span class="custom-control-label">Normal</span>
            </label>
            <label class="custom-control custom-radio custom-control-inline">
              <input type="radio" value="2" id="urgent" name="urgent" class="custom-control-input"><span class="custom-control-label">Urgent</span>
            </label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="tmb btn btn-info">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $('#tambahsperpart').parsley();

  $(document).ready(function() {
    $(function() {
      $('#tabel').DataTable()
    });
  });

  $(".tambah").click(function() {
    var row = $(this).closest("tr");
    $("#jumlah").attr("data-parsley-max", row.find("td:nth-child(7)").text());
    $('#sperpart').val($(this).attr('id'));
    $('#mesin_id').val($(this).attr('mesin'));
  });

  $("form#tambahsperpart").submit(function(e) {
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    $.ajax({
      url: "<?php echo base_url('api/prosses/inputdetailrequest') ?>",
      type: 'POST',
      dataType: 'Json',
      data: formData,
      contentType: false,
      processData: false,
      success: function(data) {
        if (data['Status'] == 'Sukses') {
          $('#modal-tambah').modal('toggle');
          $("#tambahsperpart")[0].reset();
          $('.info').html('<div class="alert alert-success" role="alert">' + data['Notif'] + '</div>');
          setTimeout(function() {
            $(".detail").load("<?php echo base_url('admin/tabelrequestdetail/') ?>" + $('#req_id').val());
          }, 1000);
        } else {
          $('.info').html('<div class="alert alert-danger" role="alert">' + data['Notif'] + '</div>');
        }
      }
    });
  });
</script>