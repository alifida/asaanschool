<?php ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title><?= $website["site_title"]?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">

    <link href="<?= base_url() ?>webtemplates/template1/scripts/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?= base_url() ?>webtemplates/template1/scripts/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Icons -->
    <link href="<?= base_url() ?>webtemplates/template1/scripts/icons/general/stylesheets/general_foundicons.css" media="screen" rel="stylesheet" type="text/css" />  
    <link href="<?= base_url() ?>webtemplates/template1/scripts/icons/social/stylesheets/social_foundicons.css" media="screen" rel="stylesheet" type="text/css" />
    <!--[if lt IE 8]>
        <link href="<?= base_url() ?>webtemplates/template1/scripts/icons/general/stylesheets/general_foundicons_ie7.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>webtemplates/template1/scripts/icons/social/stylesheets/social_foundicons_ie7.css" media="screen" rel="stylesheet" type="text/css" />
    <![endif]-->
    <link rel="stylesheet" href="<?= base_url() ?>webtemplates/template1/scripts/fontawesome/css/font-awesome.min.css">
    <!--[if IE 7]>
        <link rel="stylesheet" href="scripts/fontawesome/css/font-awesome-ie7.min.css">
    <![endif]-->

    <link href="<?= base_url() ?>webtemplates/template1/scripts/carousel/style.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>webtemplates/template1/scripts/camera/css/camera.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>webtemplates/template1/scripts/yoxview/yoxview.css" rel="stylesheet" type="text/css" />
   
<!--
    <link href="< ?= base_url() ?>webtemplates/template1/styles/custom.css" rel="stylesheet" type="text/css" />
    -->
    <style type="text/css">
    	/***** BASE CSS *****/


/* Site Name */

#divSiteTitle {text-decoration:none;}

#divTagLine {text-decoration:none;}


/* Headline Text */

#divHeaderLine1 {display:inline-block !important}

#divHeaderLine2 {display:inline-block !important}

#divHeaderLine3 {display:inline-block !important}


/* Headings */

h3, h4, h5, h6 {line-height:1.5 !important}

.lead {
    text-align:center;
}

.lead h2 {
    font-size:33px;line-height:45px;
}

.lead h3 {
    font-size:17px;
}

.lead h3 a {
    font-size:inherit !important;
}


/* Contact */

ul#contact-info .icon {font-size:20px;float:left;line-height:25px;margin-right:10px;}

ul#contact-info .field {font-weight:bold;}

ul#contact-info {list-style:none;}


/* Grid */

#tiles li {
width:240px !important;
background-color: #ffffff;
border: 1px solid #dedede;
-moz-border-radius: 2px;
-webkit-border-radius: 2px;
border-radius: 2px;
padding: 10px !important;
margin-right:7px;margin-bottom:7px;float:left;
}

#tiles li img {margin-bottom:10px;}

#tiles li div.meta {color:#999;text-transform:uppercase;font-size:10px;margin:0;}

#tiles li h4 {line-height:1.5;margin:0 0 5px 0;}

#tiles li h4 a {line-height:inherit;margin:0;text-decoration:inherit;color:inherit;font-size:inherit;font-family:inherit;font-weight:inherit;font-style:inherit;}

#tiles li p {font-size:12px;line-height:1.5;margin:0;}

#tiles li a {font-size:12px;}

#tiles li .more_link {font-size:smaller;line-height:2;text-transform:uppercase;letter-spacing:2px;white-space:nowrap;display:block;margin: 5px 0 0 0;}

#tiles li blockquote {line-height:1.5;margin:0;padding:0;color:#999;border:none;font-size:150%;font-style:italic;font-family:Georgia, Times, serif;}

#tiles li blockquote small {font-size:11px;font-style:normal;}


/* Icons */

[class*="social foundicon-"]:before {font-family: "SocialFoundicons";}

[class*="general foundicon-"]:before {font-family: "GeneralFoundicons";}

        
/* Menu Side */

.menu_menu_simple ul {margin-top:0px;margin-bottom:0px;}

.menu_menu_simple ul li {margin-top:0px;margin-bottom:0px;}


/* Header Area */

#decorative1 {
margin-top:-2px;padding-top:2px;    
margin-left: -20px !important;
margin-right: -20px !important; /* fix bg cover issue */
}


/* Menu Centered */

.centered_menu {text-align:center}

.centered_menu > div {display:inline-block;}

.centered_menu div {text-align:left}


/* Footer elements */

.social_bookmarks a {font-size:smaller !important;text-transform:uppercase;letter-spacing:1px;text-decoration:none;margin-right:20px;}

.copyright {font-size:smaller;letter-spacing:1px;}


/* Responsive Image */

img {max-width:100%;height:auto;width:100%;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;}

/* Responsive Video from Zurb Foundation. Copyright (c) 2011 ZURB, http://www.zurb.com/ License: MIT */

.flex-video {position:relative;padding-top:25px;padding-bottom:67.5%;height:0;margin-bottom:16px;overflow: hidden;}

.flex-video.widescreen {padding-bottom:57.25%;}

.flex-video.vimeo {padding-top:0;}

.flex-video iframe, .flex-video object, .flex-video embed {position:absolute;top:0;left:0;width:100%;height:100%;border:none;}

@media only screen and (max-device-width: 800px), only screen and (device-width: 1024px) and (device-height: 600px), only screen and (width: 1280px) and (orientation: landscape), only screen and (device-width: 800px), only screen and (max-width: 767px) {
        .flex-video { padding-top: 0; }

    }

    
/* Additional */
    
#divBoxed {position:relative}
 
.nav-links > a {margin-right:20px;}

.btn-secondary, .btn-secondary:hover {text-shadow:none;}

#divHeaderLine1 a, #divHeaderLine2 a, #divHeaderLine3 a {
    font-size: inherit;
    line-height: inherit;
    letter-spacing: inherit;
    font-family: inherit;
    text-shadow: inherit;
    font-weight: inherit;
    font-style: inherit;
}

#divHeaderLine1, #divHeaderLine2, #divHeaderLine3 {
    padding-top:3px !important;
    padding-bottom:3px !important;
    text-align:inherit !important;
}

#decorative2 {/*opacity:0.95;*/

    -webkit-box-shadow: 0 1px 10px rgba(0, 0, 0, 0.03);
    -moz-box-shadow: 0 1px 10px rgba(0, 0, 0, 0.03);
    box-shadow: 0 1px 10px rgba(0, 0, 0, 0.03);
}

.showcase-tabs > li > a {
    font-size: 14px;
    letter-spacing: 1px;
    padding-left: 20px;
    padding-right: 20px;
}

.cap1 div, .cap2 div, .cap3 div, .cap4 div, .cap5 div {
    margin: 0 -1px;
}

.camera_wrap .camera_pag .camera_pag_ul li {margin:20px 5px 0px !important;
}

.box{
	text-align: center;
	margin-bottom: 30px;
}

.box i{
	font-size: 50px;
	color: <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>;
}

img.pull-left { margin-right:15px !important; margin-top:7px !important;}


/* Adjustments */

.search.adjust {margin-bottom:15px}
      
.divPanel {padding: 40px;}

.divPanel.notop {padding-top:0px}

.divPanel.nobottom {padding-bottom:0px}


/***** BOOTSTRAP CSS BASE OVERRIDE *****/

.navbar .nav-pills > li > a {text-shadow:none;font-weight:normal;}

.navbar .dropdown-menu li > a {text-shadow:none;font-weight:normal;}

.navbar .nav-pills > li > .dropdown-menu:before {border:none;}

.navbar .nav-pills > li > .dropdown-menu:after {border:none;}

.navbar .nav-pills > .active > a, .navbar .nav-pills > .active > a:hover, .navbar .nav-pills > .active > a:focus {-webkit-box-shadow: none;box-shadow: none;}

.navbar .nav-pills > li > a:hover, .navbar .nav-pills li.dropdown.open.active > .dropdown-toggle {-webkit-transition: ease-in-out .2s;-moz-transition: ease-in-out .2s;-o-transition: ease-in-out .2s;-ms-transition: ease-in-out .2s; transition: ease-in-out .2s;}


body {background-image: url(scribble_light.png);  background-position: inherit inherit; background-repeat: repeat repeat; text-align: justify;}

#divBoxed {margin-top: 20px;}

#divLogo{margin-top: 20px; margin-bottom: 0px; text-align: left;}

#divSiteTitle{font-size: 26px; line-height: 49px; color: <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>; text-shadow: rgba(0, 0, 0, 0.0980392) 0px 3px 5px, rgba(255, 255, 255, 0.298039) 0px -5px 35px; letter-spacing: 0px; font-weight: normal; font-style: normal; text-transform: uppercase;}

#divTagLine{color: rgb(150, 150, 150); line-height: 20px; text-transform: none; letter-spacing: 1px; font-size: 13px; padding-left: 2px; padding-right: 2px; background-color: transparent; text-shadow: none;  font-weight: normal; font-style: normal; text-decoration: initial;}

.navContainer {}

.navContainer .navMenu {}

.navContainer .navMenu li {}

.navContainer .navMenu li a {}

.navContainer .navMenu li.current {}

.navContainer .navMenu li.current a {}

.camera_caption > div {opacity: 0.85;filter:alpha(opacity=85);}

.camera_prevThumbs, .camera_nextThumbs, .camera_prev, .camera_next, .camera_commands, .camera_thumbs_cont {opacity: 0.85;filter:alpha(opacity=85) !important;background-color:rgb(240, 240, 240);}

.camera_wrap .camera_pag .camera_pag_ul li, .camera_wrap .camera_pag .camera_pag_ul li, .camera_wrap .camera_pag .camera_pag_ul li:hover > span {box-shadow: rgba(0, 0, 0, 0.121569) 0px 3px 8px inset; background-color: rgb(230, 230, 230);  }

.camera_wrap .camera_pag .camera_pag_ul li.cameracurrent > span {}

.camera_wrap {display: block; margin-bottom: 15px; height: 391px; border: 5px solid rgb(255, 255, 255); margin-left: -5px; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; margin-top: 59px; -webkit-box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px; box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px;}

.cap1 > div {opacity: 0.85;filter:alpha(opacity=85);background-color:rgb(213, 106, 64);}

.cap2 > div {opacity: 0.85;filter:alpha(opacity=85);background-color:rgb(85, 139, 197);}

.cap3 > div {opacity: 0.85;filter:alpha(opacity=85);}

.cap4 > div {opacity: 0.85;filter:alpha(opacity=85);}

.cap5 > div {opacity: 0.85;filter:alpha(opacity=85);}

.camera_full_width {margin-left:-40px;margin-right:-40px}

h1 {font-weight: normal; font-style: normal; letter-spacing: 0px; line-height: 65px; margin-top: 0px; font-family: 'Source Sans Pro', sans-serif; color: rgb(0, 0, 0); font-size: 40px;}

.page-content {line-height: 22px; font-family: 'Open Sans', sans-serif;}

.page-content a {color: <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>; font-family: 'Open Sans', sans-serif;}

.sidebox {background-color: rgb(250, 250, 250); -webkit-box-shadow: none; box-shadow: none; padding: 18px; margin-top: 26px; border: 1px solid rgb(235, 235, 235); border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px; font-family: 'Open Sans', sans-serif; line-height: 24px; color: rgb(51, 51, 51);}

.sidebar{padding-top: 23px; }

.sidebox-title {font-weight: normal; font-style: normal; font-size: 20px; letter-spacing: 0px; line-height: 40px; font-family: 'Source Sans Pro', sans-serif; color: rgb(51, 51, 51);}

.sidebox a {color: <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>; font-family: 'Open Sans', sans-serif;}

#divFooter{
	border-bottom-left-radius: 0px;
	border-bottom-right-radius: 0px;
	background-color: #4C4C4C;
	color: #ededed;
	font-family: Actor, sans-serif;
	text-transform: none;
	font-size: 12px;
	letter-spacing: 0px;
	line-height: 22px;
	background-image: url(tactile_noise.png);
	background-repeat: repeat repeat;
}


#divFooter a {color: <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>; font-size: 13px; font-family: 'Open Sans', sans-serif;}

#divFooter h3 {font-family: 'Source Sans Pro', sans-serif; font-weight: normal; font-style: normal; font-size: 23px; line-height: 45px; color: rgb(211, 211, 211);}

h2 {font-weight: normal; font-style: normal; font-family: 'Source Sans Pro', sans-serif; font-size: 35px; line-height: 50px;}

.transparent-bg {
-moz-box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px; 
-webkit-box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px; 
box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px;   
background-color: <?= (isset($website["background_color"]) && !empty($website["background_color"]))? $website["background_color"]  : "#fff" ?>;
border-top-left-radius: 0px; 
border-top-right-radius: 0px; 
border-bottom-right-radius: 0px; 
border-bottom-left-radius: 0px;;}

.breadcrumbs {font-size: 14px; line-height: 80px; font-family: 'Open Sans', sans-serif;}

.breadcrumbs a {color: <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>; font-family: 'Open Sans', sans-serif;}

#divHeaderLine1 {font-family: 'Source Sans Pro', sans-serif; font-size: 43px; line-height: 42px; margin-top: 0px; text-transform: none; color: <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>; letter-spacing: 1px; text-align: center; text-shadow: rgba(255, 255, 255, 0.6) 1px 1px 1px; background-image: none; opacity: 1; padding: 0px;}

#divHeaderLine2 {font-family: 'Source Sans Pro', sans-serif; font-size: 19px; line-height: 30px; margin-top: 12px; color: rgb(34, 34, 34); letter-spacing: 1px; text-shadow: rgba(255, 255, 255, 0.6) 1px 1px 1px; text-align: center; background-image: none; opacity: 1; padding: 0px; font-weight: normal;}

#divHeaderLine3 {margin-top: 15px; line-height: 22px; color: rgb(0, 0, 0); text-align: center; font-family: 'Source Sans Pro', sans-serif;}

a.btn, a.btn-large, a.btn-small, a.btn-mini {color:#333}

 a.btn-info, a.btn-success, a.btn-warning, a.btn-danger, a.btn-inverse {color:#ffffff}

 .btn-secondary, .btn-secondary:hover, a.btn-secondary, a.btn-secondary:hover {color:#323232;}

 .btn-secondary {border:1px solid #dfdfdf;border-bottom:1px solid #afafaf;background-color:#fafafa;background-repeat: repeat-x;background-image:-webkit-gradient(linear, left top, left bottom, from(#fafafa), to(#e1e1e1));background-image:-webkit-linear-gradient(top, #fafafa, #e1e1e1);background-image:-moz-linear-gradient(top, #fafafa, #e1e1e1);background-image:-ms-linear-gradient(top, #fafafa, #e1e1e1);background-image:-o-linear-gradient(top, #fafafa, #e1e1e1);background-image:linear-gradient(top, #fafafa, #e1e1e1);filter: progid:dximagetransform.microsoft.gradient(startColorstr=#fafafa, endColorstr=#e1e1e1, GradientType=0);filter: progid:dximagetransform.microsoft.gradient(enabled=false);}

 .btn-secondary:hover, .btn-secondary:active, .btn-secondary.active, .btn-secondary.disabled, .btn-secondary[disabled] {background-color:#dfdfdf;}

.btn-primary, .btn-primary:hover, a.btn-primary, a.btn-primary:hover {color:#ffffff;}

 .btn-primary {border:1px solid #c75503;border-bottom:1px solid #9d4302;background-color:<?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>;background-repeat: repeat-x;background-image:-webkit-gradient(linear, left top, left bottom, from(<?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>), to(#ca5603));background-image:-webkit-linear-gradient(top, <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>, #ca5603);background-image:-moz-linear-gradient(top, <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>, #ca5603);background-image:-ms-linear-gradient(top, <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>, #ca5603);background-image:-o-linear-gradient(top, <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>, #ca5603);background-image:linear-gradient(top, <?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>, #ca5603);filter: progid:dximagetransform.microsoft.gradient(startColorstr=<?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>, endColorstr=#ca5603, GradientType=0);filter: progid:dximagetransform.microsoft.gradient(enabled=false);}

 .btn-primary:hover, .btn-primary:active, .btn-primary.active, .btn-primary.disabled, .btn-primary[disabled] {background-color:#c75503;}

#divHeaderText {padding: 0px 0px 20px; border-color: rgb(51, 51, 51); text-align: center;}

#footerOuterSeparator{margin-top: 28px; height: 0px; background-color: rgb(255, 255, 255); border-top-color: rgb(255, 255, 255); border-top-width: 0px; border-top-style: solid;}

#headerSeparator{margin-top: 0px; border-top-color: rgb(51, 51, 51); border-top-width: 0px; border-top-style: solid;}

h3,.page-content h3 a {font-weight: normal; font-style: normal; font-family: 'Source Sans Pro', sans-serif; font-size: 28px; line-height: 50px;}

h4,.page-content h4 a {font-weight: normal; font-style: normal; font-family: 'Source Sans Pro', sans-serif; font-size: 21px; line-height: 50px;}

h5,.page-content h5 a {font-weight: normal; font-style: normal; font-family: 'Source Sans Pro', sans-serif; font-size: 17px; line-height: 50px;}

h6,.page-content h6 a {font-weight: normal; font-style: normal; font-family: 'Source Sans Pro', sans-serif; font-size: 15px; line-height: 50px;}

.line-separator{border-top-width: 1px; border-top-style: dotted; margin-top: 21px; margin-bottom: 21px; border-top-color: rgb(195, 195, 195); }

#divVideo{border: 7px solid rgb(255, 255, 255); margin-left: -5px; -webkit-box-shadow: rgba(0, 0, 0, 0.498039) 0px 15px 10px -10px, rgba(0, 0, 0, 0.298039) 0px 1px 4px; box-shadow: rgba(0, 0, 0, 0.498039) 0px 15px 10px -10px, rgba(0, 0, 0, 0.298039) 0px 1px 4px; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; margin-top: 15px; }

.nav .dropdown-toggle .caret {border-top-color:rgb(0, 0, 0);border-bottom-color:rgb(0, 0, 0);}

.nav .dropdown-toggle:hover .caret {border-top-color:rgb(0, 0, 0);border-bottom-color:rgb(0, 0, 0);}

.navbar .dropdown-menu, .dropdown-menu {background-color:rgb(255, 255, 255);border-radius:0px;}

.navbar .dropdown-menu li > a, .dropdown-menu li > a, .navbar .nav-pills .open .dropdown-toggle {color:rgb(0, 0, 0)}

.navbar .dropdown-menu li > a:hover, .navbar .dropdown-menu .active > a, .navbar .dropdown-menu .active > a:hover, .dropdown-menu li > a:hover, .dropdown-menu .active > a, .dropdown-menu .active > a:hover, .dropdown-menu li > a:focus, .dropdown-submenu:hover > a, .navbar .nav-pills .open a.dropdown-toggle:hover {filter:none; color:rgb(255, 255, 255);background-color:<?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>;background-image:none}

.navbar .nav-pills > li > a {margin-left:2px;margin-right:2px;padding:10px 30px;border-radius:5px;color:rgb(41, 41, 41);background-color:rgb(240, 240, 240)}

.navbar .nav-pills > li > a:hover, .navbar .nav li.dropdown.open.active > .dropdown-toggle {color:rgb(255, 255, 255);background-color:<?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>}

.navbar .nav > .active > a, .navbar .nav > .active > a:hover, .navbar .nav li.dropdown.open > .dropdown-toggle, .navbar .nav li.dropdown.active > .dropdown-toggle {background:none}

.navbar .nav-pills > .active > a, .navbar .nav-pills > .active > a:hover, .navbar .nav-pills li.dropdown.open > .dropdown-toggle, .navbar .nav-pills li.dropdown.active > .dropdown-toggle {color:rgb(255, 255, 255);background-color:<?= (isset($website["theme_color"]) && !empty($website["theme_color"]))? $website["theme_color"]  : "#e05f03" ?>;}

.navbar .ddmenu {margin-top:67px;margin-bottom:0px}

.navbar .nav-pills li.dropdown > .dropdown-toggle .caret, .navbar .nav-pills li.dropdown.open > .dropdown-toggle .caret, .navbar .nav-pills li.dropdown.active > .dropdown-toggle .caret, .navbar .nav-pills li.dropdown.open.active > .dropdown-toggle .caret {border-top-color:rgb(41, 41, 41);border-bottom-color:rgb(41, 41, 41);}

.navbar .nav-pills li.dropdown > .dropdown-toggle:hover .caret {border-top-color:rgb(255, 255, 255);border-bottom-color:rgb(255, 255, 255);}

.navbar .nav-pills li.dropdown.active > .dropdown-toggle .caret {border-top-color:rgb(255, 255, 255);border-bottom-color:rgb(255, 255, 255);}

.dropdown-menu .sub-menu {left:100%;position:absolute;top:0;visibility:hidden;margin-top:-1px;}

.dropdown-menu li:hover .sub-menu {visibility:visible;}

.ddmenu.nav-pills li a { font-size: 15px; line-height: 17px;}

.ddmenu .dropdown-menu li a {font-family: 'Pontano Sans'; line-height: 26px; font-size: 15px;}

.camera_caption {font-size: 15px; font-family: Oxygen, sans-serif; letter-spacing: 1px; line-height: 22px; text-transform: lowercase; font-weight: normal;}

.lead h2 {font-size: 45px; line-height: 65px; font-family: 'Source Sans Pro', sans-serif;}

.lead h3 {font-size: 23px; font-family: 'Source Sans Pro', sans-serif;}

.dropdown-menu .sub-menu {left:100%;position:absolute;top:0;visibility:hidden;margin-top:-1px;}
.dropdown-menu li:hover .sub-menu {visibility:visible;}
.navbar .btn-navbar-highlight {display:none;width:100%}

#decorative2 {z-index:100 !important}

@media (max-width: 979px) {
     #divLogo {margin-bottom:10px;}


    .navbar .btn-navbar-highlight {display:inline;padding:9px 14px;margin-top:15px;}

    .navbar {width:100%;}

    #divMenuRight {float:none}


    .dropdown-menu .sub-menu {left:0%;position:relative;top:0;visibility:visible;margin-top:3px;display:block}

    .dropdown-menu, .sub-menu {border-radius:5px !important;}

    .navbar .ddmenu {margin-top: 0px;margin-bottom: 0px;}


    /* Fixed Top */

    #decorative2 {position:static;  height:auto;}

    body {padding-top:0px}


}


@media (max-width: 767px) {    
    #divLogo {margin-top:10px;margin-bottom:10px;}

    #divSiteTitle {font-size: 25px;}

    
    #divHeaderText {margin:0px;padding:10px 0px;}
   
    #divHeaderLine1 {margin-top: 0px;}
     
    
    #divMenuRight {width:100%;margin-top: 0px;padding-top:0px}

    .ddmenu, .navbar .ddmenu {margin-top: 0px; margin-bottom: 0px;}

    .navbar .btn-navbar-highlight {padding:9px 14px;margin-top:0px;}

    .navbar {width:100%;margin-top: 0px;padding-top:0px}

    
    #decorative1, #decorative2, #decorative3 {margin-left:-20px;margin-right:-20px;padding-left:20px;padding-right:20px;}

    
    /* Fixed Top */

    #decorative2 {position:static}

    body {padding-top:0px}

    
    #divFooter {margin-left:-20px;margin-right:-20px;padding-left:20px;padding-right:20px;}
    
    #divBoxed > #divFooter {margin-left:0px;margin-right:0px;padding-left:0px;padding-right:0px;}

    
    body > #footerOuterSeparator, body > #contentOuterSeparator {margin-left:-20px;margin-right:-20px;}

    
    .headerArea, .topArea {padding:20px !important;}
 /*only for templates without divBoxed*/

    
    #camera_wrap {margin-top:20px}

    #divVideo {margin-top:20px}

    
    .dropdown-menu .sub-menu {left:0%;position:relative;top:0;visibility:visible;margin-top:3px;display:block}

    .dropdown-menu, .sub-menu {border-radius:5px !important;}

    .navbar .ddmenu {margin-top: 0px;margin-bottom: 0px;}

}
.box-shadow{
	padding: 25px;
	webkit-box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px;
	box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px;
}
.font-12{
	font-size: 12px;
}
.widget{
height:100%;
}
.divbox{
	padding: 10px 40px;
}
#pageBody{
color: <?= (isset($website["text_color"]) && !empty($website["text_color"]))? $website["text_color"]  : "#333333" ?>;
background-color:#F1F1F1 ;
}
.thumbnail .caption {
	color: <?= (isset($website["text_color"]) && !empty($website["text_color"]))? $website["text_color"]  : "#333333" ?> !important;

}

    	
    </style>
</head>
<body id="pageBody">

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
			                            	<li class="<?= $menuItem["page_url"] == $webpage["page_url"] ? "active": ""?>" ><a href="http://<?= $website["domain"]."/site/page/". $menuItem["page_url"] ?>.html"><?= $menuItem["menu_title"] ?></a></li>
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
							<?= getContactUsDefaultHTML($contactInfo["primary_email"]); ?>
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

<script src="<?= base_url() ?>webtemplates/template1/scripts/jquery.min.js" type="text/javascript"></script> 
<script src="<?= base_url() ?>webtemplates/template1/scripts/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>webtemplates/template1/scripts/default.js" type="text/javascript"></script>


<script src="<?= base_url() ?>webtemplates/template1/scripts/carousel/jquery.carouFredSel-6.2.0-packed.js" type="text/javascript"></script>
<script src="<?= base_url() ?>webtemplates/template1/scripts/camera/scripts/camera.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>webtemplates/template1/scripts/easing/jquery.easing.1.3.js" type="text/javascript"></script>
<script type="text/javascript">function startCamera() {$('#camera_wrap').camera({ fx: 'scrollLeft', time: 2000, loader: 'none', playPause: false, navigation: true, height: '35%', pagination: true });}$(function(){startCamera()});</script>





<script src="<?= base_url() ?>webtemplates/template1/scripts/wookmark/js/jquery.wookmark.js" type="text/javascript"></script>
<script type="text/javascript">$(window).load(function () {var options = {autoResize: true,container: $('#gridArea'),offset: 10};var handler = $('#tiles li');handler.wookmark(options);$('#tiles li').each(function () { var imgm = 0; if($(this).find('img').length>0)imgm=parseInt($(this).find('img').not('p img').css('margin-bottom')); var newHeight = $(this).find('img').height() + imgm + $(this).find('div').height() + $(this).find('h4').height() + $(this).find('p').not('blockquote p').height() + $(this).find('iframe').height() + $(this).find('blockquote').height() + 5;if($(this).find('iframe').height()) newHeight = newHeight+15;$(this).css('height', newHeight + 'px');});handler.wookmark(options);handler.wookmark(options);});</script>
<script src="<?= base_url() ?>webtemplates/template1/scripts/yoxview/yox.js" type="text/javascript"></script>
<script src="<?= base_url() ?>webtemplates/template1/scripts/yoxview/jquery.yoxview-2.21.js" type="text/javascript"></script>
<script type="text/javascript">$(document).ready(function () {$('.yoxview').yoxview({autoHideInfo:false,renderInfoPin:false,backgroundColor:'#ffffff',backgroundOpacity:0.8,infoBackColor:'#000000',infoBackOpacity:1});$('.yoxview a img').hover(function(){$(this).animate({opacity:0.7},300)},function(){$(this).animate({opacity:1},300)});});</script>





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