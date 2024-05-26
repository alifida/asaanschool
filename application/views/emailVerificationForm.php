<?php
?>
<?php if(!$errorExist){?>
<form action="<?= site_url('user/verifyEmailCode')?>" method="post" id="verifyEmail">
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span><?= $message ?>                           
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
			  		<input type="text" id="email_code" name="email_code" class="form-control" placeholder="Email Code">
			    </div>
			  </div>
			</div>
		
		<div class="col-centered">
	    	<button type="submit" id="verify_email" name="verify_email" class="btn btn-danger">Verify</button>
	    	
	  	</div>
	</div>
</form>


<script >
$(document).ready(function() {
	$('#verifyEmail').bootstrapValidator({
		fields : {
			email_code : {
				message : 'Verification Code is required.',
				validators : {
					notEmpty : {
						message : 'Verification Code is required and can\'t be empty.'
					}

				}
			}
		}
	});

});
</script>
<?php }else{?>
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span><?= $message ?>                           
		</div>
	</div>
<?php }?>