<?php ?>
<div class="col-lg-10 col-md-offset-1">
	<div class="alert alert-success">
		<div class="row">
			<div class="col-centered">
				<h4 class="">Orignal Transaction</h4>
			</div>
			<div class="col-lg-6 col-md-offset-3">
				<table class="table table-hover" id="">
					<tr>
						<td>Transaction Type: </td>
						<td>
							<strong>
							<?=	(isset($orignalTransaction["type"]))? $orignalTransaction["type"]["type"]:"" ?>	
							 </strong>
						</td>
					</tr>
					<tr>
						<td>Amount: </td>
						<td>
							<strong>
						<?=	(isset($orignalTransaction["amount"]))? $orignalTransaction["amount"]:"" ?>	
							 </strong>
						</td>
					</tr>
					<?php if(!empty($orignalTransaction["status"])){?>
					<tr>
						<td>Status: </td>
						<td>
							<button type="button" class="btn btn-danger"><?= $orignalTransaction["status"]?></button>
						</td>
					</tr>
					<?php } ?>
				</table>
			</div>
		<?php if(isset($orignalTransaction["type"]["internal_key"]) && !empty($orignalTransaction["type"]["internal_key"])){ ?>
		<?php $internalKey = $orignalTransaction["type"]["internal_key"];?>
		<?php if($internalKey == "student.dues.clearance"){
				$this->load->view('profit/transaction_details/student_detail',array("transaction"=>$orignalTransaction)); 
			 }elseif($internalKey == "employee.salaries" ){
				$this->load->view('profit/transaction_details/employee_detail',array("transaction"=>$orignalTransaction));
			 }elseif($internalKey == "other.expenses"){
				$this->load->view('profit/transaction_details/expense_detail',array("transaction"=>$orignalTransaction));
			 }
		   
		} ?>
		</div>
	</div>
</div>