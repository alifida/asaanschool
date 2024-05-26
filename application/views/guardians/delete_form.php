<?php ?>
	
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to <strong>DELETE</strong> the following object?                            
		</div>
	</div>
	<br/>
	<form class="form-horizontal" action="<?= site_url('guardian/deleteGuardian') ?>" method="post">
		<fieldset>
		<div class="col-centered">
			<table class="table table-hover" id="">
				<tr>
					<td>Name: </td>
					<td><strong>
						<?php 
				  		if(isset($guardian["name"])){ 
				  			 echo $guardian["name"]; 
				  		} 
				  		 ?>	
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Occupation: </td>
					<td><strong>
						<?php 
				  		if(isset($guardian["occupation"])){ 
				  			 echo $guardian["occupation"]; 
				  		} 
				  		 ?>	
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Mobile: </td>
					<td><strong>
						<?php 
				  		if(isset($guardian["mobile"])){ 
				  			 echo $guardian["mobile"]; 
				  		} 
				  		 ?>	
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Email: </td>
					<td><strong>
						<?php 
				  		if(isset($guardian["email"])){ 
				  			 echo $guardian["email"]; 
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
		    	<button id="guardian_delete" name="guardian_delete" class="btn btn-danger">Yes (Delete)</button>
		  	</div>
		
		</fieldset>
		<input id="guardian_id" name="guardian_id" type="hidden" 
			<?php if(isset($guardian["id"])){ ?>
		 		value="<?= $guardian["id"] ?>">
		 <?php } ?>
	</form>
				
			