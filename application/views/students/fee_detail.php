
<div class="box box-primary">
	<div class="box-header">
	Due Fee
		<div class="pull-right " >
		
			<div class="btn-group ">
				<button type="button" onclick ="toggle_clear_due_by_component('fee_detail','red');"
					class="btn  btn-danger btn-xs">Due All</button> 
			</div>
			<div class="btn-group ">
				<button type="button" onclick ="toggle_clear_due_by_component('fee_detail','green');""
					class="btn  btn-primary btn-xs">Clear All</button> 
			</div>
		
	         
	    </div>
	</div>
	<div class="box-body">

		<table class="table table-hover simpleDataTables">
			<thead>
				<tr>
					<th>#</th>
					<th>Type</th>
					<th>Date/Month</th>
					<th>Amount</th>
					<th class="all disable-sort" ></th>
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
					<td>
						<table width="100%" class="">
							<tr>
								<td width="60%">
									<span id="fee_detail_green_<?= $fee['id']?>" class="glyphicon glyphicon-ok green" style="display:none; color:#5cb85c;"></span>
									<span id="fee_detail_red_<?= $fee['id']?>" class="glyphicon glyphicon-remove red" style="display:block;color:#d9534f"></span>
								</td>
								<td>
									<div class="pull-right">
									
										
									
									
								         <div class="btn-group  col-centered">
								              <button type="button" class="btn btn-outline btn-primary btn-xs dropdown-toggle " data-toggle="dropdown">
								                    <span class="caret"></span>
								               </button>
								               <ul class="dropdown-menu pull-right" role="menu">
								               		<li><a href="javascript:void(0);" onclick="toggle_clear_due('fee_detail','<?= $fee['id']?>','green')">Clear</a></li>
								                    <li><a href="javascript:void(0);" onclick="toggle_clear_due('fee_detail','<?= $fee['id']?>','red')">Due</a></li>
								                    <li class="divider"></li>
								                    <li><a href="javascript:void(0);"
						    							onclick="load_remote_model('<?= site_url() ?>student/revertStudentFeeForm?id=<?= $fee['id'] ?>','Revert Fee');">Revert Fee </a></li>
						    
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
