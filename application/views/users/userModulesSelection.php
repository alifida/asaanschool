<?php //pre($appModules) ?>

<div class="box box-success">
	<div class="box-header">
		User Modules 
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="row">
			<div class="col-lg-12">
				<br/>
				<?php if(isset($campusModules) && !empty($campusModules)){ ?>
				<div class="row">
					<?php foreach($campusModules as $key => $campusModule){ ?>
						<?php $key++ ;?>
							<div class="col-lg-6 col-md-6 col-sm-6  col-xs-12">
								<div class="box box-solid bg-green">
									<div class="box-header" style="padding:0px;">
										<div class="row">
											<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
												<h3 class="box-title"><?= $campusModule["module"]['name'] ?> </h3>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
												<div class="checkbox pull-right" style="margin-top: 0px; font-size: 25px; color: #fff">
						  							<label>
							            				<input type="checkbox" name="campusModules[]" value="<?=$campusModule['id'] ?>" 
															<?= isUserModuleSelected($userModules, $campusModule)?" checked='checked'":"" ?> 
														/>
																
							      							<span></span>
							  						</label>
							  					</div>
											</div>
										</div>
									</div>
									<div class="box-body">
					                	<p><?= $campusModule["module"]['description'] ?></p>
									</div>
						            <a href="#" class="small-box-footer">
						            	<br> 
						            </a>
								</div>
							</div>
					<?php }?>
					</div>
				<?php }?>
			</div>
		</div>
	</div>
</div>






	
