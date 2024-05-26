<?php  ?>

		<div class="">
			<div class="row gallery">
			<?php if(isset($gallery) && !empty($gallery)){?>
				<?php foreach($gallery as $file){?>
					<?php if(isset($file["file_path"]) && !empty($file["file_path"])){?>
						<div class="col-md-3 col-sm-4 col-xs-6 text-center">
							<a href="javascript:void(0);" onclick="load_image_details('Image Details', '<?= $file["file_path"] ?>')" >
								<?php $filePath = site_url("public/images/attachment.jpg"); 
									if(isImageFile($file["file_path"])){
										$filePath = $file["file_path"];
									}
								
								?>
								<img class="img-responsive" src="<?= $filePath ?>" onclick="copy_file_path_to_field('<?= $file["file_path"] ?>')"; />
							</a>
							<strong> <?= isset($file["name"])?$file["name"]:"" ?>	</strong> <br/>
							<button onclick="load_remote_model('<?= site_url('website/deleteGalaryFileConfirmation/'.encodeID($file['id'])) ?>','Delete File');" type="button" class="btn btn-xs btn-primary btn-raised  text-center" >Delete</button>
						</div>
					<?php } ?>
				<?php } ?>
			<?php }?>
			</div>	    
		</div>
	
    
    