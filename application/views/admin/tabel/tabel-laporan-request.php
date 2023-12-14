<div class="row">
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="text-muted"><span class="fa-xs text-warning mr-1 legend-title"><i class="fa fa-fw fa-square-full"></i></span> PROSES</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1 text-primary"><?php echo $totaltransaksi['proses']; ?> </h1>
                </div>
            </div>
            <div id="sparkline-1"></div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="text-muted"><span class="fa-xs text-success mr-1 legend-title"><i class="fa fa-fw fa-square-full"></i></span> SELESAI</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1 text-primary"><?php echo $totaltransaksi['total'] - $totaltransaksi['proses']; ?> </h1>
                </div>
            </div>
            <div id="sparkline-1"></div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="text-muted"><span class="fa-xs text-primary mr-1 legend-title"><i class="fa fa-fw fa-square-full"></i></span> TOTAL</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1 text-primary"><?php echo $totaltransaksi['total']; ?> </h1>
                </div>
            </div>
            <div id="sparkline-1"></div>
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
                                <th>#</th>
                                <th>Kode Req</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
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
                                    <td><?php echo $request->keterangan ?></td>
                                    <td><?php echo $request->tanggal ?></td>
                                    <td>
                                        <a href="<?php echo base_url('admin/requestdetail/') . $request->kodereq ?>">
                                            <?php
                                            if ($request->aksi >= 1) {
                                                echo '<span class="badge badge-pill badge-danger">Progres</span>';
                                            } else {
                                                echo '<span class="badge badge-pill badge-success">Selesai</span>';
                                            } ?>
                                        </a>
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

    Morris.Area({
        element: 'area-chart',
        behaveLikeLine: true,
        data: [<?php echo $grafik; ?>],
        xkey: 'x',
        ykeys: ['y'],
        labels: ['Jumlah'],
        lineColors: ['#5969ff'],
        resize: true

    });
</script>