<?php ?>

<section class="content-header">
<h1>Footer</h1>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
	<div class="col-lg-12">
	<?php $this->load->view('websites/edit_webpage_footer_form.php'); ?>
	</div>
</div>
</section>
<script	src="<?= base_url() ?>public/js/websites.js"></script>
<script>
	$(document).ready(function() {
		toggle_home_page_controles();
		
	});
</script>
