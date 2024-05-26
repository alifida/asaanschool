<?php

?>

<div class="box box-primary">
	<div class="box-header">
		Current Employees
		<div class="pull-right " >
			<div class="btn-group ">
				<a href="javascript:void(0);" class="btn btn-outline btn-default btn-xs" onclick="load_remote_model('<?= site_url('employee/issueSalaryForm') ?>','Issue Salary');">Issue Salaries</a>
			</div>
			<div class="btn-group ">
				<button type="button" onclick="load_remote_model('<?= site_url('employee/editEmployee') ?>','Create Employee');enlarge_remote_model();" 
					class="btn btn-outline btn-default btn-xs">New Employee</button>
			</div>
			
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="table-responsive">
			<table class="table table-hover simpleDataTables " id="">
				<thead>
					<tr>
						<th>Name</th>
						<th>Type</th>
						<th>Email</th>
						<th>Qualification</th>
						<th>Joining Date</th>
						<th class="all disable-sort"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($activeEmployees as $employee){ ?>
						<tr>
							<td><?= $employee['first_name'] ?> <?= $employee['last_name'] ?></td>
							<td><?= $employee['type']['type'] ?></td>
							<td><?= $employee['email'] ?></td>
							<td><?= $employee['qualification'] ?></td>
							<td><?= $employee['date_of_joining'] ?></td>
							
							<td>
								<div class="btn-group col-centered" >
								  <button type="button" class="btn btn-xs btn-primary btn-outline dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span> 
								  </button>
								  <ul class="dropdown-menu pull-right" role="menu">
								  <li><a href="<?= site_url('employee/details')?>?id=<?= $employee['id'] ?>" >Details</a></li>
								  <li class="divider"></li>
									<li><a href="javascript:void(0);" 
										onclick="load_remote_model('<?= site_url('employee/editEmployee') ?>?id=<?= $employee['id'] ?>','Update Employee');enlarge_remote_model();">Edit</a></li>
									<li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('employee/issueSalaryForm') ?>?id=<?= $employee['id'] ?>','Issue Salary');">Issue Salary</a></li>
									<?php if(isset($certificates) && !empty($certificates)){?>
								    	<li>
											<a class="trigger left-caret">Certificates</a>
											<ul class="dropdown-menu sub-menu sub-menu-left">
											<?php foreach ($certificates as $certificate){ ?>
												<li><a href="<?= site_url('certificate/printCertificate/'.encodeID($certificate["id"]).'/'.encodeID($employee['id'])) ?>" target="_blank" ><?= $certificate["name"] ?></a></li>
											<?php } ?>
											</ul>
										</li>
								    <?php }?>
									<li class="divider"></li>
									<li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('employee/unrollEmployeeForm') ?>?id=<?= $employee['id'] ?>','Unroll Employee');">Unroll</a></li>
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
                
