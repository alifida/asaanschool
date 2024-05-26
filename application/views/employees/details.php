<?php ?>



<div class="box box-success">
	<div class="box-header">
		Details
		
		<div class="pull-right " >
	         <div class="btn-group col-centered ">
	              <button type="button" class="btn btn-outline btn-default btn-xs dropdown-toggle " data-toggle="dropdown">
	                    <span class="caret"></span>
	               </button>
	               <ul class="dropdown-menu pull-right" role="menu">
					    <li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('employee/editEmployee') ?>?id=<?= $employee['id'] ?>','Update Employee');enlarge_remote_model();">Edit</a></li>
					    <li class="divider"></li>
					    <?php if(isset($certificates) && !empty($certificates)){?>
					    	<li>
								<a class="trigger left-caret">Certificates</a>
								<ul class="dropdown-menu sub-menu sub-menu-left">
								<?php foreach ($certificates as $certificate){ ?>
									<li><a href="<?= site_url('certificate/printCertificate/'.encodeID($certificate["id"]).'/'.encodeID($employee['id'])) ?>" target="_blank" ><?= $certificate["name"] ?></a></li>
								<?php } ?>
								</ul>
							</li>
					    <?php }?>
					    <li><a href="javascript:void(0);" onclick="load_remote_model('<?= site_url('employee/unrollEmployeeForm') ?>?id=<?= $employee['id'] ?>','Unroll Employee');">Unroll</a></li>
					</ul>
	            </div>
	    </div>
	
	</div>
	<div class="box-body">
		<div class="row">
		<div class="col-lg-1 col-md-1"></div>
			<div  class="col-lg-7 col-md-7 col-sm-8 col-xs-8">
				<br/>
				<table  class="table table-user-information"   style="min-height: 130px;">
					<tr>
						<td width="40%">Name:</td>
						<td>
						<?= $employee["first_name"] ?>
						<?= $employee["last_name"] ?>
							</td>
					</tr>
		
					<tr>
						<td>Type:</td>
						<td>
						<?= $employee["type"]["type"] ?>
							</td>
					</tr>
					<tr>
						<td >CNIC No.:</td>
						<td>
						<?= $employee["cnic"] ?>
							</td>
					</tr>
		
					<tr>
						<td >Email:</td>
						<td>
						<?= $employee["email"] ?>
							</td>
					</tr>
		
					<tr>
						<td >Address:</td>
						<td>
						<?= $employee["address"] ?>
							</td>
					</tr>
					<tr>
						<td>Salary:</td>
						<td>
						<?= $employee["salary"] ?>
							</td>
					</tr>
					<tr>
						<td>Qualification:</td>
						<td>
						<?= $employee["qualification"] ?>
							</td>
					</tr>
					
					<tr>
						<td>Joining Date:</td>
						<td>
						<?= $employee["date_of_joining"] ?>
							</td>
					</tr>
					<?php if(!empty($employee["date_of_resigning"])){?>
					<tr>
						<td>Resigning Date:</td>
						<td>
						<?= $employee["date_of_resigning"] ?>
							</td>
					</tr>
					<?php } ?>
					
					
					
				</table>
			</div>
		
		    <div  class="col-centered col-lg-3 col-md-3 col-sm-4 col-xs-4">
			     <?php if(isset($employee["employee_picture"]) && !empty($employee["employee_picture"])){?>
		    	      <img src='<?= $employee["employee_picture"] ?>' alt=''  class='img-circle circle_border max-100' />
		    	 <?php } else{?>
		    	      <img src='<?= site_url("public/images/employee_avatar.png") ?>' alt=''  class='img-circle circle_border max-100' />
		    	  <?php } ?>
			 </div>
			 <div class="col-lg-1 col-md-1"></div>
		</div>
	</div>

</div>


