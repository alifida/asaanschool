<?php

?>

 		
                    <div class="box box-success">
                        <div class="box-header">
                            Class Fee
                            <div class="pull-right " >
						         <div class="btn-group ">
						         	<button type="button" onclick="load_remote_model('<?= site_url('classes/editClassFee') ?>','Create Fee');" 
						              	class="btn btn-outline btn-default btn-xs">New Fee</button>
						         </div>
						         
						         <div class="btn-group ">
						         	<button type="button" onclick="load_remote_model('<?= site_url('classes/deleteDueFeeForm') ?>','Delete Due Fee');" 
						              	class="btn btn-outline btn-default btn-xs">Delete Due Fee</button>
						         </div>
						              
						    </div>
                        </div>
                        <!-- /.box-header -->
                       <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-hover simpleDataTables" id="">
                                    <thead>
                                        <tr>
							                <th>Fee Type</th>
							                <th>Class</th>
							                <th>Amount</th>
											<th class="all disable-sort" width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php foreach($classFees as $classFee){ ?>
											<tr>
												<td><?= $classFee["fee_type"]['type'] ?></td>
												<td><?= $classFee["class"]['name'] ?></td>
												<td><?= $classFee["amount"] ?></td>
												
												<td>
													<div class="btn-group col-centered" >
													  <button type="button" class="btn btn-xs btn-success btn-outline dropdown-toggle" data-toggle="dropdown">
													    <span class="caret"></span>
													  </button>
													  <ul class="dropdown-menu pull-right" role="menu">
													  	<li><a href="javascript:void(0);" 
													    	onclick="load_remote_model('<?= site_url('classes/editClassFee') ?>?id=<?= $classFee['id'] ?>','Update Fee');">Edit</a></li>
													    <li><a href="javascript:void(0);" 
													    	onclick="load_remote_model('<?= site_url('classes/deleteClassFeeForm') ?>?id=<?= $classFee['id'] ?>','Delete Fee');">Delete</a></li>
													    <li class="divider"></li>
													    <li><a href="javascript:void(0);" 
													    	onclick="load_remote_model('<?= site_url('classes/dueFeeForm') ?>?id=<?= $classFee['id'] ?>','Due Fee');">Due Fee</a></li>
													  </ul>
													</div>
												</td>
											</tr>
											<?php } ?>
										</tbody>
                                </table>
                            </div>
                            
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

