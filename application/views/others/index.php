<?php ?>

<section class="content-header">
<h1>Referenced Elements</h1>
</section>

<!-- Main content -->
<section class="content"> <?php //$this->load->view('common/widget_notifications'); ?>


<!-- /.row -->
<div class="row" data-columns="" id="columns">
	<div class="col-lg-4">
	<?php $this->load->view('others/item_type_list'); ?>
	<?php $this->load->view('others/configurations_list'); ?>
	<?php $this->load->view('others/employee_type_list'); ?>
	</div>
	<div class="col-lg-4">
	<?php $this->load->view('others/fee_type_list'); ?>
	<?php $this->load->view('others/relation_type_list'); ?>
	</div>
	<div class="col-lg-4">
	<?php $this->load->view('others/expense_type_list'); ?>
	<?php //$this->load->view('others/transaction_type_list'); ?>
	<?php $this->load->view('others/user_type_list'); ?>
	</div>


</div>

</section>
