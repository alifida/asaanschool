<?php ?>



<div class="box box-warning dragable">
	<div class="box-header draghandle">
		Parameters
		<div class="pull-right box-tools">
			<button class="btn btn-warning btn-xs" data-widget="collapse">
				<i class="fa fa-minus"></i>
			</button>
		</div>
	</div>
	<div class="box-body">
		<div class="row">

			<div class="col-centered" style="max-width: 90%;">
				<div class="alert alert-warning">
					<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Following are the Parameters that are mapped with Students/Employees.
				</div>
			</div>
			
			<div class="col-lg-12  params_container" id="student_params">

			<?php if(isset($studentParams) && !empty($studentParams)){?>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Short Code</th>
						</tr>
					</thead>
				<?php foreach ($studentParams as $stParam){?>
					<tr>
						<td><?= $stParam["name"] ?></td>
						<td><?= $stParam["short_code"] ?></td>
					</tr>
				<?php }?>
				</table>
			<?php }?>
			</div>
			<div class="col-lg-10 col-lg-offset-1 params_container" id="employee_params">

			<?php if(isset($employeeParams) && !empty($employeeParams)){?>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Short Code</th>
						</tr>
					</thead>
				<?php foreach ($employeeParams as $empParam){?>
					<tr>
						<td><?= $empParam["name"] ?></td>
						<td><?= $empParam["short_code"] ?></td>
					</tr>
				<?php }?>
				</table>
			<?php }?>
			</div>
		</div>
	</div>
</div>

