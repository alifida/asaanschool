<?php ?>
	
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to <strong>DELETE</strong> the following object?                            
		</div>
	</div>
	<br/>
	<form class="form-horizontal" action="<?= site_url('setting/deleteRelationType') ?>" method="post">
		<fieldset>
		<div class="col-centered">
			<table class="table table-hover" id="">
				<tr>
					
					<td><strong>Relation:</strong>
				  	</td>
					<td><strong>
						<?php 
				  		if(isset($relationType["relation"])){ 
				  			 echo $relationType["relation"]; 
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
		    	<button id="relation_type_delete" name="relation_type_delete" class="btn btn-danger">Yes (Delete)</button>
		  	</div>
		
		</fieldset>
		<input id="relation_type_id" name="relation_type_id" type="hidden" 
			<?php if(isset($relationType["id"])){ ?>
		 		value="<?= $relationType["id"] ?>">
		 <?php } ?>
	</form>
				
			