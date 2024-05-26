<?php ?>
<form class="form-horizontal" action="<?= site_url('appadmin/packageSave')?>" method="post" id="package_selection_form">
	<fieldset>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="package_id">Name</label>  
		  <div class="col-md-6">
		  	<select id="package_id" name="package_id"  class="form-control"  required="required" >
		    	<option value=""></option>
		    	<?php if(isset($packages)){ ?>
		    		<?php foreach($packages as $package){ ?>
		    			<?php if($activePackageId != $package["id"]) {?>
		    				<option value="<?= $package["id"]?>" ><?= $package["name"]?> (<?= $package["price"]["price"]?> <?= $package["price"]["currency"]?>) </option>
		    			<?php } ?> 
		    		<?php } ?> 
				<?php }		?>
		      
		    </select>
		  </div>
		</div>
		
		<div class="form-group">
		  <label class="col-md-4 control-label" for="comments">Comments</label>  
		  <div class="col-md-6">
		  	<textarea id="comments" name="comments" rows="4" class="form-control"></textarea>
		  </div>
		</div>
				
		
		<!-- Button (Double) -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="package_btn_reset"></label>
		  <div class="col-md-6 ">
			  <div class="pull-right">
			    <button id="package_btn_reset" name="package_btn_reset" class="btn btn-default" type="reset">Reset</button>
			    <button type="submit" id="package_btn_save" name="package_btn_save" class="btn btn-primary">Save</button>
			  </div>
		  </div>
		</div>
		
		
	</fieldset>
</form>


