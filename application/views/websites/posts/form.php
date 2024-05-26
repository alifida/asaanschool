<?php ?>
<section class="content-header">
	<h1>Post</h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="box box-success ">

				<div class="box-header"></div>
				<!-- /.box-header -->
				<div class="box-body">

					<div class="row">

						<div class="col-lg-12 col-md-12  col-sm-12  col-xs-12 col-centered">
							<form class="form-horizontal" action="<?= site_url('website/savePost')?>" method="post" id="post_update_form">
								<fieldset>
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

												<div class="form-group">
													<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
														<label class="col-md-12   " for="post_title">Title</label>
														<div class="col-md-12">
															<input id="post_title" name="title" type="text" class="form-control input-md   " required="required" value="<?= (isset($post["title"]))?$post["title"] : "" ?>" onblur="setSlugToField('post_title','post_slug')" />
														</div>
													</div>
													<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
														<label class="col-md-12   " for="post_title">Slug</label>
														<div class="col-md-12">
															<input id="post_slug" name="slug" type="text" class="form-control input-md   " required="required" value="<?= (isset($post["slug"]))?$post["slug"] : "" ?>" />
														</div>
													</div>

												</div>
												<div class="form-group">
													<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
														<label class="col-md-12   " for="post_status">Status</label>
														<div class="col-md-12">
															<select id="post_status" name="status" class="form-control  " required="required">
																<option value=""></option>
																<option value="<?= get_app_message("post.status.published")?>" <?= (isset($post["status"]) && get_app_message("post.status.published")==$post["status"])? "	selected ":""; ?>><?= get_app_message("post.status.published")?></option>
																<option value="<?= get_app_message("post.status.draft")?>" <?= (isset($post["status"]) && get_app_message("post.status.draft")==$post["status"])? "	selected ":""; ?>><?= get_app_message("post.status.draft")?></option>
																<option value="<?= get_app_message("post.status.trash")?>" <?= (isset($post["status"]) && get_app_message("post.status.trash")==$post["status"])? "	selected ":""; ?>><?= get_app_message("post.status.trash")?></option>
															</select>
														</div>
													</div>
													<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
														<label class="col-md-12   " for="published_at">Published Date</label>
														<div class="col-md-12">
															<div class="input-group date">
																<input value="<?= isset($post["publish_at"])?$post["publish_at"]:"" ?>" id="publish_at" name="publish_at" type="text" class="form-control input-md  " required=""> <span class="input-group-addon" style="padding: 6px;"> <span class="glyphicon glyphicon-calendar"></span>
																</span>
															</div>
														</div>
													</div>
													<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
														<label class="col-md-12   " for="expire_at">Expiry Date</label>
														<div class="col-md-12">
															<div class="input-group date ">
																<input value="<?= isset($post["expire_at"])?$post["expire_at"]:"" ?>" id="expire_at" name="expire_at" type="text" class="form-control input-md  " required=""> <span class="input-group-addon" style="padding: 6px;"> <span class="glyphicon glyphicon-calendar"></span>
																</span>
															</div>
														</div>
													</div>

													<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
														<label class="col-md-12   " for="footer_page">Footer Page</label>
														<div class="col-md-12">
															<select id="footer_page" name="footer_page" class="form-control   ">
																<option value="">Default</option>
												<?php if(isset($webPages) && !empty($webPages)){ ?>
													<?php foreach($webPages as $footerPage){ ?>
															<option value="<?= $footerPage["id"] ?>" <?= (!empty($post["footer_page_id"]) && $post["footer_page_id"] == $footerPage["id"])? " selected = 'true'":"" ?>><?= $footerPage["page_title"] ?></option>
													<?php } ?>
												<?php } ?>
											</select>
														</div>
													</div>

													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
														<label class="col-md-12   " for="categories"><br />Categories</label>
														<div class="col-md-12">

															<div class="row mt-2">
																<div class="col-lg-12">
																		<div class="checkbox  " style="margin-top: 0px; font-size: 20px; ">
																			<?php if(isset($categories)){?>
																				<?php foreach ($categories as $cat ){?>
																					<label> <input name="categories[]" <?= isset($post["categories"]) && isCatIdExistIn($post["categories"],$cat["id"])?' checked=""  ':'' ?> value="<?= $cat["id"] ?>" type="checkbox"><span><?= $cat["name"]?></span> </label>
																				<?php }?>
																			<?php }?>
																		</div>
																</div>
															</div>

														</div>
														
														
														
														
														
													</div>

												</div>

											</div>
											<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
												<div class="col-centered">
													<div class="row">
														<div id="post_thumbnail_container" class="col-centered col-lg-12 col-md-12 col-sm-12 col-xs-12">
							           	<?php if(isset($post["thumbnail_path"]) && !empty($post["thumbnail_path"])){?>
					    	       			<img src='<?= $post["thumbnail_path"] ?>' alt='' class='max-150' />
					    	       		<?php } else{?>
					    	       			<img src='<?= site_url("public/images/student_avatar.png") ?>' alt='' class='max-150' />
					    	       		<?php } ?>
						           	</div>
														<br />

														<div class="form-group is-empty is-fileinput">
															<div class="col-centered">
																<input type="text" readonly="" class="form-control  " placeholder="Browse..."> <input type="file" id="browse_file" name="post_thumbnail" onchange="ajax_file_submit('<?= site_url('fileupload/uploadPostThumbnail')?>' , 'post_thumbnail_container' ,'thumbnail_path')">
															</div>
															<span class="material-input"></span>
														</div>

													</div>
												</div>



											</div>
										</div>
									</div>


									<div class="row">
										<div class="col-lg-12 col-md-12  col-sm-12  col-xs-12 col-centered">

											<div class="form-group ">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<hr class="color dotted">
													<label class="col-md-12   " for="post_html">Contents:</label>
													<hr class="color dotted">
												</div>
											</div>
											<div class="form-group" id="contents_container">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  ">
														<textarea class=" form-control ckeditor" name="html" id="post_html" rows="13"><?= (isset($post["html"]))?$post["html"] : "" ?></textarea>
													</div>
												</div>
											</div>


											<!-- Button (Double) -->
											<div class="form-group">
												<label class="col-md-4 control-label   " for="post_btn_reset"></label>
												<div class="col-md-8">
													<div class="pull-right">
														<button id="post_btn_reset" name="post_btn_reset" class="btn btn-default btn-raised " type="reset">Reset</button>
														<button id="post_btn_save" type="submit" name="post_btn_save" class="btn btn-raised btn-primary">Save</button>
													</div>
												</div>
											</div>

										</div>
									</div>
								</fieldset>
								<input type="hidden" id="thumbnail_path" name="thumbnail_path" value="<?= isset($post["thumbnail_path"])?$post["thumbnail_path"]:"" ?>"> <input type="hidden" id="post_id" name="post_id" value="<?= (isset($post["id"]))?encodeID($post["id"]) : "" ?>" />
							</form>
						</div>
					</div>
				</div>
				<!--  box-body -->
				<div class="box-footer">
					<br />
				</div>
			</div>
		</div>
	</div>
</section>

<?php
function isCatIdExistIn($categories, $catId) {
	if (! empty ( $categories ) && ! empty ( $catId )) {
		foreach ( $categories as $cat){
			if($catId === $cat["category_id"]){
				return true;
			}
		}
	}
	return false;
}




?>

