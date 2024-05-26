<?php ?>

<section class="content-header">
<h1>Profile</h1>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
	<div class="col-lg-12">
		<div class="box box-primary">
			<div class="box-header">
				<div class="pull-right ">
					<div class="btn-group ">
						<button type="button"
							onclick="load_remote_model('<?= site_url("user/changePasswordForm") ?>','Change Password');"
							class="btn  btn-danger btn-xs">Change Password</button>
					</div>
					<a href="<?= site_url("profile/edit") ?>"
						class="btn btn-xs btn-primary">Update Profile</a>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="row">
					

					<div class="col-lg-7 col-md-7  col-sm-10  col-xs-10                  col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
						<h4>Login Details</h4>
						<table class="table table-user-information ">
							<tbody>
								<tr>
									<td class="col-lg-4">Display Name:</td>
									<td><?= $_SESSION["sessionUser"]["display_name"] ?></td>
								</tr>
								<tr>
									<td>User Type:</td>
									<td><?= $_SESSION["sessionUser"]["user_type"]["type"] ?></td>
								</tr>
								<tr>
									<td>Login Id:</td>
									<td><?= $_SESSION["sessionUser"]["email"] ?></td>
								</tr>
								<tr>
									<td>Status:</td>
									<td><?= $_SESSION["sessionUser"]["status"] ?></td>
								</tr>

							</tbody>
						</table>
					</div>
					<div class="col-lg-3 col-md-3">
						<br />
						<div class="row">
							<div class="col-centered col-lg-9 col-md-9 col-sm-4 col-xs-4">
							<?php if(isset($_SESSION["sessionUser"]["profile_picture"]) && !empty($_SESSION["sessionUser"]["profile_picture"])){?>
								<img src='<?= $_SESSION["sessionUser"]["profile_picture"] ?>'
									alt='' class='img-circle circle_border max-100' />
									<?php } else{?>
								<img src='<?= site_url("public/images/user_avatar.jpg") ?>'
									alt='' class='img-circle circle_border max-100' />
									<?php } ?>
							</div>
						</div>
						<br /> <br />
					</div>
					<div class="col-lg-12 col-md-12  col-sm-12  col-xs-12">
					<?php if(isset($contactDetail) && !empty($contactDetail)){
						$data = array();
						$data["contactDetail"] = $contactDetail;

						$this->load->view('contactDetail/contactDetail',$data);  } ?>
					</div>
				</div>

			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<br />
			</div>
		</div>
	</div>
</div>
</section>
