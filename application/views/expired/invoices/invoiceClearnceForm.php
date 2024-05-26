<?php ?>
<div class="col-centered">
	<div class="alert alert-warning">
    	<span class="glyphicon glyphicon-warning-sign"></span>If you have made the payement for this invoice, Please fill the following form for verification. Your Account will be activated upon verification.                          
	</div>
</div>
	<br/>
<form class="form-horizontal" action="<?= site_url('expired/invoiceClearanceRequest')?>" method="post" id="invoice_clearance_form">
	<fieldset>

		<div class="form-group">
		  <label class="col-md-4 control-label" >Invoice No.</label>  
		  <div class="col-md-6">
		  	<button class="btn   btn-block btn-primary  " type="button"><?= $invoice["invoice_no"] ?></button>
		  	<input type="hidden" name="invoice_id" id="invoice_id" value="<?= encodeID($invoice["id"]) ?>"/>
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="invoice_paid_date">Paid Date</label>  
		  <div class="col-md-6 date " data-date-format="YYYY-MM-DD" >
				  <div class="input-group">
					  <input id="invoice_paid_date" name="invoice_paid_date" type="text" placeholder="Paid Date" class="form-control input-md" value="" required="" />
					  <span class="input-group-addon" style="padding: 6px;">
					  	<span class="glyphicon glyphicon-calendar"></span>
					  </span>
			  	</div>  
			  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="paid_through">Paid Through</label>  
		  <div class="col-md-6">
		  	<select id="paid_through" name="paid_through"  class="form-control"  required="required" >
		    	<option value=""></option>
		    	<option value="1" >Standard Chartered Bank</option>
		    	<option value="2" >Easy Paisa</option>
		    	<option value="3" >Mobicash</option>
		    </select>
		  </div>
		</div>
		
		<div class="form-group">
		  <label class="col-md-4 control-label" for="comments">Comments</label>  
		  <div class="col-md-6">
		  	<textarea id="comments" name="comments" rows="4" class="form-control"></textarea>
		  </div>
		</div>
				
		
		<!-- Button (Double) -->
		<div class="form-group">
		  
		  <div class="col-md-12 ">
			  <div class="col-centered">
			    <button type="submit" id="invoice_clearance_btn_save" name="invoice_clearance_btn_save" class="btn btn-success">Send Request</button>
			  </div>
		  </div>
		</div>
		
		
	</fieldset>
</form>
<script type="text/javascript">
	$(function() {
		var nowDate = new Date();
		$('.date').datetimepicker({
			useCurrent:false,
			pickTime: false
		});
	});


</script>


