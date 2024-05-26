<?php  ?>
	
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to <strong>Revert</strong> the following students Fee?                            
		</div>
	</div>
	<br/>
	<form class="form-horizontal" action="<?= site_url("student/revertStudentFee");?>" method="post" >
		<fieldset>
			
			<div class="col-centered">
				<table class="table table-hover" id="">
					<tr>
						<td>Fee Type</td>
						<td><?= (isset($studentFee["fee_type"]["type"]))? $studentFee["fee_type"]["type"] :"" ?></td>
					</tr>
					<tr>
						<td>Fee Date</td>
						<td><?= (isset($studentFee["fee_date"]))? $studentFee["fee_date"] :"" ?></td>
					</tr>
					<tr>
						<td>Status</td>
						<td><?= (isset($studentFee["payment_status"]))? $studentFee["payment_status"] :"" ?></td>
					</tr>
					<?php if(isset($studentFee["paid_date"]) && !empty($studentFee["paid_date"])){ ?>
						<tr>
							<td>Paid Date</td>
							<td><?= $studentFee["paid_date"] ?></td>
						</tr>
					<?php } ?>
					<?php if(isset($studentFee["paid_by"]) && !empty($studentFee["paid_by"])){ ?>
						<tr>
							<td>Paid by</td>
							<td><?= $studentFee["paid_by"] ?></td>
						</tr>
					<?php } ?>
					<tr>
						<td>Amount</td>
						<td><?= (isset($studentFee["amount"]))? $studentFee["amount"] :"" ?></td>
					</tr>
					<tr>
						<td>Comments</td>
						<td><?= (isset($studentFee["comments"]))? $studentFee["comments"] :"" ?></td>
					</tr>
				</table>
				
			
			</div>
			
				
		
		<br/> 
		<!-- Button (Double) -->
		  	<div class="col-centered">
		    	<button id="revert_fee_delete" name="revert_fee_delete" class="btn btn-danger">Yes (Revert)</button>
		  	</div>
		</fieldset>
		<input id="student_fee_id" name="student_fee_id" type="hidden" 
			<?php if(isset($studentFee["id"])){ ?>
		 		value="<?= $studentFee["id"] ?>"
		 	<?php } ?>
		 	>
		
		 <?php

		 ?>
	</form>
				
			