<?php ?>
	
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to <strong>DELETE</strong> the following object?                            
		</div>
		
	</div>
	<br/>
	<form class="form-horizontal" action="<?= site_url('inventory/deleteItem') ?>" method="post">
		<fieldset>
		<div class="col-centered">
			<table class="table table-hover" id="">
				<tr>
					<td>Item: </td>
					<td><strong>
						<?php 
				  		if(isset($item["type"]["name"])){ 
				  			 echo $item["type"]["name"]; 
				  		}
				  		if(isset($item["description"])){ 
				  			 echo " (".$item["description"].")"; 
				  		}  
				  		 ?>	
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Quantity: </td>
					<td><strong>
						<?php if(isset($item["available_amount"])){ 
				  			 echo $item["available_amount"]; 
				  		}
				  		 if(isset($item["amount"])){ 
				  			 echo " (".$item["amount"].")"; 
				  		}  ?>
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Price: </td>
					<td><strong>
						<?php if(isset($item["price"])){ 
				  			 echo $item["price"]; 
				  		}
				  		 if(isset($item["purchase_price"])){ 
				  			 echo " (".$item["purchase_price"].")"; 
				  		}  ?>
				  		 </strong>
				  	</td>
				</tr>
			</table>
		</div>
		
		<br/> 
		<!-- Button (Double) -->
		  	<div class="col-centered">
		    	<button id="item_delete" name="item_delete" class="btn btn-danger">Yes (Delete)</button>
		  	</div>
		
		</fieldset>
		<input id="item_id" name="item_id" type="hidden" 
			<?php if(isset($item["id"])){ ?>
		 		value="<?= $item["id"] ?>">
		 <?php } ?>
	</form>
				
			