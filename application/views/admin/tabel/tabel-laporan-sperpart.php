<div class="row">
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="text-muted"><i class="text-primary fa fa-fw fa-download"></i> MASUK</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1 text-primary"><?php echo $totaltransaksi['barangmasuk']; ?></h1>
                </div>
            </div>
            <div id="sparkline-3">
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="text-muted"><i class="text-success fa fa-fw fa-upload"></i> KELUAR</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1 text-primary"><?php echo $totaltransaksi['barangkeluar']; ?></h1>
                </div>
            </div>
            <div id="sparkline-3">
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="text-muted"><i class="text-muted fa fa-fw fa-reply"></i> RETURN</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1 text-primary"><?php echo $totaltransaksi['barangreturn']; ?></h1>
                </div>
            </div>
            <div id="sparkline-3">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <div id="area-chart"></div>
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
                                <th>Foto</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Assembly</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Arus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($list as $sperpart) { ?>
                                <tr>
                                    <td><img height="100px" src="<?php echo $sperpart->foto ?>"></td>
                                    <td><?php echo $sperpart->kode ?></td>
                                    <td><?php echo $sperpart->sperpart ?></td>
                                    <td><?php echo $sperpart->mesin ?></td>
                                    <td><?php echo $sperpart->tanggal . ' ' . $sperpart->jam ?></td>
                                    <td><?php echo $sperpart->jumlah ?></td>
                                    <td>
                                        <?php if ($sperpart->arus == 'Masuk') {
                                            echo '<span class="badge badge-pill badge-primary">' . $sperpart->arus . '</span>';
                                        }
                                        if ($sperpart->arus == 'Keluar') {
                                            echo '<span class="badge badge-pill badge-success">' . $sperpart->arus . '</span>';
                                        }
                                        if ($sperpart->arus == 'Return') {
                                            echo '<span class="badge badge-pill badge-warning">' . $sperpart->arus . '</span>';
                                        } ?>
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
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });

    Morris.Line({
        element: 'area-chart',
        behaveLikeLine: true,
        data: [<?php echo $grafik; ?>],
        xkey: 'y',
        ykeys: ['a', 'b', 'c'],
        labels: ['Masuk', 'Return', 'Keluar'],
        lineColors: ['#5969ff', '#b9babb', '#2ec551'],
        resize: true
    });
    
</script>