<?php ?>
<section class="content-header">
	<h1>Notifications</h1>
</section>
<section class="content">
	<div class="box box-default">
		<div class="box-body">
			<div class="row">
				<div class="col-lg-1"></div>
				<div class="col-lg-10">
					<form class="form-horizontal" id="notificationForm"
						action="<?= site_url('notification/save'); ?>" method="post">

						<div class="modal-body">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label class="col-md-1 control-label pull-left"
											for="notification_subject">Subject: </label>
										<div class="col-md-11">
											<input id="notification_subject" name="notification_subject"
												type="text" placeholder="" class="form-control input-md"
												value="<?= (isset($notification['subject']))? $notification['subject'] : "" ?>" />
											<br />
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group">
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
										<label class="col-md-12   " for="notification_status">Status</label>
										<div class="col-md-12">
											<select id="notification_status" name="status"
												class="form-control  " required="required">
												<option value=""></option>
												<option
													value="<?= get_app_message("post.status.published")?>"
													<?= (isset($notification["status"]) && get_app_message("post.status.published")==$notification["status"])? "	selected ":""; ?>><?= get_app_message("post.status.published")?></option>
												<option value="<?= get_app_message("post.status.draft")?>"
													<?= (isset($notification["status"]) && get_app_message("post.status.draft")==$notification["status"])? "	selected ":""; ?>><?= get_app_message("post.status.draft")?></option>
												<option value="<?= get_app_message("post.status.trash")?>"
													<?= (isset($notification["status"]) && get_app_message("post.status.trash")==$notification["status"])? "	selected ":""; ?>><?= get_app_message("post.status.trash")?></option>
											</select>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
										<label class="col-md-12   " for="start_at">Start Date</label>
										<div class="col-lg-12 date " data-date-format="YYYY-MM-DD">
											<div class="input-group">
												<input readonly="readonly"
													value="<?= isset($notification["start_date"])?$notification["start_date"]:"" ?>"
													id="start_date" name="start_date" type="text"
													class="form-control input-md  " required=""> <span
													class="input-group-addon" style="padding: 6px;"> <span
													class="glyphicon glyphicon-calendar"></span>
											
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
										<label class="col-md-12   " for="end_date">End Date</label>
										<div class="col-lg-12 date " data-date-format="YYYY-MM-DD">
											<div class="input-group">
												<input readonly="readonly"
													value="<?= isset($notification["end_date"])?$notification["end_date"]:"" ?>"
													id="end_date" name="end_date" type="text"
													class="form-control input-md  " required=""> <span
													class="input-group-addon" style="padding: 6px;"> <span
													class="glyphicon glyphicon-calendar"></span>
											
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
										<label class="col-md-12  col-centered " for="send_email_alert">Send Email
											right away</label>
										<div class="col-lg-12 ">
											<span class="checkbox " style="margin-top: 0px; font-size: 16px; color: #367fa9">
					  							<label class="col-centered">
						            				<input type="checkbox" name="send_email_alert" value="yes"  >
						      							<span></span>
						  						</label>
					  						</span> 
										</div>
									</div>

								</div>

							</div>
							<div class="row">
								<div class="col-lg-12">
									<textarea class="textarea form-control"
										name="notification_body" id="notification_body" placeholder=""
										rows="13"><?= (isset($notification['body']))? $notification['body'] : "" ?></textarea>
								</div>
							</div>
							<br /> <input type="hidden" name="notification_id"
								value="<?= (isset($notification['id']))? $notification['id'] : "" ?>" />

							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="btn-toolbar pull-right" role="toolbar">
										<button type="submit" class="btn btn-primary pull-right">Save</button>
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
</section>
<script type="text/javascript">
	$(function() {
		var nowDate = new Date();
		$('.date').datetimepicker({
			useCurrent:false,
			pickTime: false
		});
	});


</script>
