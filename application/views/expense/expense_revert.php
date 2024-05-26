<?php ?>
	
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to <strong>Revert</strong> the following Expense?                            
		</div>
	</div>
	<br/>
	<form class="form-horizontal" action="<?= site_url('expense/revertExpense') ?>" method="post">
		<fieldset>
		<div class="col-centered">
			<table class="table table-hover" id="">
				<tr>
					<td>Type: </td>
					<td><strong>
						<?php 
				  		if(isset($expense["type"]["type"])){ 
				  			 echo $expense["type"]["type"]; 
				  		} 
				  		 ?>	
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Description: </td>
					<td><strong>
						<?php 
				  		if(isset($expense["description"])){ 
				  			 echo $expense["description"]; 
				  		} 
				  		 ?>	
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Amount: </td>
					<td><strong>
						<?php 
				  		if(isset($expense["amount"])){ 
				  			 echo $expense["amount"]; 
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
		    	<button id="expense_delete" name="expense_delete" class="btn btn-danger">Yes (Revert)</button>
		  	</div>
		
		</fieldset>
		<input id="expense_id" name="expense_id" type="hidden" 
			<?php if(isset($expense["id"])){ ?>
		 		value="<?= $expense["id"] ?>">
		 <?php } ?>
	</form>
				
			