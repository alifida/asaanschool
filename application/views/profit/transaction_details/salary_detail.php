<?php
?>
<div  class="alert alert-danger">
	<div class="col-centered">
		<h4 class="">Salary Detail</h4>
	</div>
	<div class="row">
		<div class="col-lg-10 col-md-offset-1">
			<table class="table table-hover" id="">
				<tr>
					<td >Amount: </td>
					<td><strong><?= $employeeSalary["amount"] ?></strong></td>
				</tr>
				<tr>
					<td >Salary Month: </td>
					<td><strong><?= $employeeSalary["month"] ?></strong></td>
				</tr>
				<tr>
				<td >Comments: </td>
				<td><strong><?= $employeeSalary["comments"] ?></strong></td>
				</tr>
			</table>
		</div>
	</div>
</div>