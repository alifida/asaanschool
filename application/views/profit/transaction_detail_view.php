<?php ?>
<div class="box box-primary">
                        <div class="box-header">
                            Transaction Details
                            <div class="pull-right ">
							<div class="btn-group ">
								<button type="button" class="btn btn-outline btn-default btn-xs">
								<?=	(isset($transaction["updated_at"]))? $transaction["updated_at"]:"" ?>	
								</button>
							</div>
						</div>
                            
                        </div>
                        <div class="box-body">
                        	<div class="row">
                            <div class="col-lg-12">
			                    <div class="alert alert-info">
			                    	<div class="row">
			                    		
				                        <div class="col-lg-3"></div>
				                        <div class="col-lg-6">
			                        		<h4 class="col-centered">Transaction</h4>
			                        	</div>
				                        <div class="col-lg-3">
				                        	<?php if(empty($transaction["profit_id"]) 
					    					&& $transaction["type"]["internal_key"] != "revert.transaction"
					    					&& $transaction["status"] != get_app_message("db.status.reverted")
					    					 ){?>
					                        	<div class="pull-right col-md-offset-3">
													<div class="btn-group ">
														<button type="button" class="btn btn-outline btn-danger btn-xs"
															onclick="load_remote_model('<?= site_url('profit/revertTransactionForm') ?>?id=<?= $transaction['id'] ?>','Revert Transaction');enlarge_remote_model();">
														Revert 
														</button>
													</div>
												</div>
				                        	<?php }?>
					                        </div>
				                        
				                        
			                        	
				                        <div class="col-lg-6 col-md-offset-3">
											<table class="table table-hover" id="">
												<tr>
													<td>Transaction Type: </td>
													<td>
														<strong>
														<?=	(isset($transaction["type"]))? $transaction["type"]["type"]:"" ?>	
												  		 </strong>
												  	</td>
												</tr>
												<tr>
													<td>Amount: </td>
													<td>
														<strong>
													<?=	(isset($transaction["amount"]))? $transaction["amount"]:"" ?>	
												  		 </strong>
												  	</td>
												</tr>
												<tr>
													<td>Remaining Amount: </td>
													<td>
														<strong>
													<?=	(isset($transaction["remaining_amount"]))? $transaction["remaining_amount"]:"" ?>	
												  		 </strong>
												  	</td>
												</tr>
												<?php if(!empty($transaction["status"])){?>
												<tr>
													<td>Status: </td>
													<td>
														<button type="button" class="btn btn-danger"><?= $transaction["status"]?></button>
												  	</td>
												</tr>
												<?php } ?>
											</table>
										</div>
			                        <?php if(isset($transaction["type"]["internal_key"]) && !empty($transaction["type"]["internal_key"])){ ?>
			                      	<?php $internalKey = $transaction["type"]["internal_key"];?>
			                      	<?php if($internalKey == "student.dues.clearance"){
				                      	 	$this->load->view('profit/transaction_details/student_detail'); 
				                      	 }elseif($internalKey == "employee.salaries"){
				                      	 	$this->load->view('profit/transaction_details/employee_detail');
				                      	 }elseif($internalKey == "other.expenses"){
				                      	 	$this->load->view('profit/transaction_details/expense_detail');
				                      	 }elseif($internalKey == "revert.transaction"){
				                      	 	$this->load->view('profit/transaction_details/revert_transaction',array("orignalTransaction"=>$transaction["orignalTransaction"]));
				                      	 }
				                       
			                       	} ?>
			                     </div>
			                </div>
                        </div>
                       </div>
                    </div>
                </div>