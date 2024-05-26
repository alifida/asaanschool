<?php  ?>

                    <div class="box box-success">
                        <div class="box-header">
                            Dependents
                            <div class="pull-right " >
								<div class="btn-group ">
						            <button type="button" onclick="javascript:location.href='<?= site_url("guardians/dues")?>'" 
						              	class="btn  btn-danger btn-xs">Total Dues</button> 
					            </div>
						    </div>
                        </div>
                        
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table  table-hover table-responsive dataTables" id="">
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
													    <li><a href="<?= site_url("guardians/dependent") ?>/<?= encodeID($student['id']) ?>/<?= $student['slug'] ?>">Details </a></li>
													    <li><a href="<?= site_url("guardians/timetable") ?>/<?= $student["class"]['id'] ?>">Timetable </a></li>
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
                
