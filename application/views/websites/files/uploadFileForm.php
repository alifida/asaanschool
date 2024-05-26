<?php  ?>

			<div  class="col-centered">
	           	<div class="row">
		           	<div  id="gallery_file_container"  class="col-centered col-lg-8 col-md-8 col-sm-4 col-xs-4">
	    	       		<img src='<?= site_url("public/images/student_avatar.png") ?>' alt=''  class='img-circle circle_border max-100' />
		           	</div>
	           		<br/>
           			<div class="form-group is-empty is-fileinput">
						<div class="col-centered">
							<input type="text" readonly="" class="form-control text-center" placeholder="Browse..."> 
							<input type="file" id="gallery_file_upload_id" name="post_thumbnail" onchange="ajax_file_submit('<?= site_url('fileupload/uploadToWebisteFile')?>' , 'gallery_file_container' ,'gallery_file_path', 'gallery_file_upload_id')" >
						</div>
						<span class="material-input"></span>
					</div>
           			
           			
	           	</div>
           	</div>
           	<input type="hidden" name="gallery_file_path" id='gallery_file_path'/>
           			
	
    
    