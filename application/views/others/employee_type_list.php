<?php

?>

 		<!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            Employee Types
                            <div class="pull-right " >
						         <div class="btn-group  col-centered">
						              <button type="button" class="btn btn-outline btn-default btn-xs dropdown-toggle " data-toggle="dropdown">
						                    <span class="caret"></span>
						               </button>
						               <ul class="dropdown-menu pull-right" role="menu">
						               		<li><a href="javascript:void(0);" 
													onclick="load_remote_model('<?= site_url('setting/editEmployeeType') ?>','Create Employee Type');">Create New</a></li>
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
											<th class="all disable-sort"   width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php foreach($employeeTypes as $employeeType){ ?>
											<tr>
												<td><?= $employeeType['type'] ?></td>
												
												<td>
													<div class="btn-group col-centered" >
													  <button type="button" class="btn btn-xs btn-primary btn-outline dropdown-toggle" data-toggle="dropdown">
													   	<span class="caret"></span> 
													  </button>
													  <ul class="dropdown-menu pull-right" role="menu">
													  
													  	<li><a href="javascript:void(0);" 
													    	onclick="load_remote_model('<?= site_url('setting/editEmployeeType') ?>?id=<?= $employeeType['id'] ?>','Update Employee Type');">Edit</a></li>
													    <li><a href="javascript:void(0);" 
													    	onclick="load_remote_model('<?= site_url('setting/deleteConfirmationEmployeeType') ?>?id=<?= $employeeType['id'] ?>','Delete Employee Type');">Delete</a></li>
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
