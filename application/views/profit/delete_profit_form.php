<?php ?>
	
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; 
	    	By Deleting the Following profit, all of its related transactions will be unlocked and can be modified, but these transactions will be mixed with current opened transactions.<br/>
	    	Please avoid delete the profit entries, unless it is really required.
	    	<br/><br/>Are you sure to <strong>Delete </strong> the following profit?                            
		</div>
	</div>
	<br/>
	<form class="form-horizontal" action="<?= site_url('profit/deleteProfit') ?>" method="post">
		<fieldset>
			
            <div class="row" >
                <div class="col-lg-4">
            		<div class="box box-success ">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-xs-12 text-right">
                                    <div class="big"><?= $profit["profit_amount"] ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                          	<span class="pull-left"><a>Profit</a></span>
                         	<div class="clearfix"></div>
                        </div>
                    </div>
                 </div>
                 <div class="col-lg-4">
               		<div class="box box box-primary">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-xs-12 text-right">
                                    <div class="big"><?= $profit["balance_amount"] ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                          	<span class="pull-left"><a>Balance</a></span>
                         	<div class="clearfix"></div>
                        </div>
                    </div>
                 </div>
                 <div class="col-lg-4">                    
                    <div class="box box-warning">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-xs-12 text-right">
                                    <div class="big "><?= (isset($feeProfit["paidFee"]))?$feeProfit["paidFee"]:"0"?></div>
                                </div>
                            </div>
                        </div>
                         <div class="box-footer">
                          	<span class="pull-left"><a>Fee Paid</a></span>
                         	<div class="clearfix"></div>
                        </div>
                    </div>
                 </div>
                 <div class="col-lg-4">                    
                	<div class="box box-danger">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-xs-12 text-right">
                                     <div class="big "><?= (isset($expense))?$expense:"0"?></div>
                                </div>
                            </div>
                        </div>
                         <div class="box-footer">
                          	<span class="pull-left"><a>Expense</a></span>
                         	<div class="clearfix"></div>
                        </div>
                    </div>
                 </div>
                 <div class="col-lg-4">                    
                    <div class="box box-success">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-xs-12 text-right">
                                    <div class="big"><?= (isset( $inventoryDetails["salePaid"]))? $inventoryDetails["salePaid"]:"0"?> / <?=(isset( $inventoryDetails["inventoryProfit"]))? $inventoryDetails["inventoryProfit"]:"0"?></div>
                                </div>
                            </div>
                        </div>
                         <div class="box-footer">
                          	<span class="pull-left"><a>Inventory (Sale / Profit)</a></span>
                         	<div class="clearfix"></div>
                        </div>
                    </div>
                 </div>
                 <div class="col-lg-4">                
                    <div class="box box-info">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-xs-12 text-right">
                                    <div class="big"><?=(isset( $discount))? $discount :"0"?></div>
                                </div>
                            </div>
                        </div>
                         <div class="box-footer">
                          	<span class="pull-left"><a>Discount</a></span>
                         	<div class="clearfix"></div>
                        </div>
                    </div>
               
            	</div>
            </div>
            <div class="row" data-columns="" id="columns">
                <div class="col-lg-12">
            		<?php $this->load->view('profit/profit_related_transactions'); ?>
            	</div>
         	</div>
		<br/> 
		<!-- Button (Double) -->
		  	<div class="col-centered">
		    	<button id="profit_delete" name="profit_delete" class="btn btn-danger">Yes (Delete)</button>
		  	</div>
		</fieldset>
		<input id="is_confirmed" name="is_confirmed" type="hidden" value="yes">
		<input id="profit_id" name="profit_id" type="hidden" value="<?= $profit["id"]?>">
	</form>
				
			