<?php ?>

	<br/>
	<form class="form-horizontal" action="<?= site_url('classes/saveClassFee') ?>" method="post" id="fee_add_update_form">
		<fieldset>
		
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="class_fee_type_id">Fee Type</label>  
		  <div class="col-md-5">
		  	<select id="class_fee_type_id" name="class_fee_type_id" class="form-control" required="">
			      <option value=""></option>
			      <?php foreach($feeTypes as $type){ ?>
					<option value="<?= $type['id'] ?>" <?= (isset($classFee) && $type['id'] == $classFee["feeType"]["id"])? " selected='selected' ":""; ?> 
					  ><?= $type['type'] ?> </option>	
						
				<?php } ?>
		    </select>	
		  </div>
		</div>
		
		
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="class_fee_class_id">Class</label>  
		  <div class="col-md-5">
	  		<select id="class_fee_class_id" name="class_fee_class_id" class="form-control" required="">
		      <option value=""></option>
		      	<?php foreach($classes as $class){ ?>
					<option value="<?= $class['id'] ?>" <?= (isset($classFee) && $class['id'] == $classFee["class"]["id"])? " selected='selected' ":""; ?> 
					  ><?= $class['name'] ?> </option>	
				<?php } ?>
		    </select>	
		  </div>
		</div>
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="class_fee_amount">Amount</label>  
		  <div class="col-md-5">
		  	<input id="class_fee_amount" name="class_fee_amount" type="text" 
		  		<?php if(isset($classFee["amount"])){ ?>
		  			value="<?= $classFee["amount"] ?>"
		  		<?php } ?>
		  		placeholder="Amount" class="form-control input-md" required="" />
		  </div>
		</div>
		
		
		
		<br/> 
		<!-- Button (Double) -->
		<div class="form-group">
		  <label class="col-md-6 control-label" for="class_fee_save"></label>
		  	<div class="col-md-6">
		     	<button id="class_fee_reset" name="class_fee_reset" class="btn btn-default" type="reset">Reset</button>  
		    	<button type="submit" id="class_fee_save" name="class_fee_save" class="btn btn-primary">Save</button>
		  	</div>
		</div>
		
		</fieldset>
		<input id="class_fee_id" name="class_fee_id" type="hidden" 
			<?php if(isset($classFee["id"])){ ?>
		 		value="<?= $classFee["id"] ?>">
		 <?php } ?>
	</form>
	
	
	
<script type="text/javascript">
    $(document).ready(function() {
        $('#fee_add_update_form').bootstrapValidator({
            fields: {
            	class_fee_type_id: {
            		message: 'Fee type is required',
            		validators: {
                        notEmpty: {
                            message: 'Fee type is required and can\'t be empty'
                        }
                    }
                },
                class_fee_class_id: {
            		message: 'Class is required',
            		validators: {
                        notEmpty: {
                            message: 'Class is required and can\'t be empty'
                        }
                    }
                },
                class_fee_amount: {
            		message: 'Amount is required',
            		validators: {
                        notEmpty: {
                            message: 'Amount is required and can\'t be empty'
                        },
                       
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'The Name can only consist of digits'
                        }
                        
                    }
                }
              
            }
        });
    });
</script>
				
			