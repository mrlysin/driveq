<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('assets/custom.css') ?>">
    <title>E- Arsip Document <?php echo $file['nama_file_upload']; ?></title>
</head>

<body>
    <?php if ($file['tipe_file'] == '.pdf' || $file['tipe_file'] == '.PDF') { ?>
        <iframe src="http://docs.google.com/gview?url=<?php echo base_url('upload/' . $file['nama_file']) ?>&embedded=true"></iframe>
    <?php } else { ?>
        <iframe src="https://view.officeapps.live.com/op/embed.aspx?src=<?php echo base_url('upload/' . $file['nama_file']) ?>" width='100%' height='900px' frameborder='0'>
            This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a>
            document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.
        </iframe>
    <?php } ?>
</body>

</html>