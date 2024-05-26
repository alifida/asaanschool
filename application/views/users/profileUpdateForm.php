<?php ?>

		<div class="box box-primary">
            <div class="box-header">Profile 
				<div class="pull-right " >
					<div class="btn-group ">
						<button type="button" onclick="load_remote_model('<?= site_url("user/changePasswordForm") ?>','Change Password');"   
							class="btn  btn-danger btn-xs">Change Password</button> 
					</div>
				</div>		
			</div>
		            <!-- /.box-header -->
		        <div class="box-body">
	        		<div class="row">
           					<br/>
	        			<div class="col-lg-1 col-md-1"></div>
		           		<div class="col-lg-3 col-md-3">
           					<br/>
           					<div  class="col-centered">
           						<div class="row">
    	       						<div id="profile_pic_container" class="col-centered col-lg-10 col-md-10 col-sm-10 col-xs-10">
    	       							  <?php if(isset($_SESSION["sessionUser"]["profile_picture"]) && !empty($_SESSION["sessionUser"]["profile_picture"])){?>
    	       							  		<img src='<?= $_SESSION["sessionUser"]["profile_picture"] ?>' alt=''  class='img-circle circle_border max-100' />
    	       							  <?php } else{?>
    	       							  	<img src='<?= site_url("public/images/user_avatar.jpg") ?>' alt=''  class='img-circle circle_border max-100' />
    	       							  <?php } ?>
    	       						</div>
	    	       						<br/>
           								
           							<div class="col-centered">
			           					<span class="btn btn-primary btn-file">Browse
					    	       			<input type="file" id="browse_file" name="profilePic"
			    		       				onchange="ajax_file_submit('<?= site_url('fileupload/uploadProfilePic')?>', 'profile_pic_container', 'profile_pic_path')" />
										</span>
	           						</div>
	           								
           						</div>
           					</div>
           					<br/>
           					<br/>
	           			</div>
				           				
           				<div class="col-lg-8 col-md-8  col-sm-12  col-xs-12">
	           						
	           					<form role="form" class="form-horizontal" action="<?= site_url('profile/save')?>" method="post" id="profile_update_form">
									<fieldset>
									<div class="container-fluid">	
										<div class="row">
											<div class="form-group">
											  	<label class="col-md-4 control-label" for="display_name">Display Name</label>  
											  	<div class="col-md-6">
											  		<input id="display_name" name="display_name" type="text" placeholder="Display Name" class="form-control input-md" required="required" 
													  <?php if(isset($_SESSION["sessionUser"]["display_name"])){?>
													  		value="<?= $_SESSION["sessionUser"]["display_name"] ?>"
													  	<?php } ?>
													  />
											    
											  	</div>
											</div>
											
											<div class="form-group">
											  	<label class="col-md-4 control-label" for="primary_email">Primary Email</label>  
											  	<div class="col-md-5">
											  		<input id="" name="" readonly="readonly" type="text" placeholder="" class="form-control input-md" required="required" 
													  <?php if(isset($contactDetail["primary_email"])){?>
													  		value="<?= $contactDetail["primary_email"] ?>"
													  	<?php } ?>
													  />
											    
											  	</div>
											  	<div class="col-md-1">
											  		<a href="javascript:void(0);" tabindex="0" class="btn btn-sm btn-info  " role="button" data-toggle="popover" data-trigger="focus" 
											  		title="" data-content="<?= get_app_message("help.cannot.update.primaryemail") ?>"><span  class="glyphicon glyphicon-info-sign"></span></a>
											  	</div>
											</div>
											
											<div class="form-group">
											  	<label class="col-md-4 control-label" for="secondary_email">Secondary Email</label>  
											  	<div class="col-md-6">
											  		<input id="secondary_email" name="secondary_email" type="text" placeholder="Secondary Email" class="form-control input-md" 
													  <?php if(isset($contactDetail["secondary_email"])){?>
													  		value="<?= $contactDetail["secondary_email"] ?>"
													  	<?php } ?>
													  />
											    
											  	</div>
											</div>
											
											<div class="form-group">
											  	<label class="col-md-4 control-label" for="website">Website</label>  
											  	<div class="col-md-6">
											  		<input id="website" name="website" type="text" placeholder="Website" class="form-control input-md" 
													  <?php if(isset($contactDetail["website"])){?>
													  		value="<?= $contactDetail["website"] ?>"
													  	<?php } ?>
													  />
											    
											  	</div>
											</div>
											
											
											<div class="form-group">
											  	<label class="col-md-4 control-label" for="primary_phone">Primary Phone</label>  
											  	<div class="col-md-6">
											  		<input id="primary_phone" name="primary_phone" type="text" placeholder="Primary Phone" class="form-control input-md" required="required" 
													  <?php if(isset($contactDetail["primary_phone"])){?>
													  		value="<?= $contactDetail["primary_phone"] ?>"
													  	<?php } ?>
													  />
											  	</div>
											</div>
											
											<div class="form-group">
											  	<label class="col-md-4 control-label" for="secondary_phone">Secondary Phone</label>  
											  	<div class="col-md-6">
											  		<input id="secondary_phone" name="secondary_phone" type="text" placeholder="Secondary Phone" class="form-control input-md" 
													  <?php if(isset($contactDetail["secondary_phone"])){?>
													  		value="<?= $contactDetail["secondary_phone"] ?>"
													  	<?php } ?>
													  />
											  	</div>
											</div>
											
											
											<div class="form-group">
											  	<label class="col-md-4 control-label" for="fax">Fax</label>  
											  	<div class="col-md-6">
											  		<input id="fax" name="fax" type="text" placeholder="Fax" class="form-control input-md" 
													  <?php if(isset($contactDetail["fax"])){?>
													  		value="<?= $contactDetail["fax"] ?>"
													  	<?php } ?>
													  />
											  	</div>
											</div>
											
											<div class="form-group">
											  	<label class="col-md-4 control-label" for="city">City</label>  
											  	<div class="col-md-6">
											  		<input id="city" name="city" type="text" placeholder="City" class="form-control input-md" required="required" 
													  <?php if(isset($contactDetail["city"])){?>
													  		value="<?= $contactDetail["city"] ?>"
													  	<?php } ?>
													  />
											  	</div>
											</div>
											
											<div class="form-group">
											  	<label class="col-md-4 control-label" for="state">State</label>  
											  	<div class="col-md-6">
											  		<input id="state" name="state" type="text" placeholder="State" class="form-control input-md" required="required" 
													  <?php if(isset($contactDetail["state"])){?>
													  		value="<?= $contactDetail["state"] ?>"
													  	<?php } ?>
													  />
											  	</div>
											</div>
											
											<div class="form-group">
											  	<label class="col-md-4 control-label" for="post_code">Post Code</label>  
											  	<div class="col-md-6">
											  		<input id="post_code" name="post_code" type="text" placeholder="Post Code" class="form-control input-md" 
													  <?php if(isset($contactDetail["post_code"])){?>
													  		value="<?= $contactDetail["post_code"] ?>"
													  	<?php } ?>
													  />
											  	</div>
											</div>
										
											<div class="form-group">
											  	<label class="col-md-4 control-label" for="address">Address</label>  
											  	<div class="col-md-6">
											  		<input id="address" name="address" type="text" placeholder="Address" class="form-control input-md" required="required" 
													  <?php if(isset($contactDetail["address"])){?>
													  		value="<?= $contactDetail["address"] ?>"
													  	<?php } ?>
													  />
											  	</div>
											</div>
										
										
										
										
											<!-- Button (Double) -->
												<div class="form-group">
												  	<label class="col-md-4 control-label" for="profile_btn_reset"></label>
												  	<div class="col-md-6">
												  		<div class="pull-right">
													    	<button id="profile_btn_reset" name="profile_btn_reset" class="btn btn-default" type="reset">Reset</button>
												    		<button id="profile_btn_save" type="submit" name="profile_btn_save" class="btn btn-primary">Save</button>
												  		</div>
												  	</div>
												</div>
												
											</div>
										</div>
									</fieldset>
									<input type="hidden" name="profile_pic_path" id="profile_pic_path" value=""/>
								</form>
                         	</div>
				     	</div>
	        	</div>  <!-- /.box-body -->
				<div class="box-footer">
					<br/>
					
				</div>
        	</div>
        	
        	

	        	
        	
        	