<?php ?>

<div class="modal fade" id="feePaymentModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h4 class="modal-title" id="myModalLabel">Pay Dues</h4>
            </div>
            <div class="modal-body">
                
                    <!-- Nav tabs -->
                    <div class="centered-pills">
						<ul class="nav nav-pills ">
							<li class="active"><a href="#paymenttab" data-toggle="tab">Payment</a></li>
							<li class=""><a href="#summarytab" data-toggle="tab">Summary</a></li>
						</ul>
					</div>
					<hr/>
				<!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane fade active in" id="paymenttab">
						<h4></h4>
						<p></p>
				<form class="form-horizontal" action="<?= site_url('student/savePayment') ?>" method="post" id="student_payment_form">
					<fieldset>
					
					<!-- Form Name 
						<legend>Form Name</legend>
					-->
					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="totaldues">Total Dues</label>  
					  <div class="col-md-6">
					  	<input id="totaldues" disabled name="totaldues" type="text" placeholder="Total Dues" class="form-control input-md">
					  </div>
					</div>
					
					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="current_payable">Current Payable</label>  
					  <div class="col-md-6">
					  <input id="current_payable"  name="current_payable" type="text" placeholder="" class="form-control input-md"  required="" readonly="readonly">
					    
					  </div>
					</div>
					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="payment">Payment</label>  
					  <div class="col-md-6">
					  <input id="payment"  name="payment" type="text" placeholder="" class="form-control input-md"  required="" onkeyup="calculate_on_payment_onchange();">
					    
					  </div>
					</div>
					
					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="discount">Discount</label>  
					  <div class="col-md-6">
					  	<input id="discount" name="discount" type="text" placeholder="Discount" class="form-control input-md" onkeyup="calculate_fee_payment()">
					  </div>
					</div>
					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="remaing_dues">Remaining Dues (After Payment)</label>  
					  <div class="col-md-5">
					  	<input id="remaing_dues" name="remaing_dues" type="text" placeholder="Remaining Dues" class="form-control input-md" readonly>
					  </div>
					  <div class="col-md-1 " >
					  		<a href="javascript:void(0);" tabindex="0" class="btn btn-sm btn-info pull-right " role="button" data-toggle="popover" data-trigger="focus" title="" data-content="<?= get_app_message("help.remaing.dues.as.arrears") ?>"><span  class="glyphicon glyphicon-info-sign"></span></a>
					  	</div>
					</div>
					<!-- Select Basic -->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="paidby">Paid By</label>
					  <div class="col-md-6">
					    <select id="paidby" name="paidby" class="form-control" required="">
					      <option value=""></option>
					      <?php foreach($guardians as $guardian){ ?>
							<option value="<?= $guardian['id'] ?>"><?= $guardian['name'] ?> </option>		
						<?php } ?>
						 <option value="Student">Student</option>
						 <option value="Other">Some one else</option>
					      
					    </select>
					  </div>
					</div>
					<!-- Textarea -->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="payment_comments">Comments</label>
					  <div class="col-md-6">                     
					    <textarea class="form-control" id="payment_comments" name="payment_comments" rows="5"></textarea>
					  </div>
					</div>
					<input type="hidden" id="payment_for" name="payment_for"/>
					<input type="hidden" id="student_id" name="student_id" value="<?= $student["id"] ?>"/>
					
					<!-- Button -->
					<div class="form-group">
					 
					  <div class="col-md-8 ">
					    <button type="submit" id="" name="" class="pull-right btn btn-primary">save</button>
					  </div>
					</div>
					</fieldset>
				</form>
						
						
					</div>
					<div class="tab-pane fade" id="summarytab">
						<h4></h4>
						<div class="row">
							<div class="col-xs-12 " id="payment_summary_on_model">
	                                    
	                        </div>
                        </div>
					</div>
					
				</div>
                
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
        </div>
    </div>
  </div>
</div>




