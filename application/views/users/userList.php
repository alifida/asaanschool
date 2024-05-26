<?php

?>
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<div class="box box-warning">
			<div class="box-header">
				Users
				<div class="pull-right " >
			         <div class="btn-group  col-centered">
			         	<a href="javascript:void(0);" class="btn btn-outline btn-warning btn-xs" 
										onclick="load_remote_model('<?= site_url('admin/createUserForm') ?>','Create New User');enlarge_remote_model();">New User</a>
			              
		            </div>
			    </div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			
				<div class="table-responsive">
					<table class="table table-hover simpleDataTables" id="">
						<thead>
							<tr>
								<th>Display Name</th>
								<th>Email</th>
								<th>Status</th>
								<th>Type</th>
								<th class="all disable-sort"  width="10%"></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($campusUsers as $user){ ?>
								<tr>
									<td><?= $user["user"]["display_name"] ?></td>
									<td><?= $user["user"]["email"] ?></td>
									<td>
										<span class="btn btn-xs <?= ($user["user"]["status"] == get_app_message("db.status.active"))?"bg-green":"bg-red" ?> ">
											<?= $user["user"]["status"] ?>
										</span>
									</td>
									<td><?= $user["user"]["userType"]["type"] ?></td>
									
									<td>
										<div class="btn-group col-centered" >
										  <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
											<span class="caret"></span> 
										  </button>
										  <ul class="dropdown-menu pull-right" role="menu">
											<li><a href="<?= site_url("admin/viewUser") ?>/<?= encodeID($user["user"]["id"]) ?>">Detail</a></li>
											<?php if($user["user"]["userType"]['internal_key']!="admin"){?>
											<?php if($user["user"]["userType"]['internal_key']=="employee"){?>
												<li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('admin/editUserForm') ?>/<?= encodeID($user["user"]["id"]) ?>','Update User');enlarge_remote_model();">Edit</a></li>
											<?php }?>
											
											<li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('admin/deleteUserForm') ?>/<?= encodeID($user["user"]["id"]) ?>','Delete User');enlarge_remote_model();">Delete</a></li>
											<?php }?>
										  </ul>
										</div>
										
									</td>
								</tr>
								<?php } ?>
							</tbody>
					</table>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
 		
