<?php //pre($studentDueFee); ?>
<div class="box box-danger">
	<div class="box-header">
		Fee Dues
		
	</div>
	<div class="box-body">
	<div class="table-responsive">
		<table class="table  table-hover table-responsive dataTables">
			<thead>
				<tr>
					<th>Name</th>
					<th>Father Name</th>
					<th>Class & Roll No.</th>
					<th>Registration No.</th>
					<th>Type</th>
					<th>Fee Date</th>
					<th>Amount</th>
					<th class="all disable-sort"></th>
				</tr>
			</thead>
			<tbody>
		<?php if(!empty($studentDueFee)){ ?>
			<?php foreach($studentDueFee as $key => $studentfee){ ?>
				<tr>
					<td><?= $studentfee["student"]['first_name'] ?> <?= $studentfee["student"]['last_name'] ?></td>
					<td><?= $studentfee["student"]['father_name'] ?></td>
					<td><?= $studentfee["student"]['class']['name'] ?> (<?= $studentfee["student"]['roll_no'] ?>)</td>
					<td><?= isset($studentfee["student"]['reg_no']) ? $studentfee["student"]['reg_no'] :"" ?></td>
					<td><?= $studentfee['fee_type']['type'] ?></td>
					<td><?= date("Y",strtotime($studentfee['fee_date']))  ?>-<?= date("m",strtotime($studentfee['fee_date'])) ?></td>
					<td><?= $studentfee['amount'] ?> PKR</td>
					
					<td>
						<div class="btn-group col-centered" >
						  <button type="button" class="btn btn-outline btn-danger btn-xs dropdown-toggle " data-toggle="dropdown">
						    <span class="caret"></span> 
						  </button>
						  	<ul class="dropdown-menu pull-right" role="menu">
						  		<li><a href="<?= site_url("guardians/dependent") ?>/<?= encodeID($studentfee['student']['id']) ?>/<?= $studentfee['student']['slug'] ?>">Student Details </a></li>
						    
						  	</ul>
							</div>
						</td>
					</tr>
					<?php } ?>
				<?php } ?>
				
				</tbody>
			</table>
		</div>
	</div>
</div>
