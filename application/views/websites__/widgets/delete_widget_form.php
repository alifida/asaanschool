<?php ?>
	
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to <strong>DELETE</strong> the following Widget?                            
		</div>
	</div>
	<br/>
	<form class="form-horizontal" action="<?= site_url('website/deleteWidget/'.encodeID($widget["id"])) ?>" method="post">
		<fieldset>
		<div class="col-centered">
			<table class="table table-hover" id="">
				<tr>
					<td>Page Title: </td>
					<td><strong>
						<?php 
				  		if(isset($widget["title"])){ 
				  			 echo $widget["title"]; 
				  		} 
				  		 ?>	
				  		 </strong>
				  	</td>
				</tr>
				
				<tr>
					<td>Contents: </td>
					<td><strong>
						<?php 
				  		if(isset($widget["html"])){ 
				  			echo preg_replace('/(?:\s\s+|\n|\t|&nbsp;)/', ' ',strip_tags($widget["html"]));
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
		    	<button id="widget_delete" name="widget_delete" class="btn btn-danger">Yes (Delete)</button>
		  	</div>
		</fieldset>
		
	</form>
				
			