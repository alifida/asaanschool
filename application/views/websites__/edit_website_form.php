<?php ?> 	
										  	


<div class="box box-primary">
	<div class="box-header">Configure Website</div>
		<!-- /.box-header -->
	<div class="box-body">
		<br/>
		<br/>
		<div class="row">
			<div class="col-lg-9 col-md-9  col-sm-12  col-xs-12 col-centered">
           		<form class="form-horizontal" action="<?= site_url('website/updateWebsite')?>" method="post" id="website_update_form">
					<fieldset>
						<div class="container-fluid">	
							<div class="row">
								<div class="form-group">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 "  >
									  	<label class="col-md-3 control-label " for="site_title"><span class="pull-left">Site Title:</span></label>  
									  	<div class="col-md-6">
									  		<input id="site_title" name="site_title" type="text" placeholder="Site Title" class="form-control input-md"  
											  	value="<?= (isset($website["site_title"]))?$website["site_title"] : "" ?>"/>
									  	</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 "  >
									  	<label class="col-md-3 control-label " for="tag_line"><span class="pull-left">Tag line:</span></label>  
									  	<div class="col-md-6">
									  		<input id="tag_line" name="tag_line" type="text" placeholder="Tag Line" class="form-control input-md"  
											  	value="<?= (isset($website["tag_line"]))?$website["tag_line"] : "" ?>"/>
									  	</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 "  >
									  	<label class="col-md-3 control-label " for="domain_type"><span class="pull-left">Domain Type:</span></label>  
									  	<div class="col-md-6">
									  		<select id="domain_type" name="domain_type" class="form-control"   onchange="toggleDomainControles();" >
									    		<option value=""></option>
									    		<option value="freesubdomain" <?= (isset($isSubDomain)&&($isSubDomain===true))?" selected ":""?>>Free Sub Domain</option>
									    		<option value="domain" <?= (isset($isSubDomain)&&($isSubDomain===false))?" selected ":""?>>Domain</option>
									    	</select>
									  		
									  	</div>
									</div>
								</div>
								<div class="form-group" id="subdomain_container" style="display:none">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 "  >
									  	<label class="col-md-3 col-lg-3 col-sm-10 col-xs-10 control-label" for="subdomain"><span class="pull-left">Free Sub Domain:</span></label>  
									  	<div class="col-md-6 col-lg-6 col-sm-10 col-xs-10  ">
									  			
											  	<div class="input-group">
												  <input id="subdomain" name="subdomain" type="text" placeholder="myschool" class="form-control input-md "  
											  			value="<?= (isset($subdomain))? $subdomain : "" ?>" onchange="checkDmainAvailability();" />
												  <span class="input-group-addon" id="basic-addon2">.<?= get_app_message("app.domain") ?></span>
												</div>
											  	
									  	</div>
									  	<div class="col-md-3 col-lg-3 col-sm-2 col-xs-2" id="subdomain_validity_status"></div>
									</div>
								</div>
								<div class="form-group" id="domain_container" style="display:none">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 "  >
									  	<label class="col-md-3 col-lg-3 col-sm-10 col-xs-10 control-label" for="domain"><span class="pull-left">Domain:</span></label>  
									  	<div class="col-md-6 col-lg-6 col-sm-10 col-xs-10 ">
									  		<input id="domain" name="domain" type="text" placeholder="example.com" class="form-control input-md " 
											  	value="<?= (isset($domain))?$domain : "" ?>" onchange="checkDmainAvailability();"/>
									  	</div>
									  	<div class="col-md-3 col-lg-3 col-sm-2 col-xs-2" id="domain_validity_status"></div>
									</div>
								</div>
								
								<div class="form-group"  >
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 "  >
									  	<label class="col-centered control-label" for="domain"><span class="pull-left">Templates:</span></label>  
									  	
									  	
									</div>
								</div>
								
								<div class="form-group"  >
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 "  >
									  	
									  	<?php if(isset($webTemplates) && !empty($webTemplates)){?>
									  		<?php foreach($webTemplates as $webTemplate){ ?>
										  		
												<div class="col-lg-4 col-md-4 col-sm-6  col-xs-6 "  >
													  <div class="box box-primary" style="background-color: #E0E0E0;">
														<div class="box-header" style="padding:0px;">
															<div class="row">
																<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
																	<h5 class="box-title"><?= $webTemplate["template_name"] ?> </h5>
																</div>
																<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
																<div class="checkbox pull-right" style="margin-top: 0px; font-size: 25px; color: #fff">
										  							<label>
											            				<input type="radio" name="template[]" value="<?=$webTemplate['id'] ?>" 
																				<?= isTemplateSelected($webTemplate, $website["webTemplate"])?" checked='checked'":"" ?>  >
											      							<span></span>
											  						</label>
											  					</div>
															</div>
																
															</div>
														</div>
														<div class="box-body">
										                	<img src='<?= site_url()."".$webTemplate['thumbnail_path'] ?>' alt="<?= $webTemplate["template_name"] ?>"/>
														</div>
														<div class="box-footer">
											            	<a href="<?= site_url("site/previewTemplate")."/". generate_slug($webTemplate["template_name"])."/".encodeID($webTemplate["id"])?>" target="_blank" class="small-box-footer">Preview</a>
											            </div>
													</div>
												</div>
												
											 <?php } ?> 	
										 <?php } ?>
										  	
										  	
										  	
									  	
									  	
									</div>
								</div>
								
								
								
								
								
								
								
								<div class="form-group"  >
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 "  >
									  	<label class="col-md-3 col-lg-3 col-sm-10 col-xs-10 control-label" for="themeColor"><span class="pull-left">Theme Color:</span></label>  
									  	<div class="col-md-6 col-lg-6 col-sm-10 col-xs-10  ">
										  	<div class="input-group my-colorpicker2 colorpicker-element">
											  <input id="themeColor" name="themeColor" type="text" placeholder="#001e59" class="form-control input-md "  readonly="readonly" 
										  			value="<?= (isset($website["theme_color"]))? $website["theme_color"] : "#e05f03" ?>"  />
											  <div class="input-group-addon" ><i style="background-color: rgb(0, 29, 89);"></i></div>
											</div>
									  	</div>
									  	
									</div>
								</div>
								
								<div class="form-group"  >
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 "  >
									  	<label class="col-md-3 col-lg-3 col-sm-10 col-xs-10 control-label" for="backgroundColor"><span class="pull-left">Background Color:</span></label>  
									  	<div class="col-md-6 col-lg-6 col-sm-10 col-xs-10  ">
										  	<div class="input-group my-colorpicker2 colorpicker-element">
											  <input id="backgroundColor" name="backgroundColor" type="text" placeholder="#001e59" class="form-control input-md "  readonly="readonly" 
										  			value="<?= (isset($website["background_color"]))? $website["background_color"] : "#fff" ?>"  />
											  <div class="input-group-addon" ><i style="background-color: rgb(0, 29, 89);"></i></div>
											</div>
									  	</div>
									  	
									</div>
								</div>
								
								<div class="form-group"  >
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 "  >
									  	<label class="col-md-3 col-lg-3 col-sm-10 col-xs-10 control-label" for="textColor"><span class="pull-left">Text Color:</span></label>  
									  	<div class="col-md-6 col-lg-6 col-sm-10 col-xs-10  ">
										  	<div class="input-group my-colorpicker2 colorpicker-element">
											  <input id="textColor" name="textColor" type="text" placeholder="#001e59" class="form-control input-md "  readonly="readonly" 
										  			value="<?= (isset($website["text_color"]))? $website["text_color"] : "#333333" ?>"  />
											  <div class="input-group-addon" ><i style="background-color: rgb(0, 29, 89);"></i></div>
											</div>
									  	</div>
									  	
									</div>
								</div>
								
								
								<!-- Button (Double) -->
								<div class="form-group">
								  	
								  	<div class="col-lg-9 col-md-9 col-sm-11 col-xs-11">
								  		<div class="pull-right">
									    	<button id="website_btn_reset" name="website_btn_reset" class="btn btn-default" type="reset">Reset</button>
								    		<button id="website_btn_save" type="submit" name="website_btn_save" class="btn btn-primary">Save</button>
								  		</div>
								  	</div>
								</div>
								
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div> <!--  box-body -->
	<div class="box-footer">
		<br/>
	</div>	
</div>

<?php  
function isTemplateSelected($webTemplate, $template){
	$isSelected = false;
	
		if($template["id"]==$webTemplate["id"]){
			$isSelected = true;
			
		}
	
	
	return $isSelected;
}
?>