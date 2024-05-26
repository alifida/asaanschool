<?php  ?>

		<div class="">
			<div class="row gallery">
			<?php if(isset($gallery) && !empty($gallery)){?>
				<?php foreach($gallery as $image){?>
					<?php if(isset($image["image_path"]) && !empty($image["image_path"])){?>
						<div class="col-md-3 col-sm-4 col-xs-6 pull-left">
							<a href="javascript:void(0);" onclick="load_image_details('Image Details', '<?= $image["image_path"] ?>')" >
								<img class="img-responsive" src="<?= $image["image_path"] ?>" onclick="copy_image_path_to_field('<?= $image["image_path"] ?>')"; />
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
	
    
    