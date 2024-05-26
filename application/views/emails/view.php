<?php  ?>

<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
<?= $emailUser["emailType"]["type"] ?>
</h1>
</section>

<!-- Main content -->
<section class="content">
<div class="box box-primary">
	<div class="box-body">

		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 ">
			<?php $this->load->view('emails/emailMenu'); ?>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-9 col-xs-9">
			<?php $this->load->view('emails/conversation'); ?>
			</div>

		</div>
	</div>
</div>
</section>

<script	src="<?= base_url() ?>public/js/email.js"></script>
