<?php ?>
 <!-- /.row -->
 
 <?php 
 
 $balance =0;
 $profit =0;
 if(isset($expectedProfit["feeDetails"]["paidFee"])){
 	$balance = $balance + $expectedProfit["feeDetails"]["paidFee"];
 	$profit = $profit + $expectedProfit["feeDetails"]["paidFee"];
 }
 if(isset($expectedProfit["inventoryDetails"]["salePaid"])){
 	$balance = $balance + $expectedProfit["inventoryDetails"]["salePaid"];
 }
 if(isset($expectedProfit["inventoryDetails"]["inventoryProfit"])){
 	$profit = $profit + $expectedProfit["inventoryDetails"]["inventoryProfit"];
 }
 
 if (isset($expectedProfit["expenseDetails"])){
 	$profit = $profit - $expectedProfit["expenseDetails"];
 	$balance = $balance - $expectedProfit["expenseDetails"];
 }
 if (isset($expectedProfit["discountsDetails"])){
 	$profit = $profit - $expectedProfit["discountsDetails"];
 	$balance = $balance - $expectedProfit["discountsDetails"];
 }
 
 
 ?>
 
		
			<!--  <div class="col-lg-4 col-md-6">-->
				
                    
                
                    <div class="box box-success">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-xs-12 text-right">
                                    <div class="big"><?= $profit ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                          	<span class="pull-left"><a>Profit</a></span>
                         	<div class="clearfix"></div>
                        </div>
                    </div>
               		<div class="box box box-primary">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-xs-12 text-right">
                                    <div class="big"><?= $balance ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <span class="pull-left"><a>Balance</a></span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="box box-warning">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-xs-12 text-right">
                                    <div class="big "><?= (isset($expectedProfit["feeDetails"]["paidFee"]))?$expectedProfit["feeDetails"]["paidFee"]:"0"?></div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <span class="pull-left"><a>Paid Fee</a></span>
                         	<div class="clearfix"></div>
                        </div>
                    </div>
                	<div class="box box-danger">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-xs-12 text-right">
                                    <div class="big"><?= (isset($expectedProfit["expenseDetails"]))? $expectedProfit["expenseDetails"]:"0"?></div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <span class="pull-left"><a>Expense</a></span>
                         	<div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="box box-success">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-xs-12 text-right">
                                    <div class="big"><?= (isset( $expectedProfit["inventoryDetails"]["salePaid"]))? $expectedProfit["inventoryDetails"]["salePaid"]:"0"?> / <?=(isset( $expectedProfit["inventoryDetails"]["inventoryProfit"]))? $expectedProfit["inventoryDetails"]["inventoryProfit"]:"0"?></div>
                                </div>
                            </div>
                        </div>
                         <div class="box-footer">
                            <span class="pull-left"><a>Inventory (Sale / Profit)</a></span>
                         	<div class="clearfix"></div>
                        </div>
                    </div>
                
                    
               
                    <div class="box box-info">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-xs-12 text-right">
                                    <div class="big"><?=(isset( $expectedProfit["discountsDetails"]))? $expectedProfit["discountsDetails"] :"0"?></div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <span class="pull-left"><a>Discounts</a></span>
                         	<div class="clearfix"></div>
                        </div>
                        
                    </div>
               
                
         
