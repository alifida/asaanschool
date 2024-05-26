<?php ?>
<section class="content-header">
<h1>Profit</h1>
</section>

<!-- Main content -->
<section class="content">
<div class="row" data-columns="" id="columns">
	<div class="col-lg-9">
	<?php $this->load->view('profit/profit_related_transactions'); ?>
	</div>
	<div class="col-lg-3">
		<div class="box box-success">
			<div class="box-header">
				<div class="row">
					<div class="col-xs-12 text-right">
						<div class="big">
						<?= $profit["profit_amount"] ?>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
				<span class="pull-left"><a>Profit</a> </span> <span
					class="pull-right"> <a href="javascript:void(0);"
					onclick="load_remote_model('<?= site_url('profit/deleteProfitConfirm') ?>?id=<?= $profit['id'] ?>','Delete Profit');enlarge_remote_model();">
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
				</a> </span>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="box box box-primary">
			<div class="box-header">
				<div class="row">
					<div class="col-xs-12 text-right">
						<div class="big">
						<?= $profit["balance_amount"] ?>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
				<span class="pull-left"><a>Balance</a> </span>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="box box-warning">
			<div class="box-header">
				<div class="row">
					<div class="col-xs-12 text-right">
						<div class="big ">
						<?= (isset($feeProfit["paidFee"]))?$feeProfit["paidFee"]:"0"?>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
				<span class="pull-left"><a>Fee Paid</a> </span>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="box box-danger">
			<div class="box-header">
				<div class="row">
					<div class="col-xs-12 text-right">
						<div class="big ">
						<?= (isset($expense))?$expense:"0"?>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
				<span class="pull-left"><a>Expense</a> </span>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="box box-success">
			<div class="box-header">
				<div class="row">
					<div class="col-xs-12 text-right">
						<div class="big">
						<?= (isset( $inventoryDetails["salePaid"]))? $inventoryDetails["salePaid"]:"0"?>
							/
							<?=(isset( $inventoryDetails["inventoryProfit"]))? $inventoryDetails["inventoryProfit"]:"0"?>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
				<span class="pull-left"><a>Inventory (Sale / Profit)</a> </span>
				<div class="clearfix"></div>
			</div>
		</div>



		<div class="box box-info">
			<div class="box-header">
				<div class="row">
					<div class="col-xs-12 text-right">
						<div class="big">
						<?=(isset( $discount))? $discount :"0"?>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
				<span class="pull-left"><a>Discount</a> </span>
				<div class="clearfix"></div>
			</div>
		</div>

	</div>
</div>

</section>
