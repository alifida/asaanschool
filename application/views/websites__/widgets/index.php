<?php ?>

<section class="content-header">
<h1>Widgets</h1>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
	<?php $this->load->view('websites/widgets'); ?>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
	<?php $this->load->view('websites/list'); ?>
	</div>
</div>
<!-- /.row --> </section>

<script	src="<?= base_url() ?>public/js/websites.js"></script>
