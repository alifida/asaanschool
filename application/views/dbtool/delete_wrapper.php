<?php ?>
<?php $this->load->view('dbtool/top_section'); ?>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="box box-danger">
				<!-- Default panel contents -->
				<div class="box-header"></div>
				<div class="box-body">
					<div class="col-centered">
						<div class="alert alert-warning">
							<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to <strong>DELETE</strong> the following <?= isset($table)?  strtoupper ($table): ""?> Record?
						</div>
					</div>
					<?php $this->load->view('dbtool/delete'); ?>
				</div>
			</div>
		</div>
	</div>
</section>

