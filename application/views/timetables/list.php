<?php // pre_d($timetables);
?>


<div class="box box-danger">
	<div class="box-header">
		Time Tables
		<div class="pull-right  col-centered">
			<div class="btn-group  col-centered">
				<button type="button"
					class="btn btn-outline btn-default btn-xs dropdown-toggle "
					data-toggle="dropdown">
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu pull-right" role="menu">
					<li><a href="javascript:void(0);"
						onclick="load_remote_model('<?= site_url('timetable/edit') ?>','Create timetable');">Create New</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="table  table-hover table-responsive dataTables">
			<table class="table table-hover" id="">
				<thead>
					<tr>
						<th>Class</th>
						<th>Subject</th>
						<th>Start Time</th>
						<th>End Time</th>
						<th>Week Day</th>
						<th>Status</th>
						

						<th width="10%"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($timetables as $timetable){ ?>
							<tr>				 
						<td><?= $timetable['subject']['class']['name'] ?></td>
						<td><?= $timetable['subject']['name'] ?></td>
						<td><?= $timetable['start_time'] ?></td>
						<td><?= $timetable['end_time'] ?></td>
						<td><?= $timetable['week_day'] ?></td>
						<td><?= $timetable['status'] ?></td>
						


						<td>
							<div class="btn-group">
								<button type="button"
									class="btn btn-xs btn-danger btn-outline dropdown-toggle"
									data-toggle="dropdown">
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu pull-right" role="menu">

									<li><a href="javascript:void(0);"
										onclick="load_remote_model('<?= site_url('timetable/edit') ?>/<?= $timetable['id'] ?>','Update Timetable');">Edit</a></li>
									<li><a href="javascript:void(0);"
										onclick="load_remote_model('<?= site_url('timetable/detail') ?>/<?= $timetable['id'] ?>','Detail');">Detail</a></li>
									<li><a href="javascript:void(0);"
										onclick="load_remote_model('<?= site_url('timetable/deleteConfirmation') ?>?id=<?= $timetable['id'] ?>','Delete Timetable');">Delete</a></li>


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

