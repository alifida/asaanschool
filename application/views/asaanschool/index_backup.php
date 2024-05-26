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

    <section id="main-slider" class="carousel">
        <div class="carousel-inner">

            <div class="item active">
                <div class="container">
                    <div class="carousel-content">
                        <div class="row">
                        	<div class="col-lg-7 col-md-6 col-sm-12 col-xs-12 ">
    	                    	<div class="monitor_frame">
	    	                    	<img src="<?= base_url() ?>public/images/banner/banner_4.png" alt="" >
    	                    	</div>
	                        </div>
    	                    <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 ">
                        		<h1>Online School Management System</h1>
		                        <p class="lead">Most Secure, Reliable, User friendly.</p>
	                        </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div><!--/.item-->
            <div class="item">
                <div class="container">
                    <div class="row">
    	                    <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 ">
                        		<h1>Online School Management System</h1>
		                        <p class="lead">Most Secure, Reliable, User friendly.</p>
	                        </div>
    	                    <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12 ">
    	                    	<div class="monitor_frame">
	    	                    	<img src="<?= base_url() ?>public/images/banner/banner_1.png" alt="" >
    	                    	</div>
	                        </div>
                        </div>
                </div>
            </div><!--/.item-->
            <div class="item">
                <div class="container">
                    <div class="carousel-content">
                        <div class="row">
    	                    
    	                    <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12 ">
    	                    	<div class="monitor_frame">
	    	                    	<img src="<?= base_url() ?>public/images/banner/banner_3.png" alt="" >
    	                    	</div>
	                        </div>
	                        <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 ">
                        		<h1>Online School Management System</h1>
		                        <p class="lead">Most Secure, Reliable, User friendly.</p>
	                        </div>
                        </div>
                    </div>
                </div>
            </div><!--/.item-->

        </div><!--/.carousel-inner-->
        <a class="prev" href="#main-slider" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" ></span></a>
        <a class="next" href="#main-slider" data-slide="next"><span class="glyphicon glyphicon-chevron-right" ></span></a>
    </section><!--/#main-slider-->

    <section id="services">
        <div class="container">
            <div class="box first">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="center">
                            <i class="icon-user icon-md icon-color1"></i>
                            <h4>Student management</h4>
                            <p>A complete student management System. Personal Details, Academic Details, Guardian information, Dues and Payments.</p>
                        </div>
                    </div><!--/.col-md-4-->
                    <div class="col-md-4 col-sm-6">
                        <div class="center">
                            <i class="icon-book icon-md icon-color2"></i>
                            <h4>Stationary & Uniform</h4>
                            <p>A generic system that can maintain the record of Inventory issued to students, such as Stationary or Uniforms.</p>
                        </div>
                    </div><!--/.col-md-4-->
                    <div class="col-md-4 col-sm-6">
                        <div class="center">
                             <i class="icon-star icon-md icon-color3"></i>
                            <h4>Employee management</h4>
                            <p>Employees management system. Employees personal details, academic details, Complete log of Current and Old employees Salaries</p>
                        </div>
                    </div><!--/.col-md-4-->
                    <div class="col-md-4 col-sm-6">
                        <div class="center">
                            <i class=" icon-md icon-color4">$</i>
                            <h4>Fee management</h4>
                            <p>Complete Fee details of every Student. Custom types of Fee can be created per class, Complete log of Fee with details.</p>
                        </div>
                    </div><!--/.col-md-4-->
                    <div class="col-md-4 col-sm-6">
                        <div class="center">
                            <i class="icon-plus-sign icon-md icon-color5"></i>
                            <h4>Profit</h4>
                            <p>Calculates the profit from the whole money transactions related to Student dues clearnce, School expenses.</p>
                        </div>
                    </div><!--/.col-md-4-->
                    <div class="col-md-4 col-sm-5">
                        <div class="center">
                            <i class="icon-fire icon-md icon-color6"></i>
                            <h4>Expenses</h4>
                            <p>Custom Type of expenses can be created. Complete log of expenses like, Building rent, employees salaries, Study trip etc.</p>
                        </div>
                    </div><!--/.col-md-4-->
                    
                    
                    
                    <div class="col-md-4 col-sm-6">
                        <div class="center">
                            <i class="fa fa-fw fa-clock-o icon-md icon-color1"></i>
                            <h4>Attendance Register</h4>
                            <p>Daily Attendance Register where any authorized user can take attendance and can go through the old attendance simply by selecting the Date.</p>
                        </div>
                    </div><!--/.col-md-4-->
                    <div class="col-md-4 col-sm-6">
                        <div class="center">
                            <i class="fa fa-fw fa-users icon-md icon-color2"></i>
                            
                            <h4>User Management</h4>
                            <p>A complete User Management System, where new user can be created by Admin or any other authorized person, with rights over the campus selected modules.</p>
                        </div>
                    </div><!--/.col-md-4-->
                    <div class="col-md-4 col-sm-6">
                        <div class="center">
                             <i class="icon-globe icon-md icon-color3"></i>
                            <h4>Free Website</h4>
                            <p>The most attractive feature, without any extra charges, totally free with maintenance & support. Responsive template and user friendly interface.</p>
                        </div>
                    </div><!--/.col-md-4-->
                    
                    
                </div><!--/.row-->
            </div><!--/.box-->
        </div><!--/.container-->
    </section><!--/#services-->

    
<!-- 
    

    <section id="about-us">
        <div class="container">
            <div class="box">
                <div class="center">
                    <h2>Meet the Team</h2>
                    <p class="lead">Pellentesque habitant morbi tristique senectus et netus et<br>malesuada fames ac turpis egestas.</p>
                </div>
                <div class="gap"></div>
                <div id="team-scroller" class="carousel scale">
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="<?= base_url() ?>public/images/team1.jpg" alt="" ></p>
                                        <h3>Agnes Smith<small class="designation">CEO &amp; Founder</small></h3>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="<?= base_url() ?>public/images/team2.jpg" alt="" ></p>
                                        <h3>Donald Ford<small class="designation">Senior Vice President</small></h3>
                                    </div>
                                </div>        
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="<?= base_url() ?>public/images/team3.jpg" alt="" ></p>
                                        <h3>Karen Richardson<small class="designation">Assitant Vice President</small></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="<?= base_url() ?>public/images/team3.jpg" alt="" ></p>
                                        <h3>David Robbins<small class="designation">Co-Founder</small></h3>
                                    </div>
                                </div>   
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="<?= base_url() ?>public/images/team1.jpg" alt="" ></p>
                                        <h3>Philip Mejia<small class="designation">Marketing Manager</small></h3>
                                    </div>
                                </div>     
                                <div class="col-sm-4">
                                    <div class="member">
                                        <p><img class="img-responsive img-thumbnail img-circle" src="<?= base_url() ?>public/images/team2.jpg" alt="" ></p>
                                        <h3>Charles Erickson<small class="designation">Support Manager</small></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="left-arrow" href="#team-scroller" data-slide="prev">
                        <i class="icon-angle-left icon-4x"></i>
                    </a>
                    <a class="right-arrow" href="#team-scroller" data-slide="next">
                        <i class="icon-angle-right icon-4x"></i>
                    </a>
                </div><!--/.carousel-- >
            </div><!--/.box-- >
        </div><!--/.container
    </section><!--/#about-us

-->
     <?php $this->load->view('asaanschool/contactus'); ?>
     <?php $this->load->view('asaanschool/common/footer'); ?>

    

    <!-- jQuery Version 1.11.0 -->

    
    <?php $this->load->view('asaanschool/common/common_include_body'); ?>
	    <script>
	    $(document).ready(function(){
		    $.ajax({
				url : 'http://ipinfo.io',
				type : "get",
				dataType: 'jsonp',
				success : function(result) {
					 document.cookie = "SL_COUNTRY="+result.country;
				}
			});
		});
	    </script>
</body>
</html>