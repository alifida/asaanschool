<?php ?>

<section class="content-header">
<h1>Promote Students</h1>
</section>

<!-- Main content -->
<section class="content"> <!-- /.row -->
<div class="row">
	<div class="col-lg-9 col-centered">
	<?php $this->load->view('students/promote_students_form'); ?>
	</div>
</div>
</section>

<script	src="<?= base_url() ?>public/js/student.js?v=<?= get_app_message("release.version")?>"></script>
<script>
		var d = $('#promote_student_multiple_students').bootstrapDualListbox({
			nonSelectedListLabel : 'Available',
			selectedListLabel : 'Selected',
			preserveSelectionOnMove : 'moved',
			moveOnSelect : false,
			nonSelectedFilter : ''
		});
	</script>
