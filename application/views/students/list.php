<?php  ?>

                    <div class="box box-success">
                        <div class="box-header">
                            Students
                            
                            <div class="pull-right " >
						         <div class="btn-group ">
						              <button type="button" onclick="load_remote_model('<?= site_url('student/edit') ?>','New Student');enlarge_remote_model();" 
						              	class="btn btn-outline btn-success btn-xs">New Student</button>
					            </div>
					            <div class="btn-group ">
						            <button type="button" onclick="javascript:location.href='<?= site_url("student/promoteStudents")?>'" 
						              	class="btn btn-outline btn-success btn-xs">Promote Students</button> 
					            </div>
								<div class="btn-group ">
						            <button type="button" onclick="javascript:location.href='<?= site_url("student/dues")?>'" 
						              	class="btn  btn-danger btn-xs">Total Dues</button> 
					            </div>
						    </div>
                        </div>
                        
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table  class="table  table-hover table-responsive dataTables" id="my_st_tbl">
                                	 
                                    <thead>
                                        <tr>
											<th>Name</th>
											<th>Father Name</th>
											<th>Registration No</th>
											<th>Roll No</th>
											<th>Class</th>
											<th>Date of Birth</th>
											<th class="all disable-sort"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php foreach($students as $student){ ?>
											<tr>
												<td><?= $student['first_name'] ?> <?= $student['last_name'] ?></td>
												<td><?= $student['father_name'] ?></td>
												<td><?= isset($student['reg_no']) ? $student['reg_no'] :"" ?></td>
												<td><?= $student['roll_no'] ?></td>
												<td><?= $student["class"]['name'] ?></td>
												<td><?= $student["date_of_birth"] ?></td>
												<td>
													<div class="btn-group col-centered" >
													  <button type="button" class="btn btn-xs btn-outline btn-success dropdown-toggle" data-toggle="dropdown">
													    <span class="caret"></span> 
													  </button>
													  <ul class="dropdown-menu pull-right" role="menu">
													    <li><a href="<?= site_url("student/view") ?>/<?= encodeID($student['id']) ?>/<?= $student['slug'] ?>">Details </a></li>
													    <li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('student/edit') ?>/<?= encodeID($student['id']) ?>','Update Student');enlarge_remote_model();">Edit</a></li>
													    <li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('guardian/edit') ?>?student_id=<?= $student['id'] ?>','Add New Guardian')">Add New Guardian</a></li>
													    <li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('guardian/linkGuardianForm') ?>?student_id=<?= $student['id'] ?>','Link Guardian')">Link Guardian</a></li>
													    <li class="divider"></li>
													    <li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('inventory/issueForm') ?>?student_id=<?= $student['id'] ?>&redirectURL=<?=  $_SERVER['REQUEST_URI'] ?>','Issue Item');">Issue Item</a></li>
													    <li class="divider"></li>
													    <li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('student/unrollForm') ?>?id=<?= $student['id'] ?>','Update Student')">Unroll</a></li>
													    <?php if(isset($certificates) && !empty($certificates)){?>
													    	<li>
																<a class="trigger left-caret">Certificates</a>
																<ul class="dropdown-menu sub-menu sub-menu-left">
																<?php foreach ($certificates as $certificate){ ?>
																	<li><a href="<?= site_url('certificate/printCertificate/'.encodeID($certificate["id"]).'/'.encodeID($student['id'])) ?>" target="_blank" ><?= $certificate["name"] ?></a></li>
																<?php } ?>
																</ul>
															</li>
													    <?php }?>
													    <li>
													    	<ul class="dropdown-menu pull-right" role="menu">
													    		<li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('inventory/issueForm') ?>?student_id=<?= $student['id'] ?>&redirectURL=<?=  $_SERVER['REQUEST_URI'] ?>','Issue Item');">Issue Item</a></li>
													    	</ul>
													    </li>
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
                
