<?php ?>
<section class="content-header">
<h1>Users</h1>
</section>

<!-- Main content -->
<section class="content"> <!-- /.col-lg-12 --> <!-- /.row -->
<div class="row" data-columns="" id="columns">
	<div class="col-lg-8">
	<?php $this->load->view('users/userList'); ?>
	</div>
	<div class="col-lg-4">
	<?php $this->load->view('users/campusModules'); ?>
	</div>
</div>

</section>
