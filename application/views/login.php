<?php 
	 
?>
<!DOCTYPE html>
<html lang="en">

<head>
<style type="text/css">
.footer{display:none;}
</style>
   <?php $this->load->view('common/common_include_head'); ?>

</head>

<body class="skin-blue">
<?php $this->load->view('asaanschool/common/analyticstracking'); ?>
   <div class="container">
<br/>
<div class="row">
    <div class="col-xs-12 col-sm-10 col-md-6 col-sm-offset-2 col-md-offset-3">
		<div class="list-group-item">
		<form role="form" action="<?= site_url('user/authenticate') ?>" method="post" id="login_form">
			<fieldset>
				<div class="container-fluid">
				<h2>Please Login 
					<small>
						<span class="col-xs-4 col-sm-4 col-md-4 pull-right" style="padding-top: 10px;">
							   <a href="<?= site_url("user/signup") ?>"  >Sign up</a> 
						</span>
						
					</small>
				</h2>
				<hr class="">
	
			<br/>
				<div class="form-group">
					<div class="row">
						<div class="col-lg-1"></div>
						<label class="col-lg-2 control-label  "  for="email" style="margin-top: 10px;">Email</label>  
						  <div class="col-lg-8 " >
						  	<div class="input-group">
						  		<span class="input-group-addon" >
								  	<span class="glyphicon glyphicon-envelope"></span>
								</span>
						  		<input type="text" id="email" name="email" class="form-control" placeholder="Email">
						    </div>
						  </div>
						  <div class="col-lg-1"></div>
					</div>
				</div>
				
				
				
				<div class="form-group">
					<div class="row">
						<div class="col-lg-1"></div>
						<label class="col-lg-2 control-label  "  for="password" style="margin-top: 10px;">Password</label>  
					  	<div class="col-lg-8  " >
					  	<div class="input-group">
					  		<span class="input-group-addon">
							  	<span class="glyphicon glyphicon-lock"></span>
							</span>
					  		<input type="password" name="password" id="password" class="form-control" placeholder="Password">
					    </div>
					  </div>
					  <div class="col-lg-1"></div>
					</div>	  
				</div>
					
				
				
				<br/>
				
				<div class="row">
					<div class="col-md-12">
						   <a href="javascript:void(0);" onclick="load_remote_model('<?= site_url("resetpassword/form") ?>','Forgot Password')" class=" pull-right">Forgot Password</a> 
					</div>
				</div>
				
				
				<div class="row">
					
				</div>
				
				<hr class="">
				<div class="row">
					<div class="col-xs-6 col-md-5 col-lg-4 pull-left">
						<a href="javascript:void(0);" class="btn btn-primary btn-block " onclick="load_remote_model('<?= site_url('user/activiateAccountForm') ?>','Activate Account');">Activate Account</a> 
					</div>
					<div class="col-xs-6 col-md-5 col-lg-4 pull-right">
						<input type="submit" value="Login" class="btn btn-primary btn-block " tabindex="3">
					</div>
					<!-- <div class="col-xs-12 col-md-6"><a href="#" class="btn btn-success btn-block btn-lg">Sign In</a></div>-->
				</div>
				<br/>
				</div>
			</fieldset>
		</form>
		</div>
	</div>
</div>


</div>
<?php $this->load->view('common/common_include_body'); ?>
 <?php $this->load->view('common/server_messages'); ?>
	
<script >
$(document).ready(function() {

	$('#login_form').bootstrapValidator({

		fields : {
			email : {
				message : 'Login Id (Email) is required.',
				validators : {
					notEmpty : {
						message : 'Login Id (Email) is required and can\'t be empty.'
					},
					regexp: {
						regexp: /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,9})$/,
                        message: 'Email is not valid. Format: xxx@xx.xx'
                    }

				}
			},
			password: {
				message : 'Please provide the password.',
				validators : {
					notEmpty : {
						message : 'Password is required and can\'t be empty.'
					}
				}
			},
			expense_date: {
				message : 'expense_date provide the password.',
				validators : {
					notEmpty : {
						message : 'expense_date is required and can\'t be empty.'
					}
				}
			}
		}
	});

});
</script>
	<?php session_destroy();?>
	
</body>

</html>