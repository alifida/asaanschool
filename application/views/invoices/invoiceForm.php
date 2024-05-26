<?php ?>

<?php ?>
<div class="box box-success">
	<div class="box-header">
		<h3 class="box-title"> Invoice Form </h3>
        <span class="pull-right" ></span>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="row">
			<div class="col-lg-12">
				<form class="form-horizontal" action="<?= site_url('appadmin/saveInvoice')?>" method="post" id="invoiceForm">
					<fieldset>
						<div class="form-group">
						  <label class="col-md-4 control-label" for="invoiceNo">Invoice No.</label>  
						  <div class="col-md-5">
						  <input readonly="readonly" id="invoiceNo" name="invoiceNo" type="text" placeholder="Invoice No."   class="form-control input-md" 
						    value="<?= $invoice["invoice_no"] ?>"
						  />
						    
						  </div>
						</div>
					
						<div class="form-group">
						  <label class="col-md-4 control-label" for="status">Status.</label>  
						  <div class="col-md-5">
						  <select id="status" name="status"  class="form-control"  required="required" >
		    					<option value=""></option>
		    					<option <?= ($invoice["status"]==get_app_message("db.status.paid"))?" selected ":" "  ?> value="<?= get_app_message("db.status.paid") ?>"><?= get_app_message("db.status.paid") ?></option>
		    					<option <?= ($invoice["status"]==get_app_message("db.status.due"))?" selected ":" "  ?> value="<?= get_app_message("db.status.due") ?>"><?= get_app_message("db.status.due") ?></option>
		    				</select>
						    
						  </div>
						</div>
						<div class="form-group">
						  <label class="col-md-4 control-label" for="paid_through">Paid Through</label>  
						  <div class="col-md-5">
						  	<select id="paid_through" name="paid_through"  class="form-control"   >
						    	<option value=""></option>
						    	<option <?= ($invoice["payment_method"]==1)?" selected ":" "  ?> value="1">Standard Chartered Bank</option>
						    	<option <?= ($invoice["payment_method"]==2)?" selected ":" "  ?> value="2">Easy Paisa</option>
						    	<option <?= ($invoice["payment_method"]==3)?" selected ":" "  ?> value="3">Mobicash</option>
						    </select>
						  </div>
						</div>
					
					
						<div class="form-group">
						  <label class="col-md-4 control-label" for="payableAmount">Payable Amount</label>  
						  <div class="col-md-5">
						  <input id="payableAmount" name="payableAmount" type="text" placeholder="Payable Amount" class="form-control input-md" 
						    value="<?= $invoice["payable_amount"] ?>"
						    readonly="readonly"
						  />
						    
						  </div>
						</div>
					
						<div class="form-group">
						  <label class="col-md-4 control-label" for="discount">Discount</label>  
						  <div class="col-md-5">
						  <input id="discount" name="discount" type="text" placeholder="Discount" class="form-control input-md" 
						    value="<?= $invoice["discount"] ?>"
						  />
						    
						  </div>
						</div>
					
						<div class="form-group">
						  <label class="col-md-4 control-label" for="totalPayable">Total Payable</label>  
						  <div class="col-md-5">
						  <input readonly="readonly" id="totalPayable" name="totalPayable" type="text" placeholder="Total Payable" class="form-control input-md" 
						    value="<?= $invoice["total_payable_amount"] ?>"
						  />
						    
						  </div>
						</div>
					
						<div class="form-group">
						  <label class="col-md-4 control-label" for="paidAmount">Paid Amount</label>  
						  <div class="col-md-5">
						  <input id="paidAmount" name="paidAmount" type="text" placeholder="Paid Amount" class="form-control input-md" 
						    value="<?= $invoice["paid_amount"] ?>"
						  />
						    
						  </div>
						</div>
					
						<div class="form-group">
						  <label class="col-md-4 control-label" for="invoiceDate">Invoice Date</label>  
						  <div class="col-md-5 date" data-date-format="YYYY-MM-DD" >
						  	<div class="input-group">
						  		<input id="invoiceDate" name="invoiceDate" type="text" placeholder="Invoice Date" class="form-control input-md"   required=""
				    				value="<?= $invoice["invoice_date"] ?>"
				 				/>
								  <span class="input-group-addon" style="padding: 6px;">
								  	<span class="glyphicon glyphicon-calendar"></span>
								  </span>
					  		</div>
						  </div>
						</div>
						
						
						
						
					
						<div class="form-group">
						  <label class="col-md-4 control-label" for="dueDate">Due Date</label>  
						  <div class="col-md-5 date" data-date-format="YYYY-MM-DD" >
						  		<div class="input-group">
						  			<input id="dueDate" name="dueDate" type="text" placeholder="Due Date" class="form-control input-md" required=""
						   			 	value="<?= $invoice["due_date"] ?>"
						  			/>
						    		<span class="input-group-addon" style="padding: 6px;">
								  		<span class="glyphicon glyphicon-calendar"></span>
								  	</span>
					  			</div>
						  </div>
						</div>
					
						<div class="form-group">
						  	<label class="col-md-4 control-label" for="paidDate">Paid Date</label>  
						 	<div class="col-md-5 date" data-date-format="YYYY-MM-DD" >
						  		<div class="input-group">
						  			<input id="paidDate" name="paidDate" type="text" placeholder="Paid Date" class="form-control input-md" 
									    value="<?= $invoice["paid_date"] ?>"
									  />
						    		<span class="input-group-addon" style="padding: 6px;">
								  		<span class="glyphicon glyphicon-calendar"></span>
								  	</span>
					  			</div>
						  </div>
						</div>
						
						<div class="form-group">
						  	<label class="col-md-4 control-label" for="expiryDate">Expiry Date</label>  
						 	<div class="col-md-5 date" data-date-format="YYYY-MM-DD" >
						  		<div class="input-group">
						  			<input id="expiryDate" name="expiryDate" type="text" placeholder="Expiry Date" class="form-control input-md" required=""
									    value="<?= $invoice["invoice_expiry_date"] ?>"
									  />
						    		<span class="input-group-addon" style="padding: 6px;">
								  		<span class="glyphicon glyphicon-calendar"></span>
								  	</span>
					  			</div>
						  </div>
						</div>
						
						
						<div class="form-group">
						  	<label class="col-md-4 control-label" for="invoice_btn_reset"></label>
						  	<div class="col-md-6">
						  		<div class="pull-right">
							    	<button id="invoice_btn_reset" name="invoice_btn_reset" class="btn btn-default" type="reset">Reset</button>
						    		<button id="invoice_btn_save" type="submit" name="invoice_btn_save" class="btn btn-primary">Save</button>
						  		</div>
						  	</div>
						</div>
					</fieldset>
					<input type="hidden" name="invoice_id" id="invoice_id" value="<?= isset($invoice["id"])? encodeID($invoice["id"]):"" ?>" />
				</form>
			</div>
		</div>
	</div>
</div>
<?php ?>