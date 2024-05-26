<?php  ?>
	
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to <strong>Promote</strong> the following students from <strong><?=(isset($classFrom))? $classFrom["name"]:""?> </strong> to <strong><?=(isset($classTo))? $classTo["name"]:""?>	</strong>                            
		</div>
	</div>
	<br/>
	<form class="form-horizontal" action="<?= site_url("student/processStudentPromotion");?>" method="post" >
		<fieldset>
			
			<div class="col-centered">
				<table class="table table-hover" id="">
					
					<tr>
						<td colspan="2">Students to be promoted: </td>
					</tr>
					
					<?php if(isset($studentsToBePromoted)){?>
						<?php foreach($studentsToBePromoted as $key => $student){?>
							<tr>
								<td><?= $key+1 ?></td>
								<td><?= $student["first_name"]." ". $student["last_name"]."(".$student["roll_no"].")"?></td>
							</tr>
						<?php }?>
					<?php }?>
					
				</table>
				
			
			</div>
			
			
			
				<?php if(isset($toClassExistingStudents)){?>
						
					<div class="col-centered">
						<div class="alert alert-warning">
					    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp;<strong><?= $classTo["name"]?></strong> already contains the following students. By submitting the form existing and newly promoted students will be merged.                            
						</div>
					</div>
					<div class="col-centered">
						<table class="table table-hover" >
							
						<?php foreach($toClassExistingStudents as $ekey => $existingStudent){?>
							<tr>
								<td width="20%"><?= $ekey+1 ?></td>
								<td><?= $existingStudent["first_name"]." ". $existingStudent["last_name"]."(".$existingStudent["roll_no"].")"?></td>
							</tr>
								
						<?php }?>
						</table>
					</div>
					<?php }?>
		
		<br/> 
		<!-- Button (Double) -->
		  	<div class="col-centered">
		    	<button id="item_delete" name="item_delete" class="btn btn-danger">Yes (Promote)</button>
		  	</div>
		</fieldset>
		<input id="students_to_promote_ids" name="students_to_promote_ids" type="hidden" 
			<?php if(isset($studentsToPromoteIds)){ ?>
		 		value="<?= $studentsToPromoteIds ?>"
		 	<?php } ?>
		 	>
		 <input type="hidden" id="class_from_id" name="class_from_id"
		 	<?php if(isset($promoteFromClassId)){ ?>
		 		value="<?= $promoteFromClassId ?>"
		 	<?php } ?>
		 >
		 <input type="hidden" id="promote_to_class_id" name="promote_to_class_id"
		 	<?php if(isset($promoteToClassId)){ ?>
		 		value="<?= $promoteToClassId ?>"
		 	<?php } ?>
		 >
		 <?php

		 ?>
	</form>
				
			