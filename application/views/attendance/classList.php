<?php

?>
<div class="box box-success attendance">
	<div class="box-header">
		Classes
		
	</div>
	<!-- /.box-header -->
	<div class="box-body ">
		<div class="table-responsive">
			<table class="table table-hover simpleDataTables" id="">
				<thead>
					<tr>
						<th>Name</th>
						<th class="all disable-sort" width="10%"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($classes as $class){ ?>
						<tr <?= ($class["id"]==decodeID($selectedClass))?"class='bg-green'":"" ?>>
							<td><?= $class['name'] ?></td>
							<td>
								<div class="btn-group col-centered" >
								  <button type="button" class="btn btn-xs btn-success btn-outline dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu pull-right" role="menu">
									<li><a href="<?= site_url("attendance/take") ?>/<?= encodeID($class["id"])?>">Take Attendance</a></li>
									<li><a href="<?= site_url("attendance/old") ?>/<?= encodeID($class["id"])?>">Old Attendance</a></li>
								  </ul>
								</div>
							</td>
						</tr>
						<?php } ?>
					</tbody>
			</table>
		</div>
		
	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->

