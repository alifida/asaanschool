<?php ?>
<!DOCTYPE html>
<html lang="en">
	<head>
	   <link href="<?= base_url() ?>public/css/bootstrap.css" rel="stylesheet">

	</head>
	<body class="skin-blue">
	<br/><br/><br/>
	<br/>
	   <div class="container">
			<div class="row">
			    <div class="col-md-6 col-md-offset-3">
			    <?php if(isset($_SESSION["appErrors"]) && !empty($_SESSION["appErrors"])){ ?>
					<div class="alert alert-info">
						<div class="row">
							<div class="col-centered" style="padding:20px;">
								<table width="100%" >
									<tr>
										<td>
											<div class="col-centered">
												<span class=" glyphicon glyphicon-warning-sign" style="font-size: 28px;"></span>
											</div>
										</td>
										<td>
											<div class="col-lg-12" style="font-size: 14px;" >
									          <ul class="custom_ul" style="list-style: none;">
									             <?php foreach ($_SESSION["appErrors"] as $error){ ?>
									             <li><?= $error ?> </li>
									             <?php } ?>
									          </ul>
											</div>
										</td>
									</tr>
								</table>
									
							</div>
						</div>
						<?php unset($_SESSION["appErrors"]); ?>
						<?php } ?>	
			    <?php if(isset($_SESSION["appMessages"]) && !empty($_SESSION["appMessages"])){ ?>
					<div class="alert alert-info">
						<div class="row">
							<div class="col-centered" style="padding:20px;">
								<table width="100%" >
									<tr>
										<td>
											<div class="col-centered">
												<span class=" glyphicon glyphicon-warning-sign" style="font-size: 28px;"></span>
											</div>
										</td>
										<td>
											<div class="col-lg-12" style="font-size: 14px;" >
									          <ul class="custom_ul" style="list-style: none;">
									             <?php foreach ($_SESSION["appMessages"] as $msg){ ?>
									             <li><?= $msg ?> </li>
									             <?php } ?>
									          </ul>
											</div>
										</td>
									</tr>
								</table>
									
							</div>
						</div>
						<?php unset($_SESSION["appMessages"]); ?>
						<?php } ?>	
					</div>
				</div>
				<div class="row">	
					<div style="text-align: center">
						<img src="<?= site_url("public/images/loader_gif_2.gif")?>"/>
					</div>
				</div>
					
			</div>
		</div>
		</div>
		<?php if(isset($_SESSION["tmp_login_email"]) && !empty($_SESSION["tmp_login_email"]) && isset($_SESSION["tmp_login_password"]) && !empty($_SESSION["tmp_login_password"]) ){?>
		<div style="display: none">
			<form role="form" id="autloginForm" action="<?= site_url('user/authenticate') ?>" method="post">
				<input type="password" name="email" value="<?= $_SESSION["tmp_login_email"] ?>">
				<input type="password" name="password"  value="<?= $_SESSION["tmp_login_password"] ?>">
				
			</form>
		</div>
		<script src="<?= base_url() ?>public/js/jquery-2.1.1.min.js"></script>
		<script>
			$( document ).ready(function() {
	    		setTimeout(function(){
		    		$( "#autloginForm" ).submit();
			    }, 3000);
			});
		</script>
		<?php
		 unset($_SESSION["tmp_login_email"]);
		 unset($_SESSION["tmp_login_email"]);
		?>
		<?php } ?>
	</body>
    
</html>
