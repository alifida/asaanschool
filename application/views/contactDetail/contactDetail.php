<?php if(isset($contactDetail) && !empty($contactDetail)){ ?>
		<div class="row">
			
			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
				<h4>Contact Details</h4>
				<table class="table table-user-information ">
				<tbody>
				<tr>
					<td class="col-lg-4">
						Primary Email:
					</td>
					<td>
						<?= $contactDetail["primary_email"] ?>
					</td>
				</tr>
				<tr>
					<td class="col-lg-4">
						Secondary Email:
					</td>
					<td>
						<?= $contactDetail["secondary_email"] ?>
					</td>
				</tr>
				<tr>
					<td class="col-lg-4">
						Website:
					</td>
					<td>
						<?= $contactDetail["website"] ?>
					</td>
				</tr>
				<tr>
					<td class="col-lg-4">
						Primary Phone:
					</td>
					<td>
						<?= $contactDetail["primary_phone"] ?>
					</td>
				</tr>
				<tr>
					<td class="col-lg-4">
						Secondary Phone:
					</td>
					<td>
						<?= $contactDetail["secondary_phone"] ?>
					</td>
				</tr>
				<tr>
					<td class="col-lg-4">
						Fax:
					</td>
					<td>
						<?= $contactDetail["fax"] ?>
					</td>
				</tr>
				<tr>
					<td class="col-lg-4">
						City:
					</td>
					<td>
						<?= $contactDetail["city"] ?>
					</td>
				</tr>
				<tr>
					<td class="col-lg-4">
						State:
					</td>
					<td>
						<?= $contactDetail["state"] ?>
					</td>
				</tr>
				<tr>
					<td class="col-lg-4">
						Post Code:
					</td>
					<td>
						<?= $contactDetail["post_code"] ?>
					</td>
				</tr>
				<tr>
					<td class="col-lg-4">
						Country:
					</td>
					<td>
						<?= $contactDetail["country"] ?>
					</td>
				</tr>
				<tr>
					<td class="col-lg-4">
						Address:
					</td>
					<td>
						<?= $contactDetail["address"] ?>
					</td>
				</tr>
				</tbody>
				</table>
			</div>
			
		</div>
		<?php } ?>