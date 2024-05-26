<?php

?>

 		<!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-danger">
                        <div class="box-header">
                            Transaction Types
                            <!--
                            <div class="pull-right " >
						         <div class="btn-group  col-centered">
						              <button type="button" class="btn btn-outline btn-default btn-xs dropdown-toggle " data-toggle="dropdown">
						                    <span class="caret"></span>
						               </button>
						               <ul class="dropdown-menu pull-right" role="menu">
						               		<li><a    href="javascript:void(0);" 
													    	onclick="load_remote_model('<?= site_url('setting/editTransactionType') ?>','Create Transaction Type');">Create New</a></li>
						               </ul>
						            </div>
						    </div>
						    -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive ">
                                <table class="table table-hover simpleDataTables" id="">
                                    <thead>
                                        <tr>
							                <th>Type</th>
											<th class="all disable-sort"  width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php foreach($transactionTypes as $transactionType){ ?>
											<tr>
												<td><?= $transactionType['type'] ?></td>
												
												<td>
													<div class="btn-group col-centered" >
													  <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
													    <span class="caret"></span> 
													  </button>
													  <ul class="dropdown-menu pull-right" role="menu">
													    <li><a href="javascript:void(0);" 
													    	onclick="load_remote_model('<?= site_url('setting/editTransactionType') ?>?id=<?= $transactionType['id'] ?>','Update Transaction Type');">Edit</a></li>
													    	<?php if($transactionType['can_delete'] != "No"){?>
													    		<li><a href="javascript:void(0);" 
													    			onclick="load_remote_model('<?= site_url('setting/deleteConfirmationTransactionType') ?>?id=<?= $transactionType['id'] ?>','Delete Transaction Type');">Delete</a></li>
													  	<?php } ?>
													    
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
