<?php

?>

<div class="box box-danger">
	<div class="box-header">
		All Invoices
		<?php if ($_SESSION['sessionUser']['user_type']['internal_key'] == "application_admin") { ?>
			<span class="pull-right" >
				<a href="<?= site_url("appadmin/createInvoice") ?>" class="btn btn-xs btn-danger">Create Invoice</a>
			</span>
		<?php } ?>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="table-responsive">
			<table class="table   table-hover table-responsive dataTables" id="">
				<thead>
					<tr>
						<th>Invoice Date</th>
						<th>Payable Amount</th>
						<th>Due Date</th>
						<th>Paid Amount</th>
						<th>Paid Date</th>
						<th>Invoice Package</th>
						<th>Status</th>
						<th class="all disable-sort"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($invoices as $invoice){ ?>
						<tr>
							<td><?= $invoice['invoice_date'] ?></td>
							<td><?= $invoice['payable_amount'] ?></td>
							<td><?= $invoice['due_date'] ?></td>
							<td><?= $invoice['paid_amount'] ?></td>
							<td><?= $invoice['paid_date'] ?></td>
							<td><?= $invoice['campusPackage']['package']['name'] ?></td>
							<td><?= $invoice['status'] ?></td>
							
							
							<td>
								<div class="btn-group col-centered" >
								  <button type="button" class="btn btn-xs btn-danger btn-outline dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu pull-right" role="menu">
								  <?php if ($_SESSION['sessionUser']['user_type']['internal_key'] == "application_admin") { ?>
									<li><a href="<?= site_url("appadmin/editInvoice") ?>/<?= encodeID($invoice["id"])?>">Edit</a></li>
								  <?php } ?>
									<li><a href="<?= site_url("campus/invoiceDetails") ?>/<?= encodeID($invoice["id"])?>">Details</a></li>
									
								  </ul>
								</div>
								
							</td>
						</tr>
						<?php } ?>
					</tbody>
			</table>
		</div>
		
	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->

