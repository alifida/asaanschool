<?php  ?>

                    <div class="box box-danger">
                        <div class="box-header">
                            Bulk Clearance Form
                             
                             <div class="pull-right " >
						         <div class="btn-group ">
						              <button type="button" onclick="student_clearance_confirmation();"  class="btn btn-outline btn-danger btn-xs">Process Bulk</button>
					            </div>
					             
						    </div>
                        </div>
                        
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table  table-hover table-responsive noPaginationDataTables" id="">
                                    <thead>
                                        <tr>
											<th>Name</th>
											<th>Guardian Name</th>
											<th>Registration No</th>
											<th>Class (Roll No)</th>
											<th>Dues</th>
											<th class="all disable-sort">
												<div class="checkbox pull-right checkbox-md" >
            										<label> <input type="checkbox" id="header_students_chkbox" onclick="toggle_all_source_chkbx('header_students_chkbox', 'student_chkbox');" > <span></span></label>
            									</div>
            								</th>
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
            										<div class="checkbox pull-right checkbox-md" >
            											<label> <input class="student_chkbox" type="checkbox" name="studentIds[]" value="<?= $student["id"]  ?>"> <span></span>
            											</label>
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
<script>
	function student_clearance_confirmation(){
		$url = '<?= site_url('student/clear_in_bulk_confirm') ?>?sids='+get_selected_checkbox_by_class('student_chkbox');
		
		load_remote_model($url,'Confirmation');enlarge_remote_model();
		//alert();
	}		
</script>    
