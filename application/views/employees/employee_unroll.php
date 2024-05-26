<?php ?>
	
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to <strong>UNROLL</strong> the following Employee?                            
		</div>
	</div>
	<br/>
	<form class="form-horizontal" action="<?= site_url('employee/unrollEmployee') ?>" method="post">
		<fieldset>
		<div class="col-centered">
			<table class="table table-hover" id="">
				<tr>
					<td>Name: </td>
					<td><strong>
						<?php 
				  		if(isset($employee["first_name"])){ 
				  			 echo $employee["first_name"]; 
				  		} 
				  		 ?>	
						<?php 
				  		if(isset($employee["last_name"])){ 
				  			 echo $employee["last_name"]; 
				  		} 
				  		 ?>	
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Type: </td>
					<td><strong>
						<?php 
				  		if(isset($employee["type"]["type"])){ 
				  			 echo $employee["type"]["type"]; 
				  		} 
				  		 ?>	
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Citizen No: </td>
					<td><strong>
						<?php 
				  		if(isset($employee["cnic"])){ 
				  			 echo $employee["cnic"]; 
				  		} 
				  		 ?>	
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Email: </td>
					<td><strong>
						<?php 
				  		if(isset($employee["email"])){ 
				  			 echo $employee["email"]; 
				  		} 
				  		 ?>	
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Qualification: </td>
					<td><strong>
						<?php 
				  		if(isset($employee["qualification"])){ 
				  			 echo $employee["qualification"]; 
				  		} 
				  		 ?>	
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Joining Date: </td>
					<td><strong>
						<?php 
				  		if(isset($employee["date_of_joining"])){ 
				  			 echo $employee["date_of_joining"]; 
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
		    	<button id="employee_unroll" name="employee_unroll" class="btn btn-danger">Yes (Unroll)</button>
		  	</div>
		
		</fieldset>
		<input id="employee_id" name="employee_id" type="hidden" 
			<?php if(isset($employee["id"])){ ?>
		 		value="<?= $employee["id"] ?>">
		 <?php } ?>
	</form>
				
			