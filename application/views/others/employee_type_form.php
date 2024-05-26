<?php ?>

	<br/>
	<form class="form-horizontal" action="<?= site_url('setting/saveEmployeeType') ?>" method="post" id="employee_type_form">
		<fieldset>
		
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="employee_type_name">Name</label>  
		  <div class="col-md-5">
		  	<input id="employee_type_name" name="employee_type_name" type="text" 
		  		<?php if(isset($employeeType["type"])){ ?>
		  			value="<?= $employeeType["type"] ?>"
		  		<?php } ?>
		  		placeholder="Name" class="form-control input-md" required="">
		  </div>
		</div>
		<br/> 
		<!-- Button (Double) -->
		<div class="form-group">
		  <label class="col-md-6 control-label" for="employee_type_save"></label>
		  	<div class="col-md-6">
		     	<button id="employee_type_reset" name="employee_type_reset" class="btn btn-default" type="reset">Reset</button>  
		    	<button type="submit" id="employee_type_save" name="employee_type_save" class="btn btn-primary">Save</button>
		  	</div>
		</div>
		
		</fieldset>
		<input id="employee_type_id" name="employee_type_id" type="hidden" 
			<?php if(isset($employeeType["id"])){ ?>
		 		value="<?= $employeeType["id"] ?>">
		 <?php } ?>
	</form>
	<script type="text/javascript">
    $(document).ready(function() {
        $('#employee_type_form').bootstrapValidator({
            fields: {
            	employee_type_name: {
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
				
						
			