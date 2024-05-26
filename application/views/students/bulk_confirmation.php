<?php ?>
<div class="row">
	<div class="col-lg-12">






		<div class="box box-danger">
			<div class="box-header"></div>

			<!-- /.box-header -->
			<div class="box-body">
				<?php if(isset($defaulters) && !empty($defaulters)){?>
				
				<form class="form-horizontal"
					action="<?= site_url('student/process_bulk_clearance') ?>" method="post">
					<fieldset>
						<div class="col-centered">
							<div class="alert alert-warning">
								<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp;
								Are you sure to <strong>PROCESS</strong> the following Dues?
							</div>
						</div>
						<br />
						<div class="table-responsive">
							<table
								class="table  table-hover table-responsive noPaginationDataTables"
								id="">
								<thead>
									<tr>
										<th>Name</th>
										<th>Father Name</th>
										<th>Registration No</th>
										<th>Class (Roll No)</th>
										<th>Dues</th>

									</tr>
								</thead>
								<tbody>
<?php

foreach ($defaulters as $student) {
    
    $totalDueFee = 0;
    $totalDueItems = 0;
    
    if (isset($student["dueFee"])) {
        foreach ($student["dueFee"] as $dueFee) {
            $totalDueFee += $dueFee["amount"];
        }
    }
    if (isset($student["dueItem"])) {
        foreach ($student["dueItem"] as $dueItem) {
            $totalDueItems += $dueItem["due_money"];
        }
    }
    
    $defaulterData = array();
    $defaulterData["student"] = $student;
    $defaulterData["totalDueFee"] = $totalDueFee;
    $defaulterData["totalDueItems"] = $totalDueItems;
    
    ?>
									<tr>
										<td><?= $student['first_name'] ?> <?= $student['last_name'] ?></td>
										<td><?= $student['father_name'] ?></td>
										<td><?= isset($student['reg_no']) ? $student['reg_no'] :"" ?></td>
										<td><?= $student["class"]['name'] ?> (<?= $student['roll_no'] ?>)</td>
										<td>
											<div class="btn-group col-centered" style="width: 100% !important">
												<button class="btn btn-xs btn-outline btn-block btn-warning dropdown-toggle" data-toggle="dropdown"><?= $totalDueFee + $totalDueItems ?></button>
												<?php $this->load->view('students/defaulter_quick_details', $defaulterData); ?>
											</div>
										</td>
									</tr>
<?php } ?>
								</tbody>
							</table>
						</div>
					</fieldset>
					<div class="col-centered">
						<button class="btn btn-danger">Yes (Process)</button>
					</div>
					<input type="hidden" name="sids" value="<?= (isset($studentIds))? $studentIds : "" ?>" />
				</form>
				<?php }else{?>
				<div class="row">
					<div class="col-lg-12">
						<div class="col-centered">
							<div class="alert alert-warning">
								<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp;
								Nothing to process. Kindly select at least one record to process.
							</div>
						</div>		
					</div>
				</div>
				<?php }?>
			</div>
			<!-- /.box-body -->
		</div>
	</div>
</div>