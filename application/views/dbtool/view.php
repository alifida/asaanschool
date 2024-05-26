<?php //pre($meta)?>

		<div class="col-centered">
			<table class="table table-hover" id="">
		<?php foreach ($meta as $m){?>	
				<tr>
					<td><?= $m["column_name"] ?>:</td>
					<td>
						<strong><?= isset($row[$m["column_name"]])? htmlentities($row[$m["column_name"]]):"" ?> </strong>
					</td>
				</tr>
		<?php } ?>

			</table>
		</div>

		<br/>
		<div class="form-group">
			<div class="col-centered">
				<a onclick="global_ajax_from_submit('<?= site_url("db/load/$table/$pageNo") ?>','','content_area');" href="javascript: void(0);" class="btn btn-sm btn-danger">Back to <?= $table ?></a>
			</div>
		</div>



