<?php //isset($meta)?pre($meta):"";?>
<div class="box box-danger">
	<!-- Default panel contents -->
	<div class="box-header"></div>
	<div class="box-body">
	<?php if(isset($rs) && !empty($rs)){?>
	<?php
		$headers = array ();
		foreach ( $rs [0] as $key => $header ) {
			$headers [] = $key;
		}
		?>
		<div class="table-responsive">
		<table class="table table-hover table-responsive dataTables ">
		<thead>
			<tr>	
				<th></th>
				<?php foreach ($headers as $header){?>
					<th><?= strtoupper ($header) ?></th>
				<?php }?>
				</tr>
		</thead>
		<tbody>
				<?php foreach ($rs as $row){?>
					<tr>
						<td>
							<div class="btn-group col-centered" >
							  <button type="button" class="btn btn-xs btn-danger btn-outline dropdown-toggle" data-toggle="dropdown">
							    <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu pull-right" role="menu">
								  	<li><a href="javascript:void(0);"  onclick="global_ajax_from_submit('<?=  site_url('db/edit/'.$table.'/'.encodeID($row["id"]).'/'.$pageNo.'/'.$pageSize) ?>','','content_area');">Edit</a></li>
								  	<li><a href="javascript:void(0);"  onclick="global_ajax_from_submit('<?=  site_url('db/view/'.$table.'/'.encodeID($row["id"])).'/'.$pageNo.'/'.$pageSize ?>','','content_area');">View</a></li>
									<li class="divider"></li>
								  	<li><a href="javascript:void(0);"  onclick="global_ajax_from_submit('<?=  site_url('db/deleteConfirm/'.$table.'/'.encodeID($row["id"])).'/'.$pageNo.'/'.$pageSize ?>','','content_area');">Delete</a></li>
								    	
							  </ul>
							</div>
						</td>
						<?php foreach ($row as $cell){?>
								<td><?= htmlentities($cell) ?></td>
						<?php }?>
					</tr>
				<?php }?>
			</tbody>
	</table>
	</div>
	<?php }?>
	<?php if(isset($totalPages) && $totalPages > 1){?>
		<nav>
			<ul class="pagination">
				<?php 
				$prevLink = "global_ajax_from_submit('". site_url("db/load/$table/$prevPage") ."','','content_area');";
				$nextLink = "global_ajax_from_submit('". site_url("db/load/$table/$nextPage") ."','','content_area');";
				?>
				<li class='<?= ($pageNo <=1)?"disabled":""  ?>' ><a onclick="<?= ($pageNo > 1)? $prevLink :"" ?>" href="javascript: void(0);" aria-label="Previous"> <span aria-hidden="true">&laquo;</span></a></li>
				<?php for($pageIndex =1 ; $pageIndex <= $totalPages; $pageIndex++){?>
					<li  class='<?= $pageNo == $pageIndex? "active":""?>'><a onclick="global_ajax_from_submit('<?= site_url("db/load/$table/$pageIndex") ?>','','content_area');" href="javascript: void(0);"><?= $pageIndex ?></a></li>
				<?php }?>
				<li class='<?= ($pageNo >= $totalPages)?"disabled":""  ?>' ><a onclick="<?= ($pageNo < $totalPages)? $nextLink :"" ?>" href="javascript: void(0);" aria-label="Next"> <span aria-hidden="true">&raquo;</span></a></li>
			</ul>
		</nav>
	<?php } ?>
	</div>
</div>
<script>
// initDataTables();
</script>
