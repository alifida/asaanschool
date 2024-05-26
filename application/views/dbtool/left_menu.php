<?php // pre_d($tables);
?>
<div class="box box-default">
	<div class="box-body">
		<?php if(isset($tables)){?>
			<table class=" table table-hover table-responsive noPaginationDataTables  ">
				<thead>
					<tr>	
						<th>TABLES</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($tables as $table){?>
				<tr><td onclick="global_ajax_from_submit('<?= site_url("db/load/".$table["table_name"]) ?>','','content_area');" href="javascript: void(0);"><?= $table["table_name"] ?></td></tr>
				<?php }?>
				</tbody>
			</table>
		<?php } ?>
	</div>
</div>