<?php ?>

	<br/>
	<form class="form-horizontal" action="<?= site_url('setting/saveRelationType') ?>" method="post">
		<fieldset>
		
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="relation_type_name">Relation:</label>  
		  <div class="col-md-5">
		  	<input id="relation_type_name" name="relation_type_name" type="text" 
		  		<?php if(isset($relationType["relation"])){ ?>
		  			value="<?= $relationType["relation"] ?>"
		  		<?php } ?>
		  		placeholder="Name" class="form-control input-md" required="">
		  </div>
		</div>
		
		<br/> 
		<!-- Button (Double) -->
		<div class="form-group">
		  <label class="col-md-6 control-label" for="relation_type_save"></label>
		  	<div class="col-md-6">
		     	<button id="relation_type_reset" name="relation_type_reset" class="btn btn-default" type="reset">Reset</button>  
		    	<button id="relation_type_save" name="relation_type_save" class="btn btn-primary">Save</button>
		  	</div>
		</div>
		
		</fieldset>
		<input id="relation_type_id" name="relation_type_id" type="hidden" 
			<?php if(isset($relationType["id"])){ ?>
		 		value="<?= $relationType["id"] ?>">
		 <?php } ?>
	</form>
				
			