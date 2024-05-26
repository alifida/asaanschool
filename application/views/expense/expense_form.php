<?php ?>

	<br/>
	<form class="form-horizontal" action="<?= site_url('expense/saveExpense') ?>" method="post" id="expense_form">
		<fieldset>
		
		
		<div class="form-group">
		  <label class="col-md-4 control-label" for="expense_type_name">Type</label>  
		  <div class="col-md-5">
		  	<select id="expense_type_id" name="expense_type_id" class="form-control" required="">
			      <option value=""></option>
			      <?php foreach($expenseTypes as $type){ ?>
					<option value="<?= $type['id'] ?>" <?= (isset($expense) && $type['id'] == $expense["type"]["id"])? " selected='selected' ":""; ?> 
					  ><?= $type['type'] ?> </option>	
						
				<?php } ?>
		    </select>
		  </div>
		</div>
		
		
		
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="expense_description">Description</label>  
		  <div class="col-md-5">
		  	<input id="expense_description" name="expense_description" type="text" 
		  		<?php if(isset($expense["description"])){ ?>
		  			value="<?= $expense["description"] ?>"
		  		<?php } ?>
		  		placeholder="Description" class="form-control input-md" required="">
		  </div>
		</div>
		
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="expense_date">Date</label>  
		  <div class="col-md-5 date" data-date-format="YYYY-MM-DD">
		  	<div class="input-group">
		  		<input id="expense_date" name="expense_date" type="text" readonly="readonly"
		  		<?php if(isset($expense["expense_date"])){ ?>
		  			value="<?= $expense["expense_date"] ?>"
		  		<?php } ?>
		  		placeholder="Expense Date" class="form-control input-md" required="">
		  		<span class="input-group-addon" style="padding: 6px;">
				  	<span class="glyphicon glyphicon-calendar"></span>
				</span>
		    </div>
		  </div>
		</div>
		
		
		<?php if(!isset($expense["id"])){ ?>
		<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="expense_amount">Amount</label>  
			  <div class="col-md-5">
			  	<input id="expense_amount" name="expense_amount" type="text" 
			  		<?php if(isset($expense["amount"])){ ?>
			  			value="<?= $expense["amount"] ?>"
			  		<?php } ?>
			  		placeholder="Amount" class="form-control input-md" required="">
			  </div>
			</div>
		 <?php } ?>
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="expense_comments">Comments</label>  
		  <div class="col-md-5">
		  	<textarea class="form-control" rows="4" id="expense_comments" name="expense_comments" ><?php if(isset($expense["comments"])){ ?><?= $expense["comments"] ?><?php } ?></textarea>
		  </div>
		</div>
		
		
		
		
		<br/> 
		<!-- Button (Double) -->
		<div class="form-group">
		  <label class="col-md-6 control-label" for="expense_type_save"></label>
		  	<div class="col-md-6">
		     	<button id="expense_type_reset" name="expense_type_reset" class="btn btn-default" type="reset">Reset</button>  
		    	<button type="submit" id="expense_type_save" name="expense_type_save" class="btn btn-primary">Save</button>
		  	</div>
		</div>
		
		</fieldset>
		<input id="expense_id" name="expense_id" type="hidden" 
			<?php if(isset($expense["id"])){ ?>
		 		value="<?= $expense["id"] ?>">
		 <?php } ?>
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

<script type="text/javascript">
    $(document).ready(function() {

    	 // enable revalidation of date
    	dateTimePickerRevalidator();
        
        $('#expense_form').bootstrapValidator({
            fields: {
            	expense_type_id: {
            		message: 'Type is required',
            		validators: {
            			notEmpty: {
                            message: 'Type is required and can\'t be empty'
                        }
                    }
                },
                expense_description: {
            		message: 'Description is required',
            		validators: {
            			notEmpty: {
                            message: 'The Description is required and can\'t be empty'
                        }
                    }
                },
                expense_amount: {
                    message: 'Amount is required',
                    validators: {
                    	notEmpty: {
                            message: 'Amount is required and can\'t be empty'
                        },
                        integer: {
                            message: 'Amount is not a valid number.'
                        }
                    }
                },
                expense_date: {
                    message: 'Date is required',
                    validators: {
                    	notEmpty: {
                            message: 'Date is required and can\'t be empty'
                        },
                        date: {
                            format: 'YYYY-MM-DD',
                            message: 'The value is not a valid date. (Format: YYYY-MM-DD)'
                        }
                    }
                }
                
                
            }
        });
    });
</script>		
			
		
			