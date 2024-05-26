<?php ?>

	<br/>
	<form class="form-horizontal" action="<?= site_url('timetable/save') ?>" method="post" id="timetable_form">
		<fieldset>
		
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="subject_id">Subject</label>  
		  <div class="col-md-5">
		  
		  	<select id="subject_id" name="subject_id" class="form-control" required="">
			      <option value=""></option>
			      <?php foreach($subjects as $subject){ ?>
					<option value="<?= $subject['id'] ?>" <?= (isset($timetable) && $subject['id'] == $timetable["subject"]["id"])? " selected='selected' ":""; ?> 
					  ><?= $subject['name'] ?> (<?= $subject["class"]['name'] ?>) </option>	
						
				<?php } ?>
		    </select>
		  </div>
		</div>
		
		<div class="form-group">
		  <label class="col-md-4 control-label" for="timetable_start_time">Start Time:</label>  
		  <div class="col-md-5">
		  	<input id="timetable_start_time" name="timetable_start_time" type="time" 
		  	<?php if(isset($timetable["start_time"])){ ?>
		  			value="<?= $timetable["start_time"] ?>"
		  		<?php } ?>
		  		placeholder="Start Time" class="form-control input-md" required="">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="timetable_end_time">End Time:</label>  
		  <div class="col-md-5">
		  	<input id="timetable_end_time" name="timetable_end_time" type="time" 
		  	<?php if(isset($timetable["end_time"])){ ?>
		  			value="<?= $timetable["end_time"] ?>"
		  		<?php } ?>
		  		placeholder="End Time" class="form-control input-md" required="">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="timetable_week_day">Week Day:</label>  
		  <div class="col-md-5">
		  
		  
		  		<select   id="timetable_week_day" name="timetable_week_day" class="form-control"  required="required" >
			    	<option value=""></option>
		    		<?php foreach(getWeekDays() as $day){ ?>
		    			<option value="<?= $day ?>"
		    			<?= isset($timetable["week_day"]) && $timetable["week_day"]==$day ?" selected ":"" ?> ><?= $day ?></option>
		    		<?php } ?>
			    </select>
		   
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="timetable_status">Status:</label>  
		  <div class="col-md-5">
		  	<input id="timetable_status" name="timetable_status" type="text" 
		  	<?php if(isset($timetable["status"])){ ?>
		  			value="<?= $timetable["status"] ?>"
		  		<?php } ?>
		  		placeholder="Status" class="form-control input-md" required="">
		  </div>
		</div>
		
		
	
		<br/> 
		<!-- Button (Double) -->
		<div class="form-group">
		  <label class="col-md-6 control-label" ></label>
		  	<div class="col-md-6">
		     	<button id="timetable_reset" name="timetable_reset" class="btn btn-default" type="reset">Reset</button>  
		    	<button type="submit" id="timetable_save" name="timetable_save" class="btn btn-primary">Save</button>
		  	</div>
		</div>
		
		</fieldset>
 		<input id="timetable_id" name="id" type="hidden" 
 		<?php if(isset($timetable["id"])){ ?>
			value="<?= $timetable["id"] ?>">
		 <?php } ?>
	</form>
 	<script type="text/javascript"> 
     $(document).ready(function() {
         $('#timetable_form').bootstrapValidator({
             fields: {
            	 timetable_name: {
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
			