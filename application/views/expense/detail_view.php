<?php ?>
	
<fieldset>
<div class="col-centered">
	<table class="table table-hover" id="">
		<?php 	if(isset($expense['type']["type"])){ ?> 
		<tr>
			<td>Type: </td>
			<td><strong>
				<?php   echo $expense['type']["type"];   ?>	
		  		 </strong>
		  	</td>
		</tr>
		<?php } ?> 
		<?php 	if(isset($expense["description"])){ ?> 
		<tr>
			<td>Description: </td>
			<td><strong>
				<?php   echo $expense["description"];   ?>	
		  		 </strong>
		  	</td>
		</tr>
		<?php } ?> 
		<?php 	if(isset($expense["expense_date"])){ ?> 
		<tr>
			<td>Date: </td>
			<td><strong>
				<?php   echo $expense["expense_date"];   ?>	
		  		 </strong>
		  	</td>
		</tr>
		<?php } ?> 
		<?php 	if(isset($expense["amount"])){ ?> 
		<tr>
			<td>Amount: </td>
			<td><strong>
				<?php   echo $expense["amount"];   ?>	
		  		 </strong>
		  	</td>
		</tr>
		<?php } ?> 
		<?php 	if(isset($expense["status"])){ ?> 
		<tr>
			<td>Status: </td>
			<td><strong>
				<?php   echo $expense["status"];   ?>	
		  		 </strong>
		  	</td>
		</tr>
		<?php } ?> 
		<?php 	if(isset($expense["comments"])){ ?> 
		<tr>
			<td>Comments: </td>
			<td><strong>
				<?php   echo $expense["comments"];   ?>	
		  		 </strong>
		  	</td>
		</tr>
		<?php } ?> 
	</table>
</div>


<br/> 
		<!-- Button (Double) 
		  	<div class="col-centered">
		    	<button id="guardian_delete" name="guardian_delete" class="btn btn-danger">Yes (Delete)</button>
		  	</div>
		-->
		
		</fieldset>
		
			