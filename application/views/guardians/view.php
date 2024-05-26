<?php ?>

<section class="content-header">
<h1>Guardian Details</h1>
</section>

<!-- Main content -->
<section class="content">

<div class="row">
	<div class="col-lg-8">
	<?php
	$students = array();
	if(isset($guardianDetail["students"]) && !empty($guardianDetail["students"])){
		$students = $guardianDetail["students"];
	}
	?>
	<?php $this->load->view('students/list',array("students" => $students)); ?>
	</div>

	<div class="col-lg-4">
	<?php $this->load->view('guardians/guardian_detail'); ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">

	<?php //$this->load->view('guardians/list'); ?>

	</div>
</div>

</section>
