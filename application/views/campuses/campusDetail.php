<?php ?>


<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title"><?= $campus["campus_name"] ?> </h3>
        <span class="pull-right" >
			<a href="<?= site_url("campus/edit/".$campus['id']) ?>" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
		</span>
	</div>
	<!-- /.box-header -->
	<div class="box-body table-responsive">
		<div class="row">
			
			<div class="col-lg-7 col-md-7 col-sm-10 col-xs-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
				<h4>Campus Details</h4>
				<table class="table table-user-information ">
					<tbody>
						<tr>
							<td class="col-lg-4">
								Campus Name:
							</td>
							<td>
								<?= $campus["campus_name"] ?>
							</td>
						</tr>
						<tr>
							<td>
								Registration No.:
							</td>
							<td>
								<?= $campus["school"]["registration_no"] ?>
							</td>
						</tr>
						<tr>
							<?php if(isset( $campus["school"]["details"]) && !empty( $campus["school"]["details"])){ ?>
								<td>
									Details:
								</td>
								<td>
									<?= $campus["school"]["details"] ?>
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
		           		<?php if(isset($campus["campus_logo"]) && !empty($campus["campus_logo"])){?>
    	       				<img src='<?= $campus["campus_logo"] ?>' alt=''  class='img-circle circle_border max-100' />
    	       			<?php } else{?>
    	       				<img src='<?= site_url("public/images/school_logo.png") ?>' alt=''  class='img-circle circle_border max-100' />
    	       			<?php } ?>
	           		</div>
           		</div>
	           	<br/><br/>
			 </div>
			
			
		</div>
		<?php $contactDetail = $campus["contactDetail"]; ?>
		<?php if(isset($contactDetail) && !empty($contactDetail)){ ?>
		<?php 
		$data = array();
		$data["contactDetail"] = $contactDetail; 
		
		?>
		 <?php $this->load->view('contactDetail/contactDetail',$data); ?>
		
		
		<?php } ?>
	</div>
	<!-- /.box-body -->
	<div class="box-footer">
		<br/>
	</div>
</div>



