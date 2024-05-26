<?php $twoColumns=false;
	if(!empty($transaction["studentFee"]) && !empty($transaction["studentItems"])){ 
 		$twoColumns=true;?> 
<?php }?>

<?php if(!empty($transaction["studentFee"])){ ?>
	<div class="<?= ($twoColumns)?"col-lg-6 pull-left":"col-lg-10 col-md-offset-1" ?>">
<?php foreach($transaction["studentFee"] as $key=>$studentFee){ ?>
		<div  class="alert alert-success">
			<div class="col-centered">
				<h4 class="">Related Fee</h4>
			</div>
			<div class="row">
				<div class="<?= ($twoColumns)?"col-lg-10 col-md-offset-1":"col-lg-8 col-md-offset-2" ?>">
					<table class="table table-hover" >
						<tr>
							<td width="40%">Fee Type: </td>
							<td>
								<strong><?= $studentFee["fee_type"]["type"]	?></strong>
							</td>
						</tr>
						<tr>
							<td>Amount: </td>
							<td>
								<strong>
								<?= $studentFee["amount"]	?>	
								 </strong>
							</td>
						</tr>
						<tr>
							<td>Fee Date: </td>
							<td>
								<strong>
								<?= $studentFee["fee_date"]	?>	
								 </strong>
							</td>
						</tr>
						<tr>
							<td>Paid By: </td>
							<td>
								<strong>
								<?= $studentFee["paid_by"]	?>	
								 </strong>
							</td>
						</tr>
						<tr>
							<td>Comments: </td>
							<td><strong><?= $studentFee["comments"]	?></strong></td>
						</tr>
						</table>
					</div>
				</div>
 			</div>
 <?php 		}	 ?>
 			</div>
<?php }	 ?>
														 