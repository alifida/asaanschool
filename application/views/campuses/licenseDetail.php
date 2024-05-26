<?php 
if(isset($campusCurrentPackage) && !empty($campusCurrentPackage)){ ?>
		
<div class="box box-success">
	<div class="box-header">
		License Detail
		<div class="pull-right " >
		 	<div class="btn-group ">
				<div class="btn-group ">
				<?php if ($_SESSION['sessionUser']['user_type']['internal_key'] == "application_admin") { ?>
		              	<button type="button" onclick="load_remote_model('<?= site_url('appadmin/choosePackage') ?>','Change Package');" 
		              		class="btn btn-outline btn-default btn-xs">Change Package</button>
		         <?php }elseif ($_SESSION['sessionUser']['user_type']['internal_key'] == "admin" && $campusCurrentPackage["package"]["name"] == get_app_message("db.status.trail")) { ?>
		         		<button type="button" onclick="load_remote_model('<?= site_url('admin/activiateAccountForm') ?>','Activate Account');" 
		              		class="btn btn-outline btn-default btn-xs">Activate Account</button>
		         <?php }elseif ($_SESSION['sessionUser']['user_type']['internal_key'] == "admin" ) { ?>
		         		<button type="button" onclick="load_remote_model('<?= site_url('admin/packageChangeRequestForm') ?>','Change Package');" 
		              		class="btn btn-outline btn-default btn-xs">Change Package</button>
		         <?php }?>
	            </div>
			</div>
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="table-responsive">
			<table class="table table-user-information ">
				<tbody>
					<tr>
						<td class="col-lg-4">
							Package Name: 
						</td>
						<td>
							<?= $campusCurrentPackage["package"]["name"] ?>
						</td>
					</tr>
					<tr>
						<td class="col-lg-4">
							Price: 
						</td>
						<td>
							<?= $campusCurrentPackage["package"]["price"]["price"] ?> <?= $campusCurrentPackage["package"]["price"]["currency"] ?>
						</td>
					</tr>
					<tr>
						<td class="col-lg-4">
							Description: 
						</td>
						<td>
							<?= $campusCurrentPackage["package"]["description"] ?>
						</td>
					</tr>
					<tr>
						<td class="col-lg-4">
							Package Date: 
						</td>
						<td>
							<?= $campusCurrentPackage["start_date"] ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php 
 } ?>