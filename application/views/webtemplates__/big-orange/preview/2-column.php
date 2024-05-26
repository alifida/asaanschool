<?php ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Preview</title>
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
   
<!--
    <link href="< ?= base_url() ?>webtemplates/big-orange/styles/custom.css" rel="stylesheet" type="text/css" />
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


body {background-image: url(<?= base_url() ?>webtemplates/big-orange/scribble_light.png);  background-position: inherit inherit; background-repeat: repeat repeat; text-align: justify;}

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
	background-image: url(<?= base_url() ?>webtemplates/big-orange/tactile_noise.png);
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

.ddmenu .dropdown-menu li a { line-height: 26px; font-size: 15px;}

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

    <div class="divPanel notop nobottom">
            <div class="row-fluid">
                <div class="span12">

                    <div id="divLogo" class="pull-left">
                        <a href="index.html" id="divSiteTitle">Your Name</a><br />
                        <a href="index.html" id="divTagLine">Your Tag Line Here</a>
                    </div>

                     <?php $this->load->view('webtemplates/big-orange/preview/menu',array("template"=>$template)); ?>





                </div>
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <div id="contentInnerSeparator"></div>
                </div>
            </div>
    </div>

    <div class="contentArea">

        <div class="divPanel notop page-content">

            <div class="breadcrumbs">
                <a href="index.html">Home</a> &nbsp;/&nbsp; <span>Two Column</span>
            </div>

            <div class="row-fluid">
			
			<!--Edit Sidebar Content here-->
                <div class="span3">                    
                 <h3>Left Sidebar Content</h3>
                 <p>Lorem Ipsum is simply dummy text of the printing and <a href="#">typesetting industry</a>.</p>
				 <p> Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s.</p>     
                
				
        <h3>Static Image</h3>        
          <img src="<?= base_url() ?>webtemplates/big-orange/images/windmill.jpg" class="img-polaroid" alt="">
		  
			<h3>Another Section</h3>
                 <p>Lorem Ipsum is simply dummy text of the printing and <a href="#">typesetting industry</a>.</p>
				 <p> Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s.</p>                 	
          </div>
				<!--/End Sidebar Content -->        				
					                 
            	<!--Edit Main Content Area here-->
                <div class="span9" id="divMain">

                    <h1>Two Column (left-hand sidebar)</h1>
					<hr>	
                    <p>Aliquam a tellus quam. Phasellus sit amet bibendum nunc. Donec lobortis nulla diam, a laoreet nisi rhoncus vitae. Suspendisse tincidunt, nulla sed convallis consectetur, diam enim ultricies nulla, a luctus odio nisi in ligula. Aenean ornare rhoncus fermentum. Suspendisse et enim in nibh dictum blandit et id nisi. Duis mollis, libero id venenatis viverra, metus lacus placerat turpis, at semper orci odio id lectus. Proin fringilla quam porttitor est mattis, id aliquam est laoreet. Nulla congue urna nisi, eu commodo dolor aliquet eget. Donec ullamcorper diam quis porttitor convallis. Aliquam erat volutpat. Phasellus pulvinar sagittis nunc et adipiscing.</p>
                    <p>Duis facilisis tellus ante, eu sodales neque ornare vitae. Pellentesque laoreet velit diam, quis tempor est fringilla sed. Curabitur in ullamcorper lectus, et gravida mauris. Suspendisse tristique euismod metus, quis facilisis lectus cursus faucibus. Nulla sed leo sed tellus egestas mattis sed id libero. Aenean at scelerisque augue. Phasellus at sem porttitor, auctor metus pharetra, lacinia sapien.</p>
                    <p>Etiam enim dui, dictum vitae lobortis quis, placerat feugiat leo. Sed commodo elit orci, non tincidunt velit suscipit in. Nulla facilisi. Praesent vel eros tristique, lobortis orci vitae, interdum quam. In hac habitasse platea dictumst. Praesent lobortis iaculis ante, at laoreet est pulvinar vel. Cras vulputate tempus nulla eget venenatis. Suspendisse magna lacus, tincidunt nec pulvinar sit amet, semper quis neque. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Cras vehicula volutpat enim, id vehicula dolor porttitor in. Nam vehicula velit erat, eu consectetur elit luctus ut. Aliquam ac convallis enim, et venenatis dui. Maecenas et leo metus. Etiam diam ante, lacinia vitae orci vel, dignissim vestibulum tortor. Aliquam elit sapien, pellentesque eu consectetur et, tempor vitae nisl.</p>		
                    <p>Donec arcu nisi, euismod vitae facilisis id, pulvinar eget tortor. Nunc lobortis ultrices pellentesque. Sed sollicitudin dapibus erat a interdum. Cras massa mauris, rutrum vel nisi non, malesuada lobortis velit. Fusce eu tellus justo. Donec dictum, purus at adipiscing rhoncus, risus libero bibendum ipsum, mollis vestibulum arcu arcu eget elit. In tempor laoreet ultricies. 
					Maecenas lacus neque, fermentum in blandit a, mollis in libero. Vivamus ornare eros quis arcu cursus, at luctus nisi accumsan.
					</p>					
				</div>	                             
                    					                  
				<!--/End Main Content Area here-->	                
					
							
            </div>

            <div id="footerInnerSeparator"></div>
        </div>
    </div>

    <div id="footerOuterSeparator"></div>

    <div id="divFooter" class="footerArea">

        <div class="divPanel">

            <div class="row-fluid">
                <div class="span3" id="footerArea1">
                
                    <h3>About Company</h3>

                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s.</p>
                    
                    <p> 
                        <a href="#" title="Terms of Use">Terms of Use</a><br />
                        <a href="#" title="Privacy Policy">Privacy Policy</a><br />
                        <a href="#" title="FAQ">FAQ</a><br />
                        <a href="#" title="Sitemap">Sitemap</a>
                    </p>

                </div>
                <div class="span3" id="footerArea2">

                    <h3>Recent Blog Posts</h3> 
                    <p>
                        <a href="#" title="">Lorem Ipsum is simply dummy text</a><br />
                        <span style="text-transform:none;">2 hours ago</span>
                    </p>
                    <p>
                        <a href="#" title="">Duis mollis, est non commodo luctus</a><br />
                        <span style="text-transform:none;">5 hours ago</span>
                    </p>
                    <p>
                        <a href="#" title="">Maecenas sed diam eget risus varius</a><br />
                        <span style="text-transform:none;">19 hours ago</span>
                    </p>
                    <p>
                        <a href="#" title="">VIEW ALL POSTS</a>
                    </p>

                </div>
                <div class="span3" id="footerArea3">

                    <h3>Sample Content</h3> 
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s. 
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s.
                    </p>

                </div>
                <div class="span3" id="footerArea4">

                    <h3>Get in Touch</h3>  
                                                               
                    <ul id="contact-info">
                    <li>                                    
                        <i class="general foundicon-phone icon"></i>
                        <span class="field">Phone:</span>
                        <br />
                        (123) 456 7890 / 456 7891                                                                      
                    </li>
                    <li>
                        <i class="general foundicon-mail icon"></i>
                        <span class="field">Email:</span>
                        <br />
                        <a href="mailto:info@yourdomain.com" title="Email">info@yourdomain.com</a>
                    </li>
                    <li>
                        <i class="general foundicon-home icon" style="margin-bottom:50px"></i>
                        <span class="field">Address:</span>
                        <br />
                        123 Street<br />
                        12345 City, State<br />
                        Country
                    </li>
                    </ul>

                </div>
            </div>

            <br /><br />
            <div class="row-fluid">
                <div class="span12">
                    <p class="copyright">
                        Copyright © 2013 Your Company. All Rights Reserved.
                    </p>

                    <p class="social_bookmarks">
                        <a href="#"><i class="social foundicon-facebook"></i> Facebook</a>
			<a href=""><i class="social foundicon-twitter"></i> Twitter</a>
			<a href="#"><i class="social foundicon-pinterest"></i> Pinterest</a>
			<a href="#"><i class="social foundicon-rss"></i> Rss</a>
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
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

</body>
</html>