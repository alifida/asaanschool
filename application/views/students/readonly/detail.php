<?php ?>


	           		
	           		
		           


<div class="box box-success">
	<div class="box-header">
		Student Details
		<div class="pull-right " >
	         <div class="btn-group  col-centered">
	              <button type="button" class="btn btn-outline btn-default btn-xs dropdown-toggle " data-toggle="dropdown">
	                    <span class="caret"></span>
	               </button>
	               <ul class="dropdown-menu pull-right" role="menu">
					    <li><a href="<?= site_url('guardians/timetable/') ?><?= $student["class"]["id"] ?>">Timetable</a></li>
					</ul>
	            </div>
	    </div>
	</div>
	<div class="box-body">

	
	
		<div class="row">
			<div  class="col-lg-9 col-md-9 col-sm-8 col-xs-8">
				<br/>
				<table class="table table-user-information"  style="min-height: 130px;">
					<tr>
						<td width="40%">Name:</td>
						<td>
						<?= $student["first_name"] ?>
						<?= $student["last_name"] ?>
							</td>
					</tr>
		
					<tr>
						<td>Father Name:</td>
						<td>
						<?= $student["father_name"] ?>
							</td>
					</tr>
					<tr>
						<td >Class & Roll No.:</td>
						<td>
						<?= $student["class"]['name'] ?> (<?= $student["roll_no"] ?>)
							</td>
					</tr>
		
					<tr>
						<td >Registration No.:</td>
						<td>
							<?= $student["reg_no"] ?>
							</td>
					</tr>
		
					<tr>
						<td>Date Of Birth:</td>
						<td><?= $student["date_of_birth"] ?></td>
					</tr>
					<tr>
						<td>Gender:</td>
						<td><?= $student["gender"] ?></td>
					</tr>
					<tr>
						<td>Admission date:</td>
						<td><?= $student["admission_date"] ?></td>
					</tr>
					<tr>
						<td >Address:</td>
						<td>
						<?= $student["address"] ?>
							</td>
					</tr>
				</table>
			</div>
		
		    <div  class="col-centered col-lg-3 col-md-3 col-sm-4 col-xs-4">
			     <?php if(isset($student["student_picture"]) && !empty($student["student_picture"])){?>
		    	      <img src='<?= $student["student_picture"] ?>' alt=''  class='img-circle circle_border max-100' />
		    	 <?php } else{?>
		    	      <img src='<?= site_url("public/images/student_avatar.png") ?>' alt=''  class='img-circle circle_border max-100' />
		    	  <?php } ?>
			  </div>
		</div>
		

	</div>

</div>





