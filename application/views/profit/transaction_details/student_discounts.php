<?php if(!empty($transaction["studentDiscounts"])){ ?>

	<div class="col-lg-10 col-md-offset-1">
<?php foreach($transaction["studentDiscounts"] as $key=>$discount){ ?>
		<div  class="alert alert-danger">
			<div class="row">
				<div class="col-centered">
					<h4 class="">Discount</h4>
				</div>
				<div class="row">
					<div class="col-lg-8 col-md-offset-2">
						<table class="table table-hover" id="" width="80%">
							<tr>
								<td width="40%">Total Dues: </td>
								<td>
									<strong><?= $discount["orignal_amount"] + $discount["discount_amount"] ?></strong>
								</td>
							</tr>
							<tr>
								<td width="40%">Discount: </td>
								<td>
									<strong><?= $discount["discount_amount"] ?></strong>
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