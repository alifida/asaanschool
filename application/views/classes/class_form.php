<?php ?>

	<br/>
	<form class="form-horizontal" action="<?= site_url('classes/saveClass') ?>" method="post" id="class_add_update_form">
		<fieldset>
		
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="class_name">Name</label>  
		  <div class="col-md-5">
		  	<input id="class_name" name="class_name" type="text" 
		  		<?php if(isset($class["name"])){ ?>
		  			value="<?= $class["name"] ?>"
		  		<?php } ?>
		  		placeholder="Name" class="form-control input-md" required="" />
		  </div>
		</div>
		
		
		
		<br/> 
		<!-- Button (Double) -->
		<div class="form-group">
		  <label class="col-md-6 control-label" for="class_save"></label>
		  	<div class="col-md-6">
		     	<button id="class_reset" name="class_reset" class="btn btn-default" type="reset">Reset</button>  
		    	<button type="submit" id="class_save" name="class_save" class="btn btn-primary">Save</button>
		  	</div>
		</div>
		
		</fieldset>
		<input id="class_id" name="class_id" type="hidden" 
			<?php if(isset($class["id"])){ ?>
		 		value="<?= $class["id"] ?>">
		 <?php } ?>
	</form>
				
		
<script type="text/javascript">
    $(document).ready(function() {
        $('#class_add_update_form').bootstrapValidator({
            fields: {
            	class_name: {
            		message: 'Name is required',
            		validators: {
                        notEmpty: {
                            message: 'Name is required and can\'t be empty'
                        }
                    }
                }
            }
        });
    });
</script>	