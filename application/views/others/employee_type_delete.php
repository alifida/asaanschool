<?php ?>
	
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to <strong>DELETE</strong> the following object?                            
		</div>
	</div>
	<br/>
	<form class="form-horizontal" action="<?= site_url('setting/deleteEmployeeType') ?>" method="post">
		<fieldset>
		<div class="col-centered">
			<table class="table table-hover" id="">
				<tr>
					<td>Name: </td>
					<td><strong>
						<?php 
				  		if(isset($employeeType["type"])){ 
				  			 echo $employeeType["type"]; 
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
		    	<button id="employee_type_delete" name="employee_type_delete" class="btn btn-danger">Yes (Delete)</button>
		  	</div>
		
		</fieldset>
		<input id="employee_type_id" name="employee_type_id" type="hidden" 
			<?php if(isset($employeeType["id"])){ ?>
		 		value="<?= $employeeType["id"] ?>">
		 <?php } ?>
	</form>
				
			