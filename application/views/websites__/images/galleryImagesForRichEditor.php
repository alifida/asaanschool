<?php  ?>
		<br/>
		<br/>
		<br/>
		<div class="">
			<div class="row">
			<?php if(isset($gallery) && !empty($gallery)){?>
				<?php foreach($gallery as $image){?>
					<?php if(isset($image["image_path"]) && !empty($image["image_path"])){?>
						<div class="col-md-3 col-sm-4 col-xs-6 pull-left">
							<a href="javascript:void(0);" onclick="copy_image_path_to_field('<?= $image["image_path"] ?>')" >
								<img class="img-responsive img-thumbnail" src="<?= $image["image_path"] ?>" style="margin: 5px;"  />
							</a>
						</div>
					<?php } ?>
				<?php } ?>
			<?php }?>
				<!-- 
			<a href="javascript:void(0);" data-toggle="popover" data-trigger="focus" title="Image Path" data-content="<?= $image["image_path"] ?>">Image Info</a>
				
				 -->
			</div>	    
		</div>
	
    
    