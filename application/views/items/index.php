<?php ?>
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>Inventory</h1>
</section>

<!-- Main content -->
<section class="content"> <!-- /.col-lg-12 --> <!-- /.row -->
<div class="row" data-columns="" id="columns">
	<div class="col-lg-8">
	<?php $this->load->view('items/available_items'); ?>
	</div>
	<div class="col-lg-4">
	<?php $this->load->view('others/item_type_list'); ?>
	</div>
</div>

<div class="row" data-columns="" id="columns">
	<div class="col-lg-12">
	<?php $this->load->view('items/old_items'); ?>
	</div>
</div>

</section>
