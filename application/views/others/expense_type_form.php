<?php ?>

	<br/>
	<form class="form-horizontal" action="<?= site_url('setting/saveExpenseType') ?>" method="post" id="expense_type_form">
		<fieldset>
		
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="expense_type_name">Name</label>  
		  <div class="col-md-5">
		  	<input id="expense_type_name" name="expense_type_name" type="text" 
		  		<?php if(isset($expenseType["type"])){ ?>
		  			value="<?= $expenseType["type"] ?>"
		  		<?php } ?>
		  		placeholder="Name" class="form-control input-md" required="">
		  </div>
		</div>
		<br/> 
		<!-- Button (Double) -->
		<div class="form-group">
		  <label class="col-md-6 control-label" for="expense_type_save"></label>
		  	<div class="col-md-6">
		     	<button id="expense_type_reset" name="expense_type_reset" class="btn btn-default" type="reset">Reset</button>  
		    	<button type="submit" id="expense_type_save" name="expense_type_save" class="btn btn-primary">Save</button>
		  	</div>
		</div>
		
		</fieldset>
		<input id="expense_type_id" name="expense_type_id" type="hidden" 
			<?php if(isset($expenseType["id"])){ ?>
		 		value="<?= $expenseType["id"] ?>">
		 <?php } ?>
	</form>
	<script type="text/javascript">
    $(document).ready(function() {
        $('#expense_type_form').bootstrapValidator({
            fields: {
            	expense_type_name: {
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
			