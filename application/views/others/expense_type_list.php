<?php

?>

 		<!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-danger">
                        <div class="box-header">
                            Expense Types
                            <div class="pull-right  col-centered" >
						         <div class="btn-group  col-centered">
						              <button type="button" class="btn btn-outline btn-default btn-xs dropdown-toggle " data-toggle="dropdown">
						                    <span class="caret"></span>
						               </button>
						               <ul class="dropdown-menu pull-right" role="menu">
						               		<li><a    href="javascript:void(0);" 
													    	onclick="load_remote_model('<?= site_url('setting/editExpenseType') ?>','Create Expense Type');">Create New</a></li>
						               </ul>
						            </div>
						    </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="">
                                    <thead>
                                        <tr>
							                <th>Type</th>
											<th width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php foreach($expenseTypes as $expenseType){ ?>
											<tr>
												<td><?= $expenseType['type'] ?></td>
												
												<td>
													<div class="btn-group" >
													  <button type="button" class="btn btn-xs btn-danger btn-outline dropdown-toggle" data-toggle="dropdown">
													    <span class="caret"></span>
													  </button>
													  <ul class="dropdown-menu pull-right" role="menu">
													  
													  	<li><a href="javascript:void(0);" 
													    	onclick="load_remote_model('<?= site_url('setting/editExpenseType') ?>?id=<?= $expenseType['id'] ?>','Update Expense Type');">Edit</a></li>
													    		<li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('setting/deleteConfirmationExpenseType') ?>?id=<?= $expenseType['id'] ?>','Delete Expense Type');">Delete</a></li>
													    
													    
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
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
