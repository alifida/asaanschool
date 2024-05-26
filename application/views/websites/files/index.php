<?php ?>
<section class="content-header">
	<h1>Webpage</h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-12">
					<div class="box box-primary">
						<div class="box-header">
							Images
							<div class="pull-right ">
								<div class="btn-group  ">
									<a href="<?= site_url('website/gallery') ?>" class="btn btn-raised btn-danger btn-xs  "> Reload </a>
								</div>
								<div class="btn-group   ">
									<button type="button" onclick="load_remote_model('<?= site_url('website/uploadGalaryFile') ?>','Upload File');" class="btn btn-raised btn-danger btn-xs  ">Upload File</button>


								</div>
							</div>
						</div>
						<div class="box-body">
				<?php $this->load->view('websites/files/gallery'); ?>
			</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
