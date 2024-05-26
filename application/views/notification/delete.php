<?php ?>
	<form class="form-horizontal" action="<?= site_url('notification/delete') ?>" method="post">
		<fieldset>
        	<div class="col-centered">
        		<div class="alert alert-warning">
        	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to <strong>DELETE</strong> the following object?                            
        		</div>
        	</div>
        	<br/>
        	<?php $this->load->view('notification/detail'); ?>
        	
        </fieldset>
        <div class="col-centered">
		    <button   class="btn btn-danger">Yes (Delete)</button>
		  </div>
		<input type="hidden" name="notification_id"   value="<?= (isset($notification['id']))? $notification['id'] : "" ?>" />
		  
	</form>
				
			