</div>
</div>
</div>
<script src="<?php echo base_url('assets/vendor/select2/js/select2.min.js') ?>"></script>

<script src="<?php echo base_url('assets/vendor/datatables/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables/js/data-table.js') ?>"></script>
<!-- slimscroll js -->
<script src="<?php echo base_url('assets/vendor/slimscroll/jquery.slimscroll.js') ?>"></script>
<!-- main js -->
<script src="<?php echo base_url('assets/libs/js/main-js.js') ?>"></script>
<!-- chart chartist js -->
<script src="<?php echo base_url('assets/vendor/charts/chartist-bundle/chartist.min.js') ?>"></script>
<!-- sparkline js -->
<script src="<?php echo base_url('assets/vendor/charts/sparkline/jquery.sparkline.js') ?>"></script>
<!-- morris js -->
<script src="<?php echo base_url('assets/vendor/charts/morris-bundle/raphael.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/charts/morris-bundle/morris.js') ?>"></script>
<!-- chart c3 js -->
<script src="<?php echo base_url('assets/vendor/charts/c3charts/c3.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/charts/c3charts/d3-5.4.0.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/charts/c3charts/C3chartjs.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/js/dashboard-ecommerce.js') ?>"></script>

<script>
	$(document).ready(function() {
		$('[data-toggle="popover"]').popover();
	});

	var clipboard = new Clipboard('.copyButton');
	clipboard.on('success', function(e) {
		console.log(e);
	});
	clipboard.on('error', function(e) {
		console.log(e);
	});

	$(".select2").select2({
		allowClear: true
	});

	$(document).on("input", ".number", function(e) {
		this.value = this.value.replace(/[^0-9]/g, '');
	});

	$(document).ready(function() {
		$('#example').DataTable({
			order: [
				[0, 'desc']
			],
		});
	});

	(function() {
		'use strict';
		window.addEventListener('load', function() {
			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			var forms = document.getElementsByClassName('needs-validation');
			// Loop over them and prevent submission
			var validation = Array.prototype.filter.call(forms, function(form) {
				form.addEventListener('submit', function(event) {
					if (form.checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					}
					form.classList.add('was-validated');
				}, false);
			});
		}, false);
	})();
</script>

</body>

</html>