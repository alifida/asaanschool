
<div class="box box-primary">
	<div class="box-header">
	Due Fee
		 
	</div>
	<div class="box-body">

		<table class="table table-hover simpleDataTables">
			<thead>
				<tr>
					<th>#</th>
					<th>Type</th>
					<th>Date/Month</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody>
			<?php $totalFee =0; $studentFeeIDs = "";?>
			<?php foreach($studentFee as $key => $fee){ ?>
			<?php $studentFeeIDs = $studentFeeIDs . ",".$fee["id"];?>
				<tr>
					<td>
					<?= $key+1 ?>
					<input type="hidden" id="fee_detail_desc_<?= $fee["id"] ?>" name="fee_detail_desc_<?= $fee["id"] ?>" value="<?= $fee['fee_type']['type'] ?> (<?= date("Y",strtotime($fee['fee_date']))  ?>-<?= date("m",strtotime($fee['fee_date']))  ?>)" />
					<input type="hidden" id="fee_detail_amount_<?= $fee["id"] ?>" name="fee_detail_amount_<?= $fee["id"] ?>"  value="<?= $fee['amount'] ?>" />
					</td>
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
					<td><?= $fee['amount'] ?> PKR</td>
					<?php $totalFee = $totalFee + $fee['amount']; ?>
				</tr>
				<?php } ?>
				
			</tbody>
		</table>
	<input type="hidden" id="fee_detail_all_ids" name="fee_detail_all_ids" value="<?= $studentFeeIDs ?>" />
	</div>
	<div class="box-footer">
		<div class="row">
			<div class="col-lg-6"><b>Total:</b></div>
			<div class="col-lg-5">
			<button type="button" class="btn btn-primary pull-right">
				<strong><span id="student_total_fee"><?php echo $totalFee ;?></span>  PKR</strong>
              </button>
			</div>
		</div>
	</div>
	
</div>
