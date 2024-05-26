<?php ?>

<div class="col-centered">
	<div class="alert alert-info">
    	<span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;&nbsp; You can set the  <strong><?= $classFee["feeType"]["type"] ?></strong> as <strong>Due</strong> to following Students of <strong><?= $classFee["class"]["name"] ?></strong>.                            
	</div>
</div>
	
<form class="form-horizontal" action="<?= site_url('classes/dueClassFee') ?>" method="post" id="due_fee_form">
	<fieldset>
	
		<div class="form-group">
		  <label class="col-md-4 control-label" for="due_fee_date">Fee Date</label>  
		  <div class="col-md-5 date " 
			  <?php if($classFee["feeType"]["internal_key"] == "tuition.fee"){ ?>
			  	data-date-format="YYYY-MM" 
			  <?php } elseif($classFee["feeType"]["internal_key"] == "admission.fee"){ ?>
			  	data-date-format="YYYY" 
			  <?php } else { ?>
			  	data-date-format="YYYY-MM-DD" 
			  <?php } ?>
		  >	
			  <div class="input-group">
				  <input id="due_fee_date" name="due_fee_date" type="text" placeholder="Fee Date" class="form-control input-md" required=""
				 	readonly ="readonly"/>
				  <span class="input-group-addon" style="padding: 6px;">
				  		<span class="glyphicon glyphicon-calendar"></span>
				  </span>
		  	</div>  
		  </div>
		</div>
	
	
		<div id="" class="form-group ">
			<div class="col-lg-12 col-centered">
				<select id="due_fee_multiple_students" name = "due_fee_multiple_students[]" class="form-control " multiple="multiple" >
					<?php foreach ($students as $student){?>
						<option value="<?= $student["id"]?>"><?= $student["first_name"]." ".$student["last_name"]."(".$student["class"]["name"]." - ". $student["roll_no"].")"?></option>
					<?php }?>
				</select>
			</div>
		</div>
		
		
		<!-- Button (Double) -->
		<div class="row">
		  
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


<script>
        var demo2 = $('#due_fee_multiple_students').bootstrapDualListbox({
          nonSelectedListLabel: 'Available',
          selectedListLabel: 'Selected',
          preserveSelectionOnMove: 'moved',
          moveOnSelect: false,
          nonSelectedFilter: ''
        });
</script>


<script type="text/javascript">
	$(function() {
		var nowDate = new Date();
		$('.date').datetimepicker({
			useCurrent:false,
			pickTime: false
		<?php if($classFee["feeType"]["internal_key"] == "tuition.fee"){ 
				echo ", \n viewMode: \"months\",\n";
				echo "minViewMode: \"months\"";
			  	
			   } elseif($classFee["feeType"]["internal_key"] == "admission.fee"){ 
			  	echo ", \n viewMode: \"years\",\n";
				echo "minViewMode: \"years\"";
			   } 
			    
		   ?>
		});
	});
</script>


<script type="text/javascript">
    $(document).ready(function() {

    	dateTimePickerRevalidator();
        
        $('#due_fee_form').bootstrapValidator({
            fields: {
            	due_fee_date: {
            		message: 'Fee date is required',
                    validators: {
                    	notEmpty: {
		                    message: 'Fee date is required and can\'t be empty'
		                }
                        
                    }
                }
            }
        });
    });
</script>

