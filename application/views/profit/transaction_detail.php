<?php ?>
<section class="content-header">
<h1>Transaction Details</h1>
</section>

<!-- Main content -->
<section class="content"> <?php if(isset($transaction) && !empty($transaction)){ ?>

<!-- /.row -->
<div class="row" data-columns="" id="columns">
	<div class="col-lg-12">
	<?php $this->load->view('profit/transaction_detail_view'); ?>
	</div>
	<?php }else{ ?>
	<div class="row" data-columns="" id="columns">
		<div class="col-lg-12">
			<div class="box box-primary">
				<div class="box-header">Transaction Details</div>
				<div class="box-body">
					<div class="alert alert-warning">No detail available.</div>
				</div>
			</div>
		</div>
	</div>
	<?php }?>
</div>
</section>
