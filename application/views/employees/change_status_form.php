<?php ?>
	
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; You are going to modify the <strong> Status </strong> of the following Employee.                            
		</div>
	</div>
	<br/>
	<form class="form-horizontal" action="<?= site_url('employee/updateStatusEmployee') ?>" method="post">
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
					<td>CNIC No: </td>
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
				<tr>
					
					<td colspan="2">
						<div class="form-group">
							  <label class="col-md-4 control-label" for="employee_status">Status</label>  
							  <div class="col-md-8">
							  	<select id="employee_status" name="employee_status" class="form-control" required="">
								   	<option value=""></option>
								     
									<option value="<?= get_app_message("db.status.active") ?>" <?= (isset($employee) && get_app_message("db.status.active") == $employee["status"])? " selected='selected' ":""; ?> ><?= get_app_message("db.status.active") ?> </option>	
									<option value="<?= get_app_message("db.status.inactive") ?>" <?= (isset($employee) && get_app_message("db.status.inactive") == $employee["status"])? " selected='selected' ":""; ?> ><?= get_app_message("db.status.inactive") ?> </option>	
											
									
							    </select>
							  </div>
						</div>
				  	</td>
				</tr>
			</table>
		</div>
		
		<br/> 
		<!-- Button (Double) -->
		  	<div class="col-centered">
		    	<button id="employee_change_status" name="employee_change_status" class="btn btn-danger">Update</button>
		  	</div>
		
		</fieldset>
		<input id="employee_id" name="employee_id" type="hidden" 
			<?php if(isset($employee["id"])){ ?>
		 		value="<?= $employee["id"] ?>">
		 <?php } ?>
	</form>
				
			