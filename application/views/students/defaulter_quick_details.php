<?php ?>



<div class="dropdown-menu pull-right row" role="menu" style="width: 280px">
	<div class="col-lg-12">
	
	
	<div class="user-header col-centered">
	<?php if(isset($student["student_picture"]) && !empty($student["student_picture"])){?>
		<img src='<?= $student["student_picture"] ?>' alt='' class='col-centered img-circle circle_border max-150' />
	<?php } else{?>
		<img src='<?= site_url("public/images/student_avatar.png") ?>' alt=''  class='col-centered img-circle circle_border max-150' />
	<?php } ?>

<br/>


		<h5 class="col-centered">
			<?= $student["first_name"]?>
			<?= $student["last_name"]?>
			<br />
		</h5>
		<h6 class="col-centered">
		<?= $student["class"]["name"]?> ( <?= $student["roll_no"]?> )
		</h6>
<br/>
	</div>
	
		
		
	
	
	<div class="box box-solid bg-light-blue">
		<div class="box-body">
			<table class="table table-user-information bg-light-blue" >
				<tbody>
					<tr>
						<td width="40%">Fee </td>
						<td><?= $totalDueFee ?></td>
					</tr>
					<tr>
						<td width="40%">Stationary </td>
						<td><?= $totalDueItems ?></td>
					</tr>
		
					
				</tbody></table>

	</div>
	<div class="box-footer bg-light-blue">
		<div class="row">
			<div class="col-lg-6"><b>Total Dues:</b></div>
			<div class="col-lg-5">
			<button type="button" class="btn btn-danger pull-right">
				<strong><span ><?= $totalDueFee + $totalDueItems ?></span>  PKR</strong>
              </button>
			</div>
		</div>
	</div>
	
</div>
	</div>

</div>












