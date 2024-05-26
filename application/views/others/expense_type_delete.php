<?php ?>
	
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to <strong>DELETE</strong> the following Expense Type?                            
		</div>
	</div>
	<br/>
	<form class="form-horizontal" action="<?= site_url('setting/deleteExpenseType') ?>" method="post">
		<fieldset>
		<div class="col-centered">
			<table class="table table-hover" id="">
				<tr>
					<td>Name: </td>
					<td><strong>
						<?php 
				  		if(isset($expenseType["type"])){ 
				  			 echo $expenseType["type"]; 
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
		    	<button id="expense_type_delete" name="expense_type_delete" class="btn btn-danger">Yes (Delete)</button>
		  	</div>
		
		</fieldset>
		<input id="expense_type_id" name="expense_type_id" type="hidden" 
			<?php if(isset($expenseType["id"])){ ?>
		 		value="<?= $expenseType["id"] ?>">
		 <?php } ?>
	</form>
				
			