<?php

?>

 		<!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            Item Types
                            <div class="pull-right " >
						         <div class="btn-group  col-centered">
						              <button type="button" class="btn btn-outline btn-default btn-xs dropdown-toggle " data-toggle="dropdown">
						                    <span class="caret"></span>
						               </button>
						               <ul class="dropdown-menu pull-right" role="menu">
						               		<li><a    href="javascript:void(0);" 
													    	onclick="load_remote_model('<?= site_url('setting/editItemType') ?>','Create Item Type');">Create New</a></li>
						               </ul>
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
										<?php foreach($itemTypes as $itemType){ ?>
											<tr>
												<td><?= $itemType['name'] ?></td>
												
												<td>
													<div class="btn-group col-centered" >
													  <button type="button" class="btn btn-xs btn-primary btn-outline dropdown-toggle" data-toggle="dropdown">
													    <span class="caret"></span> 
													  </button>
													  <ul class="dropdown-menu pull-right" role="menu">
													    <li><a href="javascript:void(0);" 
													    	onclick="load_remote_model('<?= site_url('setting/editItemType') ?>?id=<?= $itemType['id'] ?>','Update Item Type');">Edit</a></li>
													    <li><a href="javascript:void(0);" 
													    	onclick="load_remote_model('<?= site_url('setting/deleteConfirmationItemType') ?>?id=<?= $itemType['id'] ?>','Delete Item Type');">Delete</a></li>
													   
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
