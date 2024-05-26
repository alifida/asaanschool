<?php   ?>

	<br/>
	
	<form class="form-horizontal" action="<?= site_url('admin/saveUser') ?>" method="post" id="create_user_form">
		<fieldset>
		
		
			<div class="form-group">
			  <label class="col-md-4 control-label" for="user_type">User Type</label>
			  <div class="col-md-5">
			    <select id="user_type" name="user_type" onchange="on_user_type_selection();" class="form-control required"  required="required" >
			    		<option value=""></option>
				    	<?php if(isset($userTypes)){ ?>
				    		<?php foreach($userTypes as $userType){ ?>
				    			<option value="<?= $userType["id"]?>" <?= (isset($user) && $user["userType"]["id"]==$userType["id"]) ? " selected ":"";  ?> ><?= $userType["type"]?></option>
				    		<?php } ?>
						<?php }	?>
			    </select>
			  </div>
			</div>
		
		
		
		
		<div class="form-group student_section dependent_section">
		  <label class="col-md-4 control-label" for="create_user_student_id">Student</label>  
		  <div class="col-md-5">
		  		<input id="create_user_student_id" name="student_id" type="text"  placeholder="Student" class="form-control input-md required" />
		  		<script type="text/javascript">
                    $(document).ready(function() {
                        $("#create_user_student_id").tokenInput("<?= site_url('student/getAutoComplete') ?>", {
                        	<?php if (isset($prePopulateStudent)) { ?>
                        		prePopulate: <?= $prePopulateStudent ?>,
							<?php } ?>
                            theme: "custom",
                            <?php if (isset($readonlyStudent)) { ?>
                            	readonly: <?= $readonlyStudent ?>,
							<?php } ?>
                            tokenLimit: 1
                        });
                    });
                </script>
		  </div>
		</div>
 
		<div class="form-group guardian_section dependent_section">
		  <label class="col-md-4 control-label" for="create_user_guardian_id">Guardian</label>  
		  <div class="col-md-5">
		  		<input id="create_user_guardian_id" name="guardian_id" type="text"  placeholder="Guardian" class="form-control input-md required" />
		  		<script type="text/javascript">
                    $(document).ready(function() {
                        $("#create_user_guardian_id").tokenInput("<?= site_url('guardian/getAutoComplete') ?>", {
                        	<?php if (isset($prePopulateGuardian)) { ?>
                        		prePopulate: <?= $prePopulateGuardian ?>,
							<?php } ?>
                            theme: "custom",
                            <?php if (isset($readonlyGuardian)) { ?>
                            	readonly: <?= $readonlyGuardian ?>,
							<?php } ?>
                            tokenLimit: 1
                        });
                    });
                </script>
		  </div>
		</div>
		
		
		
		
		
		
		<div class="form-group employee_section dependent_section">
		  <label class="col-md-4 control-label" for="create_user_employee_id">Employee</label>  
		  <div class="col-md-5">
		  		<input id="create_user_employee_id" name="employee_id" type="text"  placeholder="Employee" class="form-control input-md required " />
		  		<script type="text/javascript">
                    $(document).ready(function() {
                        $("#create_user_employee_id").tokenInput("<?= site_url('employee/getAutoComplete') ?>", {
                        	<?php if (isset($prePopulateEmployee)) { ?>
                        	prePopulate: <?= $prePopulateEmployee ?>,
							<?php } ?>
                            theme: "custom",
                            <?php if (isset($readonlyEmployee)) { ?>
                            readonly: <?= $readonlyEmployee ?>,
							<?php } ?>
                            tokenLimit: 1
                        });
                    });

                </script>
		  </div>
		</div>
		<div class="employee_section dependent_section">
			<?php $this->load->view("users/userModulesSelection");?>
		</div>
		
		<br/> 
		<!-- Button (Double) -->
		<div class="form-group">
		  <label class="col-md-6 control-label" for="create_user_save"></label>
		  	<div class="col-md-6">
		     	<button id="create_user_reset" name="create_user_reset" class="btn btn-default" type="reset">Reset</button>  
		    	<button id="create_user_save" name="create_user_save" class="btn btn-primary" type="submit">Save</button>
		  	</div>
		</div>
		</fieldset>
		
		<input type="hidden" name="userId" id= "userId" value="<?= (isset($userId) && !empty($userId)) ? $userId: ""?>"/>
		<input type="hidden" name="type" id= "type" value="<?= (isset($type) && !empty($type)) ? $type: "" ?>"/>
	</form>
		
        
        
<script>

function get_type_key_by_id($id){
	var types = <?= isset($userTypes)? json_encode($userTypes):"''" ?>;
	for (var i in types) {
	     if( types[i].id == $id){
			return types[i].internal_key;
		 }
	}
	return "";
	
}

	function on_user_type_selection(){
		
		$typeid = $("#user_type").val();
		$type = get_type_key_by_id($typeid);

		$(".required").prop('required',false);
		$(".user_type").prop('required',false);
		 
		
		if($type == "employee"){
			$(".dependent_section").slideUp();
			$(".employee_section").slideDown();
			$(".employee_section .required").prop('required',true);
		}else if($type == "guardian"){
			$(".dependent_section").slideUp();
			$(".guardian_section").slideDown();
			$(".guardian_section .required").prop('required',true);
		}else if($type == "student"){
			$(".dependent_section").slideUp();
			$(".student_section").slideDown();
			$(".student_section .required").prop('required',true);
		}
}

	 $(document).ready(function() {
		on_user_type_selection();
	 });
</script>
				
			