<?php ?>
<section class="content-header">
	<h1 style="float: left">
		<?= isset($table)?  strtoupper ($table): "" ?>
	</h1>
	<div class="pull-right ">
		<div class="btn-group ">
			<button type="button" class="btn btn-outline btn-default btn-xs" onclick="global_ajax_from_submit('<?=  site_url('db/runSQLForm/') ?>','','content_area');">Run SQL</button>
		</div>
	</div>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="box box-danger">
				<!-- Default panel contents -->
				<div class="box-header"></div>
				<div class="box-body">
					<form class="form-horizontal" action="" method="POST" name="query_form" id="query_form" onsubmit="submitQueryForm(); return false;">
						<fieldset>

							<div class="form-group">
								<label class="col-md-2 control-label" for="sql_query">SQL Query</label>
								<div class="col-md-9">
									<textarea cols="80" rows="8" name="sql" id="sql" required="required" style="max-width: 100%;min-width: 100%;"><?= isset($sql)? $sql:"" ?></textarea>
								</div>
							</div>
							<!-- Button (Double) -->
							<div class="form-group">
								<label class="col-md-6 control-label" for="query_exe"></label>
								<div class="col-md-6">
									<button type="submit" id="query_exe" name="query_exe" class="btn btn-danger">Run</button>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
			
			<?php $this->load->view('dbtool/query_result'); ?>
		</div>
	</div>
</section>

<script type="text/javascript">
function submitQueryForm(){
	$serialized= $("#query_form").serialize();
	global_ajax_from_submit('<?= site_url('db/runSQL') ?>','','content_area', $serialized);
	return false;
}
</script>
