<?php
?>
<form action="<?= site_url('user/changePassword')?>" method="post" id="forgot_password_form">
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; You can only change your password if you know your current password.                           
		</div>
	</div>
	<br/>
	<div class="row">
	
			<div class="form-group">
			  <div class="col-md-8 col-centered " >
			  	<div class="input-group">
			  		<span class="input-group-addon">
					  	<span class="glyphicon glyphicon-lock"></span>
					</span>
			  		<input type="password" name="curr_password" id="curr_password" class="form-control" placeholder="Current Password">
			    </div>
			  </div>
			</div>

			<div class="form-group">
			  <div class="col-md-8 col-centered " >
			  	<div class="input-group">
			  		<span class="input-group-addon">
					  	<span class="glyphicon glyphicon-lock"></span>
					</span>
			  		<input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password">
			    </div>
			  </div>
			</div>

			<div class="form-group">
			  <div class="col-md-8 col-centered " >
			  	<div class="input-group">
			  		<span class="input-group-addon">
					  	<span class="glyphicon glyphicon-lock"></span>
					</span>
			  		<input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password">
			    </div>
			  </div>
			</div>
		<div class="col-centered">
			<div class="alert alert-warning">
		    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to change your password?                           
			</div>
		</div>
		<div class="col-centered">
	    	<button type="submit" id="reset_pass_save" name="reset_pass_save" class="btn btn-danger">Yes (Change)</button>
	  	</div>
	</div>
</form>


<script >
$(document).ready(function() {
	$('#forgot_password_form').bootstrapValidator({
		fields : {
			curr_password : {
				message : 'Current Password is required.',
				validators : {
					notEmpty : {
						message : 'Current Password is required and can\'t be empty.'
					}
				}
			},
			new_password : {
				message : 'New Password is required.',
				validators : {
					notEmpty : {
						message : 'New Password is required and can\'t be empty.'
					},
					identical: {
                        field: 'confirm_password',
                        message: 'The password and confirm password are not the same'
                    },
                    different: {
                        field: 'curr_password',
                        message: 'The New Password can\'t be the same as Current Password'
                    }
				}
			},
			confirm_password : {
				message : 'Confirm Password is required.',
				validators : {
					notEmpty : {
						message : 'Confirm Password is required and can\'t be empty.'
					},
					identical: {
                        field: 'new_password',
                        message: 'The password and confirm password are not the same'
                    },
                    different: {
                        field: 'curr_password',
                        message: 'The New Password can\'t be the same as Current Password'
                    }
				}
			}
		}
	});

});
</script>