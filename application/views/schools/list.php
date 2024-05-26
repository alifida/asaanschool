<?php  ?>

                    <div class="box box-success">
                        <div class="box-header">
                            Schools
                        </div>
                        
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table  table-hover table-responsive dataTables" id="">
                                    <thead>
                                        <tr>
											<th>Name</th>
											<th>Registration No.</th>
											<th>License</th>
											<th>Details</th>
											<th>User Since</th>
											<th class="all disable-sort"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php foreach($schools as $school){ ?>
											<tr>
												<td><?= $school['school_name'] ?></td>
												<td><?= $school['registration_no'] ?></td>
												<td><?= $school['status'] ?></td>
												<td>
													<a href="javascript:void(0);" tabindex="0" class="text-overflow-hide " role="button" data-toggle="popover" data-trigger="focus" title="" data-content="<?= $school['details'] ?>"><?= $school['details'] ?></a>
												</td>
												<td><?= $school['created_at'] ?></td>
												
												<td>
													<div class="btn-group col-centered" >
													  <button type="button" class="btn btn-xs btn-outline btn-success dropdown-toggle" data-toggle="dropdown">
													    <span class="caret"></span> 
													  </button>
													  <ul class="dropdown-menu pull-right" role="menu">
													    <li><a href="<?= site_url("appadmin/schoolDetail") ?>/<?= encodeID($school['id']) ?>/<?= $school['slug'] ?>">Details</a></li>
													    
													    <li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url("appadmin/schoolLicenseStatusForm") ?>/<?= encodeID($school['id']) ?>','License Details');">License Details</a></li>
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
                
