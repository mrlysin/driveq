<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <?php if (empty($grafik)) {
                    echo "<center>Tidak ada transaksi dalam 7 hari terakhir</center>";
                } else { ?>
                    <center>
                        <?php echo $lastreq['namamesin'] . ' <br/> ' . date('d-m-Y', strtotime($lastreq['awal'])) . ' s/d ' . date('d-m-Y', strtotime($lastreq['akhir'])) ?>
                    </center>
                    <div id="area-chart"></div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Req</th>
                                <th>Assembly</th>
                                <th>Kode Sperpart</th>
                                <th>Sperpart</th>
                                <th>Tanggal Req</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($list as $request) { ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td>
                                        <a href="<?php echo base_url('admin/requestdetail/') . $request->kodereq ?>">
                                            <?php echo $request->kodereq ?>
                                        </a>
                                    </td>
                                    <td><?php echo $request->mesin ?></td>
                                    <td><?php echo $request->kodesperpart ?></td>
                                    <td><?php echo $request->sperpart ?></td>
                                    <td><?php echo $request->tanggal_req ?></td>
                                    <td><?php echo $request->jumlah ?></td>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });

    Morris.Bar({
        element: 'area-chart',
        behaveLikeLine: true,
        data: [<?php echo $grafik; ?>],
        xkey: 'y',
        ykeys: ['a'],
        labels: [<?php echo $nama; ?>],
        lineColors: ['#5969ff'],
        resize: true
    });
</script>