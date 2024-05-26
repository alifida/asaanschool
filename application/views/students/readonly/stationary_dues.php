<?php // pre($studentDueItems); ?>
<div class="box box-danger">
	<div class="box-header">
		Stationary Dues
	</div>
	<div class="box-body">
	<div class="table-responsive">
		<table class="table  table-hover table-responsive dataTables">
			<thead>
				<tr>
					<th>Name</th>
					<th>Father Name</th>
					<th>Class & Roll No.</th>
					<th>Registration No</th>
					<th>Item</th>
					<th>Quantity</th>
					<th>Issue Date</th>
					<th>Dues</th>
					<th class="all disable-sort"></th>
				</tr>
			</thead>
			<tbody>
		<?php if(!empty($studentDueItems)){ ?>
			<?php foreach($studentDueItems as $key => $studentItem){ ?>
				<tr>
					<td><?= $studentItem["student"]['first_name'] ?> <?= $studentItem["student"]['last_name'] ?></td>
					<td><?= $studentItem["student"]['father_name'] ?></td>
					<td><?= $studentItem["student"]['class']['name'] ?> (<?= $studentItem["student"]['roll_no'] ?>)</td>
					<td><?= isset($studentItem["student"]['reg_no']) ? $studentItem["student"]['reg_no'] :"" ?></td>
					<td><?= $studentItem['item']['description'] ?></td>
					<td><?= $studentItem['issued_amount'] ?></td>
					<td><?= $studentItem['issue_date'] ?></td>
					<td><?= $studentItem['due_money'] ?> PKR</td>
					
					
					
					<td>
						<div class="btn-group col-centered" >
						  <button type="button" class="btn btn-outline btn-danger btn-xs dropdown-toggle " data-toggle="dropdown">
						    <span class="caret"></span> 
						  </button>
						  	<ul class="dropdown-menu pull-right" role="menu">
						  		<li><a href="<?= site_url("guardians/dependent") ?>/<?= encodeID($studentItem['student']['id']) ?>/<?= $studentItem['student']['slug'] ?>">Student Details </a></li>
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
