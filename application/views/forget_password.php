<?php
?>
<form action="<?= site_url('resetpassword/reset')?>" method="post" id="forgot_password_form">
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Please provide your email address that you are using as your login Id.                           
		</div>
	</div>
	<br/>
	<div class="row">
	
		<div class="form-group">
			  <div class="col-md-6 col-centered" >
			  	<div class="input-group">
			  		<span class="input-group-addon" >
					  	<span class="glyphicon glyphicon-envelope"></span>
					</span>
			  		<input type="text" id="fp_email" name="fp_email" class="form-control" placeholder="Email">
			    </div>
			  </div>
			</div>
		
		<div class="col-centered">
	    	<button type="submit" id="reset_pass_save" name="reset_pass_save" class="btn btn-danger">Yes (Reset)</button>
	  	</div>
	</div>
</form>


<script >
$(document).ready(function() {
	$('#forgot_password_form').bootstrapValidator({
		fields : {
			fp_email : {
				message : 'Login Id (Email) is required.',
				validators : {
					notEmpty : {
						message : 'Login Id (Email) is required and can\'t be empty.'
					},
					regexp: {
                        regexp: /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/,
                        message: 'Email is not valid. Format: xxx@xx.xx'
                    }

				}
			}
		}
	});

});
</script>