<?php ?>
<form class="form-horizontal" action="<?= site_url('guardian/savelinkGuardian')?>" method="post">
<fieldset>

<?php if(isset($student) && !empty($student)){ ?>
	<div class="form-group">
	  <label class="col-md-4 control-label" for="student_name">Student</label>  
	  <div class="col-md-6">
	  <input type="hidden" name="student_id" value="<?= $student["id"]?>"/>
	  	<?= $student["first_name"]?> <?= $student["last_name"]?>  
	  
	  </div>
	</div>
<?php } ?>


<div class="form-group">
  <label class="col-md-4 control-label" for="issue_item_student_id">Guardian</label>  
  <div class="col-md-6">
  		<input id="guardian_id" name="guardian_id"  type="text"  placeholder="Guardian" class="form-control input-md" required="">
  		<script type="text/javascript">
          	$(document).ready(function() {
              	$("#guardian_id").tokenInput("<?= site_url('guardian/getAutoComplete') ?>", {
					theme: "custom",
      				tokenLimit: 1
        		});
			});

                </script>
  	
  </div>
</div>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="relation">Relation</label>  
  <div class="col-md-6">
	  <select id="relation" name="relation"  class="form-control"  required="" >
		    		<option value=""></option>
		    	<?php if(isset($relationTypes)){ ?>
		    		<?php foreach($relationTypes as $relation){ ?>
		    			<option value="<?= $relation["id"]?>">
		    				<?= $relation["relation"]?> 
		    			</option>
		    		<?php } ?>
				<?php }		?>
	      
	    </select>
  </div>
</div>


<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="guardian_btn_reset"></label>
  <div class="col-md-8">
    <button id="student_guardian_btn_reset" name="student_guardian_btn_reset" class="btn btn-default" type="reset">Reset</button>
    <button id="student_guardian_btn_save" name="student_guardian_btn_save" class="btn btn-primary">Save</button>
  </div>
</div>



</fieldset>
</form>
