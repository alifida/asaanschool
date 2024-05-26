<?php ?>
	
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; 
	    	By calculating the profit of open transactions,
	    	all the related records to the open transactions will be locked
	    	 and cannot be modfied.<br/>
	    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Are you sure to <strong>Calculate Profit</strong> of the following open Transactions?                            
		</div>
	</div>
	<br/>
	<form class="form-horizontal" action="<?= site_url('profit/calculateCurrentProfit') ?>" method="post">
		<fieldset>
		<div class="col-centered">
			<?php $this->load->view('profit/open_transactions'); ?>
		</div>
		<br/> 
		<!-- Button (Double) -->
		  	<div class="col-centered">
		    	<button id="profit_delete" name="profit_delete" class="btn btn-danger">Yes (Calculate)</button>
		  	</div>
		</fieldset>
		<input id="is_confirmed" name="is_confirmed" type="hidden" value="yes">
	</form>
				
			