<?php ?>
<?php $this->load->view('asaanschool/common/analyticstracking'); ?>
<header id="header" role="banner">
        <div class="container">
            <div id="navbar" class="navbar navbar-default row">
            	<div class="col-lg-2 col-sm-2">
            		<div class="navbar-header">
                    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        	<span class="sr-only">Toggle navigation</span>
                        	<span class="icon-bar"></span>
                        	<span class="icon-bar"></span>
                        	<span class="icon-bar"></span>
                    	</button>
                    	<a class="navbar-brand" href="<?= site_url("welcome"); ?>"></a>
                	</div>
            	</div>
            	<div class="col-lg-10 col-sm-10">
            		<div class="collapse navbar-collapse">
            			<div class="row">
            				<div class="col-lg-9 col-md-8 col-sm-8 col-xs-8">
	            				<ul class="nav navbar-nav">
			                        <li class="active"><a href="<?= site_url("welcome"); ?>"><span class="glyphicon glyphicon-home" ></span></a></li>
			                        <li><a href="<?= site_url("welcome/protfolio"); ?>">Portfolio</a></li>
			                         <li class="dropdown">
					                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Services <b class="caret"></b></a>
					                    <ul class="dropdown-menu">
					                        <li><a href="#">Custom Application Development</a></li>
					                        <li><a href="#">Design UI & UX</a></li>
					                        <li><a href="#">Application Support and Maintenance</a></li>
					                        <li><a href="#">Test Automation</a></li>
					                         
					                    </ul>
					                </li>
			                        <li><a href="<?= site_url("welcome/about"); ?>">About Us</a></li>
			                    </ul>
            				</div>
            				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
		            			<div class=" pull-right">
				                    <a class="btn btn-danger" href="<?= base_url("/user/login")?>" style="margin-top: 5px;">Login</a>
				                    <a class="btn btn-danger" href="<?= base_url("/user/signup")?>" style="margin-top: 5px;">Sign up</a>
			                	</div>
            				</div>
            			</div>
	                </div>
            	</div>
            	
                
                
                
                
            </div>
        </div>
    </header><!--/#header-->