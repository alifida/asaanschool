<?php

?>

 		<!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-success">
                        <div class="box-header">
                            Fee Types
                            <div class="pull-right " >
                            	<div class="btn-group ">
                					<button type="button" onclick="load_remote_model('<?= site_url('setting/editFeeType') ?>','Create Fee Type');" 
                						class="btn btn-outline btn-default btn-xs">New Fee Type</button>
                				</div>
                             
						    </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-hover simpleDataTables" id="">
                                    <thead>
                                        <tr>
							                <th>Type</th>
											<th class="all disable-sort"  width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php foreach($feeTypes as $feeType){ ?>
											<tr>
												<td><?= $feeType['type'] ?></td>
												
												<td>
													<div class="btn-group col-centered" >
													  <button type="button" class="btn btn-xs btn-success btn-outline dropdown-toggle" data-toggle="dropdown">
													    <span class="caret"></span> 
													  </button>
													  <ul class="dropdown-menu pull-right" role="menu">
													  
													  	<li><a href="javascript:void(0);" 
													    	onclick="load_remote_model('<?= site_url('setting/editFeeType') ?>?id=<?= $feeType['id'] ?>','Update Fee Type');">Edit</a></li>
													    	<?php if($feeType['can_delete'] != "No"){?>
													    		<li><a href="javascript:void(0);" 
													    			onclick="load_remote_model('<?= site_url('setting/deleteConfirmationFeeType') ?>?id=<?= $feeType['id'] ?>','Delete Fee Type');">Delete</a></li>
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
