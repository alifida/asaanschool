<?php ?>
	<div class="row">
		<div class="col-centered col-lg-9 col-md-9 col-sm-12 col-xs-12">
			<div class="alert alert-warning">
		    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; 
		    	<?= get_app_message("reports.config.message")?>                            
			</div>
		</div>
		<br/>
	</div>
		<div class="row">
			
			
			<div class="col-lg-4 col-md-4">
					<div  id="report_conf_logo_container "  class="col-centered col-lg-8 col-md-8 col-sm-4 col-xs-4">
	           			<a href="javascript:void(0);" tabindex="0" class="btn btn-sm btn-info col-centered " role="button" data-toggle="popover" data-trigger="focus" title="" data-content="<?= get_app_message("help.report.logo") ?>"><span  class="glyphicon glyphicon-info-sign"></span></a>
	           		</div>
           		<br/>
					
           		<div  class="col-centered">
	           		<div class="row">
	           		
		           		<div  id="report_conf_logo_container"  class="col-centered col-lg-8 col-md-8 col-sm-4 col-xs-4">
			           		<?php if(isset($reportConf["logo"]) && !empty($reportConf["logo"])){?>
	    	       				<img src='<?= $reportConf["logo"] ?>' alt=''  class='max-70' />
	    	       			<?php } else{?>
	    	       				<img src='<?= site_url("public/images/no-logo.png") ?>' alt=''  class='img-circle circle_border max-70' />
	    	       			<?php } ?>
		           		</div>
		           		<br/>
           						<div class="col-centered">
	           						<span class="btn btn-primary btn-file">Browse
			    	       				<input type="file" id="browse_file" name="schoolLogo"
	    		       					onchange="ajax_file_submit('<?= site_url('fileupload/uploadReportLogo')?>' , 'report_conf_logo_container' ,'logo_path')" />
									</span>
           						</div>
           						
	           		</div>
           		</div>
           		<br/>
           		<div  id="report_conf_logo_container "  class="col-centered col-lg-8 col-md-8 col-sm-4 col-xs-4">
	           			<a href="javascript:void(0);" tabindex="0" class="btn btn-sm btn-info col-centered " role="button" data-toggle="popover" data-trigger="focus" title="" data-content="<?= get_app_message("help.report.digital.stamp") ?>"><span  class="glyphicon glyphicon-info-sign"></span></a>
	           		</div>
           		<br/>
           		<div  class="col-centered">
	           		<div class="row">
	           		
		           		<div  id="report_digital_stamp_container"  class="col-centered col-lg-8 col-md-8 col-sm-4 col-xs-4">
			           		<?php if(isset($reportConf["stamp"]) && !empty($reportConf["stamp"])){?>
	    	       				<img src='<?= $reportConf["stamp"] ?>' alt=''  class='max-70' />
	    	       			<?php } else{?>
	    	       				<img src='<?= site_url("public/images/no-logo.png") ?>' alt=''  class='img-circle circle_border max-70' />
	    	       			<?php } ?>
		           		</div>
		           		<br/>
           						<div class="col-centered">
	           						<span class="btn btn-primary btn-file">Browse
			    	       				<input type="file" id="browse_file_2" name="digital_stamp"
	    		       					onchange="ajax_file_submit('<?= site_url('fileupload/uploadReportDigitalStamp')?>' , 'report_digital_stamp_container' ,'stamp_path', 'browse_file_2')" />
									</span>
           						</div>
           						
	           		</div>
           		</div>
	           	<br/><br/>
			 </div>
							
			<div class="col-lg-8 col-md-8  col-sm-12  col-xs-12">
           		<form class="form-horizontal" action="<?= site_url('report/saveSettings')?>" method="post" id="report_conf_update_form">
					<fieldset>
						<div class="container-fluid">	
							<div class="row">
								<div class="form-group">
								  	<label class="col-md-4 col-lg-4 col-sm-4 col-xs-4 control-label" for="report_title">Report Title:</label>  
								  	<div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
								  		<input id="report_title" name="report_title" type="text" placeholder="Title" class="form-control input-md" required="required" 
										  <?php if(isset($reportConf["title"])){?>
										  		value="<?= $reportConf["title"] ?>"
										  	<?php } ?>
										  />
								  	</div>
								  	<div class="col-md-2 " >
								  		<a href="javascript:void(0);" tabindex="0" class="btn btn-sm btn-info  " role="button" data-toggle="popover" data-trigger="focus" title="" data-content="<?= get_app_message("help.report.title") ?>"><span  class="glyphicon glyphicon-info-sign"></span></a>
								  	</div>
								</div>
								<div class="form-group">
								  	<label class="col-md-4 col-lg-4 col-sm-4 col-xs-4 control-label" for="header_string">Header String:</label>  
								  	<div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
								  		<input id="header_string" name="header_string" type="text" placeholder="Header String" class="form-control input-md" required="required" 
										  <?php if(isset($reportConf["header_string"])){?>
										  		value="<?= $reportConf["header_string"] ?>"
										  	<?php } ?>
										  />
								  	</div>
								  	<div class="col-md-2">
								  		<a href="javascript:void(0);" tabindex="0" class="btn  btn-sm btn-info  " role="button" data-toggle="popover" data-trigger="focus" title="" data-content="<?= get_app_message("help.report.header.string") ?>"><span  class="glyphicon glyphicon-info-sign"></span></a>
								  	</div>
								</div>
								<div class="form-group">
								  	<label class="col-md-4 col-lg-4 col-sm-4 col-xs-4 control-label" for="logo_width">Logo Width:</label>  
								  	<div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
								  		<input id="logo_width" name="logo_width" type="text" placeholder="Width" class="form-control input-md" required="required" 
										  <?php if(isset($reportConf["logo_width"])){?>
										  		value="<?= $reportConf["logo_width"] ?>"
										  <?php } ?>
										  />
								  	</div>
								  	<div class="col-md-2">
								  		<a href="javascript:void(0);" tabindex="0" class="btn btn-info btn-sm " role="button" data-toggle="popover" data-trigger="focus" title="" data-content="<?= get_app_message("help.report.logo.width") ?>"><span  class="glyphicon glyphicon-info-sign"></span></a>
								  	</div>
								  	
								</div>
								
								<!-- Button (Double) -->
								<div class="form-group">
								  	<label class="col-md-4 col-lg-4 col-sm-4 col-xs-4 control-label" for="campus_btn_reset"></label>
								  	<div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
								  		<div class="pull-right">
									    	<button id="report_conf_btn_reset" name="report_conf_btn_reset" class="btn btn-default" type="reset">Reset</button>
								    		<button id="report_conf_btn_save" type="submit" name="report_conf_btn_save" class="btn btn-primary">Save</button>
								  		</div>
								  	</div>
								</div>
								
							</div>
						</div>
					</fieldset>
					<input type="hidden" id="logo_path" name="logo_path" value=""/>
					<input type="hidden" id="stamp_path" name="stamp_path" value=""/>
				</form>
			</div>
		</div>

		
		
		
		<!--Validations-->
<script type="text/javascript">
    $(document).ready(function() {

    	// enable revalidation of date
    	dateTimePickerRevalidator();
    	
        $('#report_conf_update_form').bootstrapValidator({
        	
            fields: {
            	report_title: {
                    message: 'Report Title is required',
                    validators: {
                        notEmpty: {
                            message: 'Report Title is required and can\'t be empty'
                        }
                        
                    }
                },
                header_string: {
                    message: 'Header String is required',
                    validators: {
                        notEmpty: {
                            message: 'Header String is required and can\'t be empty'
                        }
                        
                    }
                },
                
                logo_width: {
                    message: 'Logo width is required',
                    validators: {
                    	notEmpty: {
                            message: 'Logo width is required and can\'t be empty'
                        },
                        integer : {
    						message : 'Logo width can only be an Integer value.'
    					}
                        
                    }
                }
                
            }
        });

    });
</script>