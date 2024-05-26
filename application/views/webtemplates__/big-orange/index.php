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
<link href="<?= base_url() ?>webtemplates/big-orange/scripts/yoxview/yoxview.css" rel="stylesheet" type="text/css" />
   
    <link href="<?= base_url() ?>webtemplates/big-orange/styles/custom.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
    	

	.box i{
		color: <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>;
	}
	#pageBody{
		color: <?= (isset($website["text_color"]) && !empty($website["text_color"]))? $website["text_color"]  : "#333333" ?>;
		background-color:#F1F1F1 ;
	}
	.thumbnail .caption {
		color: <?= (isset($website["text_color"]) && !empty($website["text_color"]))? $website["text_color"]  : "#333333" ?> !important;
	
	}
	#divSiteTitle{
		color: <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>; 
	}
	.page-content a {
		color: <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>; 
	}
  	.sidebox a {
  		color: <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>; 
  	}
  	#divFooter a {
  		color: <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>;
  	}
  	.transparent-bg{
  		background-color: <?= (isset($website["background_color"]) && !empty($website["background_color"]))? $website["background_color"]  : "#fff" ?>;
  	}
  	.breadcrumbs a {
  		color: <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>; font-family: 'Open Sans', sans-serif;
  	}
  	#divHeaderLine1 { 
  		color: <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>;  
  	}
  	.btn-primary {
  		background-color:<?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>;
  	}  
  	.navbar .dropdown-menu li > a:hover, .navbar .dropdown-menu .active > a, .navbar .dropdown-menu .active > a:hover, .dropdown-menu li > a:hover, .dropdown-menu .active > a, .dropdown-menu .active > a:hover, .dropdown-menu li > a:focus, .dropdown-submenu:hover > a, .navbar .nav-pills .open a.dropdown-toggle:hover {
		background-color:<?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>;
	}
	.navbar .nav-pills > li > a:hover, .navbar .nav li.dropdown.open.active > .dropdown-toggle {
		background-color:<?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>
	}	
	.navbar .nav-pills > .active > a, .navbar .nav-pills > .active > a:hover, .navbar .nav-pills li.dropdown.open > .dropdown-toggle, .navbar .nav-pills li.dropdown.active > .dropdown-toggle{ 
		background-color:<?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>;
	}
	.btn-primary {
		background-color:<?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>;
	}
	.btn-primary {background-image:-webkit-gradient(linear, left top, left bottom, from(<?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>), to(#ca5603));background-image:-webkit-linear-gradient(top, <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>, #ca5603);background-image:-moz-linear-gradient(top, <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>, #ca5603);background-image:-ms-linear-gradient(top, <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>, #ca5603);background-image:-o-linear-gradient(top, <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>, #ca5603);background-image:linear-gradient(top, <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>, #ca5603);}
   </style>
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
			                            	<li class="<?= $menuItem["target_url"] == $webpage["page_url"] ? "active": ""?> <?= (isset($menuItem["children"])&& !empty($menuItem["children"])) ? "dropdown": ""?>" >
			                            		<a class="<?= (isset($menuItem["children"])&& !empty($menuItem["children"])) ? "dropdown-toggle": ""?>" href="http://<?= $website["domain"]."/site/page/". $menuItem["target_url"] ?>.html">
			                            			<?= $menuItem["title"] ?>
			                            			<?php if(isset($menuItem["children"])&& !empty($menuItem["children"])){?>
			                            				<b class="caret"></b>
			                            			<?php } ?>
			                            		</a>
			                            		<?php printChildElements($menuItem, $website);?>
			                            		</li>
			                            <?php }?>
		                            </ul>
		                            <?php }?>
		                            
		                      	</div>
		                    </div>
	                    </div>
                    </div>

                </div>
            </div>

            <div class="row-fluid">
            <div class="span12">
                <div id="headerSeparator"></div>
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
	                <div class="camera_full_width">
	                    <div id="camera_wrap">
			            	<?php foreach($bannerImages as $image){?>
	            				<div data-src="<?= $image ?>" >
	            					<!--
	            					banner text 
	            					<div class="camera_caption fadeFromBottom cap1"></div>
	            					 -->
	            				</div>
							<?php } ?>
	                    </div>
	                    <br style="clear:both"/><div style="margin-bottom:10px"></div>
	                </div>               
				<?php } ?>
                <div id="headerSeparator2"></div>

            </div>
        </div>
    </div>

    <div class="contentArea">

        <div class="divbox notop page-content">
        	<?php if(isset($serverMessage)){?>
            <div id="serverMessageContainer"><br/><h4 style="color:#FF6633; margin-left: 30px;"><?= $serverMessage ?></h4><br/></div>
            <?php } ?>
<?php 
$rightSideExist=false;
$contactInfo = array();
if($webpage["pageType"]["id"]== 4){
	$rightSideExist= true;
}
if(isset($website["campus"]["contactDetails"]) && !empty($website["campus"]["contactDetails"])){
	$contactInfo = $website["campus"]["contactDetails"];
}


?>

            <div class="row-fluid">
            <!--Edit Main Content Area here-->
                <div class="<?= ($rightSideExist==true)?"span8":"span12"?>" id="divMain">
                    <h3><?= $webpage["page_title"] ?></h3>
                    				
					<p><?= $webpage["html"] ?></p>

                    <br />                   
                    <br />                 
					
					
					
                    
                    
                    <?php if(isset($webpage["widgets"]) && !empty($webpage["widgets"])){ ?>
		                    <div class="yoxview">
		                    	<div class="row-fluid">
						            <ul class="thumbnails">
	                    <?php foreach($webpage["widgets"] as $widget){?>
						              <li class="span3">
						                <div class="thumbnail">
						                  <a href="<?= $widget["thumbnail_path"]?>"><img src="<?= $widget["thumbnail_path"]?>" alt="<?= $widget["title"]?>" title="<?= $widget["title"]?>" /></a>
						                  <div class="caption">
						                    <h5><?= $widget["title"]?></h5>
						                    <p><?= $widget["html"]?></p>
						                  	<!-- 
						                   	<p><a href="#" class="btn btn-primary">Read More...</a></p>
						                   -->  
						                  </div>
						                </div>
						              </li>
	                    <?php } ?>
		                    		</ul>
		                    	</div>
		                    </div>	
                    <?php } ?>
						

					<?php if($webpage["pageType"]["id"]== 4){?>
						<br/>
							<?= getContactUsDefaultHTML($contactInfo["primary_email"], $template["id"]); ?>
						<br/>
					<?php }?>




                </div>
                
                <?php if($rightSideExist==true){?>
                	<div class="span4 sidebar">

                    <div class="sidebox">
                        <h3 class="sidebox-title">Contact Information</h3>
                    <p>
                        </p>
                        <address>
	                        <strong>
	                        	<?= isset($website["campus"]["campus_name"])?$website["campus"]["campus_name"]:"" ?>
	                        </strong>
                        	<br>
                        <?= isset($contactInfo["address"])?$contactInfo["address"]."<br>":"" ?>
                        <?= isset($contactInfo["city"])?$contactInfo["city"]."<br>":"" ?>
                        <?= isset($contactInfo["state"])?$contactInfo["state"]."<br>":"" ?>
                        <?= isset($contactInfo["zip"])?$contactInfo["zip"]."<br>":"" ?>
                        <?php if(isset($contactInfo["primary_phone"]) && !empty($contactInfo["primary_phone"])){?>
                        	Primary Phone: <?=  $contactInfo["primary_phone"] ?><br/>
                        <? } ?>
                        <?php if(isset($contactInfo["primary_phone"]) && !empty($contactInfo["primary_phone"])){?>
                        	Secondary Phone: <?=  $contactInfo["secondary_phone"] ?><br/>
                        <? } ?>
                        <?php if(isset($contactInfo["fax"]) && !empty($contactInfo["fax"])){?>
                        	Fax: <?=  $contactInfo["fax"] ?><br/>
                        <? } ?>
                        
                        </address> 
                        <?php if(isset($contactInfo["primary_email"]) && !empty($contactInfo["primary_email"])){?>
                        	<address>  <strong>Primary Email</strong><br>
                        		<a href="mailto:#"><?= $contactInfo["primary_email"] ?></a>
                        	</address>
                        <?php }?>  
                        <?php if(isset($contactInfo["secondary_email"]) && !empty($contactInfo["secondary_email"])){?>
                        	<address>  <strong>Secondary Email</strong><br>
                        		<a href="mailto:#"><?= $contactInfo["secondary_email"] ?></a>
                        	</address>
                        <?php }?>  
                    <p></p>     
                     
                    </div>
                </div>
                <? } ?>
                
                
                
            <!--End Main Content-->
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





<?php
 //echo "=============================================================================";
     //pre($topMenu); 
   //  pre($webpage); 
   // pre($website); 
     //pre($template); 
   //  pre($footer); 
 // echo "=============================================================================";
unset($_SESSION["domain"]);
unset($_SESSION["pageUrl"]);

?>

</body>
</html>
