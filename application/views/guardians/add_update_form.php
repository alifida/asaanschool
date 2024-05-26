<?php ?>
<form class="form-horizontal" action="<?= site_url('guardian/save')?>" method="post" id="guardian_add_update_form">
<fieldset>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="guardian_name">Name</label>  
  <div class="col-md-6">
  <input id="guardian_name" name="guardian_name" type="text" placeholder="Name" class="form-control input-md" required="required" 
  	<?php if(isset($guardian["name"])){?>
  		value="<?=$guardian["name"] ?>"
  	<?php } ?>
  />
  </div>
</div>



<?php if(isset($student_id) && !empty($student_id)){ ?>
	<div class="form-group">
	  <label class="col-md-4 control-label" for="guardian_relation">Relation</label>  
	  <div class="col-md-6">
	  <select id="guardian_relation" name="guardian_relation"  class="form-control"  required="required" >
	    		<option value=""></option>
	    	<?php if(isset($relationTypes)){ ?>
	    		<?php foreach($relationTypes as $relation){ ?>
	    			<option value="<?= $relation["id"]?>"
	    				<?php if(isset($guardian["studentGuardian"]["relation_type_id"])&& $relation["id"]==$guardian["studentGuardian"]["relation_type_id"]){
	    					echo "	selected "; 
	    			 	}?>
	    			><?= $relation["relation"]?></option>
	    		<?php } ?>
			<?php }		?>
	      
	    </select>
	  
	  </div>
	</div>
<?php } ?>



<!-- Multiple Radios (inline) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="guardian_gender">Gender</label>
  <div class="col-md-6"> 
    
    <span class="radio pull-left" style="margin-top: 0px; font-size: 16px; color: #367fa9">
		<label style="padding-left:0px;" for="guardian_gender-0">
            <input type="radio" name="guardian_gender" id="guardian_gender-0" value="Male"
	        	<?php if(isset($guardian) && $guardian["gender"]=="Male"){  ?>
		       		checked="checked"
		       	<?php } ?>  >
	      	<span> &nbsp;&nbsp;&nbsp;Male</span>
	  	</label>
  	</span> 
    
    <span class="radio pull-right" style="margin-top: 0px; font-size: 16px; color: #367fa9">
		<label style="padding-left:0px;" for="guardian_gender-1">
            <input type="radio" name="guardian_gender" id="guardian_gender-1" value="Female"
	        	<?php if(isset($guardian) && $guardian["gender"]=="Female"){  ?>
		       		checked="checked"
		       	<?php } ?>  >
	      	<span> &nbsp;&nbsp;&nbsp;Female</span>
	  	</label>
  	</span> 
  	
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="guardian_cnic">Citizen No.</label>  
  <div class="col-md-6">
  <input id="guardian_cnic" name="guardian_cnic" type="text" placeholder="Citizen No" class="form-control input-md" 
    <?php if(isset($guardian["cnic"])){?>
  		value="<?=$guardian["cnic"] ?>"
  	<?php } ?>
  />
    
  </div>
</div>

<!-- Select Basic -->

<div class="form-group">
  <label class="col-md-4 control-label" for="guardian_occupation">Occupation</label>
  <div class="col-md-6">
    <input id="guardian_occupation" name="guardian_occupation" type="text" placeholder="Occupation" class="form-control input-md" 
    <?php if(isset($guardian["occupation"])){?>
  		value="<?=$guardian["occupation"] ?>"
  	<?php } ?>
  />
  </div>
</div>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="guardian_mobile">Mobile</label>  
  <div class="col-md-6">
  <input id="guardian_mobile" name="guardian_mobile" type="text" placeholder="Mobile" class="form-control input-md"   required="required" 
    <?php if(isset($guardian["mobile"])){?>
  		value="<?=$guardian["mobile"] ?>"
  	<?php } ?>
  />
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="guardian_home_phone">Home Phone</label>  
  <div class="col-md-6">
  <input id="guardian_home_phone" name="guardian_home_phone" type="text" placeholder="Home Phone" class="form-control input-md" 
    <?php if(isset($guardian["home_phone"])){?>
  		value="<?=$guardian["home_phone"] ?>"
  	<?php } ?>
  />
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="guardian_work_phone">Work Phone</label>  
  <div class="col-md-6">
  <input id="guardian_work_phone" name="guardian_work_phone" type="text" placeholder="Work Phone" class="form-control input-md" 
    <?php if(isset($guardian["work_phone"])){?>
  		value="<?=$guardian["work_phone"] ?>"
  	<?php } ?>
  />
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="guardian_email">Email</label>  
  <div class="col-md-6">
  <input id="guardian_email" name="guardian_email" type="text" placeholder="Email" class="form-control input-md" 
    <?php if(isset($guardian["email"])){?>
  		value="<?=$guardian["email"] ?>"
  	<?php } ?>
  />
  </div>
</div>
<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="guardian_address">Address</label>
  <div class="col-md-6">                     
    <textarea class="form-control" id="guardian_address" name="guardian_address"><?php if(isset($guardian["address"])){ echo $guardian["address"];}?></textarea>
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="guardian_btn_reset"></label>
  <div class="col-md-6 ">
	  <div class="pull-right">
	    <button id="guardian_btn_reset" name="guardian_btn_reset" class="btn btn-default" type="reset">Reset</button>
	    <button type="submit" id="guardian_btn_save" name="guardian_btn_save" class="btn btn-primary">Save</button>
	  </div>
  </div>
</div>
<input type="hidden" name="id" id="guardian_id"
	<?php if(isset($guardian["id"]) ){  ?>
       		value='<?= $guardian["id"] ?>'
       	<?php } ?>
/>

<input type="hidden" name="student_id" id="student_id"
	<?php  if(isset($student_id)){ ?>
       	value='<?= $student_id ?>'
       	<?php } ?>
/>

</fieldset>
</form>

<!--Validations-->
<script type="text/javascript">
    $(document).ready(function() {
        
        $('#guardian_add_update_form').bootstrapValidator({
        	
            fields: {
            	guardian_name: {
                    message: 'Name is required',
                    validators: {
                        notEmpty: {
                            message: 'Name is required and can\'t be empty'
                        },
                       
                        regexp: {
                            regexp: /^[a-zA-Z ]+$/,
                            message: 'The Name can only consist of alphabets'
                        }
                        
                    }
                },
                guardian_gender: {
                    message: 'Gender is required',
                    validators: {
                        notEmpty: {
                            message: 'Gender is required'
                        }
                        
                    }
                },
                guardian_cnic: {
                    message: 'Citizen No. is required',
                    validators: {
                    	notEmpty: {
                            message: 'Citizen No. is required and can\'t be empty'
                        }
                /*,
                        regexp: {
                            regexp: /^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$/,
                            message: 'Citizen No. is not valid. Format: XXXXX-XXXXXXX-X'
                        }
                  */      
                        
                    }
                },
                guardian_email: {
                    message: 'Email is required',
                    validators: {
                    	notEmpty: {
                            message: 'Email is required and can\'t be empty'
                        },
                        regexp: {
                            regexp: /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,9})$/,
                            message: 'Email is not valid. Format: xxx@xx.xx'
                        }
                        
                        
                    }
                },
                
                guardian_mobile: {
                    message: 'Mobile No. is required',
                    validators: {
                    	notEmpty: {
                            message: 'Mobile No. is required and can\'t be empty'
                        },
                        digit: {
                            message: 'Only digits are allowed.'
                        },
                        stringLength: {
                            max: 15,
                            min: 10,
                            message: 'Mobile No is not valid.'
                        }
                    }
                }
                
            }
        });
    });
</script>

