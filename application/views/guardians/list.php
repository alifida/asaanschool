<?php   ?>
<div class="box box-primary">
                        <div class="box-header">
                            Guardians
                            <!-- 
                            <div class="pull-right " style="display: none;">
						         <div class="btn-group ">
						         < ?php $addUrl =site_url('guardian/edit');
										if(isset($student_id) && !empty($student_id)){
											$addUrl =$addUrl."?student_id=".$student_id;
										}else{
											if(isset($student) && !empty($student)){
												$addUrl =$addUrl."?student_id=".$student["id"];
											}
										}
						         ? >
						              <button type="button" onclick="load_remote_model('< ?= $addUrl ? >','New Guardian')" 
						              	class="btn btn-outline btn-info btn-xs">New Guardian</button>
						            </div>
						    </div>
                             -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table   table-hover table-responsive dataTables" id="">
                                    <thead>
                                        <tr>
							                <th>Name</th>
											<th>Occupation</th>
											<th>Mobile</th>
											<th class="all disable-sort"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php foreach($guardians as $guardian){ ?>
											<tr>
												<td><?= $guardian['name'] ?></td>
												<td><?= $guardian['occupation'] ?></td>
												<td><?= $guardian['mobile'] ?></td>
												
												<td>
													<div class="btn-group col-centered" >
													  <button type="button" class="btn btn-xs btn-primary btn-outline dropdown-toggle" data-toggle="dropdown">
													    <span class="caret"></span> 
													  </button>
													  <ul class="dropdown-menu pull-right" role="menu">
													    <li><a href="<?= site_url('guardian/view') ."?id=". $guardian['id'] ?>">Details </a></li>
													    <?php $editUrl = site_url('guardian/edit') ."?id=". $guardian['id']; ?>
													    <?php if(isset($student["id"])){
													    	$editUrl = $editUrl."&student_id=".$student["id"];
													    }
													    	?>
													    <li><a href="javascript:void(0);" onclick="load_remote_model('<?= $editUrl ?>','Update Guardian')">Edit</a></li>
													    <li class="divider"></li>
													    <?php if(isset($student["id"]) ){?>
													    	<li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('guardian/unLinkGuardianForm') ?>?student_id=<?= $student['id'] ?>&guardian_id=<?= $guardian['id'] ?>','Un Link Guardian')">Un Link Guardian</a></li>
													    <?php } ?>
													    <li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('guardian/deleteGuardianForm') ?>?id=<?= $guardian['id'] ?>','Delete Guardian')">Delete</a></li>
													    
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
                