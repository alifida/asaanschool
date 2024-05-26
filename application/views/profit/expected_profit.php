<?php ?>

<section class="content-header">
<h1>
	Expected Profit</small>
</h1>
</section>

<!-- Main content -->
<section class="content"> <!-- /.row -->
<div class="row" data-columns="" id="columns">
	<div class="col-lg-9">
	<?php $this->load->view('profit/expected_profit_transactions'); ?>
	</div>
	<div class="col-lg-3">
	<?php $this->load->view('profit/profit_detail_widgets'); ?>
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
