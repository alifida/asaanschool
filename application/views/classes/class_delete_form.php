<?php ?>
	
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to <strong>DELETE</strong> the following object?                            
		</div>
	</div>
	<br/>
	<form class="form-horizontal" action="<?= site_url('classes/deleteClass') ?>" method="post">
		<fieldset>
		<div class="col-centered">
			<table class="table table-hover" id="">
				<tr>
					<td>Name: </td>
					<td><strong>
						<?php 
				  		if(isset($class["name"])){ 
				  			 echo $class["name"]; 
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
		    	<button id="class_delete" name="class_delete" class="btn btn-danger">Yes (Delete)</button>
		  	</div>
		
		</fieldset>
		<input id="class_id" name="class_id" type="hidden" 
			<?php if(isset($class["id"])){ ?>
		 		value="<?= $class["id"] ?>">
		 <?php } ?>
	</form>
				
			