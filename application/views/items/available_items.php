<?php ?>
<div class="box box-primary">
	<div class="box-header">
		Available Items
		<div class="pull-right " >
	         <div class="btn-group ">
	              <button type="button" onclick="load_remote_model('<?= site_url("inventory/editItem")?>','New Item')" 
						  class="btn btn-outline btn-default btn-xs">New Item</button>
	            </div>
	    </div>
	</div>
	<div class="box-body">
	<div class="table-responsive">
	
		<table class="table  table-hover table-responsive dataTables">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>Quantitiy</th>
					<th>Unit Price</th>
					<th>Purchase Price</th>
					<th class="all disable-sort"></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($items as $key => $item){ ?>
				<tr>
					<td><?= $item['type']['name'] ?></td>
					<td><?= $item['description']?></td>
					<td><?= $item['available_amount']?> (<?= $item['amount']?>)</td>
					<td><?= $item['price']?></td>
					<td><?= $item['purchase_price']?></td>
					<td>
						<div class="btn-group col-centered" >
						  <button type="button" class="btn btn-xs btn-primary btn-outline dropdown-toggle" data-toggle="dropdown">
						    <span class="caret"></span>
						  </button>
						  <ul class="dropdown-menu pull-right" role="menu">
							  	<li><a href="<?= site_url('inventory/itemDetail') ?>/<?= encodeID($item['id']) ?>">Detail</a></li>
							    	
							  	<li><a href="javascript:void(0);" 
							    	onclick="load_remote_model('<?= site_url('inventory/editItem') ?>?id=<?= $item['id'] ?>','Update Item');">Edit</a></li>
							    	
					    		<li><a href="javascript:void(0);" 
						    			onclick="load_remote_model('<?= site_url('inventory/deleteConfirmationItem') ?>?id=<?= $item['id'] ?>','Delete Item');">Delete</a></li>
							  	<li class="divider"></li>
					    		<li><a href="javascript:void(0);" 
						    			onclick="load_remote_model('<?= site_url('inventory/issueForm') ?>?item_id=<?= $item['id'] ?>','Issue Item');">Issue</a></li>
							  	
							   
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
