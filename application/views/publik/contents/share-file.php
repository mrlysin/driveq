<div class="container-fluid p-0">
    <div class="email-inbox-header border-bottom">
        <div class="row">
            <div class="col-lg-12">
                <div class="email-title">
                    <span class="icon"><?php echo tipefile($file['tipe_file']) . ' ' . $file['nama_file_upload']; ?></span>
                    <div class="float-right">
                        <a href="#" onclick="downloadImage('<?php echo base_url('upload/' . $file['nama_file']) ?>', '<?php echo $file['nama_file_upload']; ?>')" title="Download" class="btn btn-sm btn-primary">
                            <i class="fas fa-download"></i> DOWNLOAD
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?php if ($file['tipe_file'] == '.MP3' || $file['tipe_file'] == '.mp3') { ?>
                <div style="margin: auto;width: 60%;padding: 50px; text-align:center;">
                    <audio controls style="width: 100%;">
                        <source src="<?php echo base_url('upload/' . $file['nama_file']) ?>" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>
            <?php }
            if ($file['tipe_file'] == '.MP4' || $file['tipe_file'] == '.mp4') {  ?>
                <div style="margin: auto;width: 60%;padding: 50px; text-align:center;">
                    <video width="100%" controls>
                        <source src="<?php echo base_url('upload/' . $file['nama_file']) ?>" type="video/mp4">
                    </video>
                </div>
            <?php }
            if (
                $file['tipe_file'] == '.PNG' || $file['tipe_file'] == '.png' || $file['tipe_file'] == '.JPG' || $file['tipe_file'] == '.jpg'
                || $file['tipe_file'] == '.JPEG' || $file['tipe_file'] == '.jpeg' || $file['tipe_file'] == '.GIF' || $file['tipe_file'] == '.gif'
            ) { ?>
                <div style="margin: auto;width: 60%;padding: 50px; text-align:center;">
                    <img width="100%" src="<?php echo base_url('upload/' . $file['nama_file']) ?>" />
                </div>
            <?php }
            if (
                $file['tipe_file'] == '.DOC' || $file['tipe_file'] == '.doc' || $file['tipe_file'] == '.DOCX' || $file['tipe_file'] == '.docx'
                || $file['tipe_file'] == '.XLS' || $file['tipe_file'] == '.xls' || $file['tipe_file'] == '.XLSX' || $file['tipe_file'] == '.xlsx'
                || $file['tipe_file'] == '.PPT' || $file['tipe_file'] == '.ppt' || $file['tipe_file'] == '.PPTX' || $file['tipe_file'] == '.pptx'
            ) { ?>
                <div style="margin: auto;width: 100%; padding: 50px; text-align:center;">
                    <iframe src="https://view.officeapps.live.com/op/embed.aspx?src=<?php echo base_url('upload/' . $file['nama_file']) ?>" width='100%' height='900px' frameborder='0'>
                        This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a>
                        document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.
                    </iframe>
                </div>
            <?php }
            if ($file['tipe_file'] == '.PDF' || $file['tipe_file'] == '.pdf') { ?>
                <div style="margin: auto;width: 100%; padding: 50px; text-align:center;">
                    <div>
                        <button class="btn btn-xs btn-light" id="prev">Previous</button>
                        <button class="btn btn-xs btn-light" id="next">Next</button>
                    </div>
                    <div>
                        <span>Page: <span id="page_num"></span> / <span id="page_count"></span>
                    </div>
                    <canvas style="margin: auto; width: 70%;" id="the-canvas"></canvas>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
</div>


<script>
    function downloadImage(url, name) {
        fetch(url)
            .then(resp => resp.blob())
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.style.display = 'none';
                a.href = url;
                a.download = name;
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
            })
            .catch(() => alert('An error sorry'));
    }

    // If absolute URL from the remote server is provided, configure the CORS
    // header on that server.
    var url = '<?php echo base_url('upload/' . $file['nama_file']) ?>';

    // The workerSrc property shall be specified.
    pdfjsLib.GlobalWorkerOptions.workerSrc = '<?php echo base_url('assets/pdfjs/build/pdf.worker.js') ?>';

    // Asynchronous download of PDF

    var pdfDoc = null,
        pageNum = 1,
        pageRendering = false,
        pageNumPending = null,
        scale = 0.8,
        canvas = document.getElementById('the-canvas'),
        ctx = canvas.getContext('2d');

    /**
     * Get page info from document, resize canvas accordingly, and render page.
     * @param num Page number.
     */
    function renderPage(num) {
        pageRendering = true;
        // Using promise to fetch the page
        pdfDoc.getPage(num).then(function(page) {
            var viewport = page.getViewport({
                scale: scale
            });
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            // Render PDF page into canvas context
            var renderContext = {
                canvasContext: ctx,
                viewport: viewport
            };
            var renderTask = page.render(renderContext);

            // Wait for rendering to finish
            renderTask.promise.then(function() {
                pageRendering = false;
                if (pageNumPending !== null) {
                    // New page rendering is pending
                    renderPage(pageNumPending);
                    pageNumPending = null;
                }
            });
        });

        // Update page counters
        document.getElementById('page_num').textContent = num;
    }

    /**
     * If another page rendering in progress, waits until the rendering is
     * finised. Otherwise, executes rendering immediately.
     */
    function queueRenderPage(num) {
        if (pageRendering) {
            pageNumPending = num;
        } else {
            renderPage(num);
        }
    }

    /**
     * Displays previous page.
     */
    function onPrevPage() {
        if (pageNum <= 1) {
            return;
        }
        pageNum--;
        queueRenderPage(pageNum);
    }
    document.getElementById('prev').addEventListener('click', onPrevPage);

    /**
     * Displays next page.
     */
    function onNextPage() {
        if (pageNum >= pdfDoc.numPages) {
            return;
        }
        pageNum++;
        queueRenderPage(pageNum);
    }
    document.getElementById('next').addEventListener('click', onNextPage);

    /**
     * Asynchronously downloads PDF.
     */
    pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
        pdfDoc = pdfDoc_;
        document.getElementById('page_count').textContent = pdfDoc.numPages;

        // Initial/first page rendering
        renderPage(pageNum);
    });
</script>