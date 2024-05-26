<?php ?>

<section class="content-header">
<h1>Classes & Fee</h1>
</section>
<section class="content">
<div class="row">
	<div class="col-lg-8">
	<?php $this->load->view('classes/classFee/fee_list'); ?>
	</div>

	<div class="col-lg-4">
	<?php $this->load->view('classes/class_list'); ?>
	<?php $this->load->view('others/fee_type_list'); ?>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
	<?php $this->load->view('students/fee_list');?>
	</div>
</div>
</section>
<script
	src="<?= base_url() ?>public/js/class_fee.js?v=<?= get_app_message("release.version")?>"></script>
