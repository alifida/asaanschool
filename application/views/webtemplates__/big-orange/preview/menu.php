<?php ?>
<div id="divMenuRight" class="pull-right">
<div class="navbar">
<button type="button" class="btn btn-navbar-highlight btn-large btn-primary" data-toggle="collapse" data-target=".nav-collapse">
NAVIGATION <span class="icon-chevron-down icon-white"></span>
</button>
<div class="nav-collapse collapse">
<ul class="nav nav-pills ddmenu">
<li><a href="<?= site_url('/site/previewTemplate/'.generate_slug($template["template_name"]).'/'.  encodeID($template["id"])) ?>/index.html">Home</a></li>
<li><a href="<?= site_url('/site/previewTemplate/'.generate_slug($template["template_name"]).'/'.  encodeID($template["id"])) ?>/about.html">About</a></li>
<li class="dropdown">
<a href="#" class="dropdown-toggle">Page <b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="<?= site_url('/site/previewTemplate/'.generate_slug($template["template_name"]).'/'.  encodeID($template["id"])) ?>/2-column.html">Two Column</a></li>
<li><a href="<?= site_url('/site/previewTemplate/'.generate_slug($template["template_name"]).'/'.  encodeID($template["id"])) ?>/3-column.html">Three Column</a></li>
<li class="dropdown">
<a href="#" class="dropdown-toggle">Dropdown Item &nbsp;&raquo;</a>
<ul class="dropdown-menu sub-menu">
<li><a href="#">Dropdown Item</a></li>
<li><a href="#">Dropdown Item</a></li>
<li><a href="#">Dropdown Item</a></li>
</ul>
</li>
</ul>
</li>

<li><a href="<?= site_url('/site/previewTemplate/'.generate_slug($template["template_name"]).'/'.  encodeID($template["id"])) ?>/services.html">Services</a></li>
<li><a href="<?= site_url('/site/previewTemplate/'.generate_slug($template["template_name"]).'/'.  encodeID($template["id"])) ?>/portfolio.html">Portfolio</a></li>
<li><a href="<?= site_url('/site/previewTemplate/'.generate_slug($template["template_name"]).'/'.  encodeID($template["id"])) ?>/contact-us.html">Contact</a></li>
</ul>
</div>
</div>
</div>