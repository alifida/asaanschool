<?php
?>
<section class="content invoice">

	<div class="row">
		<div class="col-xs-12">
			<h2 class="page-header">
				<i class="fa fa-globe"></i> <?= get_app_message("organization.name") ?>.
                                <small class="pull-right">Date: <?= $invoice["invoice_date"] ?></small>
			</h2>
		</div>
	</div>

	<div class="row invoice-info">
		<div class="col-sm-4 invoice-col">
			From
			<address>
				<strong><?= get_app_message("organization.name") ?>.</strong><br>
                                <?= get_app_message("organization.address") ?><br>
                                Phone: <?= get_app_message("organization.phone") ?><br>
                                Email: <?= get_app_message("organization.email") ?><br>

			</address>
		</div>
		<div class="col-sm-4 invoice-col">
			To
			<address>
                            <?php
																												
if (isset ( $_SESSION ["currentCampus"] ["contactDetail"] ) && ! empty ( $_SESSION ["currentCampus"] ["contactDetail"] )) {
																													$contactDetail = $_SESSION ["currentCampus"] ["contactDetail"];
																												} elseif (isset ( $_SESSION ["currentCampus"] ["school"] ["contactDetail"] ) && ! empty ( $_SESSION ["currentCampus"] ["school"] ["contactDetail"] )) {
																													$contactDetail = $_SESSION ["currentCampus"] ["school"] ["contactDetail"];
																												}
																												
																												?>
                                <strong><?= $_SESSION["currentCampus"]['campus_name'] ?></strong><br>
                                <?= $contactDetail['address'] ?><br />
                                <?php if(isset($contactDetail['city'])&& !empty($contactDetail['city'])){ ?>
                                	<?= $contactDetail['city']?>
                                <?php }?>
                                <?php if(isset($contactDetail['state'])&& !empty($contactDetail['state'])){ ?>
                                	<?= $contactDetail['state']?>
                                <?php }?>
                                <?php if(isset($contactDetail['primary_phone'])&& !empty($contactDetail['primary_phone'])){ ?>
                                	<br />Phone: <?= $contactDetail['primary_phone']?>
                                <?php }?>
                                <?php if(isset($contactDetail['email'])&& !empty($contactDetail['primary_email'])){ ?>
                                	<br />Email: <?= $contactDetail['primary_email']?>
                                <?php }?>
                                
                            </address>
		</div> 
                        
                        <?php
																								
																								?>
                        
                        <div class="col-sm-4 invoice-col">
			<b>Invoice: <?= $invoice["invoice_no"] ?></b><br /> <br /> <b>Package:</b> <?= $invoice["campusPackage"]["package"]["name"] ?><br /> <b>Due Date:</b> <?= $invoice["due_date"]?><br /> <b>Account:</b> 968-34567
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			<p class="lead">Package Detail</p>

			<div class="table-responsive">
				<table class="table" id="">
					<tr>
						<td width="35%"><span class="pull-right">Package: </span></td>
						<th><span><?= $invoice["campusPackage"]["package"]["name"] ?></span></th>
					</tr>
					<tr>
						<td width="35%"><span class="pull-right">Activated date: </span></td>
						<th><span><?= convertMySQLDateTimeToDate($invoice["campusPackage"]["start_date"]) ?></span></th>
					</tr>

					<tr>
						<td width="35%"><span class="pull-right">Package price: </span></td>
						<th><span><?= $invoice["campusPackage"]["package"]["price"]["price"] ?> <?= $invoice["currency"] ?></span></th>
					</tr>

				</table>
			</div>


		</div>
		<div class="col-lg-06 col-md-06 col-sm-6 col-xs-6">
			<p class="lead ">Detail</p>
							 <?php $subtotal = $invoice["payable_amount"]?>
                            <div class="table-responsive">
				<table class="table">

					<tr>
						<th style="width: 30%"><span class="pull-right">Subtotal:</span></th>
						<td style="width: 10%"></td>
						<td><?= $subtotal ?></td>
					</tr>
					<tr>
						<th><span class="pull-right">Balance</span></th>
						<td></td>
						<td><?= $invoice["balance"] ?></td>
					</tr>
					<tr>
						<th><span class="pull-right">Arrears:</span></th>
						<td></td>
						<td><?= $invoice["arrears"] ?></td>
					</tr>
					<tr>
						<th><span class="pull-right">Discount:</span></th>
						<td></td>
						<td><?= $invoice["discount"] ?></td>
					</tr>
					<tr>
						<th><span class="pull-right">Total:</span></th>
						<td></td>
						<td><?= $invoice["total_payable_amount"]   ?> <?= $invoice["currency"] ?></td>
					</tr>
				</table>
			</div>

		</div>
	</div>



	<!-- this row will not appear when printing -->
	<div class="row no-print">
		<div class="col-xs-12">
			<button class="btn btn-default" onclick="window.print();">
				<i class="fa fa-print"></i> Print
			</button>

		</div>
	</div>
</section>
<?php //pre($invoice);?>       
         <?php //pre($_SESSION["currentCampus"]);?>       