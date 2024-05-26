<?php ?>
<section class="content-header">
	<h1>Website </h1>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">

		<div class="col-lg-12">
		<?php $this->load->view('websites/configuration_details'); ?>
	</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<?php $this->load->view('websites/pages/list'); ?>
	</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<?php $this->load->view('websites/posts/list'); ?>
	</div>
		<div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
		<?php $this->load->view('websites/post_category/list'); ?>
	</div>
		<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
		<?php $this->load->view('websites/slider/list'); ?>
	</div>
	</div>
</section>