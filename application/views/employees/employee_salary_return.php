<?php ?>
	
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to <strong>Revert</strong> the following <?= (isset($employeeSalary["payment_status"]))?  $employeeSalary["payment_status"]:"" ?> Salary?                            
		</div>
		
	</div>
	<br/>
	<form class="form-horizontal" action="<?= site_url('employee/employeeSalaryReturn') ?>" method="post">
		<fieldset>
		<div class="col-centered">
			<table class="table table-hover" id="">
				<tr>
					<td>Name: </td>
					<td><strong>
						<?php 
				  		if(isset($employeeSalary["employee"]["first_name"])){ 
				  			 echo $employeeSalary["employee"]["first_name"]." "; 
				  		}
				  		if(isset($employeeSalary["employee"]["last_name"])){ 
				  			 echo $employeeSalary["employee"]["last_name"]; 
				  		}
				  		 ?>	
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Citizen No: </td>
					<td><strong>
						<?php 
				  		
						if(isset($employeeSalary["employee"]["cnic"])){ 
				  			 echo $employeeSalary["employee"]["cnic"]; 
				  		}  
						 
				  		 ?>	
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Employee No.: </td>
					<td><strong>
						<?php 
						if(isset($employeeSalary["employee"]["employee_no"])){ 
				  			 echo $employeeSalary["employee"]["employee_no"]; 
				  		}  
				  		 ?>	
				  		 </strong>
				  	</td>
				</tr>
				
				<tr>
					<td>Salary Date: </td>
					<td><strong>
						<?php if(isset($employeeSalary["month"])){ 
				  			 echo  $employeeSalary["month"]; 
				  		}
				  		 ?>
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Status: </td>
					<td><strong>
						<?php if(isset($employeeSalary["payment_status"])){ 
				  			 echo  $employeeSalary["payment_status"]; 
				  		}
				  		 ?>
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Paid Date: </td>
					<td><strong>
						<?php 
				  		 if(isset($employeeSalary["paid_date"])){ 
				  			 echo $employeeSalary["paid_date"]; 
				  		}  ?>
				  		 </strong>
				  	</td>
				</tr>
				
				<tr>
					<td>Paid Amount: </td>
					<td><strong>
						<?php if(isset($employeeSalary["amount"])){ 
				  			 echo $employeeSalary["amount"]." PKR"; 
				  		}
				  		?>
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Comments: </td>
					<td><strong>
						<?php if(isset($employeeSalary["comments"])){ 
				  			 echo $employeeSalary["comments"]; 
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
		    	<button id="item_delete" name="item_delete" class="btn btn-danger">Yes (Revert)</button>
		  	</div>
		
		</fieldset>
		<input id="employee_salary_id" name="employee_salary_id" type="hidden" 
			<?php if(isset($employeeSalary["id"])){ ?>
		 		value="<?= $employeeSalary["id"] ?>">
		 <?php } ?>
	</form>
				
			