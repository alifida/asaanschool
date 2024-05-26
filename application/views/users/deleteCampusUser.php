		<form class="form-horizontal" action="<?= site_url('admin/deleteCampusUser') ?>" method="post">	
			<div class="col-centered">
				<div class="alert alert-warning">
			    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to <strong>DELETE</strong> the following User?                            
				</div>
			</div>
			<div class="row">
				<div class="<?= ($userCampus["user"]["userType"]['internal_key']=="employee" || $userCampus["user"]["userType"]['internal_key']=="admin")? "col-lg-8":"col-lg-12" ?>">
				 	<div class="box box-primary">
			            <div class="box-header">
								
						</div>
					            <!-- /.box-header -->
					        <div class="box-body">
				        		<div class="row">
					           		<div class="col-lg-3 col-md-3">
			           					<br/>
			           					<div class="row">
				           					<div  class="col-centered col-lg-9 col-md-9 col-sm-4 col-xs-4">
					           					<?php if(isset($userCampus["user"]["profile_picture"]) && !empty($userCampus["user"]["profile_picture"])){?>
	    	       							  		<img src='<?= $userCampus["user"]["profile_picture"] ?>' alt=''  class='img-circle circle_border max-100' />
	    	       							  	<?php } else{?>
	    	       							  		<img src='<?= site_url("public/images/user_avatar.jpg") ?>' alt=''  class='img-circle circle_border max-100' />
	    	       							  	<?php } ?>
			           					</div>
		           					</div>
			           					<br/><br/>
					           		</div>
					           		
		           					<div class="col-lg-8 col-md-8  col-sm-12  col-xs-12">
		           						<h4>Login Details</h4>
			           					<table class="table table-user-information ">
	                                    	<tbody>
	                                    		<tr>
		                                        	<td class="col-lg-4">Display Name:</td>
		                                        	<td><?= $userCampus["user"]["display_name"] ?></td>
		                                    	</tr>
		                                    	<tr>
		                                        	<td>User Type:</td>
		                                        	<td><?= $userCampus["user"]["userType"]["type"] ?></td>
		                                    	</tr>
		                                    	<tr>
		                                        	<td >Login Id:</td>
		                                        	<td><?= $userCampus["user"]["email"] ?></td>
		                                    	</tr>
		                                    	<tr>
		                                        	<td>Status:</td>
		                                        	<td><?= $userCampus["user"]["status"] ?></td>
		                                    	</tr>
		                                    
	                                    	</tbody>
	                                	</table>
	                                </div>
					           	</div>
	
				           	<?php if(isset($userCampus["user"]["contactDetail"]) && !empty($userCampus["user"]["contactDetail"])){
								$contactDetail = $userCampus["user"]["contactDetail"];
				           		?>	
				           		<div class="row">
				           			<div class="col-lg-3 col-md-3">
			           					
					           		</div>
					           	
		           					<div class="col-lg-8 col-md-8  col-sm-12  col-xs-12">
					           		
		           						<h4>Contact Details</h4>
			           					<table class="table table-user-information ">
	                                    	<tbody>
	                                    		<tr>
		                                        	<td  class="col-lg-4">Primary Email:</td>
		                                        	<td><?= $contactDetail["primary_email"] ?></td>
		                                    	</tr>
		                                    	<tr>
		                                        	<td  class="col-lg-4">Secondary Email:</td>
		                                        	<td><?= $contactDetail["secondary_email"] ?></td>
		                                    	</tr>
		                                    	<tr>
		                                        	<td  class="col-lg-4">Website:</td>
		                                        	<td><?= $contactDetail["website"] ?></td>
		                                    	</tr>
	                                    		<tr>
		                                        	<td  class="col-lg-4">Primary Phone:</td>
		                                        	<td><?= $contactDetail["primary_phone"] ?></td>
		                                    	</tr>
		                                    	<tr>
		                                        	<td  class="col-lg-4">Secondary Phone:</td>
		                                        	<td><?= $contactDetail["secondary_phone"] ?></td>
		                                    	</tr>
		                                    	<tr>
		                                        	<td  class="col-lg-4">Fax:</td>
		                                        	<td><?= $contactDetail["fax"] ?></td>
		                                    	</tr>
		                                    	<tr>
		                                        	<td  class="col-lg-4">City:</td>
		                                        	<td><?= $contactDetail["city"] ?></td>
		                                    	</tr>
		                                    	<tr>
		                                        	<td  class="col-lg-4">State:</td>
		                                        	<td><?= $contactDetail["state"] ?></td>
		                                    	</tr>
		                                    	<tr>
		                                        	<td  class="col-lg-4">Post Code:</td>
		                                        	<td><?= $contactDetail["post_code"] ?></td>
		                                    	</tr>
		                                    	<tr>
		                                        	<td  class="col-lg-4">Country:</td>
		                                        	<td><?= $contactDetail["country"] ?></td>
		                                    	</tr>
		                                    	<tr>
		                                        	<td  class="col-lg-4">Address:</td>
		                                        	<td><?= $contactDetail["address"] ?></td>
		                                    	</tr>
		                                    
	                                    	</tbody>
	                                	</table>
	                                </div>
				           		</div>
							<?php } ?>				           		
					           		
					        </div>  <!-- /.box-body -->
							<div class="box-footer">
								<br/>
							</div>
			        	</div>
					</div>
					<?php if($userCampus["user"]["userType"]['internal_key']=="employee" || $userCampus["user"]["userType"]['internal_key']=="admin"){?>
					<div class="col-lg-4">
						<div class="box box-primary">
				            <div class="box-header">
									User Modules
							</div>
							<div class="box-body">
								<div class="table-responsive">
									<table class="table table-hover" id="">
									<thead>
										<tr>
											<th>Module Name</th>
											<th width="10%"></th>
										</tr>
									</thead>
									<tbody>
										<?php if(isset($userCampus["user"]["userModules"]) && !empty($userCampus["user"]["userModules"])){ ?>
											<?php foreach($userCampus["user"]["userModules"] as $userModule){ ?>
												<tr>
													<td><?= ($userModule["campusModule"]["module"]['name'])? $userModule["campusModule"]["module"]['name'] :"" ?></td>
													<td></td>
												</tr>
											<?php } ?>
										<?php } ?>
									</tbody>
									</table>
								</div>
								
							</div>
							
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="col-centered">
			    	<button id="campus_user_delete" name="campus_user_delete" class="btn btn-danger">Yes (Delete)</button>
			  	</div>
				<input type="hidden" name="userId" id= "userId" value="<?= $userId ?>"/>
				</form>
			