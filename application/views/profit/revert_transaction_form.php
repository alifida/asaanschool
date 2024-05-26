<?php ?>
	
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; 
	    	
	    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Are you sure to <strong>Revert</strong> the following open Transaction?                            
		</div>
	</div>
	<br/>
	<form class="form-horizontal" action="<?= site_url('profit/revertTransaction') ?>" method="post">
		<fieldset>
		<div class="col-lg-12 ">
			<div class="alert alert-success">
				<div class="row">
					<div class="col-centered">
						<h4 class="">Transaction</h4>
					</div>
					<div class="col-lg-6 col-md-offset-3">
						<table class="table table-hover " id="">
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
				<?php 	$internalKey = $orignalTransaction["type"]["internal_key"];?>
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
		<br/> 
		<!-- Button (Double) -->
		  	<div class="col-centered">
		    	<button id="revert_transaction" name="revert_transaction" class="btn btn-danger">Yes (Revert)</button>
		  	</div>
		</fieldset>
		<input id="is_confirmed" name="is_confirmed" type="hidden" value="yes">
		<input id="transaction_id" name="transaction_id" type="hidden" value="<?= $orignalTransaction["id"]?>">
	</form>
				
			