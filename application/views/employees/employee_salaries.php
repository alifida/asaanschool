<?php

?>

<div class="box box-primary">
	<div class="box-header">
		Salaries
		
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="table-responsive">
			<table class="table   table-hover table-responsive " id="employees_salaries">
				<thead>
					<tr>
						<th>Salary Date</th>
						<th>Amount</th>
						<th>Status</th>
						<th>Paid Date</th>
						<th>Comments</th>
						<th class="all disable-sort"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($employeeSalaries as $es){ ?>
						<tr>
							<td><?= $es['month'] ?> </td>
							<td><?= $es['amount'] ?> </td>
							<td><?= $es['payment_status'] ?> </td>
							<td><?= $es['paid_date'] ?> </td>
							<td><?= $es['comments'] ?> </td>
							<td>
								<div class="btn-group col-centered" >
								  <button type="button" class="btn btn-xs btn-primary btn-outline dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span> 
								  </button>
								  <ul class="dropdown-menu pull-right" role="menu">
									<li><a href="javascript:void(0);"
											onclick="load_remote_model('<?= site_url('employee/employeeSalaryDetails') ?>?id=<?= $es['id'] ?>','Salary Details');">Details</a></li>
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

