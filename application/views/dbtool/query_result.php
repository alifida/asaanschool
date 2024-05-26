<?php  ?>
<div class="box box-danger">
	<!-- Default panel contents -->
	<div class="box-header"></div>
	<div class="box-body">
	<?php if(isset($successMessage) && !empty($successMessage)){?>
		<div class="col-centered">
			<div class="alert alert-success">
				<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; <?= $successMessage ?> 
			</div>
		</div>
	<?php }?>
	<?php if(isset($rs) && !empty($rs)){?>
	<?php
		$headers = array ();
		foreach ( $rs [0] as $key => $header ) {
			$headers [] = $key;
		}
		?>
		<div class="table-responsive">
			<table class="table table-hover table-responsive dataTables">
				<thead>
					<tr>
						<th>Sr No.</th>
				<?php foreach ($headers as $header){?>
					<th><?= strtoupper ($header) ?></th>
				<?php }?>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($rs as $key=> $row){?>
					<tr>
						<td><?= $key+1 ?></td>
						<?php foreach ($row as $cell){?>
								<td><?= htmlentities($cell) ?></td>
						<?php }?>
					</tr>
				<?php }?>
			</tbody>
			</table>
		</div>
	<?php }?>
	
	</div>
</div>
<script>
// initDataTables();
</script>

