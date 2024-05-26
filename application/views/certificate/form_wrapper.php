<?php ?>
<div class="box box-warning">
	<div class="box-header">
		<div class="pull-right ">
			<div class="btn-group ">
				<button type="button" onclick="global_ajax_from_submit('<?= site_url('certificate/listAll') ?>','','certificate_area');" class="btn btn-outline btn-warning btn-xs">
					<span class="glyphicon glyphicon-remove-circle bg-yellow"></span>
				</button>
			</div>
		</div>
	</div>
	<div class="box-body">
		<?php $this->load->view('certificate/form'); ?>
	</div>
</div>
