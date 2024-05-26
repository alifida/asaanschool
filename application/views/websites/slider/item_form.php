<?php ?>
<div class="row"  id="slide_wrapper___<?= isset($itemId)?$itemId:'' ?>">
	<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 col-centered ">
		<div class="card card-light-inverse">
			<div class="card-block">
				<div class="pull-right ">
					<a href="javascript:void(0)" onclick="removeSlideItem('<?= isset($itemId)?$itemId:'' ?>')" class="btn-circle btn-circle-primary btn-circle-sm btn-circle-raised " style="margin: -33px 0px 0px -10px;position: absolute;">
						<i class="fa fa-times" aria-hidden="true"></i>
						<div class="ripple-container"></div>
					</a>
				</div>
                     <div class="row">     
                       
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label class="col-lg-12 col-md-12 col-sm-12 col-xs-12 control-label  " for="slide_title___<?= isset($itemId)?$itemId:'' ?>">Title</label>
						<input id="slide_title___<?= isset($itemId)?$itemId:'' ?>" name="slide_title___<?= isset($itemId)?$itemId:'' ?>" type="text" class="form-control input-md   " required="required" value="<?= (isset($item["title"]))?$item["title"] : "" ?>" />
						
						<label class="col-lg-12 col-md-12 col-sm-12 col-xs-12  control-label  " for="slide_text___<?= isset($itemId)?$itemId:'' ?>">Text</label>
						<textarea class="form-control  " rows="2" 
						 	id="slide_text___<?= isset($itemId)?$itemId:'' ?>" name="slide_text___<?= isset($itemId)?$itemId:'' ?>"><?=(isset($item["text"]))? $item["text"]:''?></textarea>
						 	
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="col-centered">
							<div class="row">
								<div id="slide_thumbnail_container___<?= isset($itemId)?$itemId:'' ?>" class="col-centered col-lg-12 col-md-12 col-sm-12 col-xs-12">
						           	<?php if(isset($item["thumbnail"]) && !empty($item["thumbnail"])){?>
				    	       			<img src='<?= $item["thumbnail"] ?>' alt='' style="height:120px; width: 100%" />
				    	       		<?php } else{?>
				    	       			<img src='<?= site_url("public/images/slider.jpg") ?>' alt='' style="height: 120px; width: 100%;" />
				    	       		<?php } ?>
					           	</div>
								<div class="form-group is-empty is-fileinput">
									<div class="col-centered">
										<input type="text" readonly="" class="form-control  " placeholder="Browse..."> 
										<input type="file" id="browse_file_slide___<?= isset($itemId)?$itemId:'' ?>" name="slide_thumbnail___<?= isset($itemId)?$itemId:'' ?>" 
											onchange="ajax_file_submit('<?= site_url('fileupload/uploadSliderImage')?>' , 'slide_thumbnail_container___<?= isset($itemId)?$itemId:'' ?>' ,'thumbnail_path___<?= isset($itemId)?$itemId:'' ?>', 'browse_file_slide___<?= isset($itemId)?$itemId:'' ?>')">
										<input type="hidden" name="thumbnail_path___<?= isset($itemId)?$itemId:'' ?>" id="thumbnail_path___<?= isset($itemId)?$itemId:'' ?>" value="<?= isset($item["thumbnail"])? $item["thumbnail"]:""?>" />
									</div>
									<span class="material-input"></span>
								</div>
				
							</div>
						</div>
					</div>
				</div>
			</div>
		 </div>
	</div>
</div>