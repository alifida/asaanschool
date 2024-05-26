<?php ?>

<section class="content-header">
<h1>
<?= $school["school_name"] ?>
	<small>Details</small>
</h1>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
	<div class="col-lg-8 col-md-8">
	<?php $this->load->view('schools/schoolDetail'); ?>
	</div>
	<div class="col-lg-4 col-md-4">
	<?php $this->load->view('schools/campus/list'); ?>
	</div>
</div>
<!-- Main row --> </section>
<!-- /.content -->
