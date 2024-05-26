<?php ?>

	
<form class="form-horizontal" action="" method="post" id="promote_students_from" onsubmit="event.preventDefault(); submit_promote_student_from();" >
	<fieldset>
	
	
	<br/>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="class_from_id">Load Studetns of Class</label>  
		  <div class="col-md-5">
		  	<select id="class_from_id" name="class_from_id" class="form-control"  onchange="promote_get_students_by_class();"  required="">
			      <option value=""></option>
			      <?php foreach($classes as $class){ ?>
					<option value="<?= $class['id'] ?>" <?= (isset($selectedClass["class"]) && $class['id'] == $selectedClass["id"])? " selected='selected' ":""; ?> 
					  ><?= $class["name"] ?> </option>	
						
				<?php } ?>
		    </select>
		  </div>
		</div>
	
		<div id="promote_student_students_container" class="form-group " style="display: block;">
			<div class="col-lg-12 col-centered">
				<select id="promote_student_multiple_students" name = "promote_student_multiple_students[]" class="form-control" multiple="multiple" >
				</select>
			</div>
		</div>
		
		
		<div class="form-group">
		  <label class="col-md-4 control-label" for="class_to_id">Promote To</label>  
		  <div class="col-md-5">
		  	<select id="class_to_id" name="class_to_id" class="form-control"    required="">
			      <option value=""></option>
			      <?php foreach($classes as $class){ ?>
					<option value="<?= $class['id'] ?>" ><?= $class["name"] ?> </option>	
				<?php } ?>
		    </select>
		  </div>
		</div>
		
		<br/>
		<div class="row" >
			<div class="col-lg-9 pull-right">
			  	<div class="col-lg-1 col-centered">
			  		<div style="display: table-cell;"><button id="promote_student_reset" name="promote_student_reset" class="btn btn-default" type="reset">Reset</button></div>
			  		<div style="display: table-cell;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
			  		<div style="display: table-cell;"><button type="submit" id="promote_student_save" name="promote_student_save" class="btn btn-primary">Save</button></div>
			  	</div>
		  	</div>
		</div>
	</fieldset>
	
	
</form>

