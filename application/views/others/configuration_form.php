<?php ?>

	<br/>
	<form class="form-horizontal" action="<?= site_url('setting/saveConfiguration') ?>" method="post" id="configuration_form">
		<fieldset>
		
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="configuration_label">Label</label>  
		  <div class="col-md-5">
		  	<input id="configuration_label" name="configuration_label" type="text" 
		  		<?php if(isset($configuration["label"])){ ?>
		  			value="<?= $configuration["label"] ?>"
		  		<?php } ?>
		  		placeholder="Label" class="form-control input-md" required="">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="configuration_value">Value</label>  
		  <div class="col-md-5">
		  	<input id="configuration_value" name="configuration_value" type="text" 
		  		<?php if(isset($configuration["value"])){ ?>
		  			value="<?= $configuration["value"] ?>"
		  		<?php } ?>
		  		placeholder="Value" class="form-control input-md" required="">
		  </div>
		</div>
		<br/> 
		<!-- Button (Double) -->
		<div class="form-group">
		  <label class="col-md-6 control-label" for="configuration_save"></label>
		  	<div class="col-md-6">
		     	<button id="configuration_reset"  name="configuration_reset" class="btn btn-default" type="reset">Reset</button>  
		    	<button id="configuration_save" type="submit" name="configuration_save" class="btn btn-primary">Save</button>
		  	</div>
		</div>
		
		</fieldset>
		<input id="configuration_id" name="configuration_id" type="hidden" 
			<?php if(isset($configuration["id"])){ ?>
		 		value="<?= $configuration["id"] ?>">
		 <?php } ?>
	</form>
	
	
	<script type="text/javascript">
    $(document).ready(function() {
        $('#configuration_form').bootstrapValidator({
            fields: {
            	configuration_label: {
            		message: 'Label is required',
            		validators: {
                        notEmpty: {
                            message: 'Label is required and can\'t be empty'
                        }
                    }
                },
                configuration_value: {
            		message: 'Value is required',
            		validators: {
                        notEmpty: {
                            message: 'Value is required and can\'t be empty'
                        }
                    }
                }
            }
        });
    });
</script>		
				
			