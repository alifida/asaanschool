<?php ?>

	<br/>
	<form class="form-horizontal" action="<?= site_url('setting/saveItemType') ?>" method="post" id="item_type_form">
		<fieldset>
		
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="item_type_name">Name</label>  
		  <div class="col-md-5">
		  	<input id="item_type_name" name="item_type_name" type="text" 
		  		<?php if(isset($itemType["name"])){ ?>
		  			value="<?= $itemType["name"] ?>"
		  		<?php } ?>
		  		placeholder="Name" class="form-control input-md" required="">
		  </div>
		</div>
		<br/> 
		<!-- Button (Double) -->
		<div class="form-group">
		  <label class="col-md-6 control-label" for="item_type_save"></label>
		  	<div class="col-md-6">
		     	<button id="item_type_reset" name="item_type_reset" class="btn btn-default" type="reset">Reset</button>  
		    	<button type="submit" id="item_type_save" name="item_type_save" class="btn btn-primary">Save</button>
		  	</div>
		</div>
		
		</fieldset>
		<input id="item_type_id" name="item_type_id" type="hidden" 
			<?php if(isset($itemType["id"])){ ?>
		 		value="<?= $itemType["id"] ?>">
		 <?php } ?>
	</form>
				
	<script type="text/javascript">
    $(document).ready(function() {
        $('#item_type_form').bootstrapValidator({
            fields: {
            	item_type_name: {
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
					