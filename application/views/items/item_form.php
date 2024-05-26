<?php ?>

	<br/>
	<form class="form-horizontal" action="<?= site_url('inventory/saveItem') ?>" method="post" id="item_form">
		<fieldset>
		
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="item_type_id">Type</label>  
		  <div class="col-md-5">
		  
		  	<select id="item_type_id" name="item_type_id" class="form-control" required="">
			      <option value=""></option>
			      <?php foreach($itemTypes as $type){ ?>
					<option value="<?= $type['id'] ?>" <?= (isset($item) && $type['id'] == $item["type"]["id"])? " selected='selected' ":""; ?> 
					  ><?= $type['name'] ?> </option>	
						
				<?php } ?>
		    </select>
		  </div>
		</div>
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="item_description">Description</label>  
		  <div class="col-md-5">
		  	<input id="item_description" name="item_description" type="text" 
		  		<?php if(isset($item["description"])){ ?>
		  			value="<?= $item["description"] ?>"
		  		<?php } ?>
		  		placeholder="Name" class="form-control input-md" required="">
		  </div>
		</div>
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="item_amount">Quantity</label>  
		  <div class="col-md-5">
		  	<input id="item_amount" name="item_amount" type="text" 
		  		<?php if(isset($item["amount"])){ ?>
		  			value="<?= $item["amount"] ?>"
		  		<?php } ?>
		  		placeholder="Quantity" class="form-control input-md" required="">
		  </div>
		</div>
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="item_available_amount">Available Quantity</label>  
		  <div class="col-md-5">
		  	<input id="item_available_amount" name="item_available_amount" type="text" 
		  		<?php if(isset($item["available_amount"])){ ?>
		  			value="<?= $item["available_amount"] ?>"
		  		<?php } ?>
		  		placeholder="Quantity" class="form-control input-md" required="">
		  </div>
		</div>
			<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="item_price">Price</label>  
		  <div class="col-md-5">
		  	<input id="item_price" name="item_price" type="text" 
		  		<?php if(isset($item["price"])){ ?>
		  			value="<?= $item["price"] ?>"
		  		<?php } ?>
		  		placeholder="Price" class="form-control input-md" required="">
		  </div>
		</div>
			<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="item_purchase_price">Purchase Price</label>  
		  <div class="col-md-5">
		  	<input id="item_purchase_price" name="item_purchase_price" type="text" 
		  		<?php if(isset($item["purchase_price"])){ ?>
		  			value="<?= $item["purchase_price"] ?>"
		  		<?php } ?>
		  		placeholder="Purchase Price" class="form-control input-md" required="">
		  </div>
		</div>
		<br/> 
		<!-- Button (Double) -->
		<div class="form-group">
		  <label class="col-md-6 control-label" for="item_save"></label>
		  	<div class="col-md-6">
		     	<button id="item_reset" name="item_reset" class="btn btn-default" type="reset">Reset</button>  
		    	<button type="submit" id="item_save" name="item_save" class="btn btn-primary">Save</button>
		  	</div>
		</div>
		
		</fieldset>
		<input id="item_id" name="item_id" type="hidden" 
			<?php if(isset($item["id"])){ ?>
		 		value="<?= $item["id"] ?>">
		 <?php } ?>
	</form>
			
	<script type="text/javascript">
    $(document).ready(function() {
        $('#item_form').bootstrapValidator({
            fields: {
            	item_type_id: {
            		message: 'Type is required',
            		validators: {
            			notEmpty: {
                            message: 'Type is required and can\'t be empty'
                        }
                    }
                },
                item_description: {
            		message: 'Description is required',
            		validators: {
            			notEmpty: {
                            message: 'The Description is required and can\'t be empty'
                        }
                    }
                },
                item_amount: {
                    message: 'Quantity is required',
                    validators: {
                    	notEmpty: {
                            message: 'Quantity is required and can\'t be empty'
                        },
                        integer: {
                            message: 'Quantity is not a valid number.'
                        }
                        
                        
                    }
                },
                item_available_amount: {
                    message: 'Available amount is required',
                    validators: {
                    	notEmpty: {
                            message: 'Available amount is required and can\'t be empty'
                        },
                        integer: {
                            message: 'Available amount is not a valid number.'
                        }
                        
                        
                    }
                },
                item_price: {
                    message: 'Price is required',
                    validators: {
                    	notEmpty: {
                            message: 'Price is required and can\'t be empty'
                        },
                        numeric: {
                            message: 'Price is not a valid number.'
                        }
                        
                        
                    }
                },
                item_purchase_price: {
                    message: 'Purchase price is required',
                    validators: {
                    	notEmpty: {
                            message: 'Purchase price is required and can\'t be empty'
                        },
                        numeric: {
                            message: 'Purchase price is not a valid number.'
                        }
                        
                        
                    }
                }
                
                
            }
        });
    });
</script>		
			
			
				
			