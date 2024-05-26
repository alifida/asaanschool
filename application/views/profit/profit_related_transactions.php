<?php ?>
<div class="box box-primary">
	<div class="box-header">
		Related Transactions
		
	</div>
	<div class="box-body">
	<div class="table-responsive">
	
		<table class="table  table-hover table-responsive dataTables">
			<thead>
				<tr>
					<th>Type</th>
					<th>Amount</th>
					<th>Remaining Amount</th>
					<th>Status</th>
					<th>Created By</th>
					<th>Created At</th>
					<th class="all disable-sort"></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($transactions as $key => $transaction){ ?>
				<tr>
					<td><?= $transaction['type']['type'] ?></td>
					<td><?= $transaction['amount']?></td>
					<td><?= $transaction['remaining_amount']?></td>
					<td><?= $transaction['status']?></td>
					<td><?= $transaction['created_by']?></td>
					<td><?= $transaction['created_at']?></td>
					<td>
						<div class="btn-group col-centered" >
						   <button type="button" class="btn btn-outline btn-primary btn-xs dropdown-toggle " data-toggle="dropdown">
			                    <span class="caret"></span>
			               </button>
						  <ul class="dropdown-menu pull-right" role="menu">
						 
				    		<li><a href="<?= site_url('profit/transactionDetail') ?>?id=<?= $transaction['id']?>">Details</a></li>
						  </ul>
						</div>
					</td>
				</tr>
				<?php } ?>
				
			</tbody>
		</table>
		</div>
	</div>
</div>
