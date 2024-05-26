<?php //pre($students); ?>
<form action="<?= site_url("attendance/save")?>" method="post">
					<div class="box box-success">
                        <div class="box-header">
                        	<div class="row">
                            <div class=" col-md-3 ">
                            	Attendance 
                            </div>
                            <div class=" col-md-6 text-center ">
                            	<?php if(isset($attendanceLabel)){?>
                            		<button class="btn bg-orange btn-flat " type="button"><?= $attendanceLabel ?></button>
                            	<?php } ?>
                            </div>
                            <div class=" col-md-3 ">
                            	
                            	<div class="pull-right" data-date-format="YYYY-MM-DD" id="attendance_date_wrapper">
								  <div class="input-group">
									  <input id="attendance_date" name="attendance_date" type="text"  class="form-control input-md" required=""
									    <?php if(isset($date)){?>
									  		value="<?= $date ?>"
									  	<?php } ?>
									  />
									  <span class="input-group-addon" style="padding: 6px;">
									  	<span class="glyphicon glyphicon-calendar"></span>
									  </span>
							  	</div>
							  </div>
							  	<?php
							  	
							  	if(isset($students) && !empty($students)){
							  		if(isset($isDetailAvailable) && $isDetailAvailable){
							  			$userId = $students[0]["attendance"]["created_by"];
							  			if(!empty($userId)){
							  				$userId = encodeID($userId);
							  			}
							  			$createdAt = $students[0]["attendance"]["updated_at"];
							  	?>
	                            		<a href="#" data-url="<?= site_url("activity/detailByUser/".$userId."/".$createdAt)?>" data-toggle="dropdown" class=" btn btn-success btn-xs btn-block dropdown-toggle remote-dropdown" style="margin-top:40px;">Activity Details</a>
										<ul class="dropdown-menu " ></ul>
                            	<?php
							  		}
                            	 } 
                            	 ?>
								
								
							</div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body attendance">
                            <div class="table-responsive">
                                <table class="table table-hover" id="">
                                    <thead>
                                        <tr>
							                <th width="7%" class="text-center">S No.</th>
							                <th width="10%" class="text-center">Roll No.</th>
							                <th width="">Name</th>
											<th class="text-center">Attendance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
	                                    <?php $sno = 1;?>
	                                    <?php $allStudentIds = array(); ?>
	                                    	<?php if(isset($students) && !empty($students)){?>
											<?php foreach($students as $student){ ?>
											<?php $allStudentIds[] = encodeID($student["id"]) ;?>
											<tr>
												<td class="text-center"><?= $sno ?></td>
												<td class="text-center"><?= $student["roll_no"] ?></td>
												<td><?= $student['first_name'] ?> <?= $student['last_name']? $student['last_name']:"" ?></td>
												
												<td class="text-center">
													<div class="btn-group " data-toggle="buttons">
														<label class="btn btn-default btn-xs <?= (isset($student["attendance"]["attendance"]) && $student["attendance"]["attendance"] == "P")? " active ":"" ?>">
															<input type="radio" name="stu-<?=  encodeID($student["id"]) ?>" value="P" <?= (isset($student["attendance"]["attendance"]) && $student["attendance"]["attendance"] == "P")? " checked='true' ":"" ?> >Present
														</label>
														<label class="btn btn-default btn-xs <?= (isset($student["attendance"]["attendance"]) && $student["attendance"]["attendance"] == "L")? " active ":"" ?>">
															<input type="radio" name="stu-<?=  encodeID($student["id"]) ?>" value="L" <?= (isset($student["attendance"]["attendance"]) && $student["attendance"]["attendance"] == "L")? " checked='true' ":"" ?> >Leave
														</label>
														<label class="btn btn-default btn-xs <?= (isset($student["attendance"]["attendance"]) && $student["attendance"]["attendance"] == "A")? " active ":"" ?>">
															<input type="radio" name="stu-<?=  encodeID($student["id"]) ?>" value="A" <?= (isset($student["attendance"]["attendance"]) && $student["attendance"]["attendance"] == "A")? " checked='true' ":"" ?> >Absent
														</label>
											      	</div>
													<input type="hidden" name="att-<?=  encodeID($student["id"]) ?>" value="<?= (isset($student["attendance"]["id"]))?encodeID($student["attendance"]["id"]):"" ?>" />
												</td>
											</tr>
											<?php $sno++; ?>
										<?php } ?>
									<?php } ?>
									</tbody>
                                </table>
                            </div>
                            
                            
                        </div><!--body -->
                         <div class="box-footer">
                         	<div class="row">
                            	<div class="col-lg-12">
                            		<div class="pull-right" >
		                            	<button type="submit" class="btn btn-primary">Save</button>
		                            </div>
                            	</div>
                            </div>
                         </div>
                    </div>
                    <!-- /.box -->
                    <input type="hidden" name="all_students" id="all_students" value="<?= implode(",", $allStudentIds); ?>"/>
                    <input type="hidden" name="redirectTo" id="redirectTo" value="<?= isset($redirectTo)? $redirectTo:"" ?>"/>

</form>



          
        