<?php ?>
<div class="box box-primary">
	<div class="box-header">
		Open Transactions
		<?php if(!isset($hideCalculateButton)){?>
		<div class="pull-right " >
	         <div class="btn-group ">
	              <button type="button" onclick="load_remote_model('<?= site_url("profit/calculateProfitForm")?>','Calculate Profit');enlarge_remote_model();" 
						  class="btn btn-outline btn-default btn-xs">Calculate Profit</button>
	            </div>
	    </div>
	    <?php }?>
	</div>
	<div class="box-body">
		<div class="table-responsive">
	
		<table id="open_transactions" class="table  table-hover table-responsive">
			<thead>
				<tr>
					<th>Type</th>
					<th>Amount</th>
					<th>Remaining Amount</th>
					<th>Status</th>
					<th>Created By</th>
					<th>Log</th>
					<th class="all disable-sort" ></th>
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
					<td><?= $transaction['updated_at']?></td>
					<td>
						<div class="btn-group col-centered" >
						   <button type="button" class="btn btn-outline btn-primary btn-xs dropdown-toggle " data-toggle="dropdown">
			                    <span class="caret"></span>
			               </button>
						  <ul class="dropdown-menu pull-right" role="menu">
				    		<li><a href="<?= site_url('profit/transactionDetail') ?>?id=<?= $transaction['id']?>">Details</a></li>
				    		<?php if(empty($transaction["profit_id"]) 
				    					&& $transaction["type"]["internal_key"] != "revert.transaction"
				    					&& $transaction["status"] != get_app_message("db.status.reverted")
				    					 ){?>
				    			<li><a href="javascript:void(0);" 
								onclick="load_remote_model('<?= site_url('profit/revertTransactionForm') ?>?id=<?= $transaction['id'] ?>','Revert Transaction');enlarge_remote_model();">Revert</a></li>
				    		
				    		<?php }?>
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

