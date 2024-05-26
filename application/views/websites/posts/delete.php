<?php ?>
	
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to <strong>DELETE</strong> the following Post?                            
		</div>
	</div>
	<br/>
	<form class="form-horizontal" action="<?= site_url('website/deletePost/'.encodeID($post["id"])) ?>" method="post">
		<fieldset>
		<div class="col-centered">
			<table class="table table-hover" id="">
				<tr>
					<td>Page Title: </td>
					<td><strong>
						<?php 
				  		if(isset($post["title"])){ 
				  			 echo $post["title"]; 
				  		} 
				  		 ?>	
				  		 </strong>
				  	</td>
				</tr>
				
				<tr>
					<td>Contents: </td>
					<td><strong>
						<?php 
				  		if(isset($post["html"])){ 
				  			echo preg_replace('/(?:\s\s+|\n|\t|&nbsp;)/', ' ',strip_tags($post["html"]));
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
		    	<button id="post_delete" name="post_delete" class="btn btn-danger btn-raised">Yes (Delete)</button>
		  	</div>
		</fieldset>
		
	</form>
				
			