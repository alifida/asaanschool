<?php
?>

<div class="box box-primary">
	<div class="box-header">All Employees</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="table-responsive">
			<table class="table  table-hover table-responsive dataTables" id="">
				<thead>
					<tr>
						<th>Name</th>
						<th>Type</th>
						<th>Email</th>
						<th>Qualification</th>
						<th>Joining Date</th>
						<th>Status</th>
						<th class="all disable-sort"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($allEmployees as $employee){ ?>
						<tr>
						<td><?= $employee['first_name'] ?> <?= $employee['last_name'] ?></td>
						<td><?= $employee['type']['type'] ?></td>
						<td><?= $employee['email'] ?></td>
						<td><?= $employee['qualification'] ?></td>
						<td><?= $employee['date_of_joining'] ?></td>
						<td><?= $employee['status'] ?></td>

						<td>
							<div class="btn-group col-centered">
								<button type="button" class="btn btn-xs btn-primary btn-outline dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu pull-right" role="menu">
									<li><a href="<?= site_url('employee/details')?>?id=<?= $employee['id'] ?>">Details</a></li>
									<li class="divider"></li>
									<li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('employee/editEmployee') ?>?id=<?= $employee['id'] ?>','Update Employee');">Edit</a></li>
									<li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('employee/changeStatusForm') ?>?id=<?= $employee['id'] ?>','Change Status');">Change Status</a></li>
									
									<?php if($employee["status"]==get_app_message("db.status.active")){ ?>
									<li class="divider"></li>
									<li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('employee/issueSalaryForm') ?>?id=<?= $employee['id'] ?>','Issue Salary');">Issue Salary</a></li>
									<?php } ?>
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

