<?php //pre($allFee); ?>
<div class="box box-warning">
	<div class="box-header">
		All Fee
	</div>
	<div class="box-body">
	<div class="table-responsive">
		<table class="table  table-hover table-responsive dataTables">
			<thead>
				<tr>
					<th>Type</th>
					<th>Fee Date</th>
					<th>Status</th>
					<th>Paid Date</th>
					<th>Paid by</th>
					<th>Amount</th>
					<th width="20%"  >Comments</th>
				</tr>
			</thead>
			<tbody>
		<?php if(!empty($allFee)){ ?>
			<?php foreach($allFee as $key => $fee){ ?>
				<tr>
					<td><?= $fee['fee_type']['type'] ?></td>
					<td>
					<?php
							if("tution.fee" == $fee["fee_type"]["internal_key"] || stringContains($fee["fee_type"]["type"], "monthly") || stringContains($fee["fee_type"]["type"], "Monthly")){
							     echo date("Y",strtotime($fee['fee_date']))  ."-". date("m",strtotime($fee['fee_date']));
							}else{
							    echo date("Y",strtotime($fee['fee_date']))  ."-". date("m",strtotime($fee['fee_date'])) . "-" .  date("d",strtotime($fee['fee_date']));
							}
							?>
					
					
					</td>
					<td><?= $fee['payment_status'] ?></td>
					<td><?= $fee['paid_date'] ?></td>
					<td><?= $fee['paid_by'] ?></td>
					<td><?= $fee['amount'] ?> PKR</td>
					<td>
						<a href="javascript:void(0);" tabindex="0" class="text-overflow-hide " role="button" data-toggle="popover" data-trigger="focus" title="" data-content="<?= $fee['comments'] ?>"><?= $fee['comments'] ?></a>
					</td>
					 
					</tr>
					<?php } ?>
				<?php } ?>
				
				</tbody>
			</table>
		</div>
	</div>
</div>
