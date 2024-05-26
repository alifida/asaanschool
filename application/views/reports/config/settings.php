<?php ?>

<div class="box box-primary">
	<div class="box-header">
		Profile <span class="pull-right">
		<a onclick="load_remote_model('<?= site_url("report/editSettings") ?>','Report Settings');enlarge_remote_model();"    
		class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
		</span>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="row">
			<div class="col-centered col-lg-9 col-md-9 col-sm-12 col-xs-12">
				<div class="alert alert-info">
			    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; 
			    	<?= get_app_message("reports.config.message")?>                            
				</div>
			</div>
			<br/>
		</div>
		<div class="row">
			
			<div class="col-lg-7 col-md-7 col-sm-10 col-xs-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
				<h4>Campus Details</h4>
				<table class="table table-user-information ">
					<tbody>
						<tr>
							<td class="col-lg-4">
								Report Title:
							</td>
							<td>
								<?= (isset($reportConf["title"]) && !empty($reportConf["title"]))? $reportConf["title"]: "" ?>
							</td>
						</tr>
						<tr>
							<td>
								Header String:
							</td>
							<td>
								<?= (isset($reportConf["header_string"]) && !empty($reportConf["header_string"]))? $reportConf["header_string"]: "" ?>
							</td>
						</tr>
						<tr>
							<td>
								Logo Width:
							</td>
							<td>
								<?= (isset($reportConf["logo_width"]) && !empty($reportConf["logo_width"]))? $reportConf["logo_width"]: "" ?>
							</td>
						</tr>
						
						
					</tbody>
				</table>
			</div>
			
		
			<div class="col-lg-4 col-md-4">
           		<br/>
           		<div class="row">
	           		<div  class="col-centered col-lg-9 col-md-9 col-sm-4 col-xs-4">
		           		<?php if(isset($reportConf["logo"]) && !empty($reportConf["logo"])){?>
    	       				<img src='<?= $reportConf["logo"] ?>' alt=''  class='max-70' />
    	       			<?php } else{?>
    	       				<img src='<?= site_url("public/images/no-logo.png") ?>' alt=''  class='img-circle circle_border max-70' />
    	       			<?php } ?>
	           		</div>
	           		
           		</div>
	           	<br/><br/>
           		<div class="row">
	           		<div  class="col-centered col-lg-9 col-md-9 col-sm-4 col-xs-4">
		           		<?php if(isset($reportConf["stamp"]) && !empty($reportConf["stamp"])){?>
    	       				<img src='<?= $reportConf["stamp"] ?>' alt=''  class='max-70' />
    	       			<?php } else{?>
    	       				<img src='<?= site_url("public/images/no-logo.png") ?>' alt=''  class='img-circle circle_border max-70' />
    	       			<?php } ?>
	           		</div>
	           		
           		</div>
	           	<br/><br/>
			 </div>
			
			
		</div>

	</div>
	<!-- /.box-body -->
	<div class="box-footer">
		<br/>
	</div>
</div>



