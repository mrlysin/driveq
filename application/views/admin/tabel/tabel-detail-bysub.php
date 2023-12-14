<table id="example1" class="table table-striped table-bordered first">
    <thead>
        <tr>
            <th>Sparepart</th>
            <th>Stok</th>
            <th>Jumlah Req</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $detail) { ?>
            <tr>
                <td class="center"><?php echo $detail->nama ?></td>
                <td class="center strong">
                    <?php if ($detail->stok < $detail->jumlah) {
                        echo "<span class='text-danger'>" . $detail->stok . "</span>";
                    } else {
                        echo $detail->stok;
                    } ?>
                </td>
                <td class="center strong"><?php echo $detail->jumlah ?></td>
                <!-- <td class="center strong"><?php // echo $detail->kembali 
                                                ?></td> -->
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#example1').DataTable();
    });
</script>