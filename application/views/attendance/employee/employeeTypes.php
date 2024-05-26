<?php

?>
<div class="box box-primary attendance">
	<div class="box-header">
		Employee Types
		
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
					<?php foreach($employeeTypes as $type){ ?>
						<tr <?= ($type["id"]==decodeID($selectedType))?"class='bg-blue'":"" ?>>
							<td><?= $type['type'] ?></td>
							<td>
								<div class="btn-group col-centered" >
								  <button type="button" class="btn btn-xs btn-primary btn-outline dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu pull-right" role="menu">
									<li><a href="<?= site_url("eattendance/take") ?>/<?= encodeID($type["id"])?>">Take Attendance</a></li>
									<li><a href="<?= site_url("eattendance/old") ?>/<?= encodeID($type["id"])?>">Old Attendance</a></li>
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

