<?php ?>
	
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to <strong>DELETE</strong> the following timetable?                            
		</div>
	</div>
	<br/>
	<form class="form-horizontal" action="<?= site_url('subject/delete') ?>" method="post">
		<fieldset>
		<?php $this->load->view('subjects/detail'); ?>
		
		<br/> 
		<!-- Button (Double) -->
		  	<div class="col-centered">
		    	<button   class="btn btn-danger">Yes (Delete)</button>
		  	</div>
		
		</fieldset>
		<input id="subject_id" name="id" type="hidden" value="<?=  isset($subject["id"])?$subject["id"]:'' ?>" >
	</form>
				
			