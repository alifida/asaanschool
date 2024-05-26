<?php //pre($webpage) ?>
<div class="box box-primary">
	<div class="box-header">Update Footer</div>
		<!-- /.box-header -->
	<div class="box-body">
	
		<div class="row">
							
			<div class="col-lg-11 col-md-11  col-sm-11  col-xs-11 col-centered">
           		<form class="form-horizontal" action="<?= site_url('website/updateFooter')?>" method="post" id="webpage_update_form">
					<fieldset>
						<div class="container-fluid">	
							<div class="row">
								
								<div class="form-group">
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 pull-right"  >
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
								</div>
								
								<div class="form-group " >
									<hr/>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  >
									  	<label class="col-md-12  pull-left" for="page_type">Footer Posts:</label>  
									</div>
									<hr/>
								</div>
								<?php 
								if(isset($webpage["posts"])){
									$selectedpostIds = array();
									$selectedPosts = $webpage["posts"];
									if(!empty($webpage["posts"])){
										
										foreach($webpage["posts"] as $selectedW){
											$selectedpostIds[] = $selectedW["id"];
										}
										
									}
								}
									
								?>
								<div class="form-group ">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  ">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  ">
											<select id="page_posts" name = "page_posts[]" class="form-control dual_list_box" multiple="multiple" >
												<?php if(isset($posts) && !empty($posts)){
													foreach($posts as $post){ ?>
														
														<option value="<?= $post["id"] ?>"  <?= (!empty($selectedpostIds) && in_array($post["id"], $selectedpostIds)  )? " selected = 'true'":"" ?>   ><?= $post["title"] ?></option>
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
								<div class="form-group">
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

