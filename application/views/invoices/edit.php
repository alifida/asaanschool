<?php ?>


<section class="content-header">
<h1>Invoices</h1>
</section>

<!-- Main content -->
<section class="content"> <!-- Main row -->
<div class="row">
	<div class="col-lg-12">
	<?php $this->load->view('invoices/invoiceForm'); ?>
	</div>
</div>

</section>
<!-- /.content -->

<script type="text/javascript">
	$(function() {
		var nowDate = new Date();
		$('.date').datetimepicker({
			useCurrent:false,
			pickTime: false
		});
	});


</script>
