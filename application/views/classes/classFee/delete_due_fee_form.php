<?php ?>

	
<form class="form-horizontal" action="<?= site_url('classes/deleteDueFee') ?>" method="post" id="delete_due_form">
	<fieldset>
	
	
	
		<div class="form-group">
		  <label class="col-md-4 control-label" for="due_fee_type_id">Fee Type</label>  
		  <div class="col-md-5">
		  	<select id="due_fee_type_id" name="due_fee_type_id" class="form-control" onchange="init_fee_dates();" required="">
			      <option value=""></option>
			      <?php foreach($feeTypes as $type){ ?>
					<option value="<?= $type['id'] ?>" <?= (isset($classFee["feeType"]) && $type['id'] == $classFee["feeType"]["id"])? " selected='selected' ":""; ?> 
					  ><?= $type["type"] ?> </option>	
						
				<?php } ?>
		    </select>
		  </div>
		</div>
	
		<div class="form-group">
		  <label class="col-md-4 control-label" for="due_fee_class_id">Class</label>  
		  <div class="col-md-5">
		  	<select id="due_fee_class_id" name="due_fee_class_id" class="form-control"  onchange="init_fee_dates();"  required="">
			      <option value=""></option>
			      <?php foreach($classes as $class){ ?>
					<option value="<?= $class['id'] ?>" <?= (isset($classFee["class"]) && $class['id'] == $classFee["class"]["id"])? " selected='selected' ":""; ?> 
					  ><?= $class["name"] ?> </option>	
						
				<?php } ?>
		    </select>
		  </div>
		</div>
	
	
	
		<div class="form-group">
		  <label class="col-md-4 control-label" for="due_fee_date">Fee Date</label>  
		  <div class="col-md-5">
		  	<select id="due_fee_date" name="due_fee_date" class="form-control" required="" onchange="get_students_for_due_fee_deletion();" >
			      <option value=""></option>
			      <?php foreach($feeDates as $date){ ?>
					<option value="<?= $date ?>"  
					  ><?= $date ?> </option>	
						
				<?php } ?>
		    </select>
		  </div>
		</div>
	
	
	
		<div id="delete_due_fee_students_container" class="form-group " style="display: none;">
			<div class="col-lg-12 col-centered">
				<select id="delete_due_fee_multiple_students" name = "due_fee_multiple_students[]" class="form-control" multiple="multiple" >
				</select>
			</div>
		</div>
		
		<div class="row" >
		  	<div class="col-lg-1 col-centered">
		  		<div style="display: table-cell;"><button id="due_fee_reset" name="due_fee_reset" class="btn btn-default" type="reset">Reset</button></div>
		  		<div style="display: table-cell;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
		  		<div style="display: table-cell;"><button type="submit" id="due_fee_save" name="due_fee_save" class="btn btn-primary">Save</button></div>
  
		    	
		  	</div>
		</div>
	</fieldset>
	<input id="class_fee_id" name="class_fee_id" type="hidden" 
		<?php if(isset($classFee["id"])){?>
		value = "<?= $classFee["id"]?>"
		<?php }?>
	>
	
</form>



<script type="text/javascript">
    $(document).ready(function() {
        $('#delete_due_form').bootstrapValidator({
            fields: {
            	due_fee_type_id: {
            		message: 'Fee type is required',
            		validators: {
                        notEmpty: {
                            message: 'Fee type is required and can\'t be empty'
                        }
                    }
                },
                due_fee_class_id: {
            		message: 'Class is required',
            		validators: {
                        notEmpty: {
                            message: 'Class is required and can\'t be empty'
                        }
                    }
                },
                due_fee_date: {
            		message: 'Fee date is required',
                    validators: {
                       notEmpty: {
                         	message: 'Fee Date is required and can\'t be empty'
                      	}
                  	} 
                }
              
            }
        });
    });
</script>
