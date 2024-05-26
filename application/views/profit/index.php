<?php ?>
<section class="content-header">
<h1>Profit</h1>
</section>

<!-- Main content -->
<section class="content"> <!-- /.row -->
<div class="row" data-columns="" id="columns">
	<div class="col-lg-8">
	<?php $this->load->view('profit/open_transactions'); ?>
	</div>
	<div class="col-lg-4">
	<?php  $this->load->view('profit/profit_list'); ?>
	</div>
</div>

</section>
<script>
$(document).ready(function() {
	$('#open_transactions').dataTable( {
		"order": [[ 4, "desc" ]],
		responsive: true
	});
	$('.dataTables_filter').addClass("pull-right");
	$('.table-responsive .col-sm-5').addClass("col-xs-5");
	$('.table-responsive .col-sm-7').addClass("col-xs-7");
	$('.pagination').addClass("pull-right");
});
</script>
