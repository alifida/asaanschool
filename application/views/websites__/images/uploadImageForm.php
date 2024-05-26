<?php  ?>

			<div  class="col-centered">
	           	<div class="row">
		           	<div  id="gallery_image_container"  class="col-centered col-lg-8 col-md-8 col-sm-4 col-xs-4">
	    	       		<img src='<?= site_url("public/images/student_avatar.png") ?>' alt=''  class='img-circle circle_border max-100' />
		           	</div>
	           		<br/>
           			<div class="col-centered">
           				<span class="btn btn-primary btn-file">Browse
			    	    	<input type="file" id="browse_file" name="galleryImage"
	    		       			onchange="ajax_file_submit('<?= site_url('fileupload/uploadToWebisteImages')?>' , 'gallery_image_container' ,'gallery_image_path')" />
						</span>
           			</div>
	           	</div>
           	</div>
           	<input type="hidden" name="gallery_image_path"/>
           			
	
    
    