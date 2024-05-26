<?php if(!empty($transaction["otherExpenses"])){ ?>
	<div class="col-lg-10 col-md-offset-1">
<?php foreach($transaction["otherExpenses"] as $key=>$expense){ ?>
		<div  class="alert alert-danger">
			<div class="row">
				<div class="col-centered">
					<h4 class="">Expense</h4>
				</div>
				<div class="row">
					<div class="col-lg-8 col-md-offset-2">
						<table class="table table-hover" id="" width="80%">
							<tr>
								<td width="40%">Type: </td>
								<td>
									<strong><?= $expense["type"]["type"] ?></strong>
								</td>
							</tr>
							<tr>
								<td width="40%">Description: </td>
								<td>
									<strong><?= $expense["description"] ?></strong>
								</td>
							</tr>
							<tr>
								<td width="40%">Amount: </td>
								<td>
									<strong><?= $expense["amount"] ?></strong>
								</td>
							</tr>
							<tr>
								<td width="40%">Expense Date: </td>
								<td>
									<strong><?= $expense["expense_date"] ?></strong>
								</td>
							</tr>
							<tr>
								<td width="40%">Comments: </td>
								<td>
									<strong><?= $expense["comments"] ?></strong>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
 		</div>
 <?php 		}	 ?>
 	</div>
<?php }	 ?>