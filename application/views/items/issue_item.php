<?php ?>

	<br/>
	
	<form class="form-horizontal" action="<?= site_url('inventory/issueItem') ?>" method="post" id="issue_item_form">
		<fieldset>
		
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="issue_item_student_id">Student</label>  
		  <div class="col-md-5">
		  		<input id="issue_item_student_id" name="student_id" type="text" 
		  		<?=(isset($readonlyStudentOnIssueForm) && $readonlyStudentOnIssueForm =="readonly")? " readonly ": "" ?> 	  		
		  		placeholder="Student" class="form-control input-md" required="">
		  		<script type="text/javascript">
                    $(document).ready(function() {

                        $("#issue_item_student_id").tokenInput("<?= site_url('student/getAutoComplete') ?>", {
                        	<?php if (isset($prePopulateStudent)) { ?>
                            	prePopulate: <?= $prePopulateStudent ?>,
							<?php } ?>
                            theme: "custom",
                            readonly: true,
                            tokenLimit: 1
                        });
                    });

                </script>
		  	
		  </div>
		</div>
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="item_id">Item</label>  
		  <div class="col-md-5">
		  		<input id="item_id" name="item_id" type="text" 	  		
		  		placeholder="Item" class="form-control input-md" required="">
		  		<script type="text/javascript">
                    $(document).ready(function() {
                        $("#item_id").tokenInput("<?= site_url('inventory/getAutoComplete') ?>", {
                        	<?php if (isset($prePopulateItem)) { ?>
                        		prePopulate: <?= $prePopulateItem ?>,
							<?php } ?>
                            theme: "custom",
                            tokenLimit: 1
                        });

                    });

                </script>
		  	
		  </div>
		</div>
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="issued_amount">Quantity to Issue</label>  
		  <div class="col-md-5">
		  		<input id="issued_amount" name="issued_amount" type="text" 	  		
		  		placeholder="Quantity to Issue" class="form-control input-md" required="">
		  </div>
		</div>
		
		
		<div class="form-group">
		  <label class="col-md-4 control-label" for="payment_status">Payment Status</label>  
		  <div class="col-md-5">
		  <select id="payment_status" name="payment_status"  class="form-control"  required="" >
		    		<option value=""></option>
		    	<?php if(isset($paymentStatuses)){ ?>
		    		<?php foreach($paymentStatuses as $status){ ?>
		    			<option value="<?= $status ?>"><?= $status?></option>
		    		<?php } ?>
				<?php }		?>
		      
		    </select>
		  
		  </div>
		</div>	
		
		<br/> 
		<!-- Button (Double) -->
		<div class="form-group">
		  <label class="col-md-6 control-label" for="item_save"></label>
		  	<div class="col-md-6">
		     	<button id="item_reset" name="item_reset" class="btn btn-default" type="reset">Reset</button>  
		    	<button id="item_save" name="item_save" class="btn btn-primary" type="submit">Save</button>
		  	</div>
		</div>
		</fieldset>
		<input type="hidden" name="redirectURL" value="<?= $redirectURL ?>"/>
	</form>
		
        <!--Validations-->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#issue_item_form').bootstrapValidator({
                    message: 'This value is not valid',
                    fields: {
                    	issued_amount: {
                            message: 'Quantity to Issue is required and can\'t be empty',
                            validators: {
                                notEmpty: {
                                    message: 'Quantity to Issue is required and can\'t be empty'
                                },
                                numeric : {
            						message : 'Quantity to Issue can only be a numeric value.'
            					}
                            }
                        }
                    }
                });
            });
        </script>
				
			