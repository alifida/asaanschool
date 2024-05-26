<?php ?>

<section class="content-header">
<h1>Expenses</h1>
</section>
<section class="content"> <!-- /.row -->
<div class="row" data-columns="" id="columns">
	<div class="col-lg-8">
	<?php $this->load->view('expense/active_expense_list'); ?>
	</div>
	<div class="col-lg-4">
	<?php $this->load->view('others/expense_type_list'); ?>
	</div>
</div>
<div class="row" data-columns="" id="columns">
	<div class="col-lg-12">
	<?php $this->load->view('expense/all_expense_list'); ?>
	</div>
</div>
</section>
