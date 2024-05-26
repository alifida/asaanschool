<?php

?>

 		<!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            Relation Types
                            <div class="pull-right " >
						         <div class="btn-group  col-centered">
						              <button type="button" class="btn btn-outline btn-default btn-xs dropdown-toggle " data-toggle="dropdown">
						                    <span class="caret"></span>
						               </button>
						               <ul class="dropdown-menu pull-right" role="menu">
						               		<li><a    href="javascript:void(0);" 
													    	onclick="load_remote_model('<?= site_url('setting/editRelationType') ?>','Create Relation');">Create New</a></li>
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
										<?php foreach($relationTypes as $relationType){ ?>
											<tr>
												<td><?= $relationType['relation'] ?></td>
												
												<td>
													<div class="btn-group col-centered" >
													  <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
													    <span class="caret"></span> 
													  </button>
													  <ul class="dropdown-menu pull-right" role="menu">
													    <li><a href="javascript:void(0);" 
													    	onclick="load_remote_model('<?= site_url('setting/editRelationType') ?>?id=<?= $relationType['id'] ?>','Update Relation');">Edit</a></li>
											    		<li><a href="javascript:void(0);" 
											    			onclick="load_remote_model('<?= site_url('setting/deleteConfirmationRelationType') ?>?id=<?= $relationType['id'] ?>','Delete Relation');">Delete</a></li>
													    
													    <!-- <li><a href="#">Related Students</a></li> --> 
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
