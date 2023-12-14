<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('assets/custom.css') ?>">
    <title><?php echo $file['nama_file_upload']; ?></title>
</head>

<body>
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <div class="modal-content">
            <div style="text-align:center">
                <audio controls>
                    <source src="<?php echo base_url('upload/' . $file['nama_file']) ?>" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
                <div id="caption"><a href="#" onclick="downloadImage('<?php echo base_url('upload/' . $file['nama_file']) ?>', '<?php echo $file['nama_file_upload']; ?>')">Download <?php echo $file['nama_file_upload']; ?></a></div>
            </div>
        </div>
    </div>

    <script>
        var modal = document.getElementById("myModal");
        var img = document.getElementById("myImg");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");

        setTimeout(display, 10)

        function display() {
            modal.style.display = "block";
            modalImg.src = "<?php echo base_url('upload/' . $file['nama_file']) ?>";
            // captionText.innerHTML = "Snow";
        }
        var span = document.getElementsByClassName("close")[0];
        span.onclick = function() {
            window.close();
        }


        function downloadImage(url, name) {
            fetch(url)
                .then(resp => resp.blob())
                .then(blob => {
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.style.display = 'none';
                    a.href = url;
                    // the filename you want
                    a.download = name;
                    document.body.appendChild(a);
                    a.click();
                    window.URL.revokeObjectURL(url);
                })
                .catch(() => alert('An error sorry'));
        }
    </script>

</body>

</html>