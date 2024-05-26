<?php ?>

<section class="content-header">
<h1>Employees</h1>
</section>
<section class="content"> <!-- /.row -->
<div class="row" data-columns="" id="columns">
	<div class="col-lg-8">
	<?php $this->load->view('employees/current_employees'); ?>
	</div>
	<div class="col-lg-4">
	<?php $this->load->view('others/employee_type_list'); ?>
	</div>
</div>
<div class="row" data-columns="" id="columns">
	<div class="col-lg-12">
	<?php $this->load->view('employees/all_employees'); ?>
	</div>

</div>
</section>
