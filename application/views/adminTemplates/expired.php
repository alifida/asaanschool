<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php $this->load->view('common/common_include_head'); ?>
</head>
<body class="skin-blue">

<?php $this->load->view('asaanschool/common/analyticstracking'); ?>
<?php 
	$siteTitle = "";
    if(isset($_SESSION["expiredCampus"]["school"]["school_name"])){
    	$siteTitle = $_SESSION["expiredCampus"]["school"]["school_name"];
	}
?>

		<header class="header">
            <a href="#" class="logo"><?= $siteTitle ?></a>
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
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="user">
                            <a href="<?= site_url("/user/logout")?>" >
                                <i class="glyphicon glyphicon-lock"></i>
                                <span>Login</span>
                            </a>
                            
                        </li>
                    </ul>
                </div>  
                
            </nav>
            <?php if(isset($_SESSION["license"]["status"]) && $_SESSION["license"]["status"] == get_app_message("db.status.expired")){?>
	                <div class="row"  padding:0px;">
			        	<div style=" padding-left:0px !important;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			        		 <div class="bg-orange" style="text-align: center; padding: 8px; font-size: 18px;"><?= $_SESSION["appNotifications"]["licenseExpired"]?></div>
			        	</div>
			        </div>   
                <?php } ?>
        </header>

        <div class="wrapper row-offcanvas row-offcanvas-left">
		

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="">
                <?php echo $body; ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->

<?php $this->load->view('common/common_include_body'); ?>


</body>
</html>















