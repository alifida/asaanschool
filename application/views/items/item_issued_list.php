<?php // pre($studentDueItems); ?>
<div class="box box-primary">
	<div class="box-header">
		Item Issued 
	</div>
	<div class="box-body">
	<div class="table-responsive">
		<table class="table  table-hover table-responsive dataTables">
			<thead>
				<tr>
					<th>Issued To</th>
					<th>Item</th>
					<th>Type</th>
					<th>Quantity</th>
					<th>Issue Date</th>
					<th>Payment Status</th>
					<th>Payment</th>
					<th class="all disable-sort"></th>
				</tr>
			</thead>
			<tbody>
		<?php if(!empty($item["studentItems"])){ ?>
			<?php foreach($item["studentItems"] as $key => $studentItem){ ?>
				<tr>
					<td><?= $studentItem["student"]['first_name'] ?> <?= $studentItem["student"]['last_name'] ?> <small>*<?= $studentItem["student"]['class']['name'] ?> (<?= $studentItem["student"]['roll_no'] ?>)*</small></td>
					
					<td><?= $item['description'] ?></td>
					<td><?= $item['type']['name'] ?></td>
					<td><?= $studentItem['issued_amount'] ?></td>
					<td><?= $studentItem['issue_date'] ?></td>
					<td >
						<?php 
						
						$btnClass = "btn-danger";
						if($studentItem['payment_status']==get_app_message("db.status.paid")){
							$btnClass = "btn-success"; 
						}elseif($studentItem['payment_status']==get_app_message("db.status.reverted")){
							$btnClass = "btn-warning"; 
						}elseif($studentItem['payment_status']==get_app_message("db.status.returned")){
							$btnClass = "btn-primary"; 
						} ?>
							<button class="btn btn-xs  btn-block <?= $btnClass ?>  " type="button"><?= $studentItem['payment_status'] ?></button>
						</td>
						<td><?= $studentItem['due_money'] ?> PKR</td>
					
					<td>
						<div class="btn-group col-centered" >
						  <button type="button" class="btn btn-outline btn-primary btn-xs dropdown-toggle " data-toggle="dropdown">
						    <span class="caret"></span> 
						  </button>
						  	<ul class="dropdown-menu pull-right" role="menu">
						  		<li><a href="<?= site_url("student/view") ?>/<?= encodeID($studentItem['student']['id']) ?>/<?= $studentItem['student']['slug'] ?>">Student Details </a></li>
 								<?php if($studentItem['payment_status'] == get_app_message("db.status.due")){ ?>
 									<li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('inventory/returnForm') ?>?student_item_id=<?= $studentItem['id'] ?>','Return Item')">Return</a></li>
 								<?php } ?>
 								<?php if(!empty($studentItem["transaction_id"])){ ?>
 									<li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url() ?>profit/transactionDetail?id=<?= $studentItem['transaction_id'] ?>&quickView=1','Transaction Detail');enlarge_remote_model();">Transaction Detail </a></li>
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
