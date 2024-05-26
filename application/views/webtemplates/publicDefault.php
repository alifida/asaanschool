<?php  ?>
<html lang="en">
<head>
	   <?php $this->load->view('webtemplates/public/common/header'); ?>
<style type="text/css">
.ms-header.ms-header-primary {
	background-color: #1198b7;
	color: #fff
}
.ms-navbar {
	background-color: #1198b7;
	color: #fff;
	border: none;
	height: 50px;
	margin-bottom: 0px;
	box-shadow: 0 3px 3px rgba(0, 0, 0, .29)
}
.ms-hero-bg-dark-light:after {
	display: block;
	content: "";
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	width: 100%;
	height: 100%;
	background-color: #09687d;
	z-index: 0
}
.btn-circle i.zmdi {
	font-size: 20px;
	vertical-align: middle;
	    margin-top: 15px;
}
.ms-carousel .carousel-control.right, .ms-carousel .carousel-control.left{
	display:none;
}
.btn-circle.btn-circle-raised.btn-circle-primary {
    background-color: #085d71;
}
.btn-circle.btn-circle-raised.btn-circle-primary:before {
	background-color: #0f3e48
}
.navbar, .navbar.navbar-default {
	background-color: #1198b7;
	color: rgba(255, 255, 255, .84)
}
.navbar-fixed-top .navbar-brand img{
	width: 130px !important;
	margin: 0px !important;
}
</style>

</head>
<body>
	<?php
	
	$websiteConf = getWebsiteByURL ();
	$data ["websiteConf"] = $websiteConf;
	
	?>
	  	<?php $this->load->view('webtemplates/public/common/top_section', $data); ?>
	  	<?php $this->load->view('webtemplates/public/common/nav_bar', $data); ?>
	  	<?php $this->load->view('webtemplates/public/common/login_register'); ?>
	   
		<?php if(isset($slider)){ ?>
			<div class="row">
		<div class="col-md-12">
					<?php $this->load->view('webtemplates/public/common/slider');?>
				</div>
	</div>
		<?php }?>
		
		
		
		<?php if(isset($header)){?>
			<header class="ms-hero-page ms-hero-bg-dark-light ms-hero-img-airplane mb-4">
		<div class="container">
			<div class="text-center">
				<br />
				<h1 class=" mb-4 animated fadeInDown animation-delay-4"><?= isset($header['title'])?$header['title']:""?></h1>
				<p class="lead lead-xl mw-800 center-block color-medium mb-2 animated fadeInDown animation-delay-4"> 
					<?= isset($header['description'])?$header['description']:""?>
				</p>
				<br />
			</div>
		</div>
	</header>
      <?php }?>
		
		
		
		<div class="container">
			<?php echo $body; ?>
		</div>
		<?php $this->load->view('webtemplates/public/common/footer'); ?>
		<?php $this->load->view('webtemplates/public/common/app_messages'); ?>
	</body>
</html>














