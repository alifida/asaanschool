<?php ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 
<?php $this->load->view('asaanschool/common/common_include_head'); ?>
<!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

</head>
<!--/head-->

<body data-spy="scroll" data-target="#navbar" data-offset="0">
<?php $this->load->view('asaanschool/common/top_menu'); ?>
	<br />


	<section id="modules">
		<div class="container">
			<div class="box">
				<div class="center gap">
					<h2>Video Demonstration</h2>
					<p class="lead">Following are a few of the video guide for the users.</p>
				</div>
				<!--/.center-->

				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="row">
							<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1  ">
								<div class="video-thumb-wrapper">
									<img src="<?= base_url() ?>videos/signup-thumb.png" alt=""
										style="width: 100%">
									<div class="blur-image"></div>
									<a class="play-btn btn-lg btn-danger"
										title="Sign-up and Basic Configuration"
										href="javascript:void(0);" style="background-color: #c9302c;"
										onclick="showVideo('Sign-up and Basic Configuration', '<?= base_url() ?>videos/school-management-system.mp4');">
										<i class="fa fa-fw fa-play icon-color1 "
										style="background-color: #c9302c;"></i> </a>
										
								</div>
								
								
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12vertical-margin center v-margin-10 ">
								<a href="javascript:void(0)" class="btn btn-primary">Sign-up and Basic Configuration</a>
							</div>
							
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="row ">
							<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 ">
								<div class="video-thumb-wrapper">
									<img src="<?= base_url() ?>videos/employee-thumb.png" alt=""
										style="width: 100%">
									<div class="blur-image"></div>
									<a class="play-btn btn-lg btn-danger"
										title="Employee Management"
										href="javascript:void(0);" style="background-color: #c9302c;"
										onclick="showVideo('Employee Management', '<?= base_url() ?>videos/employee-management.mp4');">
										<i class="fa fa-fw fa-play icon-color1 "
										style="background-color: #c9302c;"></i> </a>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12vertical-margin center v-margin-10 ">
								<a href="javascript:void(0)" class="btn btn-primary">Employee Management</a>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="row ">
							<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 ">
								<div class="video-thumb-wrapper">
									<img src="<?= base_url() ?>videos/attendance-thumb.png" alt=""
										style="width: 100%">
									<div class="blur-image"></div>
									<a class="play-btn btn-lg btn-danger"
										title="Attendance Register" href="javascript:void(0);"
										style="background-color: #c9302c;"
										onclick="showVideo('Attendance Register', '<?= base_url() ?>videos/attendance-register.mp4');">
										<i class="fa fa-fw fa-play icon-color1 "
										style="background-color: #c9302c;"></i> </a>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12vertical-margin center v-margin-10 ">
								<a href="javascript:void(0)" class="btn btn-primary">Attendance Register</a>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="row ">
							<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1  ">
								<div class="video-thumb-wrapper">
									<img src="<?= base_url() ?>videos/inventory-thumb.png" alt=""
										style="width: 100%">
									<div class="blur-image"></div>
									<a class="play-btn btn-lg btn-danger"
										title="Inventory Control" href="javascript:void(0);"
										style="background-color: #c9302c;"
										onclick="showVideo('Inventory Control', '<?= base_url() ?>videos/inventory-control-system.mp4');">
										<i class="fa fa-fw fa-play icon-color1 "
										style="background-color: #c9302c;"></i> </a>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12vertical-margin center v-margin-10 ">
								<a href="javascript:void(0)" class="btn btn-primary">Inventory Control</a>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="row ">
							<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1  ">
								<div class="video-thumb-wrapper">
									<img src="<?= base_url() ?>videos/profit-thumb.png" alt=""
										style="width: 100%">
									<div class="blur-image"></div>
									<a class="play-btn btn-lg btn-danger"
										title="Profit Calculator" href="javascript:void(0);"
										style="background-color: #c9302c;"
										onclick="showVideo('Profit Calculator', '<?= base_url() ?>videos/profit-calculator.mp4');">
										<i class="fa fa-fw fa-play icon-color1 "
										style="background-color: #c9302c;"></i> </a>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12vertical-margin center v-margin-10 ">
								<a href="javascript:void(0)" class="btn btn-primary">Profit Calculator</a>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="row ">
							<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1  ">
								<div class="video-thumb-wrapper">
									<img src="<?= base_url() ?>videos/website-thumb.png" alt=""
										style="width: 100%">
									<div class="blur-image"></div>
									<a class="play-btn btn-lg btn-danger"
										title="Website Management" href="javascript:void(0);"
										style="background-color: #c9302c;"
										onclick="showVideo('Website Management', '<?= base_url() ?>videos/website-management.mp4');">
										<i class="fa fa-fw fa-play icon-color1 "
										style="background-color: #c9302c;"></i> </a>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12vertical-margin center v-margin-10 ">
								<a href="javascript:void(0)" class="btn btn-primary">Website Management</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/.box-->
		</div>
		<!--/.container-->
	</section>
	<!--/#portfolio-->





	<?php $this->load->view('asaanschool/contactus'); ?>
	<?php $this->load->view('asaanschool/common/footer'); ?>

	<?php $this->load->view('asaanschool/common/common_include_body'); ?>

	<script type="text/javascript">

	function showVideo(title, url){
		$('#global_modal_label').html(title);
		$html = '	<video id="demo_video" width="100%"  controls autoplay>'
			  	+'		<source src="'+url+'" type="video/mp4">'
				+'			Your browser does not support the video tag.'
				+'	</video>';
		$('#global_modal_body').html($html);
		$('#videos_modal').modal('show');
	}
	
	
	function playPause() { 
	var demo_video = document.getElementById("demo_video"); 
		if (demo_video.paused) 
			demo_video.play(); 
		else 
			demo_video.pause(); 
	} 
	function pause_demo_video(){
		var demo_video = document.getElementById("demo_video"); 
		demo_video.pause();
	}
    
    </script>



	<div class="modal fade " id="videos_modal" tabindex="-1" role="dialog"
		aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-dialog" style="margin: 85px auto;">
			<div class="modal-content">

				<div class="modal-body" id="global_modal_body"></div>
				<div class="modal-footer">
					<h4 class="modal-title pull-left" id="global_modal_label"></h4>
					<button type="button" class="btn btn-default" data-dismiss="modal"
						onclick="pause_demo_video();">Close</button>
				</div>
			</div>
		</div>
	</div>





</body>
</html>