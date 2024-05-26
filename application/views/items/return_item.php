<?php ?>
	
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to <strong>RETURN</strong> the following Item from Specified Student?                            
		</div>
		
	</div>
	<br/>
	<form class="form-horizontal" action="<?= site_url('inventory/returnItem') ?>" method="post">
		<fieldset>
		<div class="col-centered">
			<table class="table table-hover" id="">
				<tr>
					<td>Item: </td>
					<td><strong>
						<?php 
				  		if(isset($studentItem["item"]["type"]["name"])){ 
				  			 echo $studentItem["item"]["type"]["name"]; 
				  		}
				  		if(isset($studentItem["description"])){ 
				  			 echo " (".$studentItem["description"].")"; 
				  		}  
				  		 ?>	
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Issued Amount: </td>
					<td><strong>
						<?php if(isset($studentItem["issued_amount"])){ 
				  			 echo $studentItem["issued_amount"]; 
				  		}
				  		?>
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Issued Date: </td>
					<td><strong>
						<?php if(isset($studentItem["issue_date"])){ 
				  			 echo $studentItem["issue_date"]; 
				  		}
				  		 if(isset($item["purchase_price"])){ 
				  			 echo " (".$item["purchase_price"].")"; 
				  		}  ?>
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Payment Status: </td>
					<td><strong>
						<?php if(isset($studentItem["payment_status"])){ 
				  			 echo $studentItem["payment_status"]; 
				  		}
				  		  ?>
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Student Details: </td>
					<td><strong>
						<?php 
						
						if(isset($studentItem["student"]["first_name"])){ 
				  			 echo $studentItem["student"]["first_name"]; 
				  		}
						if(isset($studentItem["student"]["last_name"])){ 
				  			 echo " ". $studentItem["student"]["last_name"]; 
				  		}
				  		  ?>
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Class Details: </td>
					<td><strong>
						<?php 
						
						if(isset($studentItem["student"]["class"]["name"])){ 
				  			 echo $studentItem["student"]["class"]["name"]; 
				  		}
						if(isset($studentItem["student"]["roll_no"])){ 
				  			 echo " (". $studentItem["student"]["roll_no"].")"; 
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
		    	<button id="item_delete" name="item_delete" class="btn btn-danger">Yes (Return)</button>
		  	</div>
		
		</fieldset>
		<input id="student_item_id" name="student_item_id" type="hidden" 
			<?php if(isset($studentItem["id"])){ ?>
		 		value="<?= $studentItem["id"] ?>"
		 	<?php } ?>
		 />
		<input id="student_id" name="student_id" type="hidden" 
			<?php if(isset($studentItem["student"]["id"])){ ?>
		 		value="<?= $studentItem["student"]["id"] ?>"
		 <?php } ?>
		 >
	</form>
				
			