<?php ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title><?= $errorCode?></title>
<link href="<?= base_url() ?>public/css/bootstrap.css" rel="stylesheet">
<link href="<?= base_url() ?>public/css/asaanschool.css" rel="stylesheet">
</head>
<body>
<br/>
	<div class="row">
		<div class="col-centered col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="box box-primary">
				<div class="box-header"><?= $errorCode?></div>
				<!-- /.box-header -->
				<div class="box-body">
						<div class="row">
							<div class="col-centered col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<?php if(isset($serverMessage) && !empty($serverMessage)){?>
									<div class="alert alert-warning">
						    			<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; 
						    				<?= $serverMessage ?>                            
									</div>
								<?php } ?>
								<br/>
							</div>
						</div>
						<div class="row">
							<div class="col-centered col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
					  			<img src="<?= base_url() ?>public/images/404.jpg" alt="Page Not Found (404)." style="">
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>