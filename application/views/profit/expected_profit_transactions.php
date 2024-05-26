<?php ?>
<div class="box box-primary">							
	<div class="box-header">
		Transactions
		
	</div>
	<div class="box-body">
		
		<div class="table-responsive">
			<?php if(isset($expectedProfit)){?>
			<table  class="table table-hover simpleDataTables">
				<thead>
					<tr>
						<th>Type</th>
						<th>Amount</th>
						<th>Remaining Amount</th>
						<th>Status</th>
						<th>Created By</th>
						<th>Log</th>
						<th class="all disable-sort"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($expectedProfit["openTransactions"] as $key => $transaction){ ?>
					<tr>
						<td><?= $transaction['type']['type'] ?></td>
						<td><?= $transaction['amount']?></td>
						<td><?= $transaction['remaining_amount']?></td>
						<td><?= $transaction['status']?></td>
						<td><?= $transaction['created_by']?></td>
						<td><?= $transaction['updated_at']?></td>
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
		<?php }else{ ?>
		
	<div class="col-centered col-lg-12">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; 
		    	No Record exist.                          
		</div>
	</div>
		
		<?php } ?>
		</div>
	</div>
</div>

						
									
							
					