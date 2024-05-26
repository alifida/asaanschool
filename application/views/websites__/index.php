<?php ?>

<section class="content-header">
<h1>Website Configuration</h1>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
	<div class="col-lg-12">
	<?php $this->load->view('websites/configuration_details'); ?>
	</div>

	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
	<?php $this->load->view('websites/webpages'); ?>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
	<?php $this->load->view('websites/widgets/list'); ?>
	</div>
</div>
<!-- /.row --> </section>
