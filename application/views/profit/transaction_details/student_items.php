<?php 
	$twoColumns=false;
	if(!empty($transaction["studentFee"]) && !empty($transaction["studentItems"])){ 
		$twoColumns=true;?> 
<?php }?>
<?php if(!empty($transaction["studentItems"])){ ?>
	<div class="<?= ($twoColumns)?"col-lg-6 pull-right":"col-lg-10 col-md-offset-1" ?>">
	 <?php foreach($transaction["studentItems"] as $key=>$studentItem){ ?>
		<div  class="alert alert-info">
			<div class="col-centered">
				<h4 class="">Related Items</h4>
			</div>
			<div class="row">
				<div class="<?= ($twoColumns)?"col-lg-10 col-md-offset-1":"col-lg-8 col-md-offset-2" ?>">
					<table class="table table-hover" id="">
						<tr>
							<td  width="40%">Item Type: </td>
							<td>
								<strong>
								<?= $studentItem["item"]["type"]["name"]	?>	
								 </strong>
							</td>
						</tr>
						<tr>
							<td>Description: </td>
							<td>
								<strong>
								<?= $studentItem["item"]["description"]	?>	
								 </strong>
							</td>
						</tr>
						<tr>
							<td>Issued Date: </td>
							<td>
								<strong>
												<?= $studentItem["issue_date"]	?>	
								 </strong>
							</td>
						</tr>
						<tr>
							<td>Items Issued: </td>
							<td>
								<strong>
								<?= $studentItem["issued_amount"]	?>	
								 </strong>
							</td>
						</tr>
						<tr>
							<td>Amount: </td>
							<td>
								<strong>
								<?= $studentItem["due_money"]	?>	
								 </strong>
							</td>
						</tr>
						<tr>
							<td>Paid by: </td>
							<td>
								<strong>
								<?= $studentItem["paid_by"]	?>	
								 </strong>
							</td>
						</tr>
						<tr>
							<td>Comments: </td>
							<td>
								<strong>
								<?= $studentItem["comments"]	?>	
								 </strong>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
 <?php }?>
	</div>
 <?php }?>
														 