<?php ?>

<div class="box box-default">
	<div class="box-body">
		<div class="row">
			 
			<div class="col-lg-12">
				<form class="form-horizontal" id="emailForm" action="<?= site_url('email/send'); ?>" method="post">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Compose Email</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">

								<div class="form-group">
									<label class="col-md-2 control-label pull-left" for="to_email">To: </label>
									<div class="col-md-10">
										<input id="to_email" name="to_email" type="text" placeholder="" class="form-control input-md" <?php if(isset($to_email)){?> value="<?= $to_email ?>" <?php } ?> />
									</div>
								</div>
								<?php if(isset($toGroups)){ ?>
								<div class="form-group">
									<label class="col-md-2 control-label pull-left" for="to_email_group">To Group: </label>
									<div class="col-md-10">
										
								    	
								    	
								    	<input type="text" id="to_email_group" name="to_email_group" />
									         
									        <script type="text/javascript">
									        $(document).ready(function() {
									            $("#to_email_group").tokenInput([
									            	<?php foreach($toGroups as $gkey=>$group){ ?>
									    			{id: '<?= $gkey?>', name: "<?= $group?>"},
									    			<?php } ?>
									            ],{
									            	theme: "custom",
										           });
									        });
									        </script>
								    	
									</div>
								</div>
								<?php }		?>
								<div class="form-group">
									<label class="col-md-2 control-label pull-left" for="email_subject">Subject: </label>
									<div class="col-md-10">
										<input id="email_subject" name="email_subject" type="text" placeholder="" class="form-control input-md" <?php if(isset($email_subject)){?> value="<?= $email_subject ?>" <?php } ?> /> <br />

									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-2"></div>
							<div class="col-lg-10">
								<textarea class="textarea form-control" name="email_body" id="email_body" placeholder="" rows="13"><?= (isset($email_body))? $email_body : "" ?></textarea>
							</div>
						</div>
						<br /> <input type="hidden" name="ref_id" id="ref_id" value="<?= (isset($reference_email_user_id)? $reference_email_user_id : "") ?>" /> <input type="hidden" name="email_user_id" id="email_user_id" value="<?= (isset($email_user_id)? $email_user_id : "") ?>" />

						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="btn-toolbar pull-right" role="toolbar">
									<div class="btn-group">
										<button type="button" class="btn btn-default" aria-label="Left Align" onclick=" $('#emailForm').attr('action', '<?= site_url('email/save'); ?>');$('#emailForm').submit();">
											<span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
										</button>
										<button type="button" class="btn btn-default" aria-label="Left Align" onclick=" $('#emailForm').attr('action', '<?= site_url('email/moveToTrash'); ?>/<?= (isset($email_user_id)? $email_user_id : "noId-yet") ?>');$('#emailForm').submit();">
											<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
										</button>
									</div>
									<button type="submit" class="btn btn-primary pull-right">Send</button>
								</div>
								<br />
							</div>
						</div>


						<br /> <br />
					</div>


				</form>
			</div>
			 
		</div>
	</div>
</div>
