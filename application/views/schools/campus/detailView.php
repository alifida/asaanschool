<?php ?>

<section class="content-header">
<h1>
<?= $campus["campus_name"] ?>
	<small>Details</small>
</h1>
</section>

<!-- Main content -->
<section class="content"> <?php $this->load->view('dashboard/widgets'); ?>

<!-- Main row -->
<div class="row">
	<div class="col-lg-8">
	<?php $this->load->view('campuses/campusDetail'); ?>
	</div>
	<!-- /.col-lg-8 -->
	<div class="col-lg-4">
	<?php $this->load->view('campuses/campusModules'); ?>
	</div>
	<!-- /.col-lg-4 -->
</div>

</section>
<!-- /.content -->
