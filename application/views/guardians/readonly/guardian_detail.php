<?php 
$guardian = array();
if(isset($guardianDetail["guardian"]) && !empty($guardianDetail["guardian"])){
	$guardian = $guardianDetail["guardian"];
}
?>

<div class="box box-success">
	<div class="box-header">
		Guardian Details
	</div>
	<div class="box-body">

		<table width="100%" style="min-height: 130px;">
			<tr>
				<td width="50%"><p>Name:</p></td>
				<td><p>
				<?php if(isset($guardian["name"])){?>
			  		<?=$guardian["name"] ?>
			  	<?php } ?>
					</p></td>
			</tr>

			<tr>
				<td><p>Gender:</p></td>
				<td><p>
				<?php if(isset($guardian["gender"])){?>
			  		<?=$guardian["gender"] ?>
			  	<?php } ?>
					</p></td>
			</tr>
			
			<tr>
				<td><p>Citizen No.:</p></td>
				<td><p>
				<?php if(isset($guardian["cnic"])){?>
			  		<?=$guardian["cnic"] ?>
			  	<?php } ?>
					</p></td>
			</tr>
			<tr>
				<td><p>Occupation: </p></td>
				<td><p>
				<?php if(isset($guardian["occupation"])){?>
			  		<?=$guardian["occupation"] ?>
			  	<?php } ?>
					</p></td>
			</tr>
			<tr>
				<td><p>Mobile: </p></td>
				<td><p>
				<?php if(isset($guardian["mobile"])){?>
			  		<?=$guardian["mobile"] ?>
			  	<?php } ?>
					</p></td>
			</tr>
			<tr>
				<td><p>Home Phone: </p></td>
				<td><p>
				<?php if(isset($guardian["home_phone"])){?>
			  		<?=$guardian["home_phone"] ?>
			  	<?php } ?>
					</p></td>
			</tr>
			<tr>
				<td><p>Work Phone: </p></td>
				<td><p>
				<?php if(isset($guardian["work_phone"])){?>
			  		<?=$guardian["work_phone"] ?>
			  	<?php } ?>
					</p></td>
			</tr>
			<tr>
				<td><p>Email: </p></td>
				<td><p>
				<?php if(isset($guardian["email"])){?>
			  		<?=$guardian["email"] ?>
			  	<?php } ?>
					</p></td>
			</tr>
			<tr>
				<td><p>Address: </p></td>
				<td><p>
				<?php if(isset($guardian["address"])){?>
			  		<?=$guardian["address"] ?>
			  	<?php } ?>
					</p></td>
			</tr>
		</table>
	</div>
</div>


