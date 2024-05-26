<?php //pre($webpage) ?>
<div class="box box-primary">
	<div class="box-header">Update Webpage</div>
		<!-- /.box-header -->
	<div class="box-body">
	
		<div class="row">
							
			<div class="col-lg-11 col-md-11  col-sm-11  col-xs-11 col-centered">
           		<form class="form-horizontal" action="<?= site_url('website/updatePage')?>" method="post" id="webpage_update_form">
					<fieldset>
						<div class="container-fluid">	
							<div class="row">
								<div class="form-group">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  >
									  	<label class="col-md-12  pull-left" for="page_title">Page Title:</label>  
									  	<div class="col-md-12">
									  		<input id="page_title" name="page_title" type="text" placeholder="Page Title" class="form-control input-md" required="required" 
											  	value="<?= (isset($webpage["page_title"]))?$webpage["page_title"] : "" ?>"/>
									  	</div>
									</div>
									
								</div>
								<div class="form-group">
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6"  >
									  	<label class="col-md-12  pull-left" for="page_status">Page Status:</label>  
									  	<div class="col-md-12">
										  	<select id="page_status" name="page_status" class="form-control"  required="required" >
									    		<option value=""></option>
									    			<option value="<?= get_app_message("webpage.status.published")?>"
									    				<?= (isset($webpage["status"]) && get_app_message("webpage.status.published")==$webpage["status"])? "	selected ":""; ?>>
									    				<?= get_app_message("webpage.status.published")?>
								    				</option>
								    				
								    				<option value="<?= get_app_message("webpage.status.draft")?>"
									    				<?= (isset($webpage["status"]) && get_app_message("webpage.status.draft")==$webpage["status"])? "	selected ":""; ?>>
									    				<?= get_app_message("webpage.status.draft")?>
								    				</option>
								    				
								    				<option value="<?= get_app_message("webpage.status.trash")?>"
									    				<?= (isset($webpage["status"]) && get_app_message("webpage.status.trash")==$webpage["status"])? "	selected ":""; ?>>
									    				<?= get_app_message("webpage.status.trash")?>
								    				</option>
									    	</select>
									  	</div>
									</div>
								
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6"  >
									  	<label class="col-md-12  pull-left" for="page_type">Page Type:</label>  
									  	<div class="col-md-12">
										  	<select id="page_type" name="page_type" class="form-control"  required="required" onchange="toggle_home_page_controles();" >
									    		<option value=""></option>
									    		<?php if(isset($webpageTypes) && !empty($webpageTypes)){ ?>
									    			<?php foreach($webpageTypes as $pageType){ ?>
									    				<option value="<?= $pageType["id"] ?>"
									    					<?= (isset($webpage["type_id"]) && $pageType["id"]==$webpage["type_id"])? "	selected ":""; ?>>
									    					<?= $pageType["type"] ?>
								    					</option>
										    		<?php } ?>
									    		<?php } ?>
									    	</select>
									  	</div>
									</div>
									
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6"  >
										<label class="col-md-12  pull-left" for="menu_title">Menu Title:</label>  
									  	<div class="col-md-12">
									  		<input id="page_title" name="menu_title" type="text" placeholder="Page Title" class="form-control input-md" required="required" 
											  	value="<?= (isset($webpage["menu_title"]))?$webpage["menu_title"] : "" ?>"/>
									  	</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6"  >
										<label class="col-md-12  pull-left" for="menu_sort_order">Sort order:</label>  
									  	<div class="col-md-12">
									  		<input id="menu_sort_order" name="menu_sort_order" type="text" placeholder="Sort order" class="form-control input-md" 
											  	value="<?= (isset($webpage["menu_sort_order"]))?$webpage["menu_sort_order"] : "" ?>"/>
									  	</div>
									</div>
									
								</div>
								
								<div class="form-group" id="contactUsFormContainer">
								<br/>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  >
									  	  
									  	<div class="col-md-12">
									  		<div class="callout callout-warning">
		                                        <h4>Email Form!</h4>
			                                        <label>
			                                            Contact Form will be placed automatically After the contents.
			                                        </label>
		                                    </div>
									  	
									  		
									  	</div>
									</div>
								</div>
								
								
								<div class="form-group home_page_contents" >
									<hr/>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  >
									  	<label class="col-md-12  pull-left" for="page_type">Banner Images:</label>  
									</div>
									<hr/>
								</div>
								
								<?php 
								
									$bannerImages = array();
									$bannerImage1="";
									$bannerImage2="";
									$bannerImage3="";
									if(isset($webpage["banner_images"]) && !empty($webpage["banner_images"])){
										$bannerImages = json_decode($webpage["banner_images"]);
									}
									if(!empty($bannerImages)){
										
										if(isset($bannerImages[0])){
											$bannerImage1 = $bannerImages[0];
										}
										if(isset($bannerImages[1])){
											$bannerImage2 = $bannerImages[1];
										}
										if(isset($bannerImages[2])){
											$bannerImage3 = $bannerImages[2];
										}
										
										
									}
								
								?>
								
								
								
								<div class="form-group home_page_contents" >
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"  >
									  	<label class="col-md-12  pull-left" for="banner_image_1">Image 1:</label>  
									  	<div class="col-md-12">
										  	<div class="input-group input-group-sm">
										        <input id="banner_image_1" name="banner_image_1" type="text" placeholder="Banner Image " class="form-control input-md" 
												  	value="<?= $bannerImage1 ?>"/>
										        <span class="input-group-btn">
										        	<a class="btn  btn-sm btn-default" href="javascript:void(0);"
												  		onclick="targetControleForImagePath='#banner_image_1';
												  			load_remote_model('<?= site_url("website/quickGallery") ?>','Report Settings');enlarge_remote_model();
												  			" ><i class="glyphicon glyphicon-picture"></i>
										  			</a>
									  			</span>
										    </div>
									  	</div>
									  	
									</div>
									
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"  >
										<label class="col-md-12  pull-left" for="banner_image_2">Image 2:</label>  
									  	<div class="col-md-12">
									  		<div class="input-group input-group-sm">
										        <input id="banner_image_2" name="banner_image_2" type="text" placeholder="Banner Image " class="form-control input-md" 
												  	value="<?= $bannerImage2 ?>"/>
										        <span class="input-group-btn">
										        	<a class="btn  btn-sm btn-default" href="javascript:void(0);"
												  		onclick="targetControleForImagePath='#banner_image_2';
												  			load_remote_model('<?= site_url("website/quickGallery") ?>','Report Settings');enlarge_remote_model();
												  			" ><i class="glyphicon glyphicon-picture"></i>
										  			</a>
									  			</span>
										    </div>
									  	</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"  >
										<label class="col-md-12  pull-left" for="banner_image_3">Image 3:</label>  
									  	<div class="col-md-12">
									  		<div class="input-group input-group-sm">
										        <input id="banner_image_3" name="banner_image_3" type="text" placeholder="Banner Image " class="form-control input-md" 
												  	value="<?= $bannerImage3 ?>"/>
										        <span class="input-group-btn">
										        	<a class="btn  btn-sm btn-default" href="javascript:void(0);"
												  		onclick="targetControleForImagePath='#banner_image_3';
												  			load_remote_model('<?= site_url("website/quickGallery") ?>','Report Settings');enlarge_remote_model();
												  			" ><i class="glyphicon glyphicon-picture"></i>
										  			</a>
									  			</span>
										    </div>
									  	</div>
									</div>
									
								</div>
								
								
								<div class="form-group " >
									<hr/>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  >
									  	<label class="col-md-12  pull-left" for="page_type">Page Widgets:</label>  
									</div>
									<hr/>
								</div>
								<?php 
								if(isset($webpage["widgets"])){
									$selectedwidgetIds = array();
									$selectedWidgets = $webpage["widgets"];
									if(!empty($webpage["widgets"])){
										
										foreach($webpage["widgets"] as $selectedW){
											$selectedwidgetIds[] = $selectedW["id"];
										}
										
									}
								}
									
								?>
								<div class="form-group ">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  ">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  ">
											<select id="page_widgets" name = "page_widgets[]" class="form-control dual_list_box" multiple="multiple" >
												<?php if(isset($widgets) && !empty($widgets)){
													foreach($widgets as $widget){ ?>
														<option value="<?= $widget["id"] ?>"  <?= (!empty($selectedwidgetIds) && in_array($widget["id"], $selectedwidgetIds)  )? " selected = 'true'":"" ?>   ><?= $widget["title"] ?></option>
													<?php } ?>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
								
								
								<div class="form-group " >
									<hr/>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  >
									  	<label class="col-md-12  pull-left" for="page_type">Contents:</label>  
									</div>
									<hr/>
								</div>
								<div class="form-group" id="contents_container">
                                 	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  >
                                      	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  ">
		                                	<textarea class="textarea form-control" name="html" id="webpage_html" rows="13"><?= (isset($webpage["html"]))?$webpage["html"] : "" ?></textarea>
	                                	</div>
									</div>
								</div>
												
							
								<!-- Button (Double) -->
								<div class="form-group">
								  	<label class="col-md-4 control-label" for="webpage_btn_reset"></label>
								  	<div class="col-md-8">
								  		<div class="pull-right">
									    	<button id="webpage_btn_reset" name="webpage_btn_reset" class="btn btn-default" type="reset">Reset</button>
								    		<button id="webpage_btn_save" type="submit" name="webpage_btn_save" class="btn btn-primary">Save</button>
								  		</div>
								  	</div>
								</div>
								
							</div>
						</div>
					</fieldset>
					<input type="hidden" id="page_id" name="page_id" value="<?= (isset($webpage["id"]))?encodeID($webpage["id"]) : "" ?>"/>
				</form>
			</div>
		</div>
	</div> <!--  box-body -->
	<div class="box-footer">
		<br/>
	</div>	
</div>


