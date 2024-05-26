<?php ?>
<nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= site_url('/site/previewTemplate/'.generate_slug($template["template_name"]).'/'.  encodeID($template["id"])) ?>/index.html"><img src="<?= base_url() ?>webtemplates/clean/images/logo.png" alt="logo"></a>
                </div>
				
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li><a href="<?= site_url('/site/previewTemplate/'.generate_slug($template["template_name"]).'/'.  encodeID($template["id"])) ?>/index.html">Home</a></li>
                        <li class="active"><a href="<?= site_url('/site/previewTemplate/'.generate_slug($template["template_name"]).'/'.  encodeID($template["id"])) ?>/about-us.html">About Us</a></li>
                        <li><a href="<?= site_url('/site/previewTemplate/'.generate_slug($template["template_name"]).'/'.  encodeID($template["id"])) ?>/services.html">Services</a></li>
                        <li><a href="<?= site_url('/site/previewTemplate/'.generate_slug($template["template_name"]).'/'.  encodeID($template["id"])) ?>/portfolio.html">Portfolio</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Blog Single</a></li>
                                <li><a href="#">Pricing</a></li>
                                <li><a href="#">404</a></li>
                                <li><a href="#">Shortcodes</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Blog</a></li> 
                        <li><a href="#">Contact</a></li>                        
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
