<?php  ?>

                    <div class="box box-danger">
                        <div class="box-header">
                            Students
                            <div class="pull-right " >
						         <div class="btn-group ">
						              <button type="button" onclick="load_remote_model('<?= site_url('student/edit') ?>','New Student');enlarge_remote_model();" 
						              	class="btn btn-outline btn-danger btn-xs">New Student</button>
					            </div>
					            <div class="btn-group ">
						            <button type="button" onclick="javascript:location.href='<?= site_url("student/promoteStudents")?>'" 
						              	class="btn btn-outline btn-danger btn-xs">Promote Students</button> 
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
                                <table class="table  table-hover table-responsive dataTables" id="">
                                    <thead>
                                        <tr>
											<th>Name</th>
											<th>Father Name</th>
											<th>Registration No</th>
											<th>Class (Roll No)</th>
											<th>Dues</th>
											<th class="all disable-sort"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php foreach($defaulters as $student){ ?>
<?php
											 
												
												
												
			$totalDueFee = 0;
			$totalDueItems = 0;
			
			if(isset($student["dueFee"])){
				foreach ($student["dueFee"] as $dueFee){
					$totalDueFee += $dueFee["amount"];
				}
			}
			if(isset($student["dueItem"])){
				foreach ($student["dueItem"] as $dueItem){
					$totalDueItems += $dueItem["due_money"];
				}
			}
			
												
			
			$defaulterData = array() ;
			$defaulterData["student"] = $student;
			$defaulterData["totalDueFee"] = $totalDueFee;
			$defaulterData["totalDueItems"] = $totalDueItems;
												
												
?>
											<tr>
												
												<td>
													<?= $student['first_name'] ?> <?= $student['last_name'] ?>
												</td>
												
												<td><?= $student['father_name'] ?></td>
												<td><?= isset($student['reg_no']) ? $student['reg_no'] :"" ?></td>
												<td ><?= $student["class"]['name'] ?> (<?= $student['roll_no'] ?>)</td>
												<td >
													<div class="btn-group col-centered" style="width: 100% !important" >
														<button class="btn btn-xs btn-outline btn-block btn-warning dropdown-toggle"  data-toggle="dropdown"><?= $totalDueFee + $totalDueItems ?></button>
														<?php $this->load->view('students/defaulter_quick_details', $defaulterData); ?>
													</div>
												</td>
												<td>
													<div class="btn-group col-centered" >
													  <button type="button" class="btn btn-xs btn-outline btn-danger dropdown-toggle" data-toggle="dropdown">
													    <span class="caret"></span> 
													  </button>
													  <ul class="dropdown-menu pull-right" role="menu">
													    <li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('student/quickView') ?>/<?= encodeID($student['id']) ?>','<?= $student["first_name"]." ". $student["last_name"] ?>');enlarge_remote_model();">Quick Payment</a></li>
													    <li><a href="<?= site_url("student/view") ?>/<?= encodeID($student['id']) ?>/<?= $student['slug'] ?>">Details </a></li>
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
                
