<?php ?>

	<br/>
	<form class="form-horizontal" action="<?= site_url('setting/saveTransactionType') ?>" method="post">
		<fieldset>
		
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="transaction_type_name">Name</label>  
		  <div class="col-md-5">
		  	<input id="transaction_type_name" name="transaction_type_name" type="text" 
		  		<?php if(isset($transactionType["type"])){ ?>
		  			value="<?= $transactionType["type"] ?>"
		  		<?php } ?>
		  		placeholder="Name" class="form-control input-md" required="">
		  </div>
		</div>
		<br/> 
		<!-- Button (Double) -->
		<div class="form-group">
		  <label class="col-md-6 control-label" for="transaction_type_save"></label>
		  	<div class="col-md-6">
		     	<button id="transaction_type_reset" name="transaction_type_reset" class="btn btn-default" type="reset">Reset</button>  
		    	<button id="transaction_type_save" name="transaction_type_save" class="btn btn-primary">Save</button>
		  	</div>
		</div>
		
		</fieldset>
		<input id="transaction_type_id" name="transaction_type_id" type="hidden" 
			<?php if(isset($transactionType["id"])){ ?>
		 		value="<?= $transactionType["id"] ?>">
		 <?php } ?>
	</form>
				
			