<?php ?>

	<br/>
	<form class="form-horizontal" action="<?= site_url('setting/saveFeeType') ?>" method="post" id="fee_type_form">
		<fieldset>
		
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="fee_type_name">Name</label>  
		  <div class="col-md-5">
		  	<input id="fee_type_name" name="fee_type_name" type="text" 
		  		<?php if(isset($feeType["type"])){ ?>
		  			value="<?= $feeType["type"] ?>"
		  		<?php } ?>
		  		placeholder="Name" class="form-control input-md" required="">
		  </div>
		</div>
		<br/> 
		<!-- Button (Double) -->
		<div class="form-group">
		  <label class="col-md-6 control-label" for="fee_type_save"></label>
		  	<div class="col-md-6">
		     	<button id="fee_type_reset" name="fee_type_reset" class="btn btn-default" type="reset">Reset</button>  
		    	<button type="submit" id="fee_type_save" name="fee_type_save" class="btn btn-primary">Save</button>
		  	</div>
		</div>
		
		</fieldset>
		<input id="fee_type_id" name="fee_type_id" type="hidden" 
			<?php if(isset($feeType["id"])){ ?>
		 		value="<?= $feeType["id"] ?>">
		 <?php } ?>
	</form>
						
		
<script type="text/javascript">
    $(document).ready(function() {
        $('#fee_type_form').bootstrapValidator({
            fields: {
            	fee_type_name: {
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
			