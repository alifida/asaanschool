<?php ?>

 		
                    <div class="box box-warning">
                        <div class="box-header">
                            Old Students
                            
                           
                            
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table   table-hover table-responsive dataTables" id="">
                                    <thead>
                                        <tr>
							                <th>First Name</th>
											<th>Last Name</th>
											<th>Father Name</th>
											<th>Registration No</th>
											<th>Roll No</th>
											<th>Class</th>
											<th class="all disable-sort"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php foreach($oldStudents as $student){ ?>
											<tr>
												<td><?= $student['first_name'] ?></td>
												<td><?= $student['last_name'] ?></td>
												<td><?= $student['father_name'] ?></td>
												<td><?= isset($student['reg_no']) ? $student['reg_no'] :"" ?></td>
												<td><?= $student['roll_no'] ?></td>
												<td><?= $student['class']['name'] ?></td>
												<td>
													<div class="btn-group col-centered" >
													  <button type="button" class="btn btn-xs btn-outline btn-warning dropdown-toggle" data-toggle="dropdown">
													    <span class="caret"></span> 
													  </button>
													  <ul class="dropdown-menu pull-right" role="menu">
													    <li><a href="<?= site_url("student/view") ?>/<?= encodeID($student['id']) ?>/<?= $student['slug'] ?>">Details </a></li>
													    <li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('student/edit') ?>?id=<?= $student['id'] ?>','Update Student')">Edit</a></li>
													    
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
                
