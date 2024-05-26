<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $website["site_title"]?></title>
	
	<!-- core CSS -->
    <link href="<?= base_url() ?>webtemplates/clean/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>webtemplates/clean/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>webtemplates/clean/css/animate.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>webtemplates/clean/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?= base_url() ?>webtemplates/clean/css/main.css" rel="stylesheet">
    <link href="<?= base_url() ?>webtemplates/clean/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= base_url() ?>webtemplates/clean/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= base_url() ?>webtemplates/clean/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url() ?>webtemplates/clean/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?= base_url() ?>webtemplates/clean/images/ico/apple-touch-icon-57-precomposed.png">
    
    
    <style type="text/css">
	    .navbar {
		  background: <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#151515" ?>;
		}
		body {
		  background: <?= (isset($website["background_color"]) && !empty($website["background_color"]))? $website["background_color"]  : "#fff" ?>;
		  color:<?= (isset($website["text_color"]) && !empty($website["text_color"]))? $website["text_color"]  : "#4e4e4e" ?>;
		}
		.dropdown-menu>li>a{
			background: <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#151515" ?>;
		}
		#footer{
			padding: 30px 30px 30px 30px;
			background: <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#151515" ?>;
		}
		#carousel-slider a i{
			top: 46%;
		}
    
    </style>
</head><!--/head-->

<body class="homepage">

    <header id="header">
        

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="http://<?= $website["domain"]?>"  class="navbar-brand"><?= $website["site_title"]?></a>
                    <a href="http://<?= $website["domain"]?>"  class="tag-line"><?= (isset($website["tag_line"]) && !empty($website["tag_line"]))? $website["tag_line"] : "" ?></a>
                    
                </div>
				
                <div class="collapse navbar-collapse navbar-right">
                	<?php if(isset($topMenu) && !empty($topMenu)){?>
                            <ul class="nav navbar-nav">
	                            <?php foreach($topMenu as $menuItem){?>
	                            
                            	<li class="<?= $menuItem["target_url"] == $webpage["page_url"] ? "active": ""?> <?= (isset($menuItem["children"])&& !empty($menuItem["children"])) ? "dropdown": ""?>" >
                            		<a class="<?= (isset($menuItem["children"])&& !empty($menuItem["children"])) ? "dropdown-toggle": ""?>" href="http://<?= $website["domain"]."/site/page/". $menuItem["target_url"] ?>.html">
                            			<?= $menuItem["title"] ?>
                            			<?php if(isset($menuItem["children"])&& !empty($menuItem["children"])){?>
                            				<i class="fa fa-angle-down"></i>
                            			<?php } ?>
                            		</a>
                            		<?php printChildElements($menuItem, $website);?>
                            		</li>
                            <?php }?>
                            </ul>
                    <?php }?>
                </div>
                
              
			
			
			
			
			
            </div><!--/.container-->
        </nav><!--/nav-->
		
    </header><!--/header-->
			<?php 
					$bannerImages = array();
					if(isset($webpage["banner_images"]) && !empty($webpage["banner_images"])){
						$bannerImages = json_decode($webpage["banner_images"]);
						foreach($bannerImages as $key => $bi){
							if(empty($bi)){
								unset($bannerImages[$key]);	
							}
						}
					}
				?>
<?php if(!empty($bannerImages)){?>
 <section id="about-us">
        <div class="container">
			<!-- about us slider -->
			<div id="about-slider">
				<div id="carousel-slider" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
				  	<ol class="carousel-indicators visible-xs">
				  		<?php foreach($bannerImages as $key=>$image){?>
						  <li data-target="#carousel-slider" data-slide-to="<?= $key ?>" class="<?= $key==0?"active":"" ?>"></li>
					   <?php } ?>
				  	</ol>

					<div class="carousel-inner">
						<?php foreach($bannerImages as $key=>$image){?>
						  <div class="item <?= $key==0?"active":"" ?>">
								<img src="<?= $image ?>" class="img-responsive" alt=""> 
						   </div>
					   <?php } ?>
					</div>
					
					<a class="left carousel-control hidden-xs" href="#carousel-slider" data-slide="prev">
						<i class="fa fa-angle-left"></i> 
					</a>
					
					<a class=" right carousel-control hidden-xs"href="#carousel-slider" data-slide="next">
						<i class="fa fa-angle-right"></i> 
					</a>
				</div> <!--/#carousel-slider-->
			</div><!--/#about-slider-->
		</div><!--/.container-->
    </section><!--/about-us-->
<?php } ?>




<!-- 

    <section id="main-slider" class="no-margin">
    		
        <div class="carousel slide">
            <ol class="carousel-indicators">
                <li data-target="#main-slider" data-slide-to="0" class="active"></li>
                <li data-target="#main-slider" data-slide-to="1"></li>
                <li data-target="#main-slider" data-slide-to="2"></li>
            </ol>
            <?php if(!empty($bannerImages)){?>
	                <div class="carousel-inner">
	                    <div id="camera_wrap">
			            	<?php foreach($bannerImages as $key=>$image){?>
	            				
	            				<div class="item active" style="">
	            					<div class="container">
				                        <div class="row slide-margin">
				                            <!-- 
				                            <div class="col-sm-6">
				                                <div class="carousel-content">
				                                    <h1 class="animation animated-item-1">Lorem ipsum dolor sit amet consectetur adipisicing elit</h1>
				                                    <h2 class="animation animated-item-2">Accusantium doloremque laudantium totam rem aperiam, eaque ipsa...</h2>
				                                    <a class="btn-slide animation animated-item-3" href="#">Read More</a>
				                                </div>
				                            </div>
				                             -- >
				
				                            <div class="col-sm-12 hidden-xs animation animated-item-4">
				                                <div class="slider-img">
				                                    <img src="<?= $image ?>" class="img-responsive">
				                                </div>
				                            </div>
				
				                        </div>
				                    </div>
	            				</div>
							<?php } ?>
	                    </div>
	                    <br style="clear:both"/><div style="margin-bottom:10px"></div>
	                </div>               
				<?php } ?>
        </div>
        <a class="prev hidden-xs" href="#main-slider" data-slide="prev">
            <i class="fa fa-chevron-left"></i>
        </a>
        <a class="next hidden-xs" href="#main-slider" data-slide="next">
            <i class="fa fa-chevron-right"></i>
        </a>
    </section>
 -->
    <br/>


			

    <section id="recent-works">
    	
    			<?php if(isset($serverMessage)){?>
	    			<div class="row">
	    				<div class="col-lg-12">
	            			<div id="serverMessageContainer"><br/><h4 style="color:#FF6633; margin-left: 30px;"><?= $serverMessage ?></h4><br/></div>
	            		</div>
	    			</div>
            	<?php } ?>
    		
        <div class="container">
            <div class="justify wow fadeInDown">
                <h2><?= $webpage["page_title"] ?></h2>
                <p class="lead justify"><?= $webpage["html"] ?></p>
            </div>
<?php 
if(isset($website["campus"]["contactDetails"]) && !empty($website["campus"]["contactDetails"])){
	$contactInfo = $website["campus"]["contactDetails"];
}
?>


<?php if($webpage["pageType"]["id"]== 4){?>
		<div class="container">
            <div class="center">        
                <h2>Drop Your Message</h2>
            </div> 
            <div class="row contact-wrap"> 
                <div class="status alert alert-success" style="display: none"></div>
                <form id="main-contact-form" class="contact-form" name="contact-form" method="post" action="sendemail.php">
                    <div class="col-sm-5 col-sm-offset-1">
                        
                        <div class="form-group">
                            <label>Address</label>
                            <address><?= isset($website["campus"]["campus_name"])?$website["campus"]["campus_name"]:"" ?></address>
	                        <p><?= isset($contactInfo["address"])?$contactInfo["address"]."<br>":"" ?>
	                        <?= isset($contactInfo["city"])?$contactInfo["city"]."<br>":"" ?>
	                        <?= isset($contactInfo["state"])?$contactInfo["state"]."<br>":"" ?>
	                        <?= isset($contactInfo["zip"])?$contactInfo["zip"]."<br>":"" ?>
	                        </p>
	                        <p>
	                        <?php if(isset($contactInfo["primary_phone"]) && !empty($contactInfo["primary_phone"])){?>
	                        	Primary Phone: <?=  $contactInfo["primary_phone"] ?><br/>
	                        <? } ?>
	                        <?php if(isset($contactInfo["primary_phone"]) && !empty($contactInfo["primary_phone"])){?>
	                        	Secondary Phone: <?=  $contactInfo["secondary_phone"] ?><br/>
	                        <? } ?>
	                        <?php if(isset($contactInfo["fax"]) && !empty($contactInfo["fax"])){?>
	                        	Fax: <?=  $contactInfo["fax"] ?><br/>
	                        <? } ?>
	                         <?php if(isset($contactInfo["primary_email"]) && !empty($contactInfo["primary_email"])){?>
	                        	  Primary Email: <a href="mailto:#"><?= $contactInfo["primary_email"] ?></a>
	                        	
	                        <?php }?>  
	                        <?php if(isset($contactInfo["secondary_email"]) && !empty($contactInfo["secondary_email"])){?>
	                        	Secondary Email: <a href="mailto:#"><?= $contactInfo["secondary_email"] ?></a>
	                        <?php }?> 
	                        </p> 
                        </div>
                                            
                    </div>
                    <div class="col-sm-5">
                       <!-- 
                        <div class="form-group">
                            <label>Subject *</label>
                            <input type="text" name="subject" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Message *</label>
                            <textarea name="message" id="message" required="required" class="form-control" rows="8"></textarea>
                        </div>                        
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">Submit Message</button>
                        </div>
                        -->
                        
						
							<?= getContactUsDefaultHTML($contactInfo["primary_email"], $template["id"]); ?>
						
					
                    </div>
                </form> 
            </div><!--/.row-->
        </div>
        <?php } ?>
<br/>


			<?php if(isset($webpage["widgets"]) && !empty($webpage["widgets"])){ ?>
				<div class="row">
					<?php foreach($webpage["widgets"] as $widget){?>
						<div class="col-md-4 wow center fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;">
							<img class="img-circle" src="<?= $widget["thumbnail_path"]?>" alt="<?= $widget["title"]?>" title="<?= $widget["title"]?>"/>
	                            <div class="recent-work-inner">
	                                <h3><?= $widget["title"]?></h3>
	                                <p class="justify"><?= $widget["html"]?></p>
	                            </div> 
	                    </div>        
				<?php } ?>
				</div>
			<?php } ?>
					

            
        </div><!--/.container-->
    </section><!--/#recent-works-->
 
<?php if(isset($footer["html"]) && !empty($footer["html"])){?>
    <footer id="footer" class="midnight-blue justify">
        		<?= $footer["html"] ?>
					 <?php if(isset($footer["widgets"]) && !empty($footer["widgets"])){?>
						<div class="row">
							<?php foreach($footer["widgets"] as $footerWidget){?>
								<div class="col-md-4 center wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;">
									<img class="img-circle" src="<?= $footerWidget["thumbnail_path"]?>" alt="<?= $footerWidget["title"]?>" title="<?= $footerWidget["title"]?>"/>
			                            <div class="recent-work-inner">
			                                <h3><?= $footerWidget["title"]?></h3>
			                                <p class="justify"><?= $footerWidget["html"]?></p>
			                            </div> 
			                    </div>        
						<?php } ?>
						</div>
					<?php } ?>
        	
    </footer><!--/#footer-->
<?php } ?>
    <script src="<?= base_url() ?>webtemplates/clean/js/jquery.js"></script>
    <script src="<?= base_url() ?>webtemplates/clean/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>webtemplates/clean/js/jquery.prettyPhoto.js"></script>
    <script src="<?= base_url() ?>webtemplates/clean/js/jquery.isotope.min.js"></script>
    <script src="<?= base_url() ?>webtemplates/clean/js/main.js"></script>
    <script src="<?= base_url() ?>webtemplates/clean/js/wow.min.js"></script>
    
    
    
    
    
    
    
    <?php  function printChildElements($menuItem, $website, $isSubMenu=false){
	if( isset($menuItem["children"]) && !empty($menuItem["children"])){?>
		<ul class="dropdown-menu <?= $isSubMenu ? " sub-menu ":"" ?>">
			<?php foreach ($menuItem["children"] as $subMenuItem){?>
					<li class="<?= (isset($subMenuItem["children"])&& !empty($subMenuItem["children"])) ? "dropdown": ""?>" >
	                	<a class="<?= (isset($subMenuItem["children"])&& !empty($subMenuItem["children"])) ? "dropdown-toggle": ""?>" href="http://<?= $website["domain"]."/site/page/". $subMenuItem["target_url"] ?>.html">
	        			<?= $subMenuItem["title"] ?>        	
						<?php if(isset($subMenuItem["children"])&& !empty($subMenuItem["children"])){?>
							&nbsp;
						<?php } ?>
						</a>
						<?php printChildElements($subMenuItem, $website, true); ?>
	              	</li>
			<?php }?>
		</ul>
	<?php }
}?>
    
</body>
</html>