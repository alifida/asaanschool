<?php //pre($allItems) ?>



<div class="box box-warning">
	<div class="box-header">
		All Items
	 </div>
	 
	<div class="box-body">
	
	
	
		<div class="table-responsive">
		
				<table class="table   table-hover table-responsive " id="stationaryList">
					<thead>
						<tr>
							<th>Name</th>
							<th >Issued Date</th>
							<th>Status</th>
							<th>Paid By</th>
							<th>Paid Date</th>
							<th>Price</th>
							<th>Comments</th>
							
						</tr>
					</thead>
					<tbody>
					
					<?php foreach($allItems as $key => $item){ ?>
					
						<tr>
							<td><?= $item['item_type']['name'] ?> (<?= $item['issued_amount'] ?>)</td>
							<td><?= $item['issue_date'] ?></td>
							<td><?= $item['payment_status'] ?></td>
							<td><?= $item['paid_by'] ?></td>
							<td><?= $item['paid_date'] ?></td>
							<td><?= $item['price']* $item['issued_amount'] ?> PKR</td>
							<td>
								<a href="javascript:void(0);" tabindex="0" class="text-overflow-hide popover-link" role="button" data-toggle="popover" data-trigger="focus" title="" data-content="<?= $item['comments'] ?>"><?= $item['comments'] ?></a>
							</td>
							 
							
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
	</div>
	
	
</div>

