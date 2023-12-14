<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title; ?></title>
    <link rel="icon" href="<?php echo base_url('assets/logoinv.png') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/fonts/circular-std/style.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/libs/css/style.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') ?>">
</head>

<body>
    <div class="dashboard-main-wrapper p-0">
        <div class="bg-light text-center">
            <div class="container">
                <div class="row">
                    <div class="offset-xl-2 col-xl-8 offset-lg-2 col-lg-8 col-md-12 col-sm-12 col-12">
                        <div class="error-section">
                            <img src="../assets/images/error-img.png" alt="" class="img-fluid">
                            <div class="error-section-content">
                                <h1 class="display-3">E - Arsip</h1>
                                <?php if ($userid == 'logout') { ?>
                                    <p> Anda telah logout dari <b>E-Arsip</b></p>
                                    <a href="<?php echo "http://" . $site ?>">Kembali Ke Dokar</a>
                                <?php } else { ?>
                                    <p> Mohon tunggu sebentar, sedang mengalihkan ke <b>E-Arsip</b></p>
                                    <span id="loading" class="dashboard-spinner spinner-primary spinner-xs"></span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="<?php echo base_url('assets/vendor/jquery/jquery-3.3.1.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        if ("<?php echo $userid; ?>" == 'logout') {

        } else {
            $.ajax({
                url: "<?= base_url('login/VerifyFromDokar') ?>",
                type: 'POST',
                dataType: 'Json',
                data: {
                    "uid": "<?php echo $userid; ?>",
                    "site": "<?php echo $site; ?>",
                    "key": "<?php echo $key; ?>",
                },
                success: function(data) {
                    if (data['Status'] == 'Sukses') {
                        // alert(data['Status'])
                        setTimeout(function() {
                            window.location.href = "<?php echo base_url('Admin') ?>";
                        }, 1000);
                    } else {

                    }

                }
            });
        }
    });
</script>

</html>