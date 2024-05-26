<?php ?>

<form class="form-horizontal" action="<?= site_url('sms/defaultersNotification')?>" method="post" id="defaultersNotificationForm">
<fieldset>
<div class="container-fluid">	
	<div class="row">
		<div class="col-lg-3 col-md-3">
           	<br/>
           	<div  class="col-centered">
	           	<div class="row">
		           	<div  id="student_image_container"  class="col-centered col-lg-8 col-md-8 col-sm-4 col-xs-4">
	    	       			<img src='<?= base_url() ?>public/images/bulk_sms.png' alt=''  class='max-100' />
		           	</div>
	           	</div>
           	</div>
	        <br/><br/>
		</div>
							
		<div class="col-lg-9 col-md-9 col-sm-12  col-xs-12">
		<!-- Text input-->
			
		
		
			<!-- Textarea -->
			<div class="form-group">
			 
			  <div class="col-md-9 pull-right">                     
			    <div class="callout callout-info">
			    	<h4>Message Template</h4>
					<p><?= get_app_message("defaulter.guardian.sms.template")?></p>
				</div>
			  </div>
			</div>
		
		
			<div class="form-group">
			  <label class="col-md-3 control-label" for="issue_item_student_id">Guardians</label>  
			  <div class="col-md-9">
			  		<input id="defaulter_guardians" name="defaulter_guardians" type="text" 
			  		placeholder="Guardian" class="form-control input-md" required="">
			  		<script type="text/javascript">
	                    $(document).ready(function() {
	
	                        $("#defaulter_guardians").tokenInput("<?= site_url('guardian/getAutoComplete') ?>", {
	                        	<?php if (isset($prePopulateGuardian)) { ?>
	                            	prePopulate: <?= $prePopulateGuardian ?>,
								<?php } ?>
	                            theme: "custom"
	                        });
	                    });
	
	                </script>
			  	
			  </div>
			</div>
		
			
		
			
			
		
			
			<!-- Button (Double) -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="defaulter_btn_reset"></label>
			  <div class="col-md-8">
			  	<div class="pull-right">
				    
			    	<button id="defaulter_btn_save" type="submit" name="defaulter_btn_save" class="btn btn-primary ">Send</button>
			  	</div>
			  </div>
			</div>
			
		</div>
	</div>
</div>
</fieldset>
</form>


<!--Validations-->



