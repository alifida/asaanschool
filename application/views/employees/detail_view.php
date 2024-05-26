<?php ?>

<section class="content-header">
<h1>
<?= $employee["first_name"] ?> <?= $employee["last_name"] ?>
</h1>
</section>


<section class="content">
<div class="row" data-columns="" id="columns">
	<div class="col-lg-12">
	<?php $this->load->view('employees/details'); ?>
	</div>
</div>
<div class="row" data-columns="" id="columns">
	<div class="col-lg-12">
	<?php $this->load->view('employees/employee_salaries'); ?>
	</div>
</div>
<div class="row" data-columns="" id="columns">
	<div class="col-lg-12">
	<?php $this->load->view('employees/all_employees'); ?>
	</div>

</div>
</section>



<script>
	$(document).ready(function() {
    	$('#employees_salaries').dataTable( {
    		"order": [[ 0, "desc" ]],
    		responsive: true
    	});
    	$('.dataTables_filter').addClass("pull-right");
    	$('.table-responsive .col-sm-5').addClass("col-xs-5");
    	$('.table-responsive .col-sm-7').addClass("col-xs-7");
    	$('.pagination').addClass("pull-right");
	});
</script>
