<?php //pre($appModules) ?>
<br/>
<?php if(isset($appModules) && !empty($appModules)){ ?>
	<div class="col-centered">
		<div class="alert alert-warning">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Are you sure to use only the following modules? </strong>                            
		</div>
	</div>
	<form action="<?= site_url("campus/saveModulesSelection")?>" method="post" name="campus_module_selection_confirm" >
		<div class="row">
			<?php foreach($appModules as $key=> $appModule){ ?>
				<?php $key++ ;?>
					<div class="col-lg-4 col-md-6 col-sm-6  col-xs-12">
						<div class="box box-solid bg-green">
							<div class="box-header" style="padding:0px;">
								<div class="row">
									<div class="col-lg-12">
										<h3 class="box-title"><?= $appModule['name'] ?> </h3>
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
					<input type="checkbox" name="modules[]" value="<?=$appModule['id'] ?>" checked="checked" style="display:none;" >
			<?php }?>
			</div>
		<div class="row">
			<div class="col-centered">
				<button id="item_delete" name="item_delete" class="btn btn-danger">Yes (Save)</button>
			</div>
		</div>
	</form>
<?php } else{?>
	<div class="col-centered">
		<div class="alert alert-danger">
	    	<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp; Please select atleast one module. </strong>                            
		</div>
	</div>

<?php }?>


	
