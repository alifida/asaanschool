<?php ?>



<div class="box box-primary">
	<div class="box-header">
		<?= $item["description"] ?>
		
		<div class="pull-right " >
	         <div class="btn-group col-centered ">
	              <button type="button" class="btn btn-outline btn-primary btn-xs dropdown-toggle " data-toggle="dropdown">
	                    <span class="caret"></span>
	               </button>
	               <ul class="dropdown-menu pull-right" role="menu">
					  	<li><a href="javascript:void(0);" 
					    	onclick="load_remote_model('<?= site_url('inventory/editItem') ?>?id=<?= $item['id'] ?>','Update Item');">Edit</a></li>
					    	
			    		<li><a href="javascript:void(0);" 
				    			onclick="load_remote_model('<?= site_url('inventory/deleteConfirmationItem') ?>?id=<?= $item['id'] ?>','Delete Item');">Delete</a></li>
					  	<li class="divider"></li>
			    		<li><a href="javascript:void(0);" 
				    			onclick="load_remote_model('<?= site_url('inventory/issueForm') ?>?item_id=<?= $item['id'] ?>','Issue Item');">Issue</a></li>
					  	
					</ul>
	            </div>
	    </div>
	
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-lg-1 col-md-1"></div>
			<div  class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
				<br/>
				<table  class="table table-user-information"   style="min-height: 130px;">
					<tr>
						<td width="40%">Description:</td>
						<td><?= $item["description"] ?></td>
					</tr>
					<tr>
						<td>Type:</td>
						<td><?= $item["type"]["name"] ?></td>
					</tr>
					<tr>
						<td>Quantity:</td>
						<td><?= $item["amount"] ?></td>
					</tr>
					<tr>
						<td>Available Quantity:</td>
						<td><?= $item["available_amount"] ?></td>
					</tr>
					<tr>
						<td>Price:</td>
						<td><?= $item["price"] ?></td>
					</tr>
					<tr>
						<td>Purchase Price:</td>
						<td><?= $item["purchase_price"] ?></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
					</tr>
				</table>
			<br/>
			</div>
			<div class="col-lg-1 col-md-1"></div>
		</div>
	</div>

</div>


