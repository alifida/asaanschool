<?php ?>

<?php $this->load->view('asaanschool/common/analyticstracking'); ?>
   <!-- Navigation -->
        		<?php 
                	$siteTitle = "";
                	if(isset($_SESSION["currentCampus"]["school"]["school_name"])){
                		$siteTitle = $_SESSION["currentCampus"]["school"]["school_name"];
                	}
                	
                ?>
        
     <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?= site_url("user") ?>" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                
                <?php if(isset($_SESSION["currentCampus"]["campus_logo"]) && !empty($_SESSION["currentCampus"]["campus_logo"])){?>
    	       		<img src='<?= $_SESSION["currentCampus"]["campus_logo"] ?>' alt=''  class='img-circle  ' />
    	       	<?php } else{?>
    	       		<img src='<?= site_url("public/images/school_logo.png") ?>' alt=''  class='img-circle  ' />
    	       	<?php } ?>
                
                <?= $siteTitle ?>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                	
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                         
                        
                        <li class="">
                            <a href="<?= site_url("notification") ?>" class="">
                               <span class="bold"> Noticeboard</span>
                            </a>
                            
                        </li>
                        <li class="">
                            <a href="<?= site_url("email/inbox") ?>" class="">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-success"><?= isset($_SESSION["unreadEmailsCount"])? $_SESSION["unreadEmailsCount"]:"" ?></span>
                            </a>
                            
                        </li>
                       
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?= isset($_SESSION["sessionUser"]["display_name"])? $_SESSION["sessionUser"]["display_name"] :"" ?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                	<?php if(isset($_SESSION["sessionUser"]["profile_picture"])){?>
                                    	<img src="<?= $_SESSION["sessionUser"]["profile_picture"] ?>" class="img-circle" alt="User Image" />
                                    <?php } else{ ?>
                                    	<img src="<?= base_url() ?>public/images/avatar3.png" class="img-circle" alt="User Image" />
                                    <?php } ?>
                                    
                                    
                                    <p>
                                        <?= isset($_SESSION["sessionUser"]["display_name"])? $_SESSION["sessionUser"]["display_name"] :"" ?>
                                        <small><?= isset($_SESSION["sessionUser"]["user_type"]["type"])? $_SESSION["sessionUser"]["user_type"]["type"] :"" ?></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?= site_url('profile') ?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?= site_url('user/logout')?>" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                
                <?php if(isset($_SESSION["currentCampus"]["school"]["status"]) && $_SESSION["currentCampus"]["school"]["status"] == get_app_message("db.status.trail") && isset($_SESSION["trailNotification"])){?>
                
                <div class="row" style="margin-left:-100px; margin-right: 0px; padding:0px;">
		        	<div style=" padding-left:0px !important; padding-right: 0px;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		        		<!-- 
		        		<a  class="btn btn-md  btn-warning  btn-block" href="#"><?= $_SESSION["trailNotification"] ?></a>
		        		 -->
		        		 <div class="bg-yellow" style="text-align: center; padding: 8px; font-size: 15px;"><?= $_SESSION["trailNotification"]?></div>
		        	</div>
		        </div>   
                <?php } ?>
                <?php if(isset($_SESSION["license"]["status"]) && $_SESSION["license"]["status"] == get_app_message("db.status.warning")){?>
	                <div class="row" style="margin-left:-100px; padding:0px;">
			        	<div style=" padding-left:0px !important;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			        		 <div class="bg-red" style="text-align: center; padding: 8px; font-size: 15px;"><?= $_SESSION["appNotifications"]["licenseWarning"]?></div>
			        	</div>
			        </div>   
                <?php } ?>
                
                
                
            </nav>
        </header>
         
        
     
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
