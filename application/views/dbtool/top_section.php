<?php ?>
<section class="content-header" >
<h1 style="float: left">
<?= isset($table)?  strtoupper ($table): "" ?>
	</h1>
	<div class="pull-right ">
		<?php if(isset($table) && !empty($table)){?>
			<div class="btn-group ">
				<button type="button" class="btn btn-outline btn-default btn-xs" onclick="global_ajax_from_submit('<?=  site_url('db/create/'.$table.'/'.$pageNo.'/'.$pageSize) ?>','','content_area');">New</button>
			</div>
		<?php }?>
		<div class="btn-group ">
			<button type="button" class="btn btn-outline btn-default btn-xs" onclick="global_ajax_from_submit('<?=  site_url('db/runSQLForm/') ?>','','content_area');">Run SQL</button>
		</div>
	</div>
</section>