<?php ?>

<section class="content-header">
<h1>Website Gallery</h1>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
	<div class="col-lg-12">
		<div class="box box-primary">
			<div class="box-header">
				Images
				<div class="pull-right ">
					<div class="btn-group  col-centered">
						<button type="button"
							class="btn btn-outline btn-default btn-xs dropdown-toggle "
							data-toggle="dropdown">
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu pull-right" role="menu">
							<li><a href="javascript:void(0);"
								onclick="load_remote_model('<?= site_url('website/uploadGalaryImage') ?>','Upload Image');">Upload
									Image</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="box-body">
			<?php $this->load->view('websites/images/gallery'); ?>
			</div>
		</div>
	</div>
</div>
<!-- /.row --> </section>
