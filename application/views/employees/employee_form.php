<?php ?>
	<br/>
	<form class="form-horizontal" action="<?= site_url('employee/saveEmployee') ?>" method="post" id="employee_form">
		<fieldset>
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-4 col-md-4">
			           	<br/>
			           	<div  class="col-centered">
				           	<div class="row">
					           	<div  id="employee_image_container"  class="col-centered col-lg-8 col-md-8 col-sm-4 col-xs-4">
						           	<?php if(isset($employee["employee_picture"]) && !empty($employee["employee_picture"])){?>
				    	       			<img src='<?= $employee["employee_picture"] ?>' alt=''  class='img-circle circle_border max-100' />
				    	       		<?php } else{?>
				    	       			<img src='<?= site_url("public/images/employee_avatar.png") ?>' alt=''  class='img-circle circle_border max-100' />
				    	       		<?php } ?>
					           	</div>
					           		<br/>
			           				<div class="col-centered">
			           					<span class="btn btn-primary btn-file">Browse
						    	       		<input type="file" id="browse_file" name="employeePic"
				    		       				onchange="ajax_file_submit('<?= site_url('fileupload/uploadStudentPic')?>' , 'employee_image_container' ,'employee_image_path')" />
										</span>
			           				</div>
				           		
				           	</div>
			           	</div>
				        <br/><br/>
					</div>
										
					<div class="col-lg-8 col-md-8  col-sm-12  col-xs-12">
			
			
					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="first_name">Name</label>  
					  <div class="col-md-3">
					  	<input id="first_name" name="first_name" type="text" 
					  		<?php if(isset($employee["first_name"])){ ?>
					  			value="<?= $employee["first_name"] ?>"
					  		<?php } ?>
					  		placeholder="First Name" class="form-control input-md" required="required">
					  </div>
					   <div class="col-md-3">
					  	<input id="last_name" name="last_name" type="text" 
					  		<?php if(isset($employee["last_name"])){ ?>
					  			value="<?= $employee["last_name"] ?>"
					  		<?php } ?>
					  		placeholder="Last Name" class="form-control input-md" >
					  </div>
					</div>
					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="employee_type_id">Type</label>  
					  <div class="col-md-6">
					  	<select id="employee_type_id" name="employee_type_id" class="form-control" required="required">
						      <option value=""></option>
						      <?php foreach($employeeTypes as $type){ ?>
								<option value="<?= $type['id'] ?>" <?= (isset($employee) && $type['id'] == $employee["type"]["id"])? " selected='selected' ":""; ?> 
								  ><?= $type['type'] ?> </option>	
									
							<?php } ?>
					    </select>
					  </div>
					</div>
					
					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="cnic">Citizen No.</label>  
					  <div class="col-md-6">
					  	<input id="cnic" name="cnic" type="text" 
					  		<?php if(isset($employee["cnic"])){ ?>
					  			value="<?= $employee["cnic"] ?>"
					  		<?php } ?>
					  		placeholder="Citizen No." class="form-control input-md" required="required">
					  </div>
					</div>
					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="email">Email</label>  
					  <div class="col-md-6">
					  	<input id="email" name="email" type="text" 
					  		<?php if(isset($employee["email"])){ ?>
					  			value="<?= $employee["email"] ?>"
					  		<?php } ?>
					  		placeholder="Email" class="form-control input-md" required="required">
					  </div>
					</div>
					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="address">Address</label>  
					  <div class="col-md-6">
					  	<input id="adress" name="address" type="text" 
					  		<?php if(isset($employee["address"])){ ?>
					  			value="<?= $employee["address"] ?>"
					  		<?php } ?>
					  		placeholder="Address" class="form-control input-md" required="required">
					  </div>
					</div>
					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="salary">Salary</label>  
					  <div class="col-md-6">
					  	<input id="salary" name="salary" type="text" 
					  		<?php if(isset($employee["salary"])){ ?>
					  			value="<?= $employee["salary"] ?>"
					  		<?php } ?>
					  		placeholder="Salary" class="form-control input-md" required="required">
					  </div>
					</div>
					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="qualification">Qualification</label>  
					  <div class="col-md-6">
					  	<input id="qualification" name="qualification" type="text" 
					  		<?php if(isset($employee["qualification"])){ ?>
					  			value="<?= $employee["qualification"] ?>"
					  		<?php } ?>
					  		placeholder="Qualification" class="form-control input-md" required="required">
					  </div>
					</div>
					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="date_of_joining">Joining Date</label>  
					  <div class="col-md-6 date" data-date-format="YYYY-MM-DD" >
					  <div class="input-group">
					  	<input id="date_of_joining" name="date_of_joining" type="text" readonly="readonly"
					  		<?php if(isset($employee["date_of_joining"])){ ?>
					  			value="<?= $employee["date_of_joining"] ?>"
					  		<?php } ?>
					  		placeholder="Joining Date" class="form-control input-md" required="required">
					  		<span class="input-group-addon" style="padding: 6px;">
							  	<span class="glyphicon glyphicon-calendar"></span>
							</span>
					  </div>
					  </div>
					</div>
					
					<?php if(isset($employee["id"])){ ?>
						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="date_of_resigning">Resigning Date</label>  
						  <div class="col-md-6 date" data-date-format="YYYY-MM-DD" >
							  <div class="input-group">
							  	<input id="date_of_resigning" name="date_of_resigning" type="text"   readonly="readonly"
							  		<?php if(isset($employee["date_of_resigning"])){ ?>
							  			value="<?= $employee["date_of_resigning"] ?>"
							  		<?php } ?>
							  		placeholder="Resigning Date" class="form-control input-md" >
						  			<span class="input-group-addon" style="padding: 6px;">
								  		<span class="glyphicon glyphicon-calendar"></span>
								  </span>
							  </div>
						  </div>
						</div>
				<?php } ?>
					<br/> 
					<!-- Button (Double) -->
					<div class="form-group">
					  <label class="col-md-6 control-label" for="employee_save"></label>
					  	<div class="col-md-6">
					     	<button id="employee_reset" name="employee_reset" class="btn btn-default" type="reset">Reset</button>  
					    	<button type="submit" id="employee_save" name="employee_save" class="btn btn-primary">Save</button>
					  	</div>
					</div>
				</div>
			</div>	
		</div>
		<input id="employee_id" name="employee_id" type="hidden" 
			<?php if(isset($employee["id"])){ 
		 		echo " value='".$employee["id"]."'";
		  } ?>
		 />
		 
		 <input type="hidden" id="employee_image_path" name="employee_image_path" value=""/>
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
		 

<script type="text/javascript">
    $(document).ready(function() {
        // enable revalidation of date
    	dateTimePickerRevalidator();
        $('#employee_form').bootstrapValidator({
            fields: {
            	first_name: {
            		message: 'First Name is required',
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
                employee_type_id: {
            		message: 'Type is required',
            		validators: {
            			notEmpty: {
                            message: 'The Type is required and can\'t be empty'
                        }
                    }
                },
                cnic: {
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
                email: {
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
                salary: {
                    message: 'Salary is required',
                    validators: {
                    	notEmpty: {
                            message: 'Salary is required and can\'t be empty'
                        },
                        numeric: {
                            message: 'Salary is not valid number.'
                        }
                    }
                },
                date_of_joining: {
                    message: 'Joining Date is required',
                    validators: {
                    	notEmpty: {
                            message: 'Joining Date is required and can\'t be empty'
                        },
                        date: {
                            format: 'YYYY-MM-DD',
                            message: 'The value is not a valid date. (Format: YYYY-MM-DD)'
                        }
                    }
                },
                date_of_resigning: {
                    message: 'Resigning Date is required',
                    validators: {
                        regexp: {
                            regexp: /^[0-9+]{4}-[0-9+]{2}-[0-9]{2}$/,
                            message: 'Resigning Date is not valid. Format: YYYY-MM-DD'
                        }
                    }
                }
            }
        });
    });
</script>		





			