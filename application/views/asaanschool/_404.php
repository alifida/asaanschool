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
    <!-- Place this tag in your head or just before your close body tag. -->
<script src="https://apis.google.com/js/platform.js" async defer></script>
</head><!--/head-->

<body data-spy="scroll" data-target="#navbar" data-offset="0">

     <?php $this->load->view('asaanschool/common/top_menu'); ?>

    <section id="main-slider" class="" style="padding: 10% 0%">
        <div class="">

            <div class="item active">
                <div class="container">
                    <div class="carousel-content">
                        <div class="row">
    	                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
    	                    	<div class="center">
	                             	<i class="fa fa-fw fa-flask icon-md icon-color1" 
	                             		style="font-size: 80px;
										height: 130px;
										width: 130px;
										line-height: 130px;"></i>
                        		</div>
                        		<h1>ERROR 404</h1>
		                        <p class="lead">Page Not Found</p>
		                        <p  class="lead">Unfortunatly the page you are looking for could not be found.</p>
		                       	
		                        
	                        </div>
    	                    
                        </div>
                        
                        
                    </div>
                </div>
            </div><!--/.item-->
            
        </div><!--/.carousel-inner-->
        
    </section><!--/#main-slider-->

    

     <?php //$this->load->view('asaanschool/contactus'); ?>
     <?php $this->load->view('asaanschool/common/footer'); ?>

    

    <!-- jQuery Version 1.11.0 -->

    
    <?php $this->load->view('asaanschool/common/common_include_body'); ?>
    
</body>
</html>