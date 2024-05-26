<?php //pre($appModules) ?>
<div class="box box-success">
	<div class="box-header">
		Modules Selection
		
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="row">
			<div class="col-lg-12">
				<br/>
			
				<form action="" method="post" name="campus_module_selection_form" id="campus_module_selection_form" 
					  onsubmit="event.preventDefault(); load_remote_model('<?= site_url("campus/moduleSelectionConfirmation")?>', 'Confirm Modules Selection', $('#campus_module_selection_form').serialize());enlarge_remote_model();">
				<?php if(isset($appModules) && !empty($appModules)){ ?>
				<div class="row">
					<?php foreach($appModules as $key=> $appModule){ ?>
						<?php $key++ ;?>
							<div class="col-lg-4 col-md-6 col-sm-6  col-xs-12">
								<div class="box box-solid bg-green">
									<div class="box-header" style="padding:0px;">
										<div class="row">
											<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
												<h3 class="box-title"><?= $appModule['name'] ?> </h3>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
												<div class="checkbox pull-right" style="margin-top: 0px; font-size: 25px; color: #fff">
						  							<label>
							            				<input type="checkbox" name="modules[]" value="<?=$appModule['id'] ?>" 
																<?= isModuleSelected($campusModules, $appModule)?" checked='checked'":"" ?>  >
							      							<span></span>
							  						</label>
							  					</div>
											</div>
										</div>
									</div>
									<div class="box-body">
					                	<p><?= $appModule['description'] ?></p>
									</div>
						            <a href="#" class="small-box-footer">
						            	<br> 
						            </a>
								</div>
							</div>
					<?php }?>
					</div>
				<?php }?>
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 pull-right">
						<button type="submit" class="btn btn-block btn-lg btn-primary pull-right ">Save</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php  
function isModuleSelected($campusModules, $appModule){
	$isSelected = false;
	foreach ($campusModules as $campusModule){
		if($campusModule["module_id"]==$appModule["id"]){
			$isSelected = true;
			break;
		}
	}
	return $isSelected;
}
?>


	
