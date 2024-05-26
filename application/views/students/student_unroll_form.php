<?php ?>
	
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to <strong>UNROLL</strong> the following?                            
	     	<br/>By using this feature the Student will not be visible on main Student List                            
		</div>
	</div>
	<br/>
	<form class="form-horizontal" action="<?= site_url('student/unroll') ?>" method="post">
		<fieldset>
		<div class="col-centered">
			<table class="table table-hover" id="">
				<tr>
					<td>Name: </td>
					<td><strong>
						<?php 
				  		if(isset($student["first_name"])){ 
				  			 echo $student["first_name"]; 
				  		} 
				  		if(isset($student["last_name"])){
				  			 
				  			 echo " ".$student["last_name"]; 
				  		} 
				  		 ?>	
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Father Name: </td>
					<td><strong>
						<?php 
				  		if(isset($student["father_name"])){ 
				  			 echo $student["father_name"]; 
				  		} 
				  		
				  		 ?>	
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Class: </td>
					<td><strong>
						<?php 
				  		if(isset($student["class"]["name"])){ 
				  			 echo $student["class"]["name"]; 
				  		} 
				  		
				  		 ?>	
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Class & Roll No: </td>
					<td><strong>
						<?php 
				  		if(isset($student["class"]["name"])){ 
				  			 echo $student["class"]["name"]; 
				  		} 
				  		 ?>	
						<?php 
				  		if(isset($student["roll_no"])){ 
				  			 echo " (".$student["roll_no"].")"; 
				  		} 
				  		 ?>	
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Date of birth </td>
					<td><strong>
						<?php 
				  		if(isset($student["date_of_birth"])){ 
				  			 echo $student["date_of_birth"]; 
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
		    	<button id="student_delete" name="student_delete" class="btn btn-danger">Yes (Unroll)</button>
		  	</div>
		
		</fieldset>
		<input id="student_id" name="student_id" type="hidden" 
			<?php if(isset($student["id"])){ ?>
		 		value="<?= $student["id"] ?>">
		 <?php } ?>
	</form>
				
			