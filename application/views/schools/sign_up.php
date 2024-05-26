<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
<style type="text/css">
.footer {
	display: none;
}
</style>
   <?php $this->load->view('common/common_include_head'); ?>

</head>

<body class="skin-blue">
<?php $this->load->view('asaanschool/common/analyticstracking'); ?>
   <div class="container">
		<br />
		<div class="row">
			<div
				class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
				<div class="list-group-item">
					<form role="form" method="post" name="school_signup_form"
						id="school_signup_form"
						onsubmit="event.preventDefault(); return false; ">
						<h2>
							Please Sign Up <small> <span
								class="col-xs-3 col-sm-3 col-md-3 pull-right"
								style="padding-top: 10px;"> <a
									href="<?= site_url("user/login") ?>">Login</a>
							</span>
							</small>
						</h2>
						<hr class="">
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" name="school_name" id="school_name"
										class="form-control input-lg" placeholder="School Name"
										tabindex="1" required="required">
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" name="registration_no" id="registration_no"
										class="form-control input-lg" placeholder="Registration No"
										tabindex="2">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="form-group">
									<input type="email" name="email" id="email"
										class="form-control input-lg" placeholder="Email Address"
										tabindex="4">
								</div>
							</div>

						</div>


						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="password" name="regPassword" id="regPassword"
										class="form-control input-lg" placeholder="Password"
										tabindex="5">
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="password" name="confirmPassword"
										id="confirmPassword" class="form-control input-lg"
										placeholder="Confirm Password" tabindex="6">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
								By clicking <strong class="label label-primary">Register</strong>,
								you agree to the <a href="#" onclick="load_remote_model('<?= site_url('tos') ?>','Terms of Service');enlarge_remote_model();">Terms of Service</a> set out by
								asaanschool.com, including our Cookie Use.
							</div>
						</div>

						<hr class="">
						<div class="row">
							<div class="col-xs-12 col-md-4 pull-right">
								<input type="button" value="Register"
									class="btn btn-primary btn-block "
									onclick="submit_signup_form();" tabindex="3">
							</div>
							<!-- <div class="col-xs-12 col-md-6"><a href="#" class="btn btn-success btn-block btn-lg">Sign In</a></div>-->
						</div>
						<br />
					</form>
				</div>
			</div>
		</div>
		 
	</div>

<?php $this->load->view('common/common_include_body'); ?>
<?php $this->load->view('common/server_messages'); ?>
	<script>
	$(function () {
    $('.button-checkbox').each(function () {

        // Settings
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox'),
            color = $button.data('color'),
            settings = {
                on: {
                    icon: 'glyphicon glyphicon-check'
                },
                off: {
                    icon: 'glyphicon glyphicon-unchecked'
                }
            };

        // Event Handlers
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $button.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $button.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$button.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $button
                    .removeClass('btn-default')
                    .addClass('btn-' + color + ' active');
            }
            else {
                $button
                    .removeClass('btn-' + color + ' active')
                    .addClass('btn-default');
            }
        }

        // Initialization
        function init() {

            updateDisplay();

            // Inject the icon if applicable
            if ($button.find('.state-icon').length == 0) {
                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i>');
            }
        }
        init();
    });
});
	</script>


	<script type="text/javascript">
    $(document).ready(function() {
    	validateForm();
    });
    function validateForm(){
    	 $('#school_signup_form').bootstrapValidator({
             fields: {
             	school_name: {
             		message: 'School name is required',
             		validators: {
                         notEmpty: {
                             message: 'School name is required and can\'t be empty'
                         }
                     }
                 },
                 registration_no: {
             		message: 'Registration No. is required',
             		validators: {
                         notEmpty: {
                             message: 'Registration No. is required and can\'t be empty'
                         }
                     }
                 },
                 email: {
             		message: 'Please Provide a valid Email Address',
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
                 regPassword: {
                     validators: {
                         notEmpty: {
                             message: 'The password is required and can\'t be empty'
                         },
                         identical: {
                             field: 'confirmPassword',
                             message: 'The password and confirm password are not the same'
                         },
                         different: {
                             field: 'email',
                             message: 'The password can\'t be the same as Email'
                         }
                     }
                 },
                 confirmPassword: {
                     validators: {
                         notEmpty: {
                             message: 'The confirm password is required and can\'t be empty'
                         },
                         identical: {
                             field: 'regPassword',
                             message: 'The password and confirm password are not the same'
                         },
                         different: {
                             field: 'email',
                             message: 'The password can\'t be the same as Email'
                         }
                     }
                 }
                 
             }
         });
         
        }
	function submit_signup_form(){
		
		event.preventDefault(); 
		validateForm(); 
		load_remote_model('<?= site_url("user/sendEmailVerificationCode")?>', 'Email Verification Code', $('#school_signup_form').serialize());
		return false;
	}
</script>
	<?php $this->load->view('common/global_modal'); ?>
</body>

</html>
