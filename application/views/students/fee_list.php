<?php //pre($allFee); ?>
<div class="box box-warning">
	<div class="box-header">
		All Fee
	</div>
	<div class="box-body">
	<div class="table-responsive">
		<table class="table  table-hover table-responsive dataTables" id="fee_list_history">
			<thead>
				<tr>
					<th>Type</th>
					<th>Fee Date</th>
					<th>Status</th>
					<th>Paid Date</th>
					<th>Paid by</th>
					<th>Amount</th>
					<th width="20%"  >Comments</th>
					<th class="all disable-sort"></th>
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
					<td>
						<div class="btn-group col-centered" >
						  <button type="button" class="btn btn-outline btn-warning btn-xs dropdown-toggle " data-toggle="dropdown">
						    <span class="caret"></span> 
						  </button>
						  	<ul class="dropdown-menu pull-right" role="menu">
						  		<?php if(isset($fee["transaction_id"]) && !empty($fee["transaction_id"])){?>
						  		<li><a href="javascript:void(0);"
										onclick="load_remote_model('<?= site_url() ?>profit/transactionDetail?id=<?= $fee['transaction_id'] ?>&quickView=1','Transaction Detail');enlarge_remote_model();">Transaction Detail </a></li>
							  		<?php if($fee['payment_status'] == get_app_message("db.status.paid")){ ?>
							  			<li><a href="<?= site_url("report/student_payment_receipt/".encodeID($fee["transaction_id"])) ?>" target="_blank"
											>Print</a></li>
							    	<?php } ?>
						    	<?php } ?>
						    
								<?php if($fee['payment_status'] == get_app_message("db.status.due")){ ?>
									<li><a href="javascript:void(0);"
										onclick="load_remote_model('<?= site_url() ?>student/revertStudentFeeForm?id=<?= $fee['id'] ?>','Revert Fee');">Revert Fee </a></li>
						    
								<?php } ?>
						  	</ul>
							</div>
						</td>
					</tr>
					<?php } ?>
				<?php } ?>
				
				</tbody>
			</table>
		</div>
	</div>
</div>
