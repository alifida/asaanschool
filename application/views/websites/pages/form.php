<?php ?>
<?php $itemIds =""; ?>
<br />
<script>
	var itemCount = 0;
</script>
<div class="box box-primary wow zoomInUp">

	<div class="box-header">
		Webpage
		<div class="pull-right ">
			<div class="btn-group  col-centered">
				<button type="button" onclick="getNewPagePostCatItem();" class="btn btn-raised  btn-danger btn-raised  btn-xs ">
					New Post Category
					<div class="ripple-container"></div>
				</button>
			</div>
		</div>
	</div>

	<div class="box-body">

		<div class="row">

			<div class="col-lg-11 col-md-11  col-sm-11  col-xs-11 col-centered">
				<form class="form-horizontal" action="<?= site_url('website/savePage')?>" method="post" id="webpage_update_form">
					<fieldset>
						<div class="container-fluid">
							<div class="row">
								<div class="form-group">
									<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
										<label class="col-md-12   " for="page_title">Page Title</label>
										<div class="col-md-12">
											<input id="page_title" name="page_title" type="text" class="form-control input-md   " required="required" value="<?= (isset($webpage["page_title"]))?$webpage["page_title"] : "" ?>" />
										</div>
									</div>

									<div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
										<label class="col-md-12   " for="page_status">Page Status</label>
										<div class="col-md-12">
											<select id="page_status" name="page_status" class="form-control  " required="required">
												<option value=""></option>
												<option value="<?= get_app_message("post.status.published")?>" <?= (isset($webpage["status"]) && get_app_message("post.status.published")==$webpage["status"])? "	selected ":""; ?>>
									    				<?= get_app_message("post.status.published")?>
								    				</option>

												<option value="<?= get_app_message("post.status.draft")?>" <?= (isset($webpage["status"]) && get_app_message("post.status.draft")==$webpage["status"])? "	selected ":""; ?>>
									    				<?= get_app_message("post.status.draft")?>
								    				</option>

												<option value="<?= get_app_message("post.status.trash")?>" <?= (isset($webpage["status"]) && get_app_message("post.status.trash")==$webpage["status"])? "	selected ":""; ?>>
									    				<?= get_app_message("post.status.trash")?>
								    				</option>
											</select>
										</div>
									</div>




									<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
										<label class="col-md-12   " for="is_welcome_page"><br />Welcome Page</label>
										<div class="col-md-12">

											<div class="row mt-2">
												<div class="col-lg-12">
													<div class="checkbox " style="margin-top: 0px; font-size: 25px; color: #fff">
														<label> <input name="is_welcome_page" id="is_welcome_page" <?= isset($webpage["is_welcome_page"]) && $webpage["is_welcome_page"]?' checked=""  ':'' ?> type="checkbox"> <span></span>
														</label>
													</div>
												</div>
											</div>

										</div>
									</div>

								</div>
								<div class="form-group">

									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
										<label class="col-md-12   " for="menu_title">Menu Title</label>
										<div class="col-md-12">
											<input id="page_title" name="menu_title" type="text" class="form-control input-md  " required="required" value="<?= (isset($webpage["menu_title"]))?$webpage["menu_title"] : "" ?>" />
										</div>
									</div>

									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
										<label class="col-md-12   " for="page_layout">Layout</label>
										<div class="col-md-12">
											<select id="page_layout" name="layout" class="form-control  " required="required">
												<option value=""></option>
									    		<?php if(isset($webpageLayouts) && !empty($webpageLayouts)){ ?>
									    			<?php foreach($webpageLayouts as $layout){ ?>
									    				<option value="<?= $layout ?>" <?= (isset($webpage["layout"]) && $layout==$webpage["layout"])? "	selected ":""; ?>>
									    					<?= $layout?>
								    					</option>
										    		<?php } ?>
									    		<?php } ?>
									    	</select>
										</div>
									</div>


									<div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
										<label class="col-md-12   " for="menu_slider">Slider</label>
										<div class="col-md-12">
											<select id="menu_slider" name="slider" class="form-control   ">
												<option value=""></option>
												<?php
												
												if (isset ( $sliders ) && ! empty ( $sliders )) {
													foreach ( $sliders as $slider ) {
														?>
														<option value="<?= $slider["id"] ?>" <?= (!empty($webpage["slider_id"]) && $webpage["slider_id"] == $slider["id"])? " selected = 'true'":"" ?>><?= $slider["name"] ?></option>
													<?php } ?>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
										<label class="col-md-12   " for="footer_page">Footer Page</label>
										<div class="col-md-12">
											<select id="footer_page" name="footer_page" class="form-control   ">
												<option value="">Default</option>
												<?php
												
												if (isset ( $webPages ) && ! empty ( $webPages )) {
													foreach ( $webPages as $footerPage ) {
														?>
														<?php if(isset($webpage["id"]) && $webpage["id"] != $footerPage["id"] ){?>
															<option value="<?= $footerPage["id"] ?>" <?= (!empty($webpage["footer_page_id"]) && $webpage["footer_page_id"] == $footerPage["id"])? " selected = 'true'":"" ?>><?= $footerPage["page_title"] ?></option>
														<?php } ?>
													<?php } ?>
												<?php } ?>
											</select>
										</div>
									</div>

									<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
										<label class="col-md-12   " for="is_default_footer"><br />Default Footer</label>
										<div class="col-md-12">



											<div class="row mt-2">
												<div class="col-lg-12">
													<div class="checkbox " style="margin-top: 0px; font-size: 25px; color: #fff">
														<label> <input name="is_default_footer" id="is_default_footer" <?= isset($webpage["is_default_footer"]) && $webpage["is_default_footer"]?' checked=""  ':'' ?> type="checkbox"> <span></span>
														</label>
													</div>
												</div>
											</div>






										</div>
									</div>
								</div>


								<div id="post_cats_wrapper">
							<?php
							$itemIdsArray = array ();
							if (isset ( $webpage ["postCategories"] ) && ! empty ( $webpage ["postCategories"] )) {
								?>
								<script>
									itemCount = <?= sizeof($webpage["postCategories"]) ?>;
								</script>
								<?php
								 
								foreach ( $webpage ["postCategories"] as $key => $pagePostCat ) {
									$itemIdsArray [] = $key+1;
									$data ["pagePostCat"] = $pagePostCat;
									$data ['itemId'] = $key+1;
									
									?>
									<div class="form-group">
										<?php $this->load->view('websites/pages/page_post_cat', $data); ?>
									</div>
								<?php } ?>
							<?php
							
								$itemIds = implode ( ",", $itemIdsArray );
							 
							}
							?>
						</div>






								<div class="form-group ">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<hr class="color dotted">
										<label class="col-md-12   " for="webpage_html">Contents:</label>
										<hr class="color dotted">
									</div>
								</div>
								<div class="form-group" id="contents_container">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  ">
											<textarea class=" form-control ckeditor" name="html" id="webpage_html" rows="13"><?= (isset($webpage["html"]))?$webpage["html"] : "" ?></textarea>
										</div>
									</div>
								</div>


								<!-- Button (Double) -->
								<div class="form-group">
									<label class="col-md-4 control-label   " for="webpage_btn_reset"></label>
									<div class="col-md-8">
										<div class="pull-right">
											<button id="webpage_btn_reset" name="webpage_btn_reset" class="btn btn-default btn-raised " type="reset">Reset</button>
											<button id="webpage_btn_save" type="submit" name="webpage_btn_save" class="btn btn-raised btn-primary">Save</button>
										</div>
									</div>
								</div>

							</div>
						</div>
					</fieldset>
					<input type="hidden" name="itemIds" id="itemIds" value="<?= $itemIds ?>" /> 
					<input type="hidden" id="page_id" name="page_id" value="<?= (isset($webpage["id"]))?encodeID($webpage["id"]) : "" ?>" />
				</form>
			</div>
		</div>
	</div>
	<!--  box-body -->
	<div class="box-footer">
		<br />
	</div>
</div>



<div id="colCatReferenceHTML" style="visibility: hidden; display: none;">
	<?php
	
	$ref = array ();
	$ref ["itemId"] = "";
	$ref ["pagePostCat"] ["layout_column"] = "";
	$ref ["pagePostCat"] ["category_id"] = "";
	$ref ["pagePostCat"] ["post_template"] = "";
	$ref ["pagePostCat"] ["top_records"] = "";
	$ref ["pagePostCat"] ["sort_order"] = "";
	
	$this->load->view ( 'websites/pages/page_post_cat', $ref );
	?>
</div>

<script>


function getNewPagePostCatItem(){
	itemCount++;
	$itemIds = $("#itemIds").val();
	if($itemIds!=""){
		$itemIds = $itemIds+",";
	}
	$itemIds = $itemIds+itemCount;
	$("#itemIds").val($itemIds);
	$itemHTML = $("#colCatReferenceHTML").html();
	$postFix = "___"+itemCount;
	$itemHTML = $itemHTML.replace(/___/g, $postFix);
	$itemHTML = $itemHTML.replace("removePagePostCatItem('", "removePagePostCatItem('"+itemCount);
	$("#post_cats_wrapper").append($itemHTML);
	
}

function removePagePostCatItem(slideId){
	console.log(slideId);
	$itemIds = $("#itemIds").val();
	
	var idsArray = $itemIds.split(',');
	var index = idsArray.indexOf(slideId);
	if (index > -1) {
		idsArray.splice(index, 1);
	}
	$itemIds = idsArray.join();
	$("#itemIds").val($itemIds);

	$("#cat_wrapper___"+slideId).remove();
}


</script>


