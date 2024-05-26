<?php  ?>
<?php if(isset($transaction["employeeSalary"]) && !empty($transaction["employeeSalary"])) { ?>
<?php 
$multipleColums = false;
if(sizeof($transaction["employeeSalary"])>1){
	$multipleColums = true;
}

?>
	
	<?php foreach($transaction["employeeSalary"] as $key => $employeeSalary){?>
		<div class="<?=($multipleColums)? "col-lg-6":"col-lg-10 col-md-offset-1" ?>">
			<div  class="alert alert-warning">
				<div class="col-centered">
					<h4 class="">Related Employee</h4>
				</div>
				<div class="row">
					<div class="col-lg-10 col-md-offset-1">
						<table class="table table-hover" id="">
							<tr>
								<td >Name: </td>
								<td><strong><?= $employeeSalary["employee"]["first_name"]." ".$employeeSalary["employee"]["first_name"]	?></strong></td>
							</tr>
							<tr>
								<td>Citizen No: </td>
								<td><strong><?= $employeeSalary["employee"]["cnic"] ?></strong></td>
							</tr>
							<tr>
								<td>Employee No.: </td>
								<td><strong><?= $employeeSalary["employee"]["employee_no"] ?></strong></td>
							</tr>
							
						</table>
					</div>
				</div>
				<?php $this->load->view('profit/transaction_details/salary_detail',array("employeeSalary"=>$employeeSalary)); ?>
			</div>
		</div>
	<?php }?>
	
<?php }?>