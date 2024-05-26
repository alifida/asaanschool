
<div class="box box-warning">
	<div class="box-header">Other Dues
	 </div>
	<div class="box-body">

		<table class="table table-hover simpleDataTables">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Quantity Issued</th>
					<th>Issued Date</th>
					<th>Unit Price</th>
					<th>Total Price</th>
					 
				</tr>
			</thead>
			<tbody>
			<?php $totalStationaryCharges =0; $studentItemIDs = "";?>
			<?php foreach($items as $key => $item){ ?>
			<?php $studentItemIDs = $studentItemIDs . ",".$item["student_item_id"];?>
				<tr>
					<td>
						<?= $key+1 ?>
						<input type="hidden" id="stationary_detail_desc_<?= $item["student_item_id"] ?>" name="fee_detail_desc_<?= $item["student_item_id"] ?>" value="<?= $item['item_type']['name'] ?> (<?= $item['issued_amount'] ?>)" />
						<input type="hidden" id="stationary_detail_amount_<?= $item["student_item_id"] ?>" name="fee_detail_amount_<?= $item["student_item_id"] ?>"  value="<?= $item['price']* $item['issued_amount'] ?>" />
					</td>
					<td><?= $item['item_type']['name'] ?></td>
					<td><?= $item['issued_amount'] ?></td>
					<td><?= $item['issue_date'] ?></td>
					<td><?= $item['price'] ?> PKR</td>
					<td><?= $item['due_money']?> PKR</td>
					<?php $totalStationaryCharges = $totalStationaryCharges + ($item['price']* $item['issued_amount']); ?>
					 
				</tr>
				<?php } ?>
			</tbody>
		</table>
<input type="hidden" id="stationary_detail_all_ids" name="stationary_detail_all_ids" value="<?= $studentItemIDs ?>" />
	</div>
	<div class="box-footer">
		<div class="row">
			<div class="col-lg-6"><b>Total Charges:</b></div>
			<div class="col-lg-5">
			<button type="button" class="btn btn-warning pull-right">
				<strong><span id="student_total_stationary"><?php echo $totalStationaryCharges ;?></span>  PKR</strong>
              </button>
			</div>
		</div>
	</div>
	
</div>
