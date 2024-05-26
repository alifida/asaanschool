<?php  ?>

	<br/>
	<form class="form-horizontal" action="<?= site_url('subject/save') ?>" method="post" id="subject_form">
		<fieldset>
		
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="subject_name">Name:</label>  
		  <div class="col-md-5">
		  	<input id="subject_name" name="subject_name" type="text" 
		  	<?php if(isset($subject["name"])){ ?>
		  			value="<?= $subject["name"] ?>"
		  		<?php } ?>
		  		placeholder="Name" class="form-control input-md" required="">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="subject_description">Description:</label>  
		  <div class="col-md-5">
		  	<input id="subject_description" name="subject_description" type="text" 
		  	<?php if(isset($subject["description"])){ ?>
		  			value="<?= $subject["description"] ?>"
		  		<?php } ?>
		  		placeholder="Description" class="form-control input-md" required="">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="class_id">Class</label>  
		  <div class="col-md-5">
		  
		  	<select id="class_id" name="class_id" class="form-control" required="">
			      <option value=""></option>
			      <?php foreach($classes as $class){ ?>
					<option value="<?= $class['id'] ?>" <?= (isset($subject) && $class['id'] == $subject["class_id"])? " selected='selected' ":""; ?> 
					  ><?= $class['name'] ?> </option>	
						
				<?php } ?>
		    </select>
		  </div>
		</div>
		<br/> 
		<!-- Button (Double) -->
		<div class="form-group">
		  <label class="col-md-6 control-label" ></label>
		  
		  	<div class="col-md-6">
		     	<button id="subject_reset" name="subject_reset" class="btn btn-default" type="reset">Reset</button>  
		    	<button type="submit" id="subject_save" name="subject_save" class="btn btn-primary">Save</button>
		  	</div>
		</div>
		
		</fieldset>
 		<input id="subject_id" name="id" type="hidden" value="<?=  isset($subject["id"])?$subject["id"]:'' ?>" >
	</form>
 	<script type="text/javascript"> -->
     $(document).ready(function() {
         $('#subject_form').bootstrapValidator({
             fields: {
            	 subject_name: {
             		message: 'Name is required',
             		validators: {
                         notEmpty: {
                             message: 'Name is required and can\'t be empty'
                         }
                     }
                 }
             }
         });
     });
</script>				  
			