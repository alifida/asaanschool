<?php ?>
<form class="form-horizontal" action="<?= site_url('website/saveWidget')?>" method="post" id="widget_edit_form">
<fieldset>
<div class="container-fluid">	
	<div class="row">
		<div class="col-lg-4 col-md-4">
           	<br/>
           	<div  class="col-centered">
	           	<div class="row">
		           	<div  id="widget_thumbnail_container"  class="col-centered col-lg-12 col-md-12 col-sm-12 col-xs-12">
			           	<?php if(isset($widget["thumbnail_path"]) && !empty($widget["thumbnail_path"])){?>
	    	       			<img src='<?= $widget["thumbnail_path"] ?>' alt=''  class='img-circle circle_border max-100' />
	    	       		<?php } else{?>
	    	       			<img src='<?= site_url("public/images/student_avatar.png") ?>' alt=''  class='img-circle circle_border max-100' />
	    	       		<?php } ?>
		           	</div>
		           		<br/>
           				<div class="col-centered">
           					<span class="btn btn-primary btn-file">Browse
			    	       		<input type="file" id="browse_file" name="widget_thumbnail"
	    		       				onchange="ajax_file_submit('<?= site_url('fileupload/uploadWidgetThumbnail')?>' , 'widget_thumbnail_container' ,'widget_thumbnail_path')" />
							</span>
           				</div>
	           		
	           	</div>
           	</div>
	        <br/><br/>
		</div>
							
		<div class="col-lg-8 col-md-8  col-sm-12  col-xs-12">
		<!-- Text input-->
			<div class="form-group">
				<label class="col-md-4 control-label" for="widget_title">Title</label>  
				  <div class="col-md-6">
					  <input id="widget_title" name="widget_title" type="text" placeholder="Title" class="form-control input-md" required="required" 
					  	<?php if(isset($widget["title"])){?>
					  		value="<?=$widget["title"] ?>"
					  	<?php } ?>
					  />
				  </div>
				  
			</div>
			
		
			<!-- Textarea -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="widget_contents">Contents</label>
			  <div class="col-md-6">                     
			    <textarea class="form-control" rows="4" id="widget_contents" name="widget_contents"><?php if(isset($widget["html"])){ echo $widget["html"];}?></textarea>
			  </div>
			</div>
			<div class="form-group">
		        <div class="col-sm-9 col-sm-offset-3">
		            <div id="widget_add_update_form_messages"></div>
		        </div>
		    </div>
			<!-- Button (Double) -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="student_btn_reset"></label>
			  <div class="col-md-6">
			  	<div class="pull-right">
				    <button id="student_btn_reset" name="student_btn_reset" class="btn btn-default" type="reset">Reset</button>
			    	<button id="student_btn_save" type="submit" name="student_btn_save" class="btn btn-primary">Save</button>
			  	</div>
			  </div>
			</div>
			
			<input type="hidden" id="widget_thumbnail_path" name="widget_thumbnail_path" value="">
			<input type="hidden" id="widget_id" name="widget_id" value="<?= (isset($widget["id"]) && !empty($widget["id"])) ? encodeID($widget["id"]):""  ?>">
			
		</div>
	</div>
</div>
</fieldset>
</form>


<!--Validations-->
<script type="text/javascript">
    $(document).ready(function() {

    	// enable revalidation of date
    	dateTimePickerRevalidator();
    	
        $('#widget_edit_form').bootstrapValidator({
        	
            fields: {
            	widget_title: {
                    message: 'Title is required',
                    validators: {
                        notEmpty: {
                            message: 'Title is required and can\'t be empty'
                        }
                    }
                },
                widget_contents: {
                    message: 'Contents is required',
                    validators: {
                        notEmpty: {
                            message: 'Contents is required and can\'t be empty'
                        }
                        
                    }
                }
                
            }
        });

    });
</script>


