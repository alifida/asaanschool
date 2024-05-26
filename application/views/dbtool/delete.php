<?php //pre($meta)?>

<div class="col-centered">
	<table class="table table-hover" id="">
		<?php 
		$pkCol = "";
		$pkVal = "";
		?>
		<?php foreach ($meta as $m){?>
		<?php if(strtolower($m["column_key"]) == "pri"){
			$pkCol = $m["column_name"];
			$pkVal = $row[$m["column_name"]];
		}?>	
		<tr>
			<td><?= $m["column_name"] ?>:</td>
			<td><strong><?= isset($row[$m["column_name"]])?htmlentities($row[$m["column_name"]]):"" ?> </strong></td>
		</tr>
		<?php } ?>
	</table>
</div>

<br />
<div class="form-group">
	<div class="col-centered">
		<form action="" method="POST" name="<?= $table ?>_delete_form"  id="<?= $table ?>_delete_form" onsubmit="deleteFormFunction(); return false;">
			<input type="hidden" name="table" value="<?= $table ?>" />
			<input type="hidden" name="pageNo" value="<?= $pageNo ?>" />
			<input type="hidden" name="pageSize" value="<?= $pageSize ?>" />
			<input type="hidden" name="pkCol" value="<?= $pkCol ?>" />
			<input type="hidden" name="<?= $pkCol ?>" value="<?= encodeID($pkVal) ?>" />
			<input type="hidden" name="confirmed" value="confirmed" />
		<button type="submit"  class="btn btn-sm btn-danger">Yes (Delete)</button>
		</form>
	</div>
</div>
<script type="text/javascript">
function deleteFormFunction(){
	$serialized= $("#<?= $table ?>_delete_form").serialize();
	global_ajax_from_submit('<?= site_url("db/delete/$table") ?>','','content_area', $serialized);
	return false;
}
</script>


