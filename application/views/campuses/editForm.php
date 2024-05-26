<?php ?>
<div class="box box-primary">
	<div class="box-header">Campus</div>
		<!-- /.box-header -->
	<div class="box-body">
	<div class="row">
		<div class="col-centered col-lg-9 col-md-9 col-sm-12 col-xs-12">
			<div class="alert alert-warning">
		    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; 
		    	<?= get_app_message("campus.details.seo.message")?>                            
			</div>
		</div>
		<br/>
	</div>
		<div class="row">
			
			
			<div class="col-lg-4 col-md-4">
           		<br/>
           		<div  class="col-centered">
	           		<div class="row">
		           		<div  id="campus_logo_container"  class="col-centered col-lg-12 col-md-12 col-sm-12 col-xs-12">
			           		<?php if(isset($campus["campus_logo"]) && !empty($campus["campus_logo"])){?>
	    	       				<img src='<?= $campus["campus_logo"] ?>' alt=''  class='img-circle circle_border max-100' />
	    	       			<?php } else{?>
	    	       				<img src='<?= site_url("public/images/school_logo.png") ?>' alt=''  class='img-circle circle_border max-100' />
	    	       			<?php } ?>
		           		</div>
		           		<br/>
           						<div class="col-centered">
	           						<span class="btn btn-primary btn-file">Browse
			    	       				<input type="file" id="browse_file" name="schoolLogo"
	    		       					onchange="ajax_file_submit('<?= site_url('fileupload/uploadCampusLogo')?>' , 'campus_logo_container' ,'campus_logo_path')" />
									</span>
           						</div>
           						
	           		</div>
           		</div>
	           	<br/><br/>
			 </div>
							
			<div class="col-lg-8 col-md-8  col-sm-12  col-xs-12">
           		<form class="form-horizontal" action="<?= site_url('campus/update')?>" method="post" id="campus_update_form">
					<fieldset>
						<div class="container-fluid">	
							<div class="row">
								<div class="form-group">
								  	<label class="col-md-4 control-label" for="campus_name">Campus Name:</label>  
								  	<div class="col-md-6">
								  		<input id="campus_name" name="campus_name" type="text" placeholder="Campus Name" class="form-control input-md" required="required" 
										  <?php if(isset($campus["campus_name"])){?>
										  		value="<?= $campus["campus_name"] ?>"
										  	<?php } ?>
										  />
								  	</div>
								</div>
								<?php if(sizeof($_SESSION["campuses"]) == 1){?>
									<div class="form-group">
									  	<label class="col-md-4 control-label" for="registration_no">Registration No.</label>  
									  	<div class="col-md-6">
									  		<input id="registration_no" name="registration_no" type="text" placeholder="Registration No." class="form-control input-md" required="required" 
											  <?php if(isset($campus["school"]["registration_no"])){?>
											  		value="<?= $campus["school"]["registration_no"] ?>"
											  	<?php } ?>
											  />
									  	</div>
									</div>
									<div class="form-group">
									  	<label class="col-md-4 control-label" for="registration_no">School Details</label>  
									  	<div class="col-md-6">
									  		<input id="school_details" name="school_details" type="text" placeholder="School Details" class="form-control input-md" 
											  <?php if(isset($campus["school"]["details"])){?>
											  		value="<?= $campus["school"]["details"] ?>"
											  	<?php } ?>
											  />
									  	</div>
									</div>
								<?php } ?>
								<?php $contactDetail = $campus["contactDetail"]; ?>
								<div class="form-group">
								  	<label class="col-md-4 control-label" for="primary_email">Primary Email</label>  
								  	<div class="col-md-6">
								  		<input id="primary_email" name="primary_email" type="text" placeholder="Primary Email" class="form-control input-md" required="required" 
										  <?php if(isset($contactDetail["primary_email"])){?>
										  		value="<?= $contactDetail["primary_email"] ?>"
										  	<?php } ?>
										  />
								    
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
								  	<label class="col-md-4 control-label" for="campus_btn_reset"></label>
								  	<div class="col-md-6">
								  		<div class="pull-right">
									    	<button id="campus_btn_reset" name="campus_btn_reset" class="btn btn-default" type="reset">Reset</button>
								    		<button id="campus_btn_save" type="submit" name="campus_btn_save" class="btn btn-primary">Save</button>
								  		</div>
								  	</div>
								</div>
								
							</div>
						</div>
					</fieldset>
					<input type="hidden" id="campus_logo_path" name="campus_logo_path" value=""/>
				</form>
			</div>
		</div>
	</div> <!--  box-body -->
	<div class="box-footer">
		<br/>
	</div>	
</div>