<?php ?>
	
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to <strong>DELETE</strong> the following timetable?                            
		</div>
	</div>
	<br/>
	<form class="form-horizontal" action="<?= site_url('timetable/delete') ?>" method="post">
		<fieldset>
		<?php $this->load->view('timetables/detail'); ?>
		
		<br/> 
		<!-- Button (Double) -->
		  	<div class="col-centered">
		    	<button   class="btn btn-danger">Yes (Delete)</button>
		  	</div>
		
		</fieldset>
		<input id="timetable_id" name="id" type="hidden" value="<?=  isset($timetable["id"])?$timetable["id"]:'' ?>" >
	</form>
				
			