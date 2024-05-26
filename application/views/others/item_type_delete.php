<?php ?>
	
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to <strong>DELETE</strong> the following object?                            
		</div>
	</div>
	<br/>
	<form class="form-horizontal" action="<?= site_url('setting/deleteItemType') ?>" method="post">
		<fieldset>
		<div class="col-centered">
			<table class="table table-hover" id="">
				<tr>
					<td>Name: </td>
					<td><strong>
						<?php 
				  		if(isset($itemType["name"])){ 
				  			 echo $itemType["name"]; 
				  		} 
				  		 ?>	
				  		 </strong>
				  	</td>
				</tr>
			</table>
		</div>
		
		<br/> 
		<!-- Button (Double) -->
		  	<div class="col-centered">
		    	<button id="item_type_delete" name="item_type_delete" class="btn btn-danger">Yes (Delete)</button>
		  	</div>
		
		</fieldset>
		<input id="item_type_id" name="item_type_id" type="hidden" 
			<?php if(isset($itemType["id"])){ ?>
		 		value="<?= $itemType["id"] ?>">
		 <?php } ?>
	</form>
				
			