<?php

?>

 		<!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            Notifications
                            <div class="pull-right " >
						         <div class="btn-group  col-centered">
						              <button type="button" class="btn btn-outline btn-default btn-xs dropdown-toggle " data-toggle="dropdown">
						                    <span class="caret"></span>
						               </button>
						               <ul class="dropdown-menu pull-right" role="menu">
						               		<li><a href="<?= site_url('notification/edit') ?>"  >New Notification</a></li>
						               </ul>
					            </div>
						    </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                               <table class="table  table-hover table-responsive dataTables" >
                                    <thead>
                                        <tr>
							                <th>Subject</th>
							                <th>Start Date</th>
							                <th>End Date</th>
							                <th>Status</th>
											<th class="all disable-sort"   width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php foreach($notifications as $notification){ ?>
											<tr>
												<td><?= $notification['subject'] ?></td>
												<td><?= $notification['start_date'] ?></td>
												<td><?= $notification['end_date'] ?></td>
												<td><?= $notification['status'] ?></td>
												<td>
													<div class="btn-group col-centered" >
													  <button type="button" class="btn btn-xs btn-primary btn-outline dropdown-toggle" data-toggle="dropdown">
													   	<span class="caret"></span> 
													  </button>
													  <ul class="dropdown-menu pull-right" role="menu">
													  
													  	<li><a href="<?= site_url('notification/edit') ?>?id=<?= $notification['id'] ?>" >Edit</a></li>
													  	 <li><a href="javascript:void(0);"  onclick="load_remote_model('<?= site_url('notification/detail') ?>/<?= $notification['id'] ?>','Detail');">Detail</a></li>
													    <li><a href="javascript:void(0);"  onclick="load_remote_model('<?= site_url('notification/deleteConfirmation') ?>?id=<?= $notification['id'] ?>','Delete Notification');">Delete</a></li>
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
