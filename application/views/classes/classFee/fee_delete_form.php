<?php ?>
	
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to <strong>DELETE</strong> the following Fee?                            
		</div>
	</div>
	<br/>
	<form class="form-horizontal" action="<?= site_url('classes/deleteClassFee') ?>" method="post">
		<fieldset>
		<div class="col-centered">
			<table class="table table-hover" id="">
				<tr>
					<td>Fee Type: </td>
					<td><strong>
						<?php 
				  		if(isset($classFee["feeType"]["type"])){ 
				  			 echo $classFee["feeType"]["type"]; 
				  		} 
				  		 ?>	
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Class: </td>
					<td><strong>
						<?php 
				  		if(isset($classFee["class"]["name"])){ 
				  			 echo $classFee["class"]["name"]; 
				  		} 
				  		 ?>	
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Amount: </td>
					<td><strong>
						<?php 
				  		if(isset($classFee["amount"])){ 
				  			 echo $classFee["amount"]; 
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
		    	<button id="fee_delete" name="fee_delete" class="btn btn-danger">Yes (Delete)</button>
		  	</div>
		
		</fieldset>
		<input id="class_fee_id" name="class_fee_id" type="hidden" 
			<?php if(isset($classFee["id"])){ ?>
		 		value="<?= $classFee["id"] ?>">
		 <?php } ?>
	</form>

			