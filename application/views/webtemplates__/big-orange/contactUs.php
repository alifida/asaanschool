<?php ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title><?= $website["site_title"]?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">

    <link href="<?= base_url() ?>webtemplates/big-orange/scripts/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?= base_url() ?>webtemplates/big-orange/scripts/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Icons -->
    <link href="<?= base_url() ?>webtemplates/big-orange/scripts/icons/general/stylesheets/general_foundicons.css" media="screen" rel="stylesheet" type="text/css" />  
    <link href="<?= base_url() ?>webtemplates/big-orange/scripts/icons/social/stylesheets/social_foundicons.css" media="screen" rel="stylesheet" type="text/css" />
    <!--[if lt IE 8]>
        <link href="<?= base_url() ?>webtemplates/big-orange/scripts/icons/general/stylesheets/general_foundicons_ie7.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>webtemplates/big-orange/scripts/icons/social/stylesheets/social_foundicons_ie7.css" media="screen" rel="stylesheet" type="text/css" />
    <![endif]-->
    <link rel="stylesheet" href="<?= base_url() ?>webtemplates/big-orange/scripts/fontawesome/css/font-awesome.min.css">
    <!--[if IE 7]>
        <link rel="stylesheet" href="scripts/fontawesome/css/font-awesome-ie7.min.css">
    <![endif]-->

    <link href="<?= base_url() ?>webtemplates/big-orange/scripts/carousel/style.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>webtemplates/big-orange/scripts/camera/css/camera.css" rel="stylesheet" type="text/css" />

   

    <link href="<?= base_url() ?>webtemplates/big-orange/styles/custom.css" rel="stylesheet" type="text/css" />
</head>
<body id="pageBody">
<?php $this->load->view('asaanschool/common/analyticstracking'); ?>

<div id="divBoxed" class="container">

    <div class="transparent-bg" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;z-index: -1;zoom: 1;"></div>

    <div class="divbox notop nobottom" style="padding: 0px 40px 0 40px; ">
            <div class="row-fluid">
                <div class="span12">
					<div class="span4">
	                    <div id="divLogo" class="pull-left">
	                        <a href="http://<?= $website["domain"]?>" id="divSiteTitle"><?= $website["site_title"]?></a><br />
	                        <a href="http://<?= $website["domain"]?>" id="divTagLine"><?= (isset($website["tag_line"]) && !empty($website["tag_line"]))? $website["tag_line"] : "" ?></a>
	                    </div>
                    </div>
					<div class="span8">
	                    <div id="divMenuRight" class="pull-right">
		                    <div class="navbar">
		                        <button type="button" class="btn btn-navbar-highlight btn-large btn-primary" data-toggle="collapse" data-target=".nav-collapse">
		                            NAVIGATION <span class="icon-chevron-down icon-white"></span>
		                        </button>
		                        <div class="nav-collapse collapse">
		                            <?php if(isset($topMenu) && !empty($topMenu)){?>
		                            <ul class="nav nav-pills ddmenu">
			                            <?php foreach($topMenu as $menuItem){?>
			                            	<li><a href="http://<?= $website["domain"]."/site/page/". $menuItem["page_url"] ?>.html"><?= $menuItem["menu_title"] ?></a></li>
			                            <?php }?>
		                            </ul>
		                            <?php }?>
		                            
		                      	</div>
		                    </div>
	                    </div>
                    </div>

                </div>
            </div>

            
    </div>

    <div class="contentArea">

        <div class="divbox notop page-content">
            

            <div class="row-fluid">
                <div class="span8" id="divMain">

                    <h1>Contact Us</h1>
                   	<h3 style="color:#FF6633;"><?php echo @$_GET['msg'];?></h3>
					<hr>
			<!--Start Contact form -->		                                                
					<form name="enq" method="post" action="email/" onsubmit="return validation();">
					  <fieldset>
					    
						<input type="text" name="name" id="name" value=""  class="input-block-level" placeholder="Name" />
					    <input type="text" name="email" id="email" value="" class="input-block-level" placeholder="Email" />
					    <textarea rows="11" name="message" id="message" class="input-block-level" placeholder="Comments"></textarea>
					    <div class="actions">
						<input type="submit" value="Send Your Message" name="submit" id="submitButton" class="btn btn-info pull-right" title="Click here to submit your message!" />
						</div>
						
						</fieldset>
					</form>  				 
			<!--End Contact form -->											 
                </div>
				
			<!--Edit Sidebar Content here-->	
                <div class="span4 sidebar">

                    <div class="sidebox">
                        <h3 class="sidebox-title">Contact Information</h3>
                    <p>
                        <address><strong>Your Company, Inc.</strong><br />
                        Address<br />
                        City, State, Zip<br />
                        <abbr title="Phone">P:</abbr> (123) 456-7890</address> 
                        <address>  <strong>Email</strong><br />
                        <a href="mailto:#">first.last@gmail.com</a></address>  
                    </p>     
                     
					 <!-- Start Side Categories -->
        <h4 class="sidebox-title">Sidebar Categories</h4>
        <ul>
          <li><a href="#">Quisque diam lorem sectetuer adipiscing</a></li>
          <li><a href="#">Interdum vitae, adipiscing dapibus ac</a></li>
          <li><a href="#">Scelerisque ipsum auctor vitae, pede</a></li>
          <li><a href="#">Donec eget iaculis lacinia non erat</a></li>
          <li><a href="#">Lacinia dictum elementum velit fermentum</a></li>
          <li><a href="#">Donec in velit vel ipsum auctor pulvinar</a></li>
        </ul>
					<!-- End Side Categories -->
                    					
                    </div>
					
					
                    
                </div>
			<!--/End Sidebar Content-->
				
				
            </div>	

            <div id="footerInnerSeparator"></div>
        </div>
    </div>

    <div id="footerOuterSeparator"></div>

    <div id="divFooter" class="footerArea">

        <div class="divbox">
			<?php if(isset($footer["html"]) && !empty($footer["html"])){?>
				<div class="row-fluid">
					<div class="span12">
						<?= $footer["html"] ?>
					</div>
				</div>
			<?php } ?>
			
			<?php if(isset($footer["widgets"]) && !empty($footer["widgets"])){?>
			<hr/>
				<div class="row-fluid">
				<?php foreach ($footer["widgets"] as $fWidget) {?>
					<div class="span3">
						<?php if(isset($fWidget["title"]) && !empty($fWidget["title"])){?>
							<div class="row-fluid">
								<div class="col-centered">
									
									<h5 class="text-info"><?= $fWidget["title"] ?></h5>
								</div>
							</div>
						<?php }?>
						<?php if(isset($fWidget["thumbnail_path"]) && !empty($fWidget["thumbnail_path"])){?>
								<div class="row-fluid">
									<div class="col-centered">
										<img src="<?= $fWidget["thumbnail_path"]?>" class="img-circle circle_border"/>
									</div>
								</div>
						<?php }?>
						<?php if(isset($fWidget["html"]) && !empty($fWidget["html"])){?>
								<div class="row-fluid">
									<div class="span12 ">
										<?= $fWidget["html"] ?>
									</div>
								</div>
						<?php }?>
					</div>
					<?php } ?>
					
				</div>
				<hr/>
			<?php } ?>
			
			
        </div>
    </div>
</div>
<br /><br /><br />

<script src="<?= base_url() ?>webtemplates/big-orange/scripts/jquery.min.js" type="text/javascript"></script> 
<script src="<?= base_url() ?>webtemplates/big-orange/scripts/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>webtemplates/big-orange/scripts/default.js" type="text/javascript"></script>


<script src="<?= base_url() ?>webtemplates/big-orange/scripts/carousel/jquery.carouFredSel-6.2.0-packed.js" type="text/javascript"></script>
<script src="<?= base_url() ?>webtemplates/big-orange/scripts/camera/scripts/camera.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>webtemplates/big-orange/scripts/easing/jquery.easing.1.3.js" type="text/javascript"></script>
<script type="text/javascript">function startCamera() {$('#camera_wrap').camera({ fx: 'scrollLeft', time: 2000, loader: 'none', playPause: false, navigation: true, height: '35%', pagination: true });}$(function(){startCamera()});</script>





<script src="<?= base_url() ?>webtemplates/big-orange/scripts/wookmark/js/jquery.wookmark.js" type="text/javascript"></script>
<script type="text/javascript">$(window).load(function () {var options = {autoResize: true,container: $('#gridArea'),offset: 10};var handler = $('#tiles li');handler.wookmark(options);$('#tiles li').each(function () { var imgm = 0; if($(this).find('img').length>0)imgm=parseInt($(this).find('img').not('p img').css('margin-bottom')); var newHeight = $(this).find('img').height() + imgm + $(this).find('div').height() + $(this).find('h4').height() + $(this).find('p').not('blockquote p').height() + $(this).find('iframe').height() + $(this).find('blockquote').height() + 5;if($(this).find('iframe').height()) newHeight = newHeight+15;$(this).css('height', newHeight + 'px');});handler.wookmark(options);handler.wookmark(options);});</script>
<script src="<?= base_url() ?>webtemplates/big-orange/scripts/yoxview/yox.js" type="text/javascript"></script>
<script src="<?= base_url() ?>webtemplates/big-orange/scripts/yoxview/jquery.yoxview-2.21.js" type="text/javascript"></script>
<script type="text/javascript">$(document).ready(function () {$('.yoxview').yoxview({autoHideInfo:false,renderInfoPin:false,backgroundColor:'#ffffff',backgroundOpacity:0.8,infoBackColor:'#000000',infoBackOpacity:1});$('.yoxview a img').hover(function(){$(this).animate({opacity:0.7},300)},function(){$(this).animate({opacity:1},300)});});</script>




<?php
 //echo "=============================================================================";
     //pre($topMenu); 
     //pre($webpage); 
   // pre($website); 
     //pre($template); 
   //  pre($footer); 
 //echo "=============================================================================";
unset($_SESSION["domain"]);
unset($_SESSION["pageUrl"]);

?>

</body>
</html>