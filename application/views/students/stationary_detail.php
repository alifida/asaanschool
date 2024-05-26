
<div class="box box-warning">
	<div class="box-header">Other Dues
		<div class="pull-right " >
		
			<div class="btn-group ">
				<button type="button" onclick ="toggle_clear_due_by_component('stationary_detail','red');"
					class="btn  btn-danger btn-xs">Due All</button> 
			</div>
			<div class="btn-group ">
				<button type="button" onclick ="toggle_clear_due_by_component('stationary_detail','green');"
					class="btn  btn-primary btn-xs">Clear All</button> 
			</div>
		
		
	         
	    </div>
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
					<th class="all disable-sort"></th>
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
					<td>
						<table width="100%" class="">
							<tr>
								<td width="60%">
									<span id="stationary_detail_green_<?= $item['student_item_id']?>" class="glyphicon glyphicon-ok green" style="display:none; color:#5cb85c;"></span>
									<span id="stationary_detail_red_<?= $item['student_item_id']?>" class="glyphicon glyphicon-remove red" style="display:block;color:#d9534f"></span>
								</td>
								<td>
									<div class="pull-right">
								         <div class="btn-group  col-centered">
								              <button type="button" class="btn btn-outline btn-warning btn-xs dropdown-toggle " data-toggle="dropdown">
								                    <span class="caret"></span>
								               </button>
								               <ul class="dropdown-menu pull-right" role="menu">
								               		<li><a href="javascript:void(0);" onclick="toggle_clear_due('stationary_detail','<?= $item['student_item_id']?>','green')">Clear</a></li>
								                    <li><a href="javascript:void(0);" onclick="toggle_clear_due('stationary_detail','<?= $item['student_item_id']?>','red')">Due</a></li>
								                    <li class="divider"></li>
 													<li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('inventory/returnForm') ?>?student_item_id=<?= $item['student_item_id'] ?>','Return Item')">Return</a></li>
								                    

								               </ul>
								            </div>
							        </div>
								</td>
							</tr>
						</table>
						
						
					</td>
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
