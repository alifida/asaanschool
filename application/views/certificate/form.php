<?php //pre($meta)?>
<div class="row">
	<div class="col-md-7 "></div>
	<div class="col-md-5 ">
		<div id="certificate_param_wrapper" class="ui-widget-content dragable_wrapper" style="display: none; float: right;">
					<?php $this->load->view('certificate/params'); ?>
				</div>
	</div>
</div>
<form class="form-horizontal" action="" method="POST" name="certificate_form" id="certificate_form" onsubmit="saveCertificate(); return false;">
	<fieldset>

		<div class="form-group">
			<label class="col-md-3 control-label" for="certificate_name">Name</label>
			<div class="col-md-4">
				<input id="certificate_name" name="certificate_name" type="text" class="form-control input-md" value="<?= isset($certificate["name"])?$certificate["name"]:"" ?>" placeholder="Name" required maxlength="100" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-3 control-label" for="certificate_description">Description</label>
			<div class="col-md-4">
				<textarea id="certificate_description" class="simple_text" name="certificate_description" style="width: 100%"><?= isset($certificate["description"])?$certificate["description"]:"" ?></textarea>
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-3 control-label" for="background_image">Background Image</label>
			<div class="col-md-4">
				<div class="col-centered">
					<div class="row">
						<div id="background_image_container" class="col-centered col-lg-10 col-md-10 col-sm-10 col-xs-10">
    	       				<?php if(isset($certificate["background_image"]) && !empty($certificate["background_image"])){?>
    	       					<img src='<?= $certificate["background_image"] ?>' alt='' class=' max-150' />
    	       				<?php } else{?>
    	       					<img src='<?= site_url("public/images/user_avatar.jpg") ?>' alt='' class='max-150' />
    	       				<?php } ?>
    	       			</div>
						<br />

						<div class="col-centered">
							<span class="btn btn-primary btn-file">Browse <input type="file" id="browse_background_image" name="background_image" onchange="ajax_file_submit('<?= site_url('fileupload/certificateBackgroundImage')?>', 'background_image_container', 'background_image_path','browse_background_image')" />
							</span>
						</div>

					</div>
				</div>
				<br /> <br />
			</div>
		</div>


		<div class="form-group">
			<label class="col-md-3 control-label" for="certificate_linked_with">Linked With</label>
			<div class="col-md-4">
				<span class="radio pull-left" style="margin-top: 0px; font-size: 16px;"> <label style="padding-left: 0px;" for="certificate_linked_with-0"> <input onclick="toggleParameters('1')" type="radio" name="certificate_linked_with" id="certificate_linked_with-0" value="1" <?= (isset($certificate["linked_with"]) && $certificate["linked_with"]=="1")? "checked='checked'":""  ?>> <span> &nbsp;&nbsp;&nbsp;Student</span>
				</label>
				</span> <span class="radio pull-right" style="margin-top: 0px; font-size: 16px;"> <label style="padding-left: 0px;" for="certificate_linked_with-1"> <input onclick="toggleParameters('2')" type="radio" name="certificate_linked_with" id="certificate_linked_with-1" value="2" <?= (isset($certificate["linked_with"]) && $certificate["linked_with"]=="2")? "checked='checked'":""  ?>> <span> &nbsp;&nbsp;&nbsp;Employee</span>
				</label>
				</span>

			</div>
		</div>

		<div class="row">
			<div class="col-lg-12 ">
				<textarea id="certificate_contents" name="certificate_contents"><?= isset($certificate["contents"])?$certificate["contents"]:"" ?></textarea>
			</div>
		</div>
		<div class="row">
			<br />
		</div>
		<div class="row">
			<div class="col-centered">
				<button name="certificate_reset" class="btn btn-default" type="reset">Reset</button>
				&nbsp;&nbsp;&nbsp;
				<button type="submit" id="certificate_save" name="certificate_save" class="btn btn-danger">Save</button>
			</div>
		</div>
		<input type="hidden" name="certificate_id" id="certificate_id" value="<?= isset($certificate["id"])?$certificate["id"]:"" ?>" /> 
		<input type="hidden" name="background_image_path" id="background_image_path" value="" />
	</fieldset>
</form>

<script type="text/javascript">
	$linkedWith="<?= isset($certificate["linked_with"]) ?$certificate["linked_with"]:"" ?>";

toggleParameters($linkedWith);
function toggleParameters(paramFor){
	
	
	$("#certificate_param_wrapper").hide();
	$(".params_container").hide();

	if(paramFor ==1){
		$("#student_params").fadeIn();
	}
	if(paramFor ==2){
		$("#employee_params").fadeIn();
	}
	if(paramFor.length>0){
		$("#certificate_param_wrapper").fadeIn();
	}
}

function saveCertificate(){
	CKupdate();
	$serialized= $("#certificate_form").serialize();
	global_ajax_from_submit('<?= site_url('certificate/save') ?>','','certificate_area', $serialized);
	return false;
}
initCKEditor('certificate_contents');

  $(function() {
    $( "#certificate_param_wrapper" ).draggable({ 
		handle: ".draghandle",
	});
  });

  enable_collapse_data_widget();
  </script>