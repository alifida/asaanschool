<?php ?>
	
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to <strong>PERMANENTLY DELETE</strong> the following Page?                            
		</div>
	</div>
	<br/>
	<form class="form-horizontal" action="<?= site_url('website/deletePage/'.encodeID($webpage["id"])) ?>" method="post">
		<fieldset>
		<div class="col-centered">
			<table class="table table-hover" id="">
				<tr>
					<td>Page Title: </td>
					<td><strong>
						<?php 
				  		if(isset($webpage["page_title"])){ 
				  			 echo $webpage["page_title"]; 
				  		} 
				  		 ?>	
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Status: </td>
					<td><strong>
						<?php 
				  		if(isset($webpage["status"])){ 
				  			 echo $webpage["status"]; 
				  		} 
				  		 ?>	
				  		 </strong>
				  	</td>
				</tr>
				<tr>
					<td>Contents: </td>
					<td><strong>
						<?php 
				  		if(isset($webpage["html"])){ 
				  			echo preg_replace('/(?:\s\s+|\n|\t|&nbsp;)/', ' ',strip_tags($webpage["html"]));
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
		    	<button id="webpage_delete" name="webpage_delete" class="btn btn-primary btn-raised">Yes (Delete)</button>
		  	</div>
		</fieldset>
		
	</form>
				
			