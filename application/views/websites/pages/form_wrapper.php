<?php ?>

<section class="content-header">
	<h1>Webpage </h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<?php $this->load->view('websites/pages/form'); ?>
		</div>
	</div>
	<!-- /.row -->
</section>
<script src="<?= base_url() ?>public/js/websites.js"></script>
<script>
	$(document).ready(function() {
		toggle_home_page_controles();
	});
</script>
