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
    <script src="<?php echo base_url('assets/vendor/jquery/jquery-3.3.1.min.js') ?>"></script>
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }
    </style>
</head>

<body>
    <div class="splash-container">
        <div class="card">
            <div class="card-header text-center">
                <img class="logo-img" width="100px" src="" alt="logo">
                <br /><br />
                <span class="splash-description">
                    E-Arsip
                </span>
            </div>
            <div class="card-body">
                <div id="info"></div>
                <form id="loginform">
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="username" name="username" type="text" placeholder="Username" autocomplete="off" autofocus>
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="password" name="password" type="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" onclick="myFunction()" type="checkbox"><span class="custom-control-label">Lihat Password</span>
                        </label>
                    </div>
                    <button type="submit" class="login btn btn-primary btn-lg btn-block">Login</button>
                    <center>
                        <span style="display: none;" class="loading dashboard-spinner spinner-primary spinner-xs"></span>
                    </center>
                </form>
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        $("form#loginform").submit(function(e) {
            $(".loading").show();
            $(".login").hide();
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: "<?= base_url('login/verify') ?>",
                type: 'POST',
                dataType: 'Json',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data['Status'] == 'Sukses') {
                        $('#info').html(data['Notif']);
                        setTimeout(function() {
                            window.location.href = "<?php echo base_url('admin') ?>";
                        }, 1500);
                    } else {
                        $('#info').html(data['Notif']);
                        $(".loading").hide();
                        $(".login").show();
                    }
                }
            });
        });
    </script>

</body>

</html>