<?php //pre($meta)?>

<form class="form-horizontal" action="" method="POST" name="<?= $table ?>_form"  id="<?= $table ?>_form" onsubmit="saveFormFunction(); return false;">
	<fieldset>
		<?php $columsList = array();?>
		<?php foreach ($meta as $m){ ?>		
		<div class="form-group">
			<label class="col-md-4 control-label" for="<?= $m["column_name"] ?>"><?= $m["column_name"] ?> <?= (strtolower($m["is_nullable"]) !=strtolower("yes"))?"<span class='text-danger'>*</span>":"" ?></label>
			<div class="col-md-5">
				<input id="<?= $m["column_name"] ?>" name="<?= $m["column_name"] ?>" type="text" class="form-control input-md" value="<?= isset($row[$m["column_name"]])?htmlentities($row[$m["column_name"]]):"" ?>" placeholder="<?= $m["column_name"] ?>" <?= (strtolower($m["is_nullable"]) !=strtolower("yes"))?" required ":"" ?> maxlength="<?= $m["character_maximum_length"] ?>" <?= (strtolower($m["extra"]) == strtolower("auto_increment" ))?" readonly ":"" ?>>
				<?php $columsList[] = $m["column_name"]; ?>
			</div>
		</div>
	<?php } ?>

		<!-- Button (Double) -->
		<div class="form-group">
			<label class="col-md-6 control-label" for="<?= $table ?>_save"></label>
			<div class="col-md-6">
				<button id="<?= $table ?>_reset" name="<?= $table ?>_reset" class="btn btn-default" type="reset">Reset</button>
				<button type="submit" id="<?= $table ?>_save" name="<?= $table ?>_save" class="btn btn-danger">Save</button>
			</div>
		</div>
		<input type="hidden"  name="fields" id="fields" value="<?= implode(",",$columsList) ?>" />
		<input type="hidden"  name="table" id="table" value="<?= $table ?>" />
		<input type="hidden"  name="pageNo" id="pageNo" value="1" />
		<input type="hidden"  name="pageSize" id="pageSize" value="10" />
	</fieldset>
</form>
<script type="text/javascript">
function saveFormFunction(){
	$serialized= $("#<?= $table ?>_form").serialize();
	global_ajax_from_submit('<?= site_url('db/save') ?>','<?= $table ?>_form','content_area', $serialized);
	return false;
}
</script>
