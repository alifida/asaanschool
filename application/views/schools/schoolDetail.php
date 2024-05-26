<?php ?>


<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title"><?= $school["school_name"] ?> </h3>
        
	</div>
	<!-- /.box-header -->
	<div class="box-body table-responsive">
		<div class="row">
			
			<div class="col-lg-7 col-md-7 col-sm-10 col-xs-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
				<h4>School Details</h4>
				<table class="table table-user-information ">
					<tbody>
						<tr>
							<td class="col-lg-4">
								School Name:
							</td>
							<td>
								<?= $school["school_name"] ?>
							</td>
						</tr>
						<tr>
							<td>
								Registration No.:
							</td>
							<td>
								<?= $school["registration_no"] ?>
							</td>
						</tr>
						<tr>
							<?php if(isset( $school["details"]) && !empty( $school["details"])){ ?>
								<td>
									Details:
								</td>
								<td>
									<?= $school["details"] ?>
								</td>
							<?php } ?>
						</tr>
					</tbody>
				</table>
			</div>
			
		
			<div class="col-lg-4 col-md-4">
           		<br/>
           		<div class="row">
	           		<div  class="col-centered col-lg-9 col-md-9 col-sm-4 col-xs-4">
		           		<?php if(isset($school["campus_logo"]) && !empty($school["campus_logo"])){?>
    	       				<img src='<?= $school["campus_logo"] ?>' alt=''  class='img-circle circle_border max-100' />
    	       			<?php } else{?>
    	       				<img src='<?= site_url("public/images/school_logo.png") ?>' alt=''  class='img-circle circle_border max-100' />
    	       			<?php } ?>
	           		</div>
           		</div>
	           	<br/><br/>
			 </div>
			
			
		</div>
		<?php $contactDetail = $school["contactDetail"];
		$data = array();
		$data["contactDetail"] = $contactDetail; 
		
		?>
		 <?php $this->load->view('contactDetail/contactDetail',$data); ?>
	</div>
	<!-- /.box-body -->
	<div class="box-footer">
		<br/>
	</div>
</div>



