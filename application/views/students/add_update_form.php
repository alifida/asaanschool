<?php ?>
<form class="form-horizontal" action="<?= site_url('student/save')?>" method="post" id="student_add_update_form">
<fieldset>
<div class="container-fluid">	
	<div class="row">
		<div class="col-lg-4 col-md-4">
           	<br/>
           	<div  class="col-centered">
	           	<div class="row">
		           	<div  id="student_image_container"  class="col-centered col-lg-8 col-md-8 col-sm-4 col-xs-4">
			           	<?php if(isset($student["student_picture"]) && !empty($student["student_picture"])){?>
	    	       			<img src='<?= $student["student_picture"] ?>' alt=''  class='img-circle circle_border max-100' />
	    	       		<?php } else{?>
	    	       			<img src='<?= site_url("public/images/student_avatar.png") ?>' alt=''  class='img-circle circle_border max-100' />
	    	       		<?php } ?>
		           	</div>
		           		<br/>
           				<div class="col-centered">
           					<span class="btn btn-primary btn-file">Browse
			    	       		<input type="file" id="browse_file" name="studentPic"
	    		       				onchange="ajax_file_submit('<?= site_url('fileupload/uploadStudentPic')?>' , 'student_image_container' ,'student_image_path')" />
							</span>
           				</div>
	           		
	           	</div>
           	</div>
	        <br/><br/>
		</div>
							
		<div class="col-lg-8 col-md-8  col-sm-12  col-xs-12">
		<!-- Text input-->
			<div class="form-group">
				<label class="col-md-3 control-label" for="student_first_name">Name</label>  
				  <div class="col-md-3">
					  <input id="student_first_name" name="student_first_name" type="text" placeholder="First Name" class="form-control input-md" required="required" 
					  	<?php if(isset($student["first_name"])){?>
					  		value="<?=$student["first_name"] ?>"
					  	<?php } ?>
					  />
				  </div>
				  <div class="col-md-4 ">
					  <input id="student_last_name" name="student_last_name" type="text" placeholder="Last Name" class="form-control input-md" 
					  <?php if(isset($student["last_name"])){?>
					  		value="<?=$student["last_name"] ?>"
					  	<?php } ?>
					  />
				  </div>
			</div>
			
			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-3 control-label" for="student_father_name">Father Name</label>  
			  <div class="col-md-7">
			  <input id="student_father_name" name="student_father_name" type="text" placeholder="Father Name" class="form-control input-md" required="required" 
			  <?php if(isset($student["father_name"])){?>
			  		value="<?=$student["father_name"] ?>"
			  	<?php } ?>
			  />
			    
			  </div>
			</div>
			
			<div class="form-group">
			  <label class="col-md-3 control-label" for="student_registration_no">Registration No.</label>  
			  <div class="col-md-7">
			  <input id="student_registration_no" name="student_registration_no" type="text" placeholder="Reg No." class="form-control input-md" required="required" 
			  <?php if(isset($student["reg_no"])){?>
			  		value="<?=$student["reg_no"] ?>"
			  	<?php } ?>
			  />
			    
			  </div>
			</div>
			
			
			
			<!-- Multiple Radios (inline) -->
			<div class="form-group">
			  <label class="col-md-3 control-label" for="student_gender">Gender</label>
			  <div class="col-md-7"> 
			    <span class="radio pull-left" style="margin-top: 0px; font-size: 16px;">
					<label style="padding-left:0px;" for="student_gender-0">
            			<input type="radio" name="student_gender" id="student_gender-0" value="Male"
	            			<?php if(isset($student["gender"]) && $student["gender"]=="Male"){  ?>
					       		checked="checked"
					       	<?php } ?>  >
	      				<span> &nbsp;&nbsp;&nbsp;Male</span>
	  				</label>
  				</span> 
			    <span class="radio pull-right" style="margin-top: 0px; font-size: 16px;" >
					<label style="padding-left:0px;" for="student_gender-1">
            			<input type="radio" name="student_gender" id="student_gender-1" value="Female"
	            			<?php if(isset($student["gender"]) && $student["gender"]=="Female"){  ?>
					       		checked="checked"
					       	<?php } ?>  >
	      				<span> &nbsp;&nbsp;&nbsp;Female</span>
	  				</label>
  				</span> 
			  </div>
			</div>
			
					
			
			
			<!-- Text input-->
			
			<div class="form-group">
			  <label class="col-md-3 control-label" for="student_date_of_birth">Date of birth</label>  
			  <div class="col-md-7 date " data-date-format="YYYY-MM-DD" >
				  <div class="input-group">
					  <input id="student_date_of_birth" name="student_date_of_birth" type="text" placeholder="Date of birth" class="form-control input-md" required=""
					 	
					    <?php if(isset($student["date_of_birth"])){?>
					  		value="<?=$student["date_of_birth"] ?>"
					  	<?php } ?>
					  />
					  <span class="input-group-addon" style="padding: 6px;">
					  	<span class="glyphicon glyphicon-calendar"></span>
					  </span>
			  	</div>  
			  </div>
			</div>
			
			<!-- Select Basic -->
			
			<div class="form-group">
			  <label class="col-md-3 control-label" for="student_class">Class & Roll No.</label>
			  <div class="col-md-4">
			    <select id="student_class" name="student_class" class="form-control"  required="required" >
			    		<option value=""></option>
			    	<?php if(isset($classes)){ ?>
			    		<?php foreach($classes as $class){ ?>
			    			<option value="<?= $class["id"]?>" <?= (isset($student) && $class["id"]==$student["class_id"])?" selected ":"" ?>><?= $class["name"]?></option>
			    		<?php } ?>
					<?php }		?>
			      
			    </select>
			  </div>
			  <div class="col-md-3">
				  <input id="student_rollno" name="student_rollno" type="text" placeholder="Roll No" class="form-control input-md" required=""
				    <?php if(isset($student["roll_no"])){?>
				  		value="<?=$student["roll_no"] ?>"
				  	<?php } ?>
				  />
			    
			  </div>
			</div>
			
			
			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-3 control-label" for="student_admission_date">Admission Date</label>  
			  <div class="col-md-7 date" data-date-format="YYYY-MM-DD">
				  <div class="input-group">
					  <input id="student_admission_date" name="student_admission_date" type="text" readonly="readonly" placeholder="Admission Date" class="form-control input-md" required=""
					    <?php if(isset($student["admission_date"])){?>
					  		value="<?=$student["admission_date"] ?>"
					  	<?php } ?>
					  />
					  <span class="input-group-addon" style="padding: 6px;">
					  		<span class="glyphicon glyphicon-calendar"></span>
					  </span>
			    </div>
			  </div>
			</div>
			
			<!-- Textarea -->
			<div class="form-group">
			  <label class="col-md-3 control-label" for="student_address">Address</label>
			  <div class="col-md-7">                     
			    <textarea class="form-control" rows="2" id="student_address" name="student_address"><?php if(isset($student["address"])){ echo $student["address"];}?></textarea>
			  </div>
			</div>
			<div class="form-group">
			  <label class="col-md-3 control-label" for="student_email">Email</label>  
			  <div class="col-md-7">
			  <input id="student_email" name="student_email" type="email" placeholder="email@email.com" class="form-control input-md"  
			  value="<?= (isset($student["email"]))? $student["email"]:"" ?>" />
			    
			  </div>
			</div>
			<div class="form-group">
			  <label class="col-md-3 control-label" for="sibling_discount">Sibling Discount</label>
			  <div class="col-md-3">                     
			    <input type="number" class="form-control" id="sibling_discount" name="sibling_discount" value="<?= (isset($student["sibling_discount"]))? $student["sibling_discount"]:''?>" />
			  </div>
			  
			  <div class="col-md-4"> 
			    <span class="radio pull-left" style="margin-top: 0px; font-size: 16px;">
					<label style="padding-left:0px;padding-top:5px;" for="sibling_discount_type-0">
            			<input type="radio" name="sibling_discount_type" id="sibling_discount_type-0" value="%"
	            			<?php if(isset($student["sibling_discount_type"]) && $student["sibling_discount_type"]=="%"){  ?>
					       		checked="checked"
					       	<?php } ?>  >
	      				<span> &nbsp;&nbsp;&nbsp;Percent</span>
	  				</label>
  				</span> 
			    <span class="radio pull-right" style="margin-top: 0px; font-size: 16px;" >
					<label style="padding-left:0px;padding-top:5px;" for="sibling_discount_type-1">
            			<input type="radio" name="sibling_discount_type" id="sibling_discount_type-1" value="Fixed"
	            			<?php if(isset($student["sibling_discount_type"]) && $student["sibling_discount_type"]=="Fixed"){  ?>
					       		checked="checked"
					       	<?php } ?>  >
	      				<span> &nbsp;&nbsp;&nbsp;Fixed</span>
	  				</label>
  				</span> 
			  </div>
			</div>
			
			
			<div class="form-group">
			  <label class="col-md-3 control-label" for="student_class">Sibling Discount On Fee.</label>
			  <div class="col-md-7">
			    <select id="sibling_discount_fee_type" name="sibling_discount_fee_type" class="form-control"  >
			    		<option value=""></option>
    			    	<?php if(isset($feeTypes)){ ?>
    			    		<?php foreach($feeTypes as $feetype){ ?>
    			    			<option value="<?= $feetype["id"]?>" <?= (isset($student["sibling_discount_fee_type"])  && $feetype["id"]==$student["sibling_discount_fee_type"])?"	selected ":"" ?> ><?= $feetype["type"]?></option>
    			    		<?php } ?>
    					<?php }		?>
			      
			    </select>
			  </div>
			  
			</div>
			
			<div class="form-group">
		        <div class="col-sm-9 col-sm-offset-3">
		            <div id="student_add_update_form_messages"></div>
		        </div>
		    </div>
			<!-- Button (Double) -->
			<div class="form-group">
			  <label class="col-md-3 control-label" for="student_btn_reset"></label>
			  <div class="col-md-7">
			  	<div class="pull-right">
				    <button id="student_btn_reset" name="student_btn_reset" class="btn btn-default" type="reset">Reset</button>
			    	<button id="student_btn_save" type="submit" name="student_btn_save" class="btn btn-primary ">Save</button>
			  	</div>
			  </div>
			</div>
			<input type="hidden" name="id" id="student_id"
				<?php if(isset($student["id"]) ){  ?>
			       		value='<?= $student["id"] ?>'
			       	<?php } ?>
			/>
			<input type="hidden" name="student_status" id="student_status"
				<?php if(isset($student["status"]) ){  ?>
			       		value='<?= $student["status"] ?>' 
			       	<?php } else {?>
			       		value='Active'
			       	<?php } ?>
			/>
			<input type="hidden" id="student_image_path" name="student_image_path" value="">
		</div>
	</div>
</div>
</fieldset>
</form>

<script type="text/javascript">
	$(function() {
		var nowDate = new Date();
		$('.date').datetimepicker({
			useCurrent:false,
			pickTime: false
		});
	});


</script>

<!--Validations-->
<script type="text/javascript">
    $(document).ready(function() {

    	// enable revalidation of date
    	dateTimePickerRevalidator();
    	
        $('#student_add_update_form').bootstrapValidator({
        	
            fields: {
            	student_first_name: {
                    message: 'First name is required',
                    validators: {
                        notEmpty: {
                            message: 'The First name is required and can\'t be empty'
                        },
                       
                        regexp: {
                            regexp: /^[a-zA-Z ]+$/,
                            message: 'The First name can only consist of alphabets'
                        }
                        
                    }
                },
                student_father_name: {
                    message: 'Father name is required',
                    validators: {
                        notEmpty: {
                            message: 'The Father name is required and can\'t be empty'
                        },
                       
                        regexp: {
                            regexp: /^[a-zA-Z ]+$/,
                            message: 'The Father name can only consist of alphabets'
                        }
                        
                    }
                },
                
                student_date_of_birth: {
                    message: 'Date of birth is required',
                    validators: {
                    	notEmpty: {
                            message: 'Date of birth is required and can\'t be empty'
                        },
                        date: {
                            format: 'YYYY-MM-DD',
                            message: 'The value is not a valid date. (Format: YYYY-MM-DD)'
                        }
                        
                    }
                },
                student_admission_date: {
                    message: 'Admission date is required',
                    validators: {
                    	notEmpty: {
                            message: 'Admission date is required and can\'t be empty'
                        },
                        date: {
                            format: 'YYYY-MM-DD',
                            message: 'The value is not a valid date. (Format: YYYY-MM-DD)'
                        }
                        
                    }
                },
                student_class: {
                    message: 'Class is required',
                    validators: {
                        notEmpty: {
                            message: 'The Class is required and can\'t be empty'
                        }
                        
                    }
                },
                student_rollno: {
                    message: 'Roll No. is required',
                    validators: {
                        notEmpty: {
                            message: 'The Roll No. is required and can\'t be empty'
                        }
                        
                    }
                },
                student_gender: {
                    message: 'Gender is required',
                    validators: {
                        notEmpty: {
                            message: 'Gender is required'
                        }
                        
                    }
                }
                
            }
        });

    });
</script>


