<?php

?>

 		<!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-danger">
                        <div class="box-header">
                            Active Expense 
                            <div class="pull-right " >
						         <div class="btn-group  col-centered">
						              <button type="button" class="btn btn-outline btn-default btn-xs dropdown-toggle " data-toggle="dropdown">
						                    <span class="caret"></span>
						               </button>
						               <ul class="dropdown-menu pull-right" role="menu">
						               		<li><a    href="javascript:void(0);" 
													    	onclick="load_remote_model('<?= site_url('expense/editExpense') ?>','Create Expense');">Create New</a></li>
						               </ul>
						            </div>
						    </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table  table-hover table-responsive " id="activeExpensesList">
                                    <thead>
                                        <tr>
							                <th>Type</th>
							                <th>Description</th>
							                <th>Date</th>
							                <th>Amount</th>
							                <th width="20%">Comments</th>
											<th class="all disable-sort"  width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php foreach($activeExpenses as $expense){ ?>
											<tr>
												<td><?= $expense['type']["type"] ?></td>
												<td><?= $expense['description'] ?></td>
												<td><?= $expense['expense_date'] ?></td>
												<td><?= $expense['amount'] ?></td>
												<td>
													<a href="javascript:void(0);" tabindex="0" class="text-overflow-hide " role="button" data-toggle="popover" data-trigger="focus" title="" data-content="<?= $expense['comments'] ?>"><?= $expense['comments'] ?></a>
												<td>
													<div class="btn-group col-centered" >
													  <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
													    <span class="caret"></span> 
													  </button>
													  <ul class="dropdown-menu pull-right" role="menu">
													  	
													    <?php if($expense["status"]== get_app_message("db.status.active")){?>
													  	<li><a href="javascript:void(0);" 
													    	onclick="load_remote_model('<?= site_url('expense/editExpense') ?>?id=<?= $expense['id'] ?>','Update Expense');">Edit</a></li>
													  <?php }?>
													  	<li>
													  	<a href="javascript:void(0);" 
													    	onclick="load_remote_model('<?= site_url('expense/detailView') ?>?id=<?= $expense['id'] ?>','Expense Details');">Detail</a></li>
													    	
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
