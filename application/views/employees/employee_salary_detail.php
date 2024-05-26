<?php ?>
	<br/> 
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
		
		
		
		</fieldset>
	
	
				
			